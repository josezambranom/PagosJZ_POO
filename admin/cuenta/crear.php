<?php
    require '../../includes/app.php';
    incluirTemplate('header');
    
    estaAutenticado();

    use App\Cuenta;
    use App\Persona;
    use App\Plataforma;
    use App\Usuario;

    $plataformas = Plataforma::allorder();
    $personas = Persona::all();
    $usuarios = Usuario::all();
    $cuenta = new Cuenta();
    $errores = Cuenta::getErrores();

    $id = $_SESSION['id'] ?? false;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $cuenta = new Cuenta($_POST['cuenta']);
        $cuenta->usuarioid = $id;
        $errores = $cuenta->validar();
        
        if($cuenta->perfil != 5) {
            $pin = rand(0000, 9999);
            $cuenta->pin = $pin;
        }
        // Revisar que el array de errores este vacio
        if(empty($errores)) { 
            
            // Guarda en la BD
            $res = $cuenta->guardar();

            if($res){
                header('Location: /admin/index.php?result=1');
            }
        }
    }
?>

<main class="contenedor seccion">
    <h2>Crear Cuenta</h2>
    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_cuenta.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Crear Cuenta">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>