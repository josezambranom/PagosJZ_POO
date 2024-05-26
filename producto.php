<?php

    use App\Plataforma;

    require 'includes/app.php';
    incluirTemplate('header');

    $id = $_GET['id'] ?? false;
    ($id) ? $plataforma = Plataforma::find($id) : '';
    $error = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cantidad = $_POST['cantidad'];
        ($cantidad) ? enviarMensaje($plataforma->plataforma, $cantidad, $plataforma->precio) : $error = 'Debes ingresar una cantidad';
    }
?>

<main class="contenedor">
    <h1>Proceso de compra</h1>

    <?php if($error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>

    <div class="nosotros">
        <img class="imagen-smoll" src="/imagenes/<?php echo $plataforma->imagen ?>" alt=carrito">
        <div class="nosotros__contenido">
            <form class="producto_form" method="POST">
                <p class="producto_plataforma"><?php echo $plataforma->plataforma ?></p>
                <p class="producto_nombre"><?php echo '$ ' . $plataforma->precio ?></p>
                <input class="producto_cantidad" name="cantidad" type="number" placeholder="Cantidad" min="1">
                <input class="boton-verde" type="submit" value="Comprar" >
            </form>
            <p class="nota">Nota: Al dar clic en COMPRAR serás redireccionado a WhatsApp, para continuar con el proceso.</p>
        </div>
    </div>
</main>

<?php
    incluirTemplate('footer');
?>