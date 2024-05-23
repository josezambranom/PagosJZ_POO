<?php
    require 'includes/app.php';
    incluirTemplate('header');

    use App\Persona;
    use App\Usuario;

    $persona = new Persona();
    $usuario = new Usuario();

     // Arreglo con mensajes de errores
     $errores = Persona::getErrores();
     $errores = Usuario::getErrores();

     // Ejecutar el código después de que el usuario envía el form
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $persona = new Persona($_POST['persona']);
        $usuario = new Usuario($_POST['usuario']);

        $errores = $persona->validar();
        $errores = $usuario->validar();
     }
?>

<main class="contenedor seccion">
        <h1>Registro</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include 'includes/templates/formulario_registro.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Registrar">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>