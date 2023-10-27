<?php
//Created by: Alberto Morcillo

try {
    // Establecer la conexión a la base de datos
    $connexio = new PDO('mysql:host=localhost;dbname=pt04_alberto_morcillo', 'root', '');

    // Establecer el modo de errores para PDO
    $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Manejar errores de conexión
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    die();
}

function obtenerTodosArticulos($connexio, $start, $cantidad_articulos_por_pagina){
    $statement = $connexio->prepare("SELECT * FROM articles LIMIT :start, :cantidad");
    $statement->bindParam(':start', $start, PDO::PARAM_INT);
    $statement->bindParam(':cantidad', $cantidad_articulos_por_pagina, PDO::PARAM_INT);
    $statement->execute();
    $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

function calcularTotalArticulos($connexio){
    $statement = $connexio->query('SELECT COUNT(*) FROM articles');
    $total_articulos = $statement->fetchColumn();
    return $total_articulos;
}

/**
 * calcularTotalPaginas
 *
 * @param  mixed $connexio a la base de datos
 * @param  mixed $cantidad_articulos_por_pagina 
 * @return void
 */
function calcularTotalPaginas($connexio, $cantidad_articulos_por_pagina){
    $total_articulos = calcularTotalArticulos($connexio);
    $numero_paginas = ceil($total_articulos / $cantidad_articulos_por_pagina);
    return $numero_paginas;
}

/**
 * comprobarUsuarioExistente
 *
 * @param  mixed $connexio a la base de datos
 * @param  mixed $email email a comprobar
 * @return void
 */
function comprobarUsuarioExistente($connexio, $email){
    $statement = $connexio->prepare("SELECT * FROM usuaris WHERE email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

/**
 * validarEmailExistente
 *
 * @param  mixed $email email a validar
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function validarEmailExistente($email, $connexio) {
    $statement = $connexio->prepare('SELECT * FROM usuaris WHERE email = :email');
    $statement->execute(array(':email' => $email));

    return $statement->rowCount() > 0;
}

/**
 * insertarUsuario
 *
 * @param  mixed $email email a insertar
 * @param  mixed $password password a insertar
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function insertarUsuario($email, $password, $connexio){
    try {
        $statement = $connexio->prepare('INSERT INTO usuaris (email, contrasena) VALUES (:email, :contrasena)');
        $statement->execute(array(':email' => $email, ':contrasena' => $password));
        return true; // Inserción exitosa
    } catch (PDOException $e) {
        // Error al insertar, puedes manejar el error aquí si es necesario
        return false; // Inserción fallida
    }
}

/**
 * insertarArticulo
 *
 * @param  mixed $articuloInsertado articulo a insertar
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function insertarArticulo($articuloInsertado, $connexio){
    try {
        // Obtener el ID del usuario actualmente logueado
        if (isset($_SESSION["usuari_id"])){
            $usuari_id = $_SESSION['usuari_id'];
        }
        
        $statement = $connexio->prepare('INSERT INTO articles (article, usuari_id) VALUES (:article, :usuari_id)');
        $statement->bindParam(':article', $articuloInsertado);
        $statement->bindParam(':usuari_id', $usuari_id);
        $statement->execute();
      
        // Esto devuelve el ID del artículo insertado
        return $connexio->lastInsertId();
    } catch(PDOException $e) {
        // Manejar el error de alguna manera (por ejemplo, mostrar un mensaje de error al usuario)
        echo "Error al insertar el artículo: " . $e->getMessage();
    }
}

/**
 * getUserId
 *
 * @param  mixed $email email a buscar
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function getUserId($email, $connexio)
{
    try {
        $statement = $connexio->prepare('SELECT usuari_id FROM usuaris WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();

        if (is_array($result)) {
            return $result['usuari_id'];
        } else {
            return null;
        }

    } catch (PDOException $e) {
        echo "Error al buscar el user_id: " . $e->getMessage();
        return null;
    }
}

/**
 * verificarArticuloPerteneceUsuario
 *
 * @param  mixed $articleId id del articulo
 * @param  mixed $userId id del usuario
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function verificarArticuloPerteneceUsuario($articleId, $userId, $connexio) {
    $statement = $connexio->prepare('SELECT COUNT(*) FROM articles WHERE article_id = :articleId AND usuari_id = :userId');
    $statement->execute(array(':articleId' => $articleId, ':userId' => $userId));
    $count = $statement->fetchColumn();
    return $count > 0;
}

/**
 * borrarArticulo
 *
 * @param  mixed $article_id id del articulo
 * @param  mixed $usuari_id id del usuario
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function borrarArticulo($article_id, $usuari_id, $connexio){
    try {
        // Preparar la consulta SQL con una cláusula WHERE para asegurar que solo se elimine el artículo del usuario actual
        $statement = $connexio->prepare('DELETE FROM articles WHERE article_id = :article_id AND usuari_id = :usuari_id');
        $statement->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $statement->bindParam(':usuari_id', $usuari_id, PDO::PARAM_INT);
        $statement->execute();
        // Verificar si se eliminó el artículo correctamente
        if ($statement->rowCount() > 0) {
            return true; // El artículo se eliminó correctamente
        } else {
            return false; // No se encontró el artículo para eliminar
        }
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo "Error al borrar el artículo: " . $e->getMessage();
        return false;
    }
}

/**
 * obtenerHashContrase
 *
 * @param  mixed $email email a buscar
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function obtenerHashContraseña($email, $connexio) {
    $statement = $connexio->prepare('SELECT contrasena FROM usuaris WHERE email = :email');
    $statement->bindValue(':email', $email);
    $statement->execute();
    $result = $statement->fetchColumn();

    return $result;
}

?>