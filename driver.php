<?php
session_start();
require("config.php");
$title_page = '';
require_once("header.php");

function update_driver($id, $lastname, $firstname, $conn) {
    $qry = $conn->prepare("UPDATE Drivers
        SET lastname = :lastname,
            firstname = :firstname
        WHERE id = '$id'");
    $qry->bindValue(":lastname", $lastname);
    $qry->bindValue(":firstname", $firstname);
    $qry->execute();
}

function delete_driver($id, $conn) {
    $qry = $conn->prepare("DELETE FROM Drivers WHERE id = :id");
    $qry->bindValue(":id", $id);
    $qry->execute();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    switch ($action) {
        case "edit":
            $qry = $conn->query("SELECT * FROM Drivers WHERE id='$id'");
            $data = $qry->fetch();
            $lastname = $data['lastname'];
            $firstname = $data['firstname'];

            if (isset($_POST['update'])) {
                update_driver($_GET['id'], $_POST['lastname'], $_POST['firstname'], $conn);
                header("Location: drivers.php");
                exit();
            }
            break;
        case "delete":
            delete_driver($id, $conn);
            header("Location: drivers.php");
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
        <input type="submit" value="Update" name="update">
    </form>
</body>
