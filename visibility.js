document.addEventListener("DOMContentLoaded", function () {
  if (isAdmin) {
    document.getElementById("menu-icon").style.display = "inline-block";
    document.getElementById("contact-icon").style.display = "none";
  }

  if (isLoggedIn) {
    document.getElementById("logout-link").style.display = "inline-block";
    if (!isAdmin) {
      document.getElementById("menu-icon").style.display = "none";
    }
  }

  const menuIcon = document.getElementById("menu-icon");
  const adminMenu = document.getElementById("admin-menu");

  if (menuIcon) {
    menuIcon.addEventListener("click", function () {
      if (
        adminMenu.style.display === "none" ||
        adminMenu.style.display === ""
      ) {
        adminMenu.style.display = "block";
      } else {
        adminMenu.style.display = "none";
      }
    });
  }
});
