<?php
session_start();
require("config.php");
$title_page = 'Register';
require_once("header.php");

function isEmailValid($email, $conn) {
    if (!isset($email)) {
        echo 'Email is required';
        return false;
    }

    $selectQuery = "SELECT 1 FROM Members WHERE email = '$email';";
    $response = $conn->query($selectQuery);
    if ($response->rowCount() > 0) {
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

function createMember($email, $password, $confirm, $conn) {
    // Hash password
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert new user
    $query = $conn->prepare("INSERT INTO Members (email, password, role) VALUES(?, ?, 'Client');");
    $result = $query->execute(array($_POST['email'], $hash));

    return $result;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (isEmailValid($email, $conn) && isPasswordValid($password, $confirm)) {
        if (createMember($email, $password, $confirm, $conn)) {
            echo 'New member registered successfully';
        } else {
            echo 'Error during member creation';
        }
    }
}
?>

<body>
    <h1>Registration Form</h1>
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
            <label>Confirm password</label>
            <input type="password" name="confirm" required/>
        </p>
        <input type="submit" value="Submit">
    </form>
</body>

<?php require_once("footer.php") ?>
