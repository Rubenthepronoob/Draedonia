<?php
include 'config.php';
session_start();

if (!isset($_SESSION['accounts'])) {
    $_SESSION['accounts'] = [];
}

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $messages[] = 'Please fill in both username and password.';
        } elseif (strlen($username) < 3) {
            $messages[] = 'Username must be at least 3 characters long.';
        } elseif (strlen($password) < 6) {
            $messages[] = 'Password must be at least 6 characters long.';
        } elseif (isset($_SESSION['accounts'][$username])) {
            $messages[] = 'This username already exists.';
        } else {
            $_SESSION['accounts'][$username] = [
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $messages[] = 'Account created successfully. You can now log in.';
        }
    }

    if ($action === 'login') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $messages[] = 'Please enter your username and password.';
        } elseif (!isset($_SESSION['accounts'][$username])) {
            $messages[] = 'Account not found.';
        } elseif (!password_verify($password, $_SESSION['accounts'][$username]['password'])) {
            $messages[] = 'Incorrect password.';
        } else {
            $_SESSION['user'] = $username;
            $messages[] = 'Login successful!';
        }
    }
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-top: 0;
        }
        form {
            margin-bottom: 24px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }
        button {
            background: #2d6cdf;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        .message {
            background: #eef6ff;
            border: 1px solid #cfe2ff;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 5px;
        }
        .welcome {
            background: #eafaf1;
            border: 1px solid #b9e7c8;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 16px;
        }
        .logout {
            text-decoration: none;
            color: #b42318;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($user): ?>
            <div class="welcome">
                Welcome, <strong><?= htmlspecialchars($user) ?></strong>!<br>
                <a href="index.php?logout=1" class="logout">Logout</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!$user): ?>
            <h2>Create Account</h2>
            <form method="POST">
                <input type="hidden" name="action" value="register">
                <label for="register_username">Username</label>
                <input id="register_username" type="text" name="username" required>

                <label for="register_password">Password</label>
                <input id="register_password" type="password" name="password" required>

                <button type="submit">Create Account</button>
            </form>

            <h2>Login</h2>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <label for="login_username">Username</label>
                <input id="login_username" type="text" name="username" required>

                <label for="login_password">Password</label>
                <input id="login_password" type="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
