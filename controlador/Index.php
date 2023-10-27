<?php
//Created by: Alberto Morcillo

require_once '../modelo/Conection.php';


/**
 * mostrarArticulos
 *
 * @param  mixed $connexio a la base de datos
 * @param  mixed $start desde donde empieza
 * @param  mixed $cantidad_articulos_por_pagina 
 * @return void
 */
function mostrarArticulos($connexio, $start, $cantidad_articulos_por_pagina){
    $resultados = obtenerTodosArticulos($connexio, $start, $cantidad_articulos_por_pagina);
    $listaArticulos = '';
    foreach ($resultados as $articulo) {
        $listaArticulos .= '<li>' . $articulo['article_id'] . ' - ' . $articulo['article'] . '</li>';
    }
    return $listaArticulos;
}

function elegirCantidadArticulosPorPagina(){
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

// Pasa las variables a la vista
include_once '../vista/Index_view.php';
?>
