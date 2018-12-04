<?php
session_start();
if (!isset($_SESSION['id']) ||
    (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] !== 'Admin')) {
    header('Location: login.php');
}
require("config.php");
$title_page = 'Clients';
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

function createClient($email, $password, $lastname, $firstname, $address, $phone, $role, $conn) {
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
    $role = 'Client';
    if (isEmailValid($email, $conn)) {
        createClient($email, $password, $lastname, $firstname, $address, $phone, $role, $conn);
    }
}
?>

<body>
    <h1>List of clients</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Email</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Address</th>
            <th>Phone</th>
            <th># order</th>
        </tr>
        <?php
        $clients_qry = $conn->query("SELECT * FROM Members WHERE role = 'Client' ORDER BY lastname;");

        while ($clients_data = $clients_qry->fetch()) {
            $id = $clients_data['id'];
            $email = $clients_data['email'];
            $lastname = $clients_data['lastname'];
            $firstname = $clients_data['firstname'];
            $address = $clients_data['address'];
            $phone = $clients_data['phone'];
            $role = $clients_data['role'];

            $orders_qry = $conn->query("SELECT COUNT(*) FROM Orders WHERE id_client = '$id';");
            $orders_data = $orders_qry->fetch();

            echo '
            <tr>
            <td>'.$email.'</td>
            <td>'.$lastname.'</td>
            <td>'.$firstname.'</td>
            <td>'.$address.'</td>
            <td>'.$phone.'</td>
            <td>'.$orders_data['COUNT(*)'].'</td>';
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                echo '
                <td><a href="client.php?action=edit&id='.$id.'">Edit</a></td>
                <td><a href="client.php?action=delete&id='.$id.'">Delete</a></td>';
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
        <h1>Add a new client</h1>
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
