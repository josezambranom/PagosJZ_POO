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

    <div class="camisa">
        <img class="imagen-smoll" src="/imagenes/<?php echo $plataforma->imagen ?>" alt=carrito">
        <div class="camisa__contenido">
        <form class="formulario" method="POST">
            <p><?php echo $plataforma->plataforma ?></p>
            <p><?php echo $plataforma->precio ?></p>
            <input name="cantidad" class="formulario__campo" type="number" placeholder="Cantidad" min="1" require>
            <input class="formulario__submit" type="submit" value="Comprar" >
        </form>
        <p>Nota: Al dar clic en COMPRAR serás redireccionado a WhatsApp, para continuar con el proceso.</p>
        </div>
    </div>
</main>

<?php
    incluirTemplate('footer');
?>