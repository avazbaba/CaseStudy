<div class="container">
    <?php if (isset($errorMessage) && !empty($errorMessage)): ?>
        <h3 class="error-message"><?= $errorMessage ?></h3>
    <?php endif; ?>

    <div class="container-form">
        <h2>Benutzerregistrierung</h2>
        <form id="registration-form" action="/user/register" method="POST">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required minlength="3" maxlength="20">
            <span id="username-error"></span><br><br>

            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required minlength="8">
            <span id="password-error"></span><br><br>

            <label for="confirm-password">Passwort bestätigen:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <span id="confirm-password-error"></span><br><br>

            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address"><br><br>

            <label for="phone">Telefonnummer:</label>
            <input type="tel" id="phone" name="phone" pattern="[+]?[0-9]{8,}" placeholder="Format: +1234567890">
            <span id="phone-error"></span><br><br>

            <button type="submit" id="submit-button">Registrieren</button>
        </form>
    </div>
</div>
<script>
    const form = document.getElementById('registration-form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const phoneInput = document.getElementById('phone');

    function updateValidationMessages() {
        if (usernameInput.value.length < 3 || usernameInput.value.length > 20) {
            document.getElementById('username-error').textContent = 'Benutzername muss zwischen 3 und 20 Zeichen lang sein.';
            document.getElementById('username-error').style.color = 'red';
        } else {
            document.getElementById('username-error').style.color = 'green';
        }

        const password = passwordInput.value;
        const hasUppercase = /[A-Z]/.test(password);
        const hasLowercase = /[a-z]/.test(password);
        const hasSpecialChar = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password);

        if (password.length < 8 || !hasUppercase || !hasLowercase || !hasSpecialChar) {
            document.getElementById('password-error').textContent = 'Passwort muss mindestens 8 Zeichen lang sein und mindestens einen Großbuchstaben, einen Kleinbuchstaben und ein Sonderzeichen enthalten.';
            document.getElementById('password-error').style.color = 'red';
        } else {
            document.getElementById('password-error').style.color = 'green';
        }

        if (password !== confirmPasswordInput.value) {
            document.getElementById('confirm-password-error').textContent = 'Passwörter stimmen nicht überein.';
            document.getElementById('confirm-password-error').style.color = 'red';
        } else {
            document.getElementById('confirm-password-error').style.color = 'green';
        }

        const phoneRegex = /^[+]?[0-9]{8,}$/;
        if (!phoneRegex.test(phoneInput.value) && phoneInput.value !== '') {
            document.getElementById('phone-error').textContent = 'Ungültiges Telefonnummerformat (Minimum 8 nummern)';
            document.getElementById('phone-error').style.color = 'red';
        } else {
            document.getElementById('phone-error').style.color = 'green';
        }
    }

    usernameInput.addEventListener('input', updateValidationMessages);
    passwordInput.addEventListener('input', updateValidationMessages);
    confirmPasswordInput.addEventListener('input', updateValidationMessages);
    phoneInput.addEventListener('input', updateValidationMessages);
</script>


