

class OrderSummary extends HTMLElement {
    constructor() {
      super();
    }
  

  connectedCallback(){
    this.innerHTML = `<div class="border-bottom">
    <p class="h5">Order summary</p>
  </div>
  <div class="grid py-2" style="row-gap: 0;">
    <div class="g-col-4  text-start">Sub-total(Net)</div>
    <div class="g-col-6  text-end subtotal">
    </div>
  </div>
  <div class="grid py-2" style="row-gap: 0;">
    <div class="g-col-4 text-start">VAT(21%)</div>
    <div class="g-col-6 text-end orderVAT">
    </div>
  </div>
  <div class="grid py-2" style="row-gap: 0;">
    <div class="g-col-4  text-start"><strong>Total:</strong></div>
    <div class="g-col-6 text-end"><strong class="orderTotal">
      </strong></div>
  </div>`;


  var orderSubtotal = document.querySelector(".subtotal");
  var orderTotal = document.querySelector(".orderTotal");
  var orderVAT = document.querySelector(".orderVAT");

  $(orderSubtotal).html('&euro;'+(totalPrice-totalVAT));
  $(orderVAT).html('&euro;'+totalVAT);
  $(orderTotal).html('&euro;'+totalPrice);

}}


  
  customElements.define('order-summary-component', OrderSummary);

