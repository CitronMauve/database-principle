<?php
session_start();
require("config.php");
$title_page = '';
require_once("header.php");

function update_client($id, $lastname, $firstname, $address, $phone, $conn) {
    $qry = $conn->prepare("UPDATE Clients
        SET lastname = :lastname,
            firstname = :firstname,
            address = :address,
            phone = :phone
        WHERE id = '$id'");
    $qry->bindValue(":lastname", $lastname);
    $qry->bindValue(":firstname", $firstname);
    $qry->bindValue(":address", $address);
    $qry->bindValue(":phone", $phone);
    $qry->execute();
}

function delete_client($id, $conn) {
    $qry = $conn->prepare("DELETE FROM Clients WHERE id = :id");
    $qry->bindValue(":id", $id);
    $qry->execute();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    switch ($action) {
        case "edit":
            $qry = $conn->query("SELECT * FROM Clients WHERE id='$id'");
            $data = $qry->fetch();
            $lastname = $data['lastname'];
            $firstname = $data['firstname'];
            $address = $data['address'];
            $phone = $data['phone'];

            if (isset($_POST['update'])) {
                update_client($_GET['id'], $_POST['lastname'], $_POST['firstname'], $_POST['address'], $_POST['phone'], $conn);
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
        <input type="submit" value="Update" name="update">
    </form>
</body>
