<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}
require("config.php");
$title_page = 'My profile';
require_once("header.php");

function isEmailValid($id, $email, $conn) {
    $qry = "SELECT 1 FROM Members WHERE id = '$id' AND email = '$email'";
    $data = $conn->query($qry);
    if ($data->rowCount() > 0) {
        return true;
    }

    $qry = "SELECT 1 FROM Members WHERE email = '$email'";
    $data = $conn->query($qry);
    if ($data->rowCount() > 0) {
        echo 'Email already exists';
        return false;
    }

    return true;
}

function isPasswordValid($password, $confirm) {
    if (!isset($password)) {
        echo 'Password is required';
        return false;
    } else if ($password != $confirm) {
        echo 'Passwords do not match';
        return false;
    }

    return true;
}

$id = $_SESSION['id'];
$qry = $conn->query("SELECT * FROM Members WHERE id = '$id'");
$data = $qry->fetch();
$email = $data['email'];
$lastname = $data['lastname'];
$firstname = $data['firstname'];
$address = $data['address'];
$phone = $data['phone'];

if (isset($_POST['email']) &&
isset($_POST['lastname']) &&
isset($_POST['firstname']) &&
isset($_POST['address']) &&
isset($_POST['phone'])) {
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $qry = $conn->prepare("UPDATE Members
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

    if (isEmailValid($id, $_POST['email'], $conn)) {
        $qry = $conn->prepare("UPDATE Members
            SET email = :email
            WHERE id = '$id'");
        $qry->bindValue(":email", $email);
        $qry->execute();
    }

    if (isset($_POST['password']) && isset($_POST['confirm']) &&
    isPasswordValid($_POST['password'], $_POST['confirm'])) {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $qry = $conn->prepare("UPDATE Members
            SET password = :hash
            WHERE id = '$id'");
        $qry->bindValue(":hash", $hash);
        $qry->execute();
    }
}
?>

<body>
    <h1>My profile</h1>
    <form method="post">
        <p>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required/>
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="password">
        </p>
        <p>
            <label>Confirm</label>
            <input type="password" name="confirm">
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
        <input type="submit" value="Update" name="update">
    </form>
</body>

<?php require_once("footer.php") ?>
