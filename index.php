<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor">
        <h1>¿Quiénes Somos?</h1>

        <div class="nosotros">
            <picture>
                <source srcset="build/img/portada.webp" type="image/webp">
                <source srcset="build/img/portada.png" type="image/png">
                <img class="nosotros__imagen" loading="lazy" src="build/img/portada.webp" alt="imagenNosotros">
            </picture>
            <div class="nosotros__contenido">
                <p>
                    ¡Bienvenido a Punto de Pagos "JZ"! Ofrecemos las mejores cuentas a precios altamente competitivos, respaldados
                    por la garantía de calidad. Nuestra dedicación a la excelencia se refleja en cada cuenta que ofrecemos, respaldada
                    por un servicio al cliente excepcional. Explora nuestras ofertas especiales y descubre por qué 
                    tantos clientes confían en nosotros para sus necesidades. No solo vendemos cuentas, ¡ofrecemos experiencias únicas!
                </p>
            </div><!-- .nosotros__contenido -->
        </div><!-- .nosotros -->

        <section class="contenedor comprar">
            <h2 class="comprar__titulo">¿Por qué comprar con Nosotros?</h2>
            <div class="bloques">

                <div class="bloque">
                    <picture>
                        <source srcset="build/img/icono_1.webp" type="image/webp">
                        <source srcset="build/img/icono_1.png" type="image/png">
                        <img class="bloque__imagen" loading="lazy" src="build/img/icono_1.png" alt="porQueComprar">
                    </picture>
                    <h3 class="bloque__titulo">El Mejor Precio</h3>
                    <p>
                        Aquí encontrarás los mejores precios en servicios de entretenimiento de alta calidad. Nuestra dedicación a ofrecer tarifas
                        competitivas asegura que cada experiencia sea una inversión inteligente. Explora nuestras ofertas
                        y descubre por qué somos la elección preferida para aquellos que buscan calidad y diversión asequible.
                    </p>
                </div><!-- .bloque -->

                <div class="bloque">
                    <picture>
                        <source srcset="build/img/icono_4.webp" type="image/webp">
                        <source srcset="build/img/icono_4.png" type="image/png">
                        <img class="bloque__imagen" loading="lazy" src="build/img/icono_4.png" alt="porQueComprar">
                    </picture>
                    <h3 class="bloque__titulo">La Mejor Calidad</h3>
                    <p>
                        Te garantizamos una experiencia de entretenimiento excepcional. Nos enorgullece ofrecer servicios que cumplen con los más
                        altos estándares, proporcionando una diversión que supera tus expectativas. Desde la selección de opciones hasta la 
                        entrega, nos comprometemos a brindar experiencias que te dejarán satisfecho y entretenido.
                    </p>
                </div><!-- .bloque -->

            </div><!-- .bloques -->

        </section>
    </main>

<?php
    incluirTemplate('footer');
?>