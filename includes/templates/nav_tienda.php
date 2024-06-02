<div class="nav">
    <div id="istreaming" class="nav__tienda">
            <img class="nav__tienda__imagen" src="/build/img/streaming.webp" alt="avatar">
            <div class="nav__tienda__informacion">
                <p class="nav__tienda__nombre">Servicios Streaming</p>
                <p class="nav__tienda__nombre"><?php $cantidad = 0; foreach ($plataformas as $plataforma) {
                        if($plataforma->categoria != '1') continue;
                        $cantidad++;
                    } echo $cantidad ?></p>
            </div>
    </div><!-- .nav__tienda -->
    <div id="ivideojuegos" class="nav__tienda">
            <img class="nav__tienda__imagen" src="/build/img/videojuegos.webp" alt="avatar">
            <div class="nav__tienda__informacion">
                <p class="nav__tienda__nombre">Videojuegos</p>
                <p class="nav__tienda__nombre"><?php $cantidad = 0; foreach ($plataformas as $plataforma) {
                            if($plataforma->categoria != '2') continue;
                            $cantidad++;
                        } echo $cantidad ?></p>
            </div>
    </div><!-- .nav__tienda -->
    <div id="irecargas"  class="nav__tienda">
            <img class="nav__tienda__imagen" src="/build/img/recarga.webp" alt="avatar">
            <div class="nav__tienda__informacion">
                <p class="nav__tienda__nombre">Recargas Móviles y TV</p>
                <p class="nav__tienda__nombre"><?php $cantidad = 0; foreach ($plataformas as $plataforma) {
                            if($plataforma->categoria != '3') continue;
                            $cantidad++;
                        } echo $cantidad ?></p>
            </div>
    </div><!-- .nav__tienda -->
</div><!-- .nav -->