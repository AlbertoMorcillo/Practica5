<!-- Created by: Alberto Morcillo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo/Styles.css">
    <title>Error de token</title>
</head>
<body>
    <h1>Error: Token invalido</h1>
    <p class="blue-text">Porfavor, elija una de estas dos opciones:</p>
        <div class="signin">
            <form method="post" action="../controlador/Index.php">
                <button type="submit" name="signin" class="btn-signin">Inicio</button>
            </form>
        </div>
        <div class="login">
            <form method="post" action="../controlador/restore.php">
                <button type="submit" name="signup" class="btn-login">Volver a recuperar contraseña</button>
            </form>
        </div>
</body>
</html>