document.addEventListener("DOMContentLoaded", function () {
  if (isAdmin) {
    // Mostrar el icono de menú y ocultar el icono de contacto
    document.getElementById("menu-icon").style.display = "inline-block";
    document.getElementById("contact-icon").style.display = "none";
  }
});
