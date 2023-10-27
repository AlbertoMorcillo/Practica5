<?php
//Created by: Alberto Morcillo
// Iniciar la sesión
session_start();
$errors = '';
$insertadoCorrectamente = '';
$borradoCorrectamente = '';
require_once '../modelo/Conection.php';

if (isset($_SESSION['email'])) {
    $validEmail = $_SESSION['email'];
    $userId = getUserId($validEmail, $connexio);
    $_SESSION["usuari_id"] = $userId;
} else {
    // Si el usuario no está logueado, redirigirlo a la página de inicio de sesión
    header("Location: ./login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $articuloInsertado = isset($_POST['comentario']) ? htmlspecialchars($_POST['comentario']) : '';
    $articuloBorrado = isset($_POST['delete']) ? htmlspecialchars($_POST['delete']) : '';

    include_once './validaciones.php';

    if (!empty($articuloInsertado)) {
        // Intentar insertar un artículo
        validarArticulo($articuloInsertado, $errors);
        if (empty($errors)) {
            insertarArticulo($articuloInsertado, $connexio);
            $insertadoCorrectamente = 'Articulo insertado correctamente.';
        } else {
            $errors .= 'Ha habido un problema para insertar.';
        }
    } elseif (!empty($articuloBorrado)) {
        // Intentar borrar un artículo
        $article_id = validarArticuloBorrar($articuloBorrado, $userId, $errors, $connexio);
        if (empty($errors)) {
            borrarArticulo($article_id, $userId, $connexio);
            $borradoCorrectamente = 'Articulo borrado correctamente.';
        } else {
            $errors .= 'Ha habido un problema para borrar.';
        }
    }
}

/**
 * mostrarArticulos
 *
 * @param  mixed $connexio a la base de datos
 * @param  mixed $start desde donde empieza
 * @param  mixed $cantidad_articulos_por_pagina 
 * @return void
 */
function mostrarArticulos($connexio, $start, $cantidad_articulos_por_pagina) {
    $resultados = obtenerTodosArticulos($connexio, $start, $cantidad_articulos_por_pagina);
    $listaArticulos = '';
    foreach ($resultados as $articulo) {
        $listaArticulos .= '<li>' . $articulo['article_id'] . ' - ' . $articulo['article'] . '</li>';
    }
    return $listaArticulos;
}

/**
 * elegirCantidadArticulosPorPagina - Elegir la cantidad de artículos por página
 *
 * @return void
 */
function elegirCantidadArticulosPorPagina() {
    if (isset($_POST['cantidadArticulosPorPagina'])) {
        $cantidad_articulos_por_pagina = $_POST['cantidadArticulosPorPagina'];
    } else {
        $cantidad_articulos_por_pagina = 5;
    }
    return $cantidad_articulos_por_pagina;
}

/**
 * obtenerDatosPaginacion
 *
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function obtenerDatosPaginacion($connexio) {
    $cantidad_articulos_por_pagina = elegirCantidadArticulosPorPagina();
    $numero_paginas = calcularTotalPaginas($connexio, $cantidad_articulos_por_pagina);
    return array(
        'cantidad_articulos_por_pagina' => $cantidad_articulos_por_pagina,
        'numero_paginas' => $numero_paginas
    );
}

$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$cantidad_articulos_por_pagina = elegirCantidadArticulosPorPagina();
$start = ($pagina_actual - 1) * $cantidad_articulos_por_pagina;

$datos_paginacion = obtenerDatosPaginacion($connexio);
$cantidad_articulos_por_pagina = $datos_paginacion['cantidad_articulos_por_pagina'];
$numero_paginas = $datos_paginacion['numero_paginas'];

$articulos = mostrarArticulos($connexio, $start, $cantidad_articulos_por_pagina);

include_once '../vista/index_view_usuario_logged.php';
?>
