<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="../estilo/Styles.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-form">
        <h1>Cambiar Contraseña</h1>
        <br>
        <?php if (isset($errors) && !empty($errors)) : ?>
        <div class="error-message">
            <?php echo $errors ?>
        </div>
        <?php endif; ?>

        <form action="restore_confirm.php" method="POST">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($validPassword); ?>" autofocus>
            <label for="passwordRepetida">Vuelva a escribir la contraseña:</label>
            <input type="password" id="passwordRepetida" name="passwordRepetida" value="<?php echo htmlspecialchars($validPasswordRepetida); ?>">
            <button type="submit" name="submit" class="btn-restore">Enviar</button>
        </form>
        <p class="green-text">¿Has cambiado de opinión?</p>
        <div class="return">
            <form method="POST" action="../controlador/index.php">
                <button type="submit" name="return" class="btn-return">Inicio</button>
            </form>
        </div>
    </div>
</body>
</html>