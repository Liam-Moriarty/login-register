import {cart, addToCart} from '../data/cart.js';
import {products} from '../data/products.js';
import {formatCurrency} from './utils/money.js';

let productsHTML = '';

products.forEach((product) => {
  productsHTML += `
    <div class="product-container">

        <img class="product-image" src="${product.image}">

      <div class="card-body">

        <div class="product-name limit-text-to-2-lines">
          ${product.name}
        </div>

        <div class="product-rating-container">

          <img class="product-rating-stars"
            src="images/ratings/rating-${product.rating.stars * 10}.png"/>

          <div class="product-rating-count">
            ${product.rating.count}
          </div>
        </div>

        <div class="product-price">
          $${formatCurrency(product.priceCents.toLocaleString())}
        </div>


        <div class="added-to-cart">
          <img src="images/icons/checkmark.png">
          Added
        </div>

        <button class="add-to-cart-button  js-add-to-cart"
        data-product-id="${product.id}">
          Add to Cart
        </button>
      </div>
          <div class="product-name limit-text-to-2-lines">${product.name}</div>
    </div>
  `;
});

document.querySelector('.js-products-grid').innerHTML = productsHTML;

function updateCartQuantity() {
  let cartQuantity = 0;

  cart.forEach((cartItem) => {
    cartQuantity += cartItem.quantity;
  });

  document.querySelector('.js-cart-quantity')
    .innerHTML = cartQuantity;
}

document.querySelectorAll('.js-add-to-cart')
  .forEach((button) => {
    button.addEventListener('click', () => {
      const productId = button.dataset.productId;
      addToCart(productId);
      updateCartQuantity();
    });
  });

/* if ever i use again the quantity function

<div class="product-quantity-container">
<select>
  <option selected value=""disabled selected>Quantity</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
</div>

*/
