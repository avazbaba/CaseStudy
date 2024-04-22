<?php
$isLoggedIn = $_SESSION['user_logged_in'] ?? false;
$dummyContent = [
    'title' => 'Willkommen beim Case Study Projekt!',
    'description' => 'Dieses Projekt soll ein einfaches PHP-Login-Szenario demonstrieren.',
    'content' => 'Hier ist exklusiver Inhalt, der nur registrierten Mitgliedern zur Verfügung steht.'
];

?>
<div class="container">
    <?php if ($isLoggedIn): ?>
        <div class="content">
            <h1><?php echo $dummyContent['title']; ?></h1>
            <p><?php echo $dummyContent['description']; ?></p>
            <div><?php echo $dummyContent['content']; ?></div>
        </div>
    <?php else: ?>
        <p class="login-message">Dies ist die Startseite des CaseStudy. Bitte melden Sie sich an, um den tatsächlichen Inhalt zu sehen.</p>
    <?php endif; ?>
</div>
