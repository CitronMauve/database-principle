<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
require("config.php");
$title_page = 'My orders';
require_once("header.php");
?>

<body>
    <h1>My orders</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Bill (€)</th>
            <th>Pizza</th>
            <th>Date order</th>
            <th>Date delivery</th>
            <th><?php echo $_SESSION['role'] === 'Client' ? 'Driver' : 'Client'; ?></th>
        </tr>
        <?php
        $id = $_SESSION['id'];
        $clientQry = "SELECT bill, date_order, date_delivery, id_client, id_driver, lastname, firstname, name
            FROM Orders
                INNER JOIN Members ON Members.id = id_driver
                INNER JOIN Associate ON Associate.id_order = Orders.id
                INNER JOIN Pizzas ON Pizzas.id = id_pizza
            WHERE id_client = '$id';";
        $driverQry = "SELECT bill, date_order, date_delivery, id_client, id_driver, lastname, firstname, name
            FROM Orders
                INNER JOIN Members ON Members.id = id_driver
                INNER JOIN Associate ON Associate.id_order = Orders.id
                INNER JOIN Pizzas ON Pizzas.id = id_pizza
            WHERE id_driver = '$id';";
        $qry = $_SESSION['role'] === 'Client' ?
            $conn->query($clientQry) :
            $conn->query($driverQry);

        while ($data = $qry->fetch()) {
            $bill = $data['bill'];
            $dOrder = $data['date_order'];
            $dDelivery = $data['date_delivery'];
            $idOrder = $_SESSION['role'] === 'Client' ?
                $data['id_driver'] :
                $data['id_client'];
            $lastname = $data['lastname'];
            $firstname = $data['firstname'];
            $name = $data['name'];

            echo '
            <tr>
            <td>'.$bill.'</td>
            <td>'.$name.'</td>
            <td>'.$dOrder.'</td>
            <td>'.$dDelivery.'</td>
            <td>'.$lastname.' '.$firstname.'</td>
            </tr>';
        }
        ?>
    </table>
    </div>
</body>

<?php require_once("footer.php") ?>
