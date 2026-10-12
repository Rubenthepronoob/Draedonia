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
    <button onclick="location.href='http:login.php'" type="button" id="navButton" class="loginButton"><img src="../images/null_profile_icon.png" class="loginIcon">
    <?php
    if (!empty($_SESSION['login']) && isset($_SESSION['username'])) {
        echo $_SESSION['username'];
    }
    else {
        echo "Login";
    }
    ?>
    </button>
</nav>
</body>
</html>