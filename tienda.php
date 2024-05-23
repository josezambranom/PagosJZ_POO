<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1>Nuestros Productos</h1>
        <p><span class="negrita">Atención:</span> Para continuar con el proceso de compra debe dar clic en la plataforma o servicio de su elección.</p>
        
        <section>
            <h2>Servicios Streaming</h2>
            <div class="grid">
                <div class="producto">
                    <a href="producto.html">
                        <img class="producto__imagen" loading="lazy" src="build/img/streaming/primevideo.jpg" alt="primevideo">
                        <div class="producto__informacion">
                            <p class="producto__nombre">Amazon Prime Video Completa</p>
                            <p class="producto__precio">$ 6</p>
                        </div>
                    </a>
                </div><!-- .producto -->
            </div><!-- .grid -->
        </section>
    </main>

<?php
    incluirTemplate('footer');
?>