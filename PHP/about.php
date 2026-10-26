<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>About | Draedonia</title>
</head>
<body>
<nav id="nav">
    <button onclick="location.href='about.php'" type="button" id="navButton" class="aboutButton">About</button>
    <h1>Welcome to Draedonia</h1>
    <button onclick="location.href='logout.php'" type="button" id="navButton" class="logoutButton">logout</button>
    <button type="button" id="navButton" class="loginButton">
    <?php
    if (!empty($_SESSION['login']) && isset($_SESSION['username'])) {
        echo htmlspecialchars($_SESSION['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    } else {
        echo '<img src="../images/null_profile_icon.png" class="loginIcon">account';
    }
    ?>
    <div id="account">
    <?php
    if (!empty($_SESSION['login']) && isset($_SESSION['username'])) {
        echo htmlspecialchars($_SESSION['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    } else {
        echo '<a href="login.php">Login</a>';
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