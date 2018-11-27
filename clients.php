<?php
session_start();
require("config.php");
$title_page = 'Clients';
require_once("header.php");

function create_client($lastname, $firstname, $address, $phone, $conn) {
    $qry = $conn->prepare("INSERT INTO Clients (lastname, firstname, address, phone) VALUES(?, ?, ?, ?)");
    $qry->execute(array($lastname, $firstname, $address, $phone));
}

if (isset($_POST['lastname']) &&
isset($_POST['firstname']) &&
isset($_POST['address']) &&
isset($_POST['phone'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    create_client($lastname, $firstname, $address, $phone, $conn);
}
?>

<body>
    <h1>List of clients</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Address</th>
            <th>Phone</th>
            <th># order</th>
        </tr>
        <?php
        $clients_qry = $conn->query("SELECT *
            FROM Clients
            ORDER BY Clients.lastname");

        while ($clients_data = $clients_qry->fetch()) {
            $id = $clients_data['id'];
            $lastname = $clients_data['lastname'];
            $firstname = $clients_data['firstname'];
            $address = $clients_data['address'];
            $phone = $clients_data['phone'];

            $orders_qry = $conn->query("SELECT COUNT(*)
                FROM Orders
                WHERE id_client = '$id'");
            $orders_data = $orders_qry->fetch();

            echo '<tr>';
            echo '<td>'.$lastname.'</td>';
            echo '<td>'.$firstname.'</td>';
            echo '<td>'.$address.'</td>';
            echo '<td>'.$phone.'</td>';
            echo '<td>'.$orders_data['COUNT(*)'].'</td>';
            echo '<td><a href="client.php?action=edit&id='.$id.'">Edit</a></td>';
            echo '<td><a href="client.php?action=delete&id='.$id.'">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    </div>
    <br>

    <h1>Add new client</h1>
    <form method="post">
        <p>
            <label>Lastname</label>
            <input type="text" name="lastname" required/>
        </p>
        <p>
            <label>Firstname</label>
            <input type="text" name="firstname" required/>
        </p>
        <p>
            <label>Address</label>
            <input type="text" name="address" required/>
        </p>
        <p>
            <label>Phone</label>
            <input type="text" name="phone" required/>
        </p>
        <input type="submit" value="Add">
    </form>
</body>

<?php require_once("footer.php") ?>
