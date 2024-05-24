<?php

define ('TEMPLATES_URL', __DIR__ . '/templates');
define ('FUNCIONES_URL',  'funciones.php');
define ('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function debugear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapar/Sanitizar html
function s($html):string {
    $s = htmlspecialchars($html);
    return $s;
}

// Mostrar Mensajes
function mostrarMensaje($codigo) {
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = 'Registrado con éxito';
        break;
        case 2:
            $mensaje = 'Actualizado con éxito';
        break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
        break;
        default:
            $mensaje = false;
        break;
    }

    return $mensaje;
}

// Hashear clave
function hashPassword($password) {
    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
    return $passwordHashed;
}

function tipoUsuario($user) {
    switch ($user) {
        case '0': 
            return 'user/index.php?id='; 
        break; 
        case '1': 
            return 'admin/index.php?id='; 
        break; 
        default:
            return '';
        break;
    }
}