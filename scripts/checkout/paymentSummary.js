import {cart} from '../../data/cart.js';
import {getProduct} from '../../data/products.js';
import {getDeliveryOption} from '../../data/deliveryOptions.js';
import {formatCurrency} from '../utils/money.js';

export function renderPaymentSummary() {
  let productPriceCents = 0;
  let shippingPriceCents = 0;

  cart.forEach((cartItem) => {
    const product = getProduct(cartItem.productId);
    productPriceCents += product.priceCents * cartItem.quantity;

    const deliveryOption = getDeliveryOption(cartItem.deliveryOptionId);
    shippingPriceCents += deliveryOption.priceCents;
  });

  const totalBeforeTaxCents = productPriceCents + shippingPriceCents;
  const taxCents = totalBeforeTaxCents * 0.1;
  const totalCents = totalBeforeTaxCents + taxCents;

  const paymentSummaryHTML = `
    <div class="mode-of-payment">
      <div>
        <div class="mop-title">Mode of payment</div>
          <div class="mop-option js-delivery-option">

            <input type="radio" value="E-wallet" name="mop" />
            <label for="E-wallet">E-wallet</label>



            <input type="radio" value="debit-card" name="mop" />
            <label for="E-wallet">Debit card</label>

          

            <input type="radio" value="cod" name="mop" />
            <label for="cod">Cash on Delivery</label>
          </div>

      </div>
    </div>

    <div class="payment-summary-title">
      Order Summary
    </div>

    <div class="payment-summary-row">
      <div>Items:</div>
      <div class="payment-summary-money">
      ₱${formatCurrency(productPriceCents.toLocaleString())}
      </div>
    </div>


    <div class="payment-summary-row subtotal-row">
      <div>Total before tax:</div>
      <div class="payment-summary-money">
      ₱${formatCurrency(totalBeforeTaxCents.toLocaleString())}
      </div>
    </div>

    <div class="payment-summary-row">
      <div>Estimated tax (10%):</div>
      <div class="payment-summary-money">
      ₱${formatCurrency(taxCents.toLocaleString())}
      </div>
    </div>

    <div class="payment-summary-row total-row">
      <div>Order total:</div>
      <div class="payment-summary-money">
      ₱${formatCurrency(totalCents.toLocaleString())}
      </div>
    </div>

    <div class="place-order-button-container">
      <a href="index.php" class="button place-order-button" id="placeOrderButton">Place your order</a>
    </div>
  </div>
  `;

  document.querySelector('.js-payment-summary')
    .innerHTML = paymentSummaryHTML;

    document.addEventListener('DOMContentLoaded', function() {
      const placeOrderButton = document.getElementById('placeOrderButton');
    
      placeOrderButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the link (navigating to orders.html)
    
        // Remove the 'cart' item from localStorage
        localStorage.removeItem('cart');
    
        // Navigate to orders.html after removing the item
        window.location.href = event.target.href;
      });
    });
}