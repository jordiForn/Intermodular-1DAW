if (window.location.pathname.includes("index.php")) {
  document.addEventListener("DOMContentLoaded", function () {
    const menuIcon = document.getElementById("menu-icon");
    const adminMenu = document.getElementById("admin-menu");

    if (isLoggedIn) {
      document.getElementById("logout-link").style.display = "inline-block";
      if (isAdmin) {
        document.getElementById("menu-icon").style.display = "inline-block";
        document.getElementById("contact-icon").style.display = "none";
      }
    }

    menuIcon.addEventListener("click", function () {
      if (adminMenu.style.display === "none") {
        adminMenu.style.display = "block";
      } else {
        adminMenu.style.display = "none";
      }
    });
  });
}

if (window.location.pathname.includes("contact.php")) {
}
