<?php

    use App\Plataforma;

    require 'includes/app.php';
    incluirTemplate('header');

    $plataformas = Plataforma::allorder();
?>

<main class="contenedor">
        <h1>Nuestros Productos</h1>
        <p><span class="negrita">Atención:</span> Para continuar con el proceso de compra debe dar clic en la plataforma o servicio de su elección.</p>
        
        <section>
            <div class="grid">
                <?php foreach($plataformas as $plataforma):
                    if ($plataforma->estado === '1') { ?>
                    <div class="producto">
                        <a href="producto.php?id=<?php echo $plataforma->id ?>">
                            <img class="producto__imagen" loading="lazy" src="/imagenes/<?php echo $plataforma->imagen ?>" alt="avatar">
                            <div class="producto__informacion">
                                <p class="producto__nombre"><?php echo $plataforma->plataforma ?></p>
                                <p class="producto__precio"><?php echo '$ ' . $plataforma->precio ?></p>
                            </div>
                        </a>
                    </div><!-- .producto -->
                <?php } endforeach; ?>
            </div><!-- .grid -->
        </section>
    </main>

<?php
    incluirTemplate('footer');
?>