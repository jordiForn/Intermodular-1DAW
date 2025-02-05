document.addEventListener("DOMContentLoaded", function () {
  const toggleButtons = document.querySelectorAll(".toggle-button");

  toggleButtons.forEach((button, index) => {
    button.addEventListener("click", function () {
      const productList = this.nextElementSibling;

      if (productList) {
        if (
          productList.style.display === "none" ||
          productList.style.display === ""
        ) {
          productList.style.display = "flex";
        } else {
          productList.style.display = "none";
        }
      }
    });

    // Abrir la primera categoría por defecto
    if (index === 0) {
      const firstProductList = button.nextElementSibling;
      if (firstProductList) {
        firstProductList.style.display = "flex"; // Abre la primera lista de productos
      }
    }
  });

  // Ocultar todas las listas de productos al inicio
  document.querySelectorAll(".product-list").forEach((list) => {
    if (list.style.display !== "flex") {
      list.style.display = "none"; // Asegúrate de que las demás estén ocultas
    }
  });
});

let cart = JSON.parse(localStorage.getItem("cart")) || [];
// Función para añadir productos al carrito
function addToCart(name, price) {
  let existingItem = cart.find((item) => item.name === name);

  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({ name, price, quantity: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  loadCart();
  alert(name + " s'ha afegit al carret.");
}

// Función para cargar el carrito y mostrarlo
document.addEventListener("DOMContentLoaded", loadCart);

function loadCart() {
  let cartContainer = document.getElementById("cart-items");
  let totalElement = document.getElementById("cart-total");

  cart = JSON.parse(localStorage.getItem("cart")) || [];
  cartContainer.innerHTML = "";

  let total = 0;
  cart.forEach((item, index) => {
    total += item.price * item.quantity;

    let itemElement = document.createElement("div");
    itemElement.classList.add("cart-item");
    itemElement.innerHTML = `
              <span>${item.name} (x${item.quantity})</span>
              <span>${(item.price * item.quantity).toFixed(2)}€</span>
              <button class="remove-btn" data-index="${index}">X</button>
          `;
    cartContainer.appendChild(itemElement);
  });

  totalElement.innerText = total.toFixed(2) + "€";

  setupCartListeners();
}

function setupCartListeners() {
  document.querySelectorAll(".remove-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let index = this.getAttribute("data-index");
      removeFromCart(index);
    });
  });
}

function removeFromCart(index) {
  index = parseInt(index);
  if (cart[index].quantity > 1) {
    cart[index].quantity -= 1;
  } else {
    cart.splice(index, 1);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  loadCart();
}

document.addEventListener("DOMContentLoaded", function () {
  fetch("http://localhost:3000/api/productos")
    .then((response) => response.json())
    .then((data) => {
      const productContainer = document.querySelector(".product-list");
      productContainer.innerHTML = ""; // Limpiar el contenedor antes de agregar productos

      data.forEach((product) => {
        const productCard = document.createElement("div");
        productCard.classList.add("product-card");
        productCard.innerHTML = `
                  <h3>${product.nombre}</h3>
                  <p>${product.descripcion}</p>
                  <p class="price">${product.precio}€</p>
                  <button onclick="addToCart('${product.nombre}', ${product.precio})">Afegir al Carret</button>
              `;
        productContainer.appendChild(productCard);
      });
    })
    .catch((error) => console.error("Error fetching products:", error));
});
