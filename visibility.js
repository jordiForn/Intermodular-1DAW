document.addEventListener("DOMContentLoaded", function () {
  if (isAdmin) {
    document.getElementById("menu-icon").style.display = "inline-block";
    document.getElementById("contact-icon").style.display = "none";
  }
});

document.addEventListener("DOMContentLoaded", function () {
  if (isLoggedIn) {
    document.getElementById("logout-link").style.display = "inline-block";
    document.getElementById("menu-icon").style.display = "none";
  }
});
