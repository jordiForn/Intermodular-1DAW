let cart = JSON.parse(localStorage.getItem("cart")) || [];
function addToCart(name, price) {
  let existingItem = cart.find((item) => item.name === name);

  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({ name, price, quantity: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  loadCart();
  updateTooltip();
  alert(name + " s'ha afegit al carret.");
}

document.addEventListener("DOMContentLoaded", loadCart);
function loadCart() {
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
  updateTooltip();
}

function setupCartListeners() {
  document.querySelectorAll(".remove-btn").forEach((button) => {
    button.addEventListener("click", function () {
      let index = this.getAttribute("data-index");
      removeFromCart(index);
    });
  });
}

function updateTooltip() {
  let totalItems = 0;
  let totalPrice = 0;

  cart.forEach((item) => {
    totalItems += item.quantity;
    totalPrice += item.price * item.quantity;
  });

  const formattedPrice = totalPrice.toFixed(2).replace(".", ",");

  tooltips.forEach((tooltip) => {
    tooltip.innerText = `${totalItems} ítems - ${formattedPrice}€`;
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
  updateTooltip();
}

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

    if (index === 0) {
      const firstProductList = button.nextElementSibling;
      if (firstProductList) {
        firstProductList.style.display = "flex";
      }
    }
  });

  document.querySelectorAll(".product-list").forEach((list) => {
    if (list.style.display !== "flex") {
      list.style.display = "none";
    }
  });
});
