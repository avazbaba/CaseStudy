<div class="container">
    <div class="container-form">
        <h2>Anmelden</h2>
        <form action="/user/login" method="POST">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Anmelden</button>
        </form>
        <?php if (!empty($errorMessage)): ?>
            <h3 class="error-message"><?= $errorMessage ?></h3>
        <?php endif; ?>
    </div>
</div>
