<?php
//Created by: Alberto Morcillo

/**
 * validarEmailLogin
 *
 * @param  mixed $email email a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarEmailLogin($email, &$errors){
    validarEmailGeneral($email, $errors);
}

/**
 * validarPasswordLogin
 *
 * @param  mixed $password password a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarPasswordLogin($password, &$errors){
    validarPasswordGeneral($password, $errors);
  
}

/**
 * validarEmailSignin
 *
 * @param  mixed $email email a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarEmailSignin($email, &$errors){
    validarEmailGeneral($email, $errors);
    
}

/**
 * validarPasswordSignin
 *
 * @param  mixed $password password a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarPasswordSignin($password, &$errors){
    validarPasswordGeneral($password, $errors);
    
}

/**
 * validarEmailGeneral
 *
 * @param  mixed $email email a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarEmailGeneral($email, &$errors){
    if (empty($email)) {
        $errors .= 'El email no puede estar vacío.<br>';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors .= 'El email no es válido.<br>';
        }
    }
}

/**
 * validarPasswordGeneral
 *
 * @param  mixed $password password a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarPasswordGeneral($password, &$errors) {
    if (empty($password)){
        $errors .= 'La contraseña no puede estar vacía.<br>';
    } else {
        if (strlen($password) < 6) {
            $errors .= 'La contraseña debe tener al menos 6 caracteres.<br>';
        } else {
            if (!preg_match('`[a-z]`',$password)){
                $errors .= 'La contraseña debe tener al menos una letra minúscula.<br>';
            } else {
                if (!preg_match('`[A-Z]`',$password)){
                    $errors .= 'La contraseña debe tener al menos una letra mayúscula.<br>';
                } else {
                    if (!preg_match('`[0-9]`',$password)){
                        $errors .= 'La contraseña debe tener al menos un caracter numérico.<br>';
                    }
                }
            }
        }
    }
}

/**
 * validarPasswordRepetida
 *
 * @param  mixed $password password a validar
 * @param  mixed $errors errores
 * @param  mixed $passwordRepetida password repetida a validar
 * @return void
 */
function validarPasswordRepetida($password, &$errors, $passwordRepetida){
    if(empty($passwordRepetida)){
        $errors .= 'El campo de repetir contraseña no puede estar vacío.<br>';
    }
    else{
        if($passwordRepetida != $password){
            $errors .= 'Las contraseñas no coinciden.<br>';
        }
    }
}

/**
 * validarArticulo
 *
 * @param  mixed $articuloInsertado articulo a validar
 * @param  mixed $errors errores
 * @return void
 */
function validarArticulo($articuloInsertado, &$errors){
    if(empty($articuloInsertado)){
        $errors .= 'El campo de escribir articulo no puede estar vacío a la hora de añadirlo.<br>';
    }
}

/**
 * validarArticuloBorrar
 *
 * @param  mixed $articuloBorrado articulo a validar
 * @param  mixed $userId id del usuario
 * @param  mixed $errors errores
 * @param  mixed $connexio a la base de datos
 * @return void
 */
function validarArticuloBorrar($articuloBorrado, $userId, &$errors, $connexio){
    if(empty($articuloBorrado)){
        $errors .= 'El campo para indicar qué artículo quieres borrar no puede estar vacío si quieres eliminarlo.<br>';
    } elseif(!preg_match('/^[1-9][0-9]*$/', $articuloBorrado)) {
        $errors .= 'Solo puedes ingresar números mayores que 0 en el campo de artículo a borrar.<br>';
    } else {
        $article_id = intval($articuloBorrado);
        
        // Verificar si el artículo pertenece al usuario actual
        if (!verificarArticuloPerteneceUsuario($article_id, $userId, $connexio)) {
            $errors .= 'No puedes borrar un artículo que no te pertenece.<br>';
        }
        
        return $article_id;
    }
}


?>