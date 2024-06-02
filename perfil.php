<?php
    require 'includes/app.php';

    use App\Persona;
    use App\Usuario;
    
    estaAutenticado();

    // Validar por ID valido
    $id = $_SESSION['id'];

    $usuario = Usuario::find($id);
    $persona = Persona::find($usuario->personaid);
    
    // Arreglo con mensajes de errores
    $errores = Persona::getErrores();
    $errores = Usuario::getErrores();

    $resultado = $_GET['result'] ?? null;

     // Ejecutar el código después de que el usuario envía el form
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST['persona']) {
            $persona_arg = ($_POST['persona']);
            ($persona_arg) ? $persona->sincronizar($persona_arg): '';

            $errores = $persona->validar();   
        }

        if($_POST['usuario']) {

            $usuario_arg = ($_POST['usuario']);
            ($usuario_arg) ? $usuario->sincronizar($usuario_arg): '';

            $errores = $usuario->validar();
            $usuario->clave = hashPassword($usuario->clave);
        }

        if(empty($errores)) {
            if($persona->guardar()) {
                if($usuario->guardar()) {
                    header('Location: /perfil.php?result=2');
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
            <?php include 'includes/templates/formulario_usuario.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Actualizar mis datos">
        </form>

        <button id="boton" class="boton-verde" onclick="mostrarCampo()">Cambiar Contraseña</button>

        <form id="ocultar" class="formulario hidden" method="POST">
        <fieldset>
            <legend>Información Usuario</legend>
            <label for="clave">Nueva Clave</label>
            <input type='hidden' name="persona[]" value="">
            <input type="password" name="usuario[clave]" id="clave" placeholder="Ingrese su Contraseña"
                 minlength="8" maxlength="15" require-->
            <div class="mostrarClave">
                <input type="checkbox" class="toggle">
                <p>Mostrar Contraseña</p>
            </div>
        </fieldset>
            <input class="boton boton-rojo" type="submit" value="Actualizar Contraseña">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>