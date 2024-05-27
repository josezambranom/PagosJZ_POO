document.addEventListener("DOMContentLoaded", function() {
    var botonIrArriba = document.querySelector(".ir-arriba-btn");
    var toggle = document.querySelector('.toggle');
    var boton = document.querySelector('#boton');
    var istreaming = document.querySelector('#istreaming');
    var ivideojuegos = document.querySelector('#ivideojuegos');
    var irecargas = document.querySelector('#irecargas');
  
    // Función para detectar el desplazamiento hacia abajo en la página
    function scrollListener() {
        // Verifica si la página se ha desplazado más de 20px
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            botonIrArriba.style.display = "block"; // Muestra el botón
        } else {
            botonIrArriba.style.display = "none"; // Oculta el botón
        }
    }
  
    // Agrega el listener para el evento de desplazamiento
    window.addEventListener('scroll', scrollListener);
  
    // Función para desplazar hacia arriba suavemente
    botonIrArriba.addEventListener("click", function() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
  
    // Evento para ocultar o mostrar un campo
    if(boton){
        boton.addEventListener('click', function() {
            var campo = document.querySelector('#ocultar');
            campo.classList.toggle('hidden');
          });
    }
  
    if(toggle) {
        // Evento para cambiar la visibilidad de una contraseña
    toggle.addEventListener('change', function() {
        var clave = document.querySelector('#clave');
        clave.type = toggle.checked ? 'text' : 'password';
      });
    }

    function smoothScrollTo(element) {
        document.querySelector(element).scrollIntoView({
            behavior: 'smooth'
        });
    }
    
    if (istreaming) {
        istreaming.addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento de anclaje predeterminado
            smoothScrollTo('#streaming');
        });
    }
    
    if (ivideojuegos) {
        ivideojuegos.addEventListener('click', function(event) {
            event.preventDefault();
            smoothScrollTo('#videojuegos');
        });
    }
    
    if (irecargas) {
        irecargas.addEventListener('click', function(event) {
            event.preventDefault();
            smoothScrollTo('#recargas');
        });
    }
    
    

  });  