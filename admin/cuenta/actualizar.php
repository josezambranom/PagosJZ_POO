<?php
    require '../../includes/app.php';
    
    estaAutenticado();

    use App\Cuenta;
    use App\Plataforma;
    use App\Persona;
    use App\Usuario;

    // Validar por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('location: /admin');
    }

    $plataformas = Plataforma::allorder('plataforma', 'ASC');
    $personas = Persona::all();
    $usuarios = Usuario::all();
    $cuenta = Cuenta::find($id);
    $errores = Cuenta::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $args = ($_POST['cuenta']);
        $cuenta->sincronizar($args);
        $errores = $cuenta->validar();

        // Revisar que el array de errores este vacio
        if(empty($errores)) { 
            
            // Guarda en la BD
            $res = $cuenta->guardar();

            if($res){
                header('Location: /admin/index.php?result=2');
            }
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h2>Actualizar Cuenta</h2>
    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_cuenta.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Actualizar Cuenta">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>