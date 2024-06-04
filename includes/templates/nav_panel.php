<div class="nav">
    <div id="iplataforma" class="nav__tienda">
            <img class="nav__tienda__imagen" src="/build/img/streaming.webp" alt="avatar">
            <div class="nav__tienda__informacion">
                <p class="nav__tienda__nombre">Plataformas</p>
                <p class="nav__tienda__nombre"><?php $cantidad = 0; foreach ($plataformas as $plataforma) {
                        $cantidad++;
                    } echo $cantidad ?></p>
            </div>
    </div><!-- .nav__tienda -->
    <div id="icuenta"  class="nav__tienda">
            <img class="nav__tienda__imagen" src="/build/img/recarga.webp" alt="avatar">
            <div class="nav__tienda__informacion">
                <p class="nav__tienda__nombre">Cuentas</p>
                <p class="nav__tienda__nombre"><?php $cantidad = 0; foreach ($cuentas as $cuenta) {
                            $cantidad++;
                        } echo $cantidad ?></p>
            </div>
    </div><!-- .nav__tienda -->
</div><!-- .nav -->