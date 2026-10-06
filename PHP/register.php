<?php
require "config.php";

$message = '';
$message_type = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $check_sql = "SELECT * FROM accounts WHERE username='$username'";
    $check_result = $conn->query($check_sql);
    if ($check_result->rowCount() > 0) {
        $message = "An username can only be used once.";
        $message_type = "error";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO accounts (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        if ($conn->query($insert_sql) === TRUE) {
            $message = "User successfully registered.";
            $message_type = "success";
            } else { 
                $message = "Error: Unable to add new user " . $conn->error;
                $message_type = "error";
            }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../CSS/style.css">
    
</head>
<body class="registerPage">
<div class="container">
    <div class="box">
        <h2>Register</h2>
        <?php if ($message): ?>
            <div style="text-align: center; margin-bottom: 20px; padding: 10px; border-radius: 5px; <?php echo ($message_type === 'error') ? 'background-color: #f8d7da; color: #721c24;' : 'background-color: #d4edda; color: #155724;'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button class="registerbutton" type="submit">Register</button>
        </form>
        <br>
        <p>already have an account? <a href="login.php">login</a></p>
        <p>back to <a href="index.php">home</a></p>
    </div>
</div>
</body>
</html>