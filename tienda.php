<?php

    use App\Plataforma;

    require 'includes/app.php';

    $plataformas = Plataforma::allorder();
    
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1>Nuestros Productos</h1>

        <?php include 'includes/templates/nav_tienda.php'; ?>

        <p><span class="negrita">Atención:</span> Para continuar con el proceso de compra debe dar clic en la plataforma o servicio de su elección.</p>
        
        <section>
            <h2 id="streaming">Servicios Streaming</h2>
            <div class="grid">
                <?php foreach($plataformas as $plataforma):
                    if($plataforma->categoria === '1'){
                        if ($plataforma->estado === '1') { ?>
                        <div class="producto">
                            <a href="producto.php?id=<?php echo s($plataforma->id) ?>">
                                <img class="producto__imagen" src="/imagenes/<?php echo categoria($plataforma->categoria)?>/<?php echo $plataforma->imagen?>" alt="avatar">
                                <div class="producto__informacion">
                                    <p class="producto__nombre"><?php echo $plataforma->plataforma ?></p>
                                    <p class="producto__precio"><?php echo '$ ' . $plataforma->precio ?></p>
                                </div>
                            </a>
                        </div><!-- .producto -->
                <?php } } endforeach; ?>
            </div><!-- .grid -->

            <h2 id="videojuegos">Videojuegos</h2>
            <div class="grid">
                <?php foreach($plataformas as $plataforma):
                    if($plataforma->categoria === '2'){
                        if ($plataforma->estado === '1') { ?>
                        <div class="producto">
                            <a href="producto.php?id=<?php echo s($plataforma->id) ?>">
                                <img class="producto__imagen" src="/imagenes/<?php echo categoria($plataforma->categoria)?>/<?php echo $plataforma->imagen?>" alt="avatar">
                                <div class="producto__informacion">
                                    <p class="producto__nombre"><?php echo $plataforma->plataforma ?></p>
                                    <p class="producto__precio"><?php echo '$ ' . $plataforma->precio ?></p>
                                </div>
                            </a>
                        </div><!-- .producto -->
                <?php } } endforeach; ?>
            </div><!-- .grid -->

            <h2 id="recargas">Recargas móviles y TV</h2>
            <div class="grid">
                <?php foreach($plataformas as $plataforma):
                    if($plataforma->categoria === '3'){
                        if ($plataforma->estado === '1') { ?>
                        <div class="producto">
                            <a href="producto.php?id=<?php echo s($plataforma->id) ?>">
                                <img class="producto__imagen" src="/imagenes/<?php echo categoria($plataforma->categoria)?>/<?php echo $plataforma->imagen?>" alt="avatar">
                                <div class="producto__informacion">
                                    <p class="producto__nombre"><?php echo $plataforma->plataforma ?></p>
                                    <p class="producto__precio"><?php echo '$ ' . $plataforma->precio ?></p>
                                </div>
                            </a>
                        </div><!-- .producto -->
                <?php } } endforeach; ?>
            </div><!-- .grid -->

        </section>
    </main>

<?php
    incluirTemplate('footer');
?>