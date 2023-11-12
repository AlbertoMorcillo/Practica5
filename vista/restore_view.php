<!-- Created By Alberto Morcillo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="../estilo/Styles.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-form">
        <h1>Recuperar Contraseña</h1>
        <br>
        <?php if (isset($errors) && !empty($errors)) : ?>
        <div class="error-message">
            <?php echo $errors ?>
        </div>
        <?php endif; ?>

        <p class="blue-text">Pon el correo electrónico y enviaremos un token.</p>
        <br>
    
        <form action="restore.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($validEmail); ?>" autofocus>
            <button type="submit" name="submit" class="btn-restore">Recuperar</button>
        </form>
        <p class="green-text">¿No tienes una cuenta?</p>
        <div class="signin">
            <form method="post" action="../controlador/signin.php">
                <button type="submit" name="signin" class="btn-signin">Registrarse</button>
            </form>
        </div>
        <p class="green-text">¿Te acuerdas de la contraseña?</p>
        <div class="login">
            <form method="post" action="../controlador/login.php">
                <button type="submit" name="signup" class="btn-login">Login</button>
            </form>
        </div>
        <div class="return">
            <form method="post" action="../controlador/index.php">
                <button type="submit" name="return" class="btn-return">Inicio</button>
            </form>
        </div>
    </div>
</body>
</html>
