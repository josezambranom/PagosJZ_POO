<?php
    require 'includes/app.php';

    use App\Persona;
    use App\Usuario;
    use PHPMailer\PHPMailer\PHPMailer;

    $persona = new Persona();
    $usuario = new Usuario();

    // Arreglo con mensajes de errores
    $errores = Persona::getErrores();
    $errores = Usuario::getErrores();

    $registro = Persona::all();
    foreach ($registro as $r){
        $id = $r->id+1;
    }

    $resultado = $_GET['result'] ?? null;

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
    $email_template = file_get_contents('verificar_email.html');

     // Ejecutar el código después de que el usuario envía el form
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $persona = new Persona($_POST['persona']);
        $usuario = new Usuario($_POST['usuario']);

        $errores = $persona->validar();
        $errores = $usuario->validar();

        $usuario->tipousuario = '0';
        $usuario->personaid = $id;
        $usuario->token = $token;
        $usuario->clave = hashPassword($usuario->clave);

        // Reemplaza el token del usuario en el enlace
        $email_template = str_replace('$token', $usuario->token, $email_template);
        $email_template = str_replace('$anio', date('Y'), $email_template);
        
        if(empty($errores)) {
            if($persona->guardar()) {
                if($usuario->guardar()) {
                    $mail->addAddress($usuario->email);
                    $mail->Subject = 'Confirmacion de Cuenta';
                    $mail->msgHTML($email_template, __DIR__);
                    $mail->send();
                    header('Location: /registro.php?result=1');
                }
            }
        }
     }
     
     
    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Registro</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <?php
            $mensaje = mostrarMensaje(intval($resultado));
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
        <?php } ?>

        <form class="formulario" method="POST">
            <?php include 'includes/templates/formulario_registro.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Registrar">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>