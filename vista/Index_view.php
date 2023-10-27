<!-- Created by Alberto Morcillo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../estilo/Styles.css">
    <title>Paginació</title>
</head>

<body>
    <div class="elegirCantidadArticulosPorPagina">
        <form action="" method="post">
            <label for="cantidadArticulosPorPagina">Selecciona la cantidad de artículos por página:</label>
            <select name="cantidadArticulosPorPagina" id="cantidadArticulosPorPagina">
                <option value="5" <?php if(isset($_POST['cantidadArticulosPorPagina']) && $_POST['cantidadArticulosPorPagina'] == 5) { echo 'selected'; } ?>>5</option>
                <option value="10" <?php if(isset($_POST['cantidadArticulosPorPagina']) && $_POST['cantidadArticulosPorPagina'] == 10) { echo 'selected'; } ?>>10</option>
                <option value="20" <?php if(isset($_POST['cantidadArticulosPorPagina']) && $_POST['cantidadArticulosPorPagina'] == 20) { echo 'selected'; } ?>>20</option>
            </select>
            <input type="submit" value="Enviar">
        </form>
    </div>

<div class="login">
    <form method="post" action="../controlador/login.php">
        <button type="submit" name="login" class="btn-login">Login</button>
    </form>
</div>



    <div class="contenidor">
        <h1>Articles</h1>
        <section class="articles"> <!-- aquí guardamos los artículos -->
            <ul>
                <?php
                echo $articulos; // Mostrar los artículos obtenidos en el controlador
                ?>
            </ul>
        </section>
    </div>

    <section class="paginacio">
        <ul>
            <li><a href="?pagina=1">First</a></li>
            <?php if ($pagina_actual > 1) : ?>
                <li><a href="?pagina=<?php echo $pagina_actual - 1 ?>">Previous</a></li>
            <?php else : ?>
                <li class="disabled"><a href="#">&laquo;</a></li>
            <?php endif; ?>

            <?php for ($contador = 1; $contador <= $numero_paginas; $contador++) : ?>
                <li><a href="?pagina=<?php echo $contador ?>"><?php echo $contador ?></a></li>
            <?php endfor; ?>

            <?php if ($pagina_actual < $numero_paginas) : ?>
                <li><a href="?pagina=<?php echo $pagina_actual + 1 ?>">Next</a></li>
            <?php else : ?>
                <li class="disabled"><a href="#">&raquo;</a></li>
            <?php endif; ?>

            <li><a href="?pagina=<?php echo $numero_paginas ?>">Last</a></li>
        </ul>
    </section>
</body>

</html>
