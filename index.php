<?php
session_start();
require("config.php");
$title_page = 'Home';
require_once("header.php");
?>

<body>
    <h1>Home</h1>
    <ul>
    <li>
        # Kind of pizza:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*)
            FROM Pizzas");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Most popular pizza:
        <?php
        $best_qry = $conn->query("SELECT Pizzas.name, COUNT(Pizzas.id)
            FROM Pizzas
            INNER JOIN Associate ON Associate.id_pizza = Pizzas.id
            GROUP BY Pizzas.id
            ORDER BY COUNT(Pizzas.id) DESC LIMIT 1 OFFSET 0");
        $best_data = $best_qry->fetch();
        echo $best_data['name'];
        ?>
    </li>
    <br>
    <li>
        # Ingredients:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*)
            FROM Ingredients");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Most popular ingredient:
        <?php
        $best_qry = $conn->query("SELECT Ingredients.name, COUNT(Ingredients.id)
            FROM Ingredients
            INNER JOIN Contain ON Contain.id_ingredient = Ingredients.id
            GROUP BY Ingredients.id
            ORDER BY COUNT(Ingredients.id) DESC LIMIT 1 OFFSET 0");
        $best_data = $best_qry->fetch();
        echo $best_data['name'];
        ?>
    </li>
    <br>
    <li>
        # Clients:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*)
            FROM Clients");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Best client:
        <?php
        $best_qry = $conn->query("SELECT Clients.lastname, Clients.firstname, SUM(bill)
            FROM Orders
            INNER JOIN Clients ON Orders.id_client = Clients.id
            GROUP BY Orders.id_client
            ORDER BY SUM(bill) DESC LIMIT 1 OFFSET 0");
        $best_data = $best_qry->fetch();
        echo $best_data['lastname'].' '.$best_data['firstname'];
        ?>
    </li>
    <br>
    <li>
        # Drivers:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*)
            FROM Drivers");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Driver with the most delay:
        <?php
        $worst_qry = $conn->query("SELECT Drivers.lastname, Drivers.firstname, COUNT(Drivers.id)
            FROM Drivers
            INNER JOIN Deliver ON Drivers.id = id_driver
            INNER JOIN Orders ON Deliver.id_order = Orders.id
            WHERE TIMESTAMPDIFF(MINUTE, Orders.date_order, Orders.date_delivery) > 30
            GROUP BY Drivers.id
            ORDER BY COUNT(Drivers.id) DESC LIMIT 1 OFFSET 0;");
        $worst_data = $worst_qry->fetch();
        echo $worst_data['lastname'].' '.$worst_data['firstname'];
        ?>
    </li>
    <br>
    <li>
        # Sales:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*)
            FROM Orders");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Average bill (€):
        <?php
        $avg_qry = $conn->query("SELECT AVG(bill)
            FROM Orders");
        $avg_data = $avg_qry->fetch();
        echo $avg_data['AVG(bill)'];
        ?>
    </li>
    </ul>
</body>

<?php require_once("footer.php") ?>
