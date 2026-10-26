<?php
session_start();

function escapeHtml($value): string
{
	return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$user = $_SESSION['user'] ?? [];
$name = $user['name'] ?? $_SESSION['name'] ?? 'Guest';
$email = $user['email'] ?? $_SESSION['email'] ?? '';
$isSignedIn = $email !== '' || $name !== 'Guest';
$initials = strtoupper(substr(trim($name), 0, 1));
if ($initials === '') {
	$initials = 'A';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/style.css">
	<title>My Account | Draedonia</title>
</head>
<body class="account-page">
	<header class="topbar">
		<a class="brand" href="index.php">Drae<span>donia</span></a>
		<a class="top-link" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>">Back to site</a>
	</header>

	<main>
		<div class="heading">
			<h1>My account</h1>
			<p class="subtitle">Manage your profile and account details.</p>
		</div>

		<div class="layout">
			<aside class="card sidebar" aria-label="Account navigation">
				<div class="identity">
					<div class="avatar" aria-hidden="true"><?= escapeHtml($initials) ?></div>
					<div>
						<strong><?= escapeHtml($name) ?></strong>
						<small><?= $email !== '' ? escapeHtml($email) : 'Account profile' ?></small>
					</div>
				</div>
				<nav class="menu">
					<a class="active" href="account.php" aria-current="page">Profile overview</a>
					<a href="account.php#security">Security</a>
				</nav>
			</aside>

			<section class="card content" aria-labelledby="profile-title">
				<h2 class="section-title" id="profile-title">Profile overview</h2>
				<p class="section-copy">Your personal account information.</p>

				<?php if ($isSignedIn): ?>
					<div class="details">
						<div class="detail-row">
							<span class="detail-label">Name</span>
							<span class="detail-value"><?= escapeHtml($name) ?></span>
						</div>
						<div class="detail-row">
							<span class="detail-label">Email address</span>
							<span class="detail-value"><?= escapeHtml($email !== '' ? $email : 'Not provided') ?></span>
						</div>
						<div class="detail-row" id="security">
							<span class="detail-label">Password</span>
							<span class="detail-value">••••••••</span>
						</div>
					</div>
				<?php else: ?>
					<div class="notice">You are viewing this page as a guest. Sign in to see your account information.</div>
					<a class="button" href="login.php">Sign in</a>
				<?php endif; ?>
			</section>
		</div>
	</main>
	<footer>&copy; <?= date('Y') ?> Draedonia. All rights reserved.</footer>
</body>
</html>
