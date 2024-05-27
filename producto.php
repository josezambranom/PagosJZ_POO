<?php

    use App\Plataforma;

    require 'includes/app.php';

    $id = $_GET['id'] ?? false;
    ($id) ? $plataforma = Plataforma::find($id) : '';
    $error = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cantidad = $_POST['cantidad'];
        ($cantidad) ? enviarMensaje($plataforma->plataforma, $cantidad, $plataforma->precio) : $error = 'Debes ingresar una cantidad';
    }

    incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Proceso de compra</h1>

    <?php if($error) { ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php } ?>

    <div class="product">
        <img class="product__img" src="/imagenes/<?php echo $plataforma->imagen ?>" alt=carrito">
        <div class="product__contenido">
            <form class="product__form" method="POST">
                <p class="product__plataforma"><?php echo $plataforma->plataforma ?></p>
                <p class="product__nombre"><?php echo '$ ' . $plataforma->precio ?></p>
                <input class="product__cantidad" name="cantidad" type="number" placeholder="Cantidad" min="1">
                <input class="boton-verde" type="submit" value="Comprar" >
            </form>
            <p class="nota"><span>Nota:</span> Al dar clic en COMPRAR serás redireccionado a WhatsApp, para continuar con el proceso.</p>
        </div>
    </div>
</main>

<?php
    incluirTemplate('footer');
?>