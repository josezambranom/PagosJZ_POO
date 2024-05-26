document.addEventListener("DOMContentLoaded", function() {
  var botonIrArriba = document.querySelector(".ir-arriba-btn");

  // Función para detectar el desplazamiento hacia abajo en la página
  var scrollListener = function() {
      // Verifica si la página se ha desplazado más de 20px
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          botonIrArriba.style.display = "block"; // Muestra el botón
      } else {
          botonIrArriba.style.display = "none"; // Oculta el botón
      }
  };

  // Agrega el listener para el evento de desplazamiento
  window.addEventListener('scroll', scrollListener);

  // Función para desplazar hacia arriba suavemente
  botonIrArriba.addEventListener("click", function() {
      window.scrollTo({top: 0, behavior: 'smooth'});
  });
});
