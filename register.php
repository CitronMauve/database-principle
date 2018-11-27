<?php
session_start();
require("config.php");
$title_page = 'Register';
require_once("header.php");

function is_email_valid($email, $conn) {
    if (!isset($email)) {
        echo 'Email is required';
        return false;
    }

    $selectQuery = "SELECT 1 FROM member WHERE email = '$email'";
    $response = $conn->query($selectQuery);
    if ($response->rowCount() > 0) {
        echo 'Email already exists';
        return false;
    }

    return true;
}

function is_password_valid($password, $confirm) {
    if (!isset($password)) {
        echo 'Password is required';
        return false;
    } else if ($password != $confirm) {
        echo 'Passwords do not match';
        return false;
    }

    return true;
}

function create_member($email, $password, $confirm, $conn) {
    // Hash password
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert new user
    $query = $conn->prepare("INSERT INTO member (email, password) VALUES(?, ?)");
    $result = $query->execute(array($_POST['email'], $hash));

    return $result;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (is_email_valid($email, $conn) && is_password_valid($password, $confirm)) {
        if (create_member($email, $password, $confirm, $conn)) {
            echo 'New member registered successfully';
        } else {
            echo 'Error during member creation';
        }
    }
}
?>

<body>
    <h1>Registration Form</h1>
    <form action="" method="post">
        Email address <input type="email" name="email" placeholder="Email address" required/>

        Password <input type="password" name="password" placeholder="Password" required/>

        Confirm password <input type="password" name="confirm" placeholder="Confirm password" required/>

        <input type="submit" value="Submit">
    </form>
</body>

<?php require_once("footer.php") ?>
