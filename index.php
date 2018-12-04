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
        $count_qry = $conn->query("SELECT COUNT(*) FROM Pizzas;");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Most popular pizza:
        <?php
        $best_qry = $conn->query("SELECT name, COUNT(Pizzas.id)
            FROM Pizzas
                INNER JOIN Associate ON id_pizza = Pizzas.id
            GROUP BY Pizzas.id
            ORDER BY COUNT(Pizzas.id) DESC LIMIT 1 OFFSET 0;");
        $best_data = $best_qry->fetch();
        echo $best_data['name'];
        ?>
    </li>
    <br>
    <li>
        # Ingredients:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*) FROM Ingredients;");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Most popular ingredient:
        <?php
        $best_qry = $conn->query("SELECT name, COUNT(Ingredients.id)
            FROM Ingredients
                INNER JOIN Contain ON id_ingredient = Ingredients.id
            GROUP BY Ingredients.id
            ORDER BY COUNT(Ingredients.id) DESC LIMIT 1 OFFSET 0;");
        $best_data = $best_qry->fetch();
        echo $best_data['name'];
        ?>
    </li>
    <br>
    <li>
        # Clients:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*) FROM Members WHERE role = 'Client';");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Best client:
        <?php
        $best_qry = $conn->query("SELECT lastname, firstname, SUM(bill)
            FROM Orders
                INNER JOIN Members ON id_client = Members.id
            GROUP BY id_client
            ORDER BY SUM(bill) DESC LIMIT 1 OFFSET 0;");
        $best_data = $best_qry->fetch();
        echo $best_data['lastname'].' '.$best_data['firstname'];
        ?>
    </li>
    <br>
    <li>
        # Drivers:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*) FROM Members WHERE role = 'Driver';");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Driver with the most delay:
        <?php
        $worst_qry = $conn->query("SELECT lastname, firstname, COUNT(Members.id)
            FROM Members
                INNER JOIN Orders ON id_driver = Members.id
            WHERE TIMESTAMPDIFF(MINUTE, date_order, date_delivery) > 30
            GROUP BY Members.id
            ORDER BY COUNT(Members.id) DESC LIMIT 1 OFFSET 0;");
        $worst_data = $worst_qry->fetch();
        echo $worst_data['lastname'].' '.$worst_data['firstname'];
        ?>
    </li>
    <br>
    <li>
        # Sales:
        <?php
        $count_qry = $conn->query("SELECT COUNT(*) FROM Orders;");
        $count_data = $count_qry->fetch();
        echo $count_data['COUNT(*)'];
        ?>
    </li>
    <li>
        Average bill (€):
        <?php
        $avg_qry = $conn->query("SELECT AVG(bill) FROM Orders;");
        $avg_data = $avg_qry->fetch();
        echo $avg_data['AVG(bill)'];
        ?>
    </li>
    </ul>
</body>

<?php require_once("footer.php") ?>
