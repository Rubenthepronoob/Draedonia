<?php

require "config.php";

$error = '';

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $check_sql = "SELECT * FROM accounts WHERE username='$username' OR email='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $user = $check_result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Wachtwoord is onjuist";
        }
    } else {
        $error = "Gebruikersnaam of email niet gevonden";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="registerPage">
<div class="container">
    <div class="box">
        <h2>login</h2>
        <?php if ($error): ?>
            <div style="text-align: center; margin-bottom: 20px; padding: 10px; border-radius: 5px; background-color: #f8d7da; color: #721c24;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button class="loginbutton" type="submit">login</button>
        </form>
        <br>
        <p>dont have an account? <a href="register.php">register</a></p>
        <p>back to <a href="index.php">home</a></p>
    </div>
</div>
</body>
</html>