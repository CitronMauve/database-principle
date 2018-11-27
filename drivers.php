<?php
session_start();
require("config.php");
$title_page = 'Drivers';
require_once("header.php");

function create_driver($lastname, $firstname, $conn) {
    $qry = $conn->prepare("INSERT INTO Drivers (lastname, firstname) VALUES(?, ?)");
    $result = $qry->execute(array($lastname, $firstname));
}

if (isset($_POST['lastname']) && isset($_POST['firstname'])) {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    create_driver($lastname, $firstname, $conn);
}
?>

<body>
    <h1>List of drivers</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th># delivery</th>
        </tr>
        <?php
        $drivers_qry = $conn->query("SELECT *
            FROM Drivers
            ORDER BY Drivers.lastname");

        while ($drivers_data = $drivers_qry->fetch()) {
            $id = $drivers_data['id'];
            $lastname = $drivers_data['lastname'];
            $firstname = $drivers_data['firstname'];

            $deliver_qry = $conn->query("SELECT COUNT(*)
                FROM Deliver
                WHERE id_driver = '$id'");
            $deliver_data = $deliver_qry->fetch();

            echo '<tr>';
            echo '<td>'.$lastname.'</td>';
            echo '<td>'.$firstname.'</td>';
            echo '<td>'.$deliver_data['COUNT(*)'].'</td>';
            echo '<td><a href="driver.php?action=edit&id='.$id.'">Edit</a></td>';
            echo '<td><a href="driver.php?action=delete&id='.$id.'">Delete</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    </div>

    <br>

    <h1>Add new driver</h1>
    <form method="post">
        <p>
            <label>Lastname</label>
            <input type="text" name="lastname" required/>
        </p>
        <p>
            <label>Firstname</label>
            <input type="text" name="firstname" required/>
        </p>
        <input type="submit" value="Add">
    </form>
</body>

<?php require_once("footer.php") ?>
