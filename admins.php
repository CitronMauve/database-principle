<?php
session_start();
if (!isset($_SESSION['id']) ||
    (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] !== 'Admin')) {
    header('Location: login.php');
}
require("config.php");
$title_page = 'Admins';
require_once("header.php");
?>

<body>
    <h1>List of admins</h1>
    <div id="contener">
    <table>
        <tr>
            <th>Email</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
        <?php
        $clients_qry = $conn->query("SELECT *
            FROM Members
            WHERE role = 'Admin'
            ORDER BY Members.lastname");

        while ($clients_data = $clients_qry->fetch()) {
            $id = $clients_data['id'];
            $email = $clients_data['email'];
            $lastname = $clients_data['lastname'];
            $firstname = $clients_data['firstname'];
            $address = $clients_data['address'];
            $phone = $clients_data['phone'];

            echo '
            <tr>
            <td>'.$email.'</td>
            <td>'.$lastname.'</td>
            <td>'.$firstname.'</td>
            <td>'.$address.'</td>
            <td>'.$phone.'</td>
            </tr>';
        }
        ?>
    </table>
    </div>
</body>

<?php require_once("footer.php") ?>
