<?php

use App\Usuario;

require 'includes/app.php';

$token = $_GET['token'] ?? false;


$errores = Usuario::getErrores();
$usuario = "";

if ($token) {
    $usuario = Usuario::findcond('token', $token);
    $usuario->token = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $arg = $_POST['usuario'];
    
        if($arg['clave']) {
            $usuario->clave = hashPassword($arg['clave']);
        } else {
            $errores = 'La clave es obligatoria';
        }
    
        if(empty($errores)) {
            $usuario->guardar();
            header('Location: /login.php?result=2');
        }
    }
} else {
    header('Location: /');
}

incluirTemplate('header');

?>

<main class="contenedor seccion">

    <h2>Recuperación de la cuenta</h2>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información Usuario</legend>
            <label for="clave">Clave</label>
            <input type="password" name="usuario[clave]" id="clave" placeholder="Ingrese Nueva Clave"
                minlength="8" maxlength="15" require>
            <div class="mostrarClave">
                <input type="checkbox" class="toggle">
                <p>Mostrar Contraseña</p>
            </div>
        </fieldset>
        <input class="boton-verde" type="submit" value="Cambiar Clave">
    </form>
</main>

<?php
incluirTemplate('footer');
?>