<?php

define ('TEMPLATES_URL', __DIR__ . '/templates');
define ('FUNCIONES_URL',  'funciones.php');
define ('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado() {
    // Verifica si la sesión no está ya iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica si el usuario no está autenticado
    if (!$_SESSION['login']) {
        header('Location: /');
        exit; // Es una buena práctica llamar a exit() después de header() para detener la ejecución del script
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

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['plataforma', 'cuenta'];
    return in_array($tipo, $tipos); // Permite buscar un string/valor dentro de un arreglo
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
        case 4:
            $mensaje = 'No es posible ejecutar la operación, verifique restricciones';
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
            return 'user/'; 
        break; 
        case '1': 
            return 'admin/'; 
        break; 
        default:
            return '';
        break;
    }
}

function idTipoUsuario($user) {
    switch ($user) {
        case '0': 
            return 'Cliente'; 
        break; 
        case '1': 
            return 'Administrador'; 
        break; 
        default:
            return '';
        break;
    }
}

function calcularDiasRestantes($fecha_inicial, $dias_restantes) {
    $fechaInicial = new DateTime($fecha_inicial);
    $fechaActual = new DateTime();
    $diferencia = $fechaInicial->diff($fechaActual)->days;
    $diasRestantes = max(0, $dias_restantes - $diferencia);
    return $diasRestantes;
}

function enviarMensaje($plataforma, $cantidad, $precio) {
    $num = '593963177642';
    $msg = '¡Hola! 👋🏻, estoy comprando desde la tienda online. Deseo *' . $cantidad . '* cuenta(s) de *'
        . $plataforma . '*. *Nota:* El valor de mi compra es de $ ' . $cantidad*$precio;
    
        $urlVenta = "whatsapp://send?phone=" . urlencode($num) . "&text=" . urlencode($msg);

    // Redireccionar a la página de venta
    header("Location: " . $urlVenta);
    exit; // Asegura que el script se detenga después de la redirección
}