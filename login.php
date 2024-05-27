<?php
    require 'includes/app.php';

    use App\Usuario;

    $email = Usuario::all();
    $errores = Usuario::getErrores();

    $tipousuario = '';
    $alert = '';
    $auth = '';

    // Ejecutar el código después de que el usuario envía el form
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuario = new Usuario($_POST['usuario']);
        $errores = $usuario->validar();

        if(empty($errores)) {
            foreach($email as $user) {
                if ($user->email === $usuario->email) {
                    $auth = password_verify($usuario->clave, $user->clave);
                    if($auth) {
                        $url = tipoUsuario($user->tipousuario);
                        if($url !== '') {
                            if($user->confirmado === '1') {
                                session_start();
                                // Llenar el arreglo de la sesión
                                $_SESSION['id'] = $user->id;
                                $_SESSION['usuario'] = $user->email;
                                $_SESSION['login'] = true;
                                $_SESSION['tipoid'] = $user->tipousuario;
                                header('Location: /' . $url);
                            } else {
                                $alert = 'Email no verificado, por favor revise su bandeja de entrada';
                            }
                        } else {
                            $alert = 'No es posible inciar sesión';
                        }                        
                    } else {
                        $alert = 'Contraseña incorrecta';
                    }
                }
            }
            if (!$alert){
                $alert = 'Usuario no registrado';
            }
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Inicio de Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; echo $alert;?>
            </div>
        <?php endforeach;
        
        if($alert !== '') {?>
            <div class="alerta error">
                <?php echo $alert?>
            </div>
        <?php }?>

        <form id="form" class="formulario" method="POST">
            <?php include 'includes/templates/formulario_login.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Ingresar">
        </form>


    </main>

<?php
    incluirTemplate('footer');
?>