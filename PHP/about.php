<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/Shattered Purple Crystal Portal Emblem.png">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>About | Draedonia</title>
</head>
<body>
<nav id="nav">
    <button onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = 'index.php'; }" type="button" id="navButton" class="backButton">Back</button>
    <button onclick="location.href='http:about.php'" type="button" id="navButton" class="aboutButton">About</button>
    <img src="../images/Draedonia_ The Fractured World Logo.png" id="logo" alt="Draedonia Logo" onclick="location.href='index.php'">
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
        echo '<hr>' . $_SESSION['username'] . '<br><br><a href="account.php">My Account</a><br><br><a href="logout.php">Logout</a><br><hr><style>.loginButton:hover #account{height: 128px;}</style>';
        echo '';
    } else {
        echo '<hr><a href="http:login.php">Login</a><hr><style>.loginButton:hover #account{height: 54px;}</style>';
    }
    ?>
    </div>
    </button>
</nav>

<main class="container">
    <h2>About Draedonia</h2>
    <p>Welcome to Draedonia! This page is a little introduction to the site.</p>
    <p>Explore, play, and check back as Draedonia continues to grow.</p>
</main>
</body>
</html>