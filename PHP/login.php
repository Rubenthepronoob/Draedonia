<?php

require "config.php";
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $check_statement = $conn->prepare(
        'SELECT * FROM accounts WHERE username = :username OR email = :email'
    );
    $check_statement->execute([
        'username' => $username,
        'email' => $username,
    ]);
    $user = $check_statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Gebruikersnaam, e-mail of wachtwoord is onjuist";
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

            <label for="password">password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button class="registerbutton" type="submit">login</button>
        </form>
        <br>
        <p>dont have an account? <a href="register.php">register</a></p>
        <p>back to <a href="index.php">home</a></p>
    </div>
</div>
</body>
</html>