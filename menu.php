<?php
session_start();
require("config.php");
$title_page = 'Menu';
require_once("header.php");

if (isset($_POST['pizza_id'])) {
    $id = $_POST['pizza_id'];

    // Get the price of the pizza
    $qry = $conn->query("SELECT price FROM Pizzas WHERE id = '$id'");
    $bill = $qry->fetch()['price'];

    $current = date('c');
    $randomTime = time() + rand(60, 60*60);
    $date_delivery = date('c', $randomTime);

    // Get one random driver
    $qry = $conn->query("SELECT id FROM Members WHERE role = 'Driver' ORDER BY RAND() LIMIT 1;");
    $id_driver = $qry->fetch()['id'];

    $qry = $conn->prepare("INSERT INTO Orders (bill, date_order, date_delivery, id_client, id_driver)
    VALUES(?, ?, ?, ?, ?)");
    $qry->execute(array($bill, $current, $date_delivery, $_SESSION['id'], $id_driver));

    // Get id of the order in the previous SQL query
    $qry = $conn->query("SELECT * FROM Orders ORDER BY id DESC LIMIT 1");
    $data = $qry->fetch();

    $qry = $conn->prepare("INSERT INTO Associate (id_pizza, id_order)
    VALUES(?, ?)");
    $qry->execute(array($id, $data['id']));
}
?>

<body>
    <h1>Menu</h1>
    <div id="contener">
    <?php
    $pizza_qry = $conn->query("SELECT * FROM Pizzas ORDER BY Pizzas.name");

    while ($pizzas_data = $pizza_qry->fetch()) {
        $pizza_id = $pizzas_data['id'];
        $pizza_name = $pizzas_data['name'];
        $pizza_img = $pizzas_data['img'];
        $pizza_price = $pizzas_data['price'];

        echo '
        <div class="element">
        <h3>'.$pizza_name.' : '.$pizza_price.'€</h3>

        <img src="'.$pizza_img.'">

        <ul>';
        $ingredient_qry = $conn->query("SELECT Ingredients.name AS n
            FROM Pizzas
            INNER JOIN Contain ON Pizzas.id = Contain.id_pizza
            INNER JOIN Ingredients ON Contain.id_ingredient = Ingredients.id
            WHERE Pizzas.name = '$pizza_name'
            ORDER BY n");
        while ($ingredient_data = $ingredient_qry->fetch()) {
            echo '<li>'.$ingredient_data['n'].'</li>';
        }
        echo '</ul>';
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Client') {
            echo '
            <form method="post">
                <input type="text" name="pizza_id" value="'.$pizza_id.'" hidden/>
                <input type="submit" value="Add" style="text-align: center">
            </form>
            ';
        }
        echo '</div>';
    }
    ?>
    </div>
</body>

<?php require_once("footer.php") ?>
