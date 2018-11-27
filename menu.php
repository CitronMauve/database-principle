<?php
session_start();
require("config.php");
$title_page = 'Menu';
require_once("header.php");
?>

<body>
    <h1>Menu</h1>
    <div id="contener">
    <?php
    $pizza_qry = $conn->query("SELECT name, img, price
        FROM Pizzas
        ORDER BY Pizzas.name");

    while ($pizzas_data = $pizza_qry->fetch()) {
        $pizza_name = $pizzas_data['name'];
        $pizza_img = $pizzas_data['img'];
        $pizza_price = $pizzas_data['price'];

        echo '<div class="element">';
        echo '<h3>'.$pizza_name.' : '.$pizza_price.'€</h3>';

        echo '<img src="'.$pizza_img.'">';

        echo '<ul>';
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
        echo '</div>';
    }
    ?>
    </div>
</body>

<?php require_once("footer.php") ?>
