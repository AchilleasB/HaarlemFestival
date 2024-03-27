

class ContactInformation extends HTMLElement {
    constructor() {
      super();
    }
  

  connectedCallback(){
    this.innerHTML = `
    <div class="border-bottom">
          <p class="h5">Contact information</p>
        </div>
        <div class="grid py-2 px-2 " style="row-gap: 0;">
          <div class="g-col-2  text-start"><strong>First name:</strong></div>
          <div class="g-col-2  text-start"><strong class="firstName">
            </strong></div>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-2  text-start"><strong>Last name:</strong></div>
          <div class="g-col-2  text-start"><strong class="lastName">
            </strong></div>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-2  text-start"><strong>Email:</strong></div>
          <div class="g-col-2  text-start"><strong class="email">
            </strong></div>
        </div>

    
    `;

  
  var firstname = document.querySelector(".firstName");
  var lastname = document.querySelector(".lastName");
  var email = document.querySelector(".email");

  $(firstname).html(user.firstname);
  $(lastname).html(user.lastname);
  $(email).html(user.email);
  
  
  }}
  
  customElements.define('contact-information-component', ContactInformation);

