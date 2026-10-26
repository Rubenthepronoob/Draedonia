<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Draedonia</title>
</head>
<body>
<nav id="nav">
    <button onclick="location.href='http:about.php'" type="button" id="navButton" class="aboutButton">About</button>
    <h1>Welcome to Draedonia</h1>
    <button onclick="location.href='http:logout.php'" type="button" id="navButton" class="logoutButton">logout</button>
    <button type="button" id="navButton" class="loginButton">
    <?php
    if (!empty($_SESSION['login']) && isset($_SESSION['username'])) {
        echo $_SESSION['username'];
    } else {
        echo '<img src="../images/null_profile_icon.png" class="loginIcon">account';
    }
    ?>
    <div id="account">
    <?php
    if (!empty($_SESSION['login']) && isset($_SESSION['username'])) {
        echo '<hr>' . $_SESSION['username'] . '<br><br><a href="logout.php">Logout</a><br><br><a href="account.php">My Account</a><br><hr>';
        echo '';
    } else {
        echo '<a href="http:login.php">Login</a>';
    }
    ?>
    
    </div>
    </button>
    
</nav>
</body>
</html>