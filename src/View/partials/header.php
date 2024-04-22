<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default' ?></title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
<header>
    <h1>Welcome to CaseStudy</h1>
    <nav>
        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
            <span>Hallo <?= $_SESSION['username'] ?></span>
        <?php endif; ?>
        <a href="/">Home</a>
        <a href="/user/register">Registrieren</a>
        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']): ?>
            <a href="/user/logout">Abmelden</a>
        <?php else: ?>
            <a href="/user/login">Anmelden</a>
        <?php endif; ?>
    </nav>
</header>
