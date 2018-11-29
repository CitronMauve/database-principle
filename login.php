<?php
session_start();

require("config.php");
$title_page = 'Login';
require_once("header.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qry = $conn->query("SELECT id, password, role FROM Members WHERE email = '$email'");
    $data = $qry->fetch();
    if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['role'] = $data['role'];
        header('Location: index.php');
    } else {
        echo 'Wrong email or password';
    }
}
?>

<body>
    <h1>Login</h1>
    <form method="post">
        <p>
            <label>Email</label>
            <input type="email" name="email" required/>
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="password" required/>
        </p>
        <input type="submit" value="Submit">
    </form>
</body>

<?php require_once("footer.php") ?>
