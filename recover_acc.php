<?php

    use App\Usuario;

    require 'includes/app.php';
    $errores = Usuario::getErrores();
    $token = generarToken();
    $alert = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $arg = $_POST['usuario'];

        if($arg['email']) {
            $usuario = Usuario::findcond('email', $arg['email']);
            ($usuario) ? $usuario->token = $token : $errores[] = 'Usuario no existe';
        } else {
            $errores [] = 'El usuario es obligatorio';
        }

        if(empty($errores)){
            ($usuario->guardar()) ? $alert = 'Las instrucciones de recuperación han sido enviadas a su email' : $errores[] = 'Error al enviar';
        }
    }


    incluirTemplate('header');
?>

<main class="contenedor seccion">

    <h2>Recuperación de la cuenta</h2>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error;?>
        </div>
    <?php endforeach;?>

    <?php
        if($alert) { ?>
            <p class="alerta exito"><?php echo s($alert); ?></p>
    <?php } ?>

    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información Usuario</legend>
            <label for="email">Usuario</label>
            <input type="email" name="usuario[email]" id="email" placeholder="Ingrese Usuario">
        </fieldset>
        <input class="boton-verde" type="submit" value="Verificar">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>