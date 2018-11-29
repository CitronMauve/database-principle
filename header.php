<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title_page ?></title>
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />
    </head>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
                        echo '
                        <li><a href="clients.php">Clients</a></li>
                        ';
                    }
                    if (isset($_SESSION['role']) && $_SESSION['role'] !== 'Client') {
                        echo '
                        <li><a href="drivers.php">Drivers</a></li>
                        ';
                    }
                ?>
                <li><a href="order.php">Order</a></li>
                <?php
                    if (!isset($_SESSION['email'])) {
                        echo '
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        ';
                    } else {
                        echo '
                        <li><a href="logout.php">Log out</a></li>
                        ';
                    }
                ?>
            </ul>
        </nav>
    </header>
