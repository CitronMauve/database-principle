<?php
session_start();
if (!isset($_SESSION['id']) ||
    (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Client')) {
    header('Location: login.php');
}

require("config.php");
$title_page = 'Drivers';
require_once("header.php");

function isEmailValid($email, $conn) {
    $selectQuery = "SELECT 1 FROM Members WHERE email = '$email';";
    $response = $conn->query($selectQuery);
    if ($response->rowCount() > 0) {
        echo 'Email already exists';
        return false;
    }

    return true;
}

function createDriver($email, $password, $lastname, $firstname, $address, $phone, $role, $conn) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $qry = $conn->prepare("INSERT INTO Members (email, password, lastname, firstname, address, phone, role) VALUES(?, ?, ?, ?, ?, ?, ?);");
    $qry->execute(array($email, $hash, $lastname, $firstname, $address, $phone, $role));
}

if (isset($_POST['email']) &&
isset($_POST['password']) &&
isset($_POST['lastname']) &&
isset($_POST['firstname']) &&
isset($_POST['address']) &&
isset($_POST['phone'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = 'Driver';
    if (isEmailValid($email, $conn)) {
        createDriver($email, $password, $lastname, $firstname, $address, $phone, $role, $conn);
    }
}
?>

<body>
    <h1>List of drivers</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Email</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Address</th>
            <th>Phone</th>
            <th># delivery</th>
        </tr>
        <?php
        $drivers_qry = $conn->query("SELECT * FROM Members WHERE role = 'Driver' ORDER BY lastname;");

        while ($drivers_data = $drivers_qry->fetch()) {
            $id = $drivers_data['id'];
            $email = $drivers_data['email'];
            $lastname = $drivers_data['lastname'];
            $firstname = $drivers_data['firstname'];
            $address = $drivers_data['address'];
            $phone = $drivers_data['phone'];

            $deliver_qry = $conn->query("SELECT COUNT(*) FROM Orders WHERE id_driver = '$id';");
            $deliver_data = $deliver_qry->fetch();

            echo '
            <tr>
            <td>'.$email.'</td>
            <td>'.$lastname.'</td>
            <td>'.$firstname.'</td>
            <td>'.$address.'</td>
            <td>'.$phone.'</td>
            <td>'.$deliver_data['COUNT(*)'].'</td>';
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                echo '
                <td><a href="driver.php?action=edit&id='.$id.'">Edit</a></td>
                <td><a href="driver.php?action=delete&id='.$id.'">Delete</a></td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
    </div>
    <br>
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
        echo '
        <h1>Add a new driver</h1>
        <form method="post">
            <p>
                <label>Email</label>
                <input type="email" name="email" required/>
            </p>
            <p>
                <label>Password</label>
                <input type="password" name="password" required/>
            </p>
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
        </form>';
    } ?>
</body>

<?php require_once("footer.php") ?>
