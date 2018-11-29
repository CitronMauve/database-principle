<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
}
require("config.php");
$title_page = 'My profile';
require_once("header.php");
?>

<body>
    <h1>My profile</h1>
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
                <option value="Driver">Driver</option>
                <option value="Client">Client</option>
                <option value="Admin">Admin</option>
            </select>
        </p>
        <input type="submit" value="Update" name="update">
    </form>
</body>

<?php require_once("footer.php") ?>
