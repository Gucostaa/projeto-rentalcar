document.addEventListener("DOMContentLoaded", function() {
    var scrollContainer = document.querySelector(".scroll-container");
    var isMouseDown = false;
    var startX;
    var scrollLeft;
  
    scrollContainer.addEventListener("mousedown", function(e) {
      isMouseDown = true;
      startX = e.pageX - scrollContainer.offsetLeft;
      scrollLeft = scrollContainer.scrollLeft;
      scrollContainer.style.scrollBehavior = "auto"; // Desabilita o scroll suave durante o clique
    });
  
    scrollContainer.addEventListener("mouseleave", function() {
      isMouseDown = false;
      scrollContainer.style.scrollBehavior = "smooth"; // Reabilita o scroll suave ao liberar o clique
    });
  
    scrollContainer.addEventListener("mouseup", function() {
      isMouseDown = false;
      scrollContainer.style.scrollBehavior = "smooth"; // Reabilita o scroll suave ao liberar o clique
    });
  
    scrollContainer.addEventListener("mousemove", function(e) {
      if (!isMouseDown) return;
      e.preventDefault();
      var x = e.pageX - scrollContainer.offsetLeft;
      var walk = (x - startX) * 2; // Ajuste a sensibilidade do movimento conforme necessário
      scrollContainer.scrollLeft = scrollLeft - walk;
    });
  });

  