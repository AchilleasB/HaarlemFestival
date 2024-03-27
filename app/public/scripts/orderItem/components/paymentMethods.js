

class PaymentMethods extends HTMLElement {
    constructor() {
      super();
    }
  

  connectedCallback(){
    this.innerHTML = `<div class="grid">
    <div class="g-col-2 ">Payment methods</div>
    <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266085/ideal.svg" width="64" height="64"></div>
    <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266070/visa.svg" width="64" height="64"></div>
    <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266087/master-card.svg" width="64" height="64">
    </div>`;}}
  
  customElements.define('payment-methods-component', PaymentMethods);



