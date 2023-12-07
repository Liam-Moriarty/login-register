export const deliveryOptions = [{
  id: '1',
  deliveryDays: 'E-Wallet',
  priceCents: 0
}, {
  id: '2',
  deliveryDays: 'Debit-Card',
  priceCents: 499
}, {
  id: '3',
  deliveryDays: 'Cash on Delivery',
  priceCents: 999
}];

export function getDeliveryOption(deliveryOptionId) {
  let deliveryOption;

  deliveryOptions.forEach((option) => {
    if (option.id === deliveryOptionId) {
      deliveryOption = option;
    }
  });

  return deliveryOption;
}