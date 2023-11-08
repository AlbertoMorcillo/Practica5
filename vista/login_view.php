<!DOCTYPE html>
<!-- Created by: Alberto Morcillo -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
    <link href="../estilo/Styles.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-form">
        <h1>Login</h1>
        <br>
        <?php if (isset($errors) && !empty($errors)) : ?>
        <div class="error-message">
            <?php echo $errors ?>
        </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($validEmail); ?>" autofocus>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($validPassword); ?>">
            <?php if (isset($_SESSION['contadorErrorPass']) && $_SESSION['contadorErrorPass'] >= 3): ?>
                <div class="g-recaptcha" data-sitekey="6LdknPUoAAAAAFwoKyfOfeWpN3p_U2Tc7IYlMYib"></div>
            <?php endif; ?>
            <br>
            <button type="submit" name="submit" class="btn-login">Login</button>
            <button type="submit" name="submit2" class="btn-google">Iniciar sesión con Google</button>
        </form>
        <p class="green-text">¿No tienes una cuenta?</p>
        <div class="signin">
            <form method="post" action="../controlador/signin.php">
                <button type="submit" name="signin" class="btn-signin">Registrarse</button>
            </form>
        </div>
        <div class="return">
            <form method="post" action="../controlador/index.php">
                <button type="submit" name="return" class="btn-return">Inicio</button>
            </form>
        </div>
        <p class="green-text">¿No te acuerdas de tu contraseña?</p>
            <div class="restore">
                <form method="post" action="../controlador/restore.php">
                    <button type="submit" name="restore" class="btn-restore">Reiniciar contraseña</button>
                </form>
            </div>
    </div>
</body>
</html>