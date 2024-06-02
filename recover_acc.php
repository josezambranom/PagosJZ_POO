<?php

    use App\Usuario;
    use PHPMailer\PHPMailer\PHPMailer;

    require 'includes/app.php';
    $errores = Usuario::getErrores();
    $alert = '';

    $token = generarToken();

    $mail = new PHPMailer();
    $mail->isSMTP(true);
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@puntodepagosjz.com';
    $mail->Password = 'Reply2024.';
    $mail->SMTPSecure = 'tls';
    $mail->setFrom('no-reply@puntodepagosjz.com');

    // Lee el contenido HTML del archivo
    $email_template = file_get_contents('cambio_clave.html');

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $arg = $_POST['usuario'];

        if($arg['email']) {
            $usuario = Usuario::findcond('email', $arg['email']);
            ($usuario) ? $usuario->token = $token : $errores[] = 'Usuario no existe';
            ($usuario->confirmado === '0') ? $errores[] = 'Email no verificado' : '' ;
            $email_template = str_replace('$token', $usuario->token, $email_template);
            $email_template = str_replace('$anio', date('Y'), $email_template);
        } else {
            $errores [] = 'El usuario es obligatorio';
        }

        if(empty($errores)){
            if($usuario->guardar()) {
                $mail->addAddress($usuario->email);
                $mail->Subject = 'Confirmacion de Cuenta';
                $mail->msgHTML($email_template, __DIR__);
                
                if($mail->send()){
                    $alert = 'Las instrucciones de recuperación han sido enviadas a su email';
                } else {
                    $errores[] = 'Error al enviar';
                }
            }
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