<?php
session_start();
if (!isset($_SESSION['id']) ||
    (isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] !== 'Admin')) {
    header('Location: login.php');
}
require("config.php");
$title_page = '';
require_once("header.php");

function update_client($id, $lastname, $firstname, $address, $phone, $role, $conn) {
    $qry = $conn->prepare("UPDATE Members
        SET lastname = :lastname,
            firstname = :firstname,
            address = :address,
            phone = :phone,
            role = :role
        WHERE id = '$id'");
    $qry->bindValue(":lastname", $lastname);
    $qry->bindValue(":firstname", $firstname);
    $qry->bindValue(":address", $address);
    $qry->bindValue(":phone", $phone);
    $qry->bindValue(":role", $role);
    $qry->execute();
}

function delete_client($id, $conn) {
    $qry = $conn->prepare("DELETE FROM Members WHERE id = :id");
    $qry->bindValue(":id", $id);
    $qry->execute();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    switch ($action) {
        case "edit":
            $qry = $conn->query("SELECT email, lastname, firstname, address, phone, role FROM Members WHERE id = '$id'");
            $data = $qry->fetch();
            $email = $data['email'];
            $lastname = $data['lastname'];
            $firstname = $data['firstname'];
            $address = $data['address'];
            $phone = $data['phone'];
            $role = $data['role'];

            if (isset($_POST['update'])) {
                update_client($_GET['id'], $_POST['lastname'], $_POST['firstname'], $_POST['address'], $_POST['phone'], $_POST['role'], $conn);
                header("Location: clients.php");
                exit();
            }
            break;
        case "delete":
            delete_client($id, $conn);
            header("Location: clients.php");
            exit();
            break;
    }
}
?>

<body>
    <h1>Client id <?php echo $_GET['id']; ?></h1>
    <form method="post">
        <p>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required disabled/>
        </p>
        <p>
            <label>Lastname</label>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" required/>
        </p>
        <p>
            <label>Firstname</label>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>" required/>
        </p>
        <p>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>" required/>
        </p>
        <p>
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>" required/>
        </p>
        <p>
            <label>Role</label>
            <select name="role" required>
                <option value="Client">Client</option>
                <option value="Driver">Driver</option>
                <option value="Admin">Admin</option>
            </select>
        </p>
        <input type="submit" value="Update" name="update">
    </form>
</body>

<?php require_once("footer.php") ?>
