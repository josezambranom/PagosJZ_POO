<?php
    require 'includes/app.php';

    use App\Persona;
    use App\Usuario;
    estaAutenticado();

    // Validar por ID valido
    $id = $_SESSION['id'];

    $persona = Persona::find($id);
    $usuario = Usuario::find($id);

    // Arreglo con mensajes de errores
    $errores = Persona::getErrores();
    $errores = Usuario::getErrores();

    $resultado = $_GET['result'] ?? null;

     // Ejecutar el código después de que el usuario envía el form
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $persona_arg = ($_POST['persona']);
        $usuario_arg = ($_POST['usuario']);

        $persona->sincronizar($persona_arg);
        $usuario->sincronizar($usuario_arg);

        $errores = $persona->validar();
        $errores = $usuario->validar();

        $usuario->clave = hashPassword($usuario->clave);

        if(empty($errores)) {
            if($persona->guardar()) {
                if($usuario->guardar()) {
                    header('Location: /registro.php?result=2');
                }
            }
        }
        
     }
     
    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Mi Perfil</h1>

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

        <h2>Actualizar mis datos</h2>

        <form class="formulario" method="POST">
            <?php include 'includes/templates/formulario_registro.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Actualizar mis datos">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>