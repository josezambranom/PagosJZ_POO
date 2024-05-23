<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion">
        <h1>Inicio de Sesión</h1>

        <form class="formulario" method="POST">
            <?php include 'includes/templates/formulario_login.php'; ?>
            <input class="boton boton-rojo" type="submit" value="Ingresar">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>