<?php
    require '../../includes/app.php';
    incluirTemplate('header');
    estaAutenticado();

use App\Persona;
use App\Plataforma;
use App\Usuario;
use Intervention\Image\ImageManager;

    // Validar por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('location: /admin');
    }
    
    $plataforma = Plataforma::find($id);
    $usuarios = Usuario::all();
    $personas = Persona::all();
    
    $errores = Plataforma::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {  

        $arg = $_POST['plataforma'];
        $plataforma->sincronizar($arg);
        // Subida de archivos
        $manager = new ImageManager(
            new Intervention\Image\Drivers\Gd\Driver()
        );
        // Generar nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) . ".webp"; // Usar .webp como extensión
        
        // Setear la imagen
        // Realiza un resize a la imagen con Intervention
        $imagePath = $_FILES['plataforma']['tmp_name']['imagen'];
        if ($imagePath) {        
            // Leer y redimensionar la imagen
            $image = $manager->read($imagePath)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        
            // Convertir a webp y guardar
            $image = $image->toWebp();
        
            // Establecer la imagen en el objeto plataforma
            $plataforma->setImagen($nombreImagen);
        }

        $errores = $plataforma->validar();

        // Revisar que el array de errores este vacio
        if(empty($errores)) {             
            // Guarda en la BD
            $res = $plataforma->guardar();
            if($res){
                // Guarda la imagen en el server
                ($imagePath) ? $image->save(CARPETA_IMAGENES . $nombreImagen) : '';
                header('Location: /admin/index.php?result=2');
            }
        }
    }
?>

<main class="contenedor seccion">
    <h2>Actualizar Plataforma</h2>
    <a class="boton boton-verde" href="/admin">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_plataforma.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Actualizar Plataforma">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>