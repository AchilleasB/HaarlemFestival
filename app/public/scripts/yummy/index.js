const reservationAPIendpoint = "http://localhost/api/reservation";
const phoneInput = document.getElementById('phone');
const maxGuestsPerReservation = 20;
const textarea = document.getElementById('remark');
const counterDisplay = document.getElementById('characters-left');
const button = document.getElementById('add-to-cart-button');
const maxChars = 1000;

let currentAvailability = 0

async function updateAvailability() {
    var restaurantId = document.querySelector('.reservation-restaurant').dataset.restaurantId;
    var sessionId = document.getElementById('session').value;

    const response = await fetch(`${reservationAPIendpoint}?restaurantId=${restaurantId}&sessionId=${sessionId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const data = await response.json();
    var availabilityParagraph = document.getElementById('availability');
    availabilityParagraph.textContent = "Availability: " + data;
    currentAvailability = data;
    setMaxGuests(data);
}

function checkPhoneValidity() {
    const phoneValue = phoneInput.value.trim();
    // Define a regular expression pattern to match a simple phone number format
    // Min 7 digits, optional + at the beginning
    const phonePattern = /^\+?\d{7,}$/;
    const isValidPhone = phonePattern.test(phoneValue);
    const phoneHelp = document.getElementById('phone-help-message');

    if (isValidPhone && currentAvailability > 0) { // Check both conditions
        button.removeAttribute('disabled');
        phoneHelp.textContent = 'Valid phone number.';
        phoneHelp.classList.remove('text-danger');
        phoneHelp.classList.add('text-success');
    } else {
        button.setAttribute('disabled', true);
        phoneHelp.textContent = isValidPhone ? 'Valid phone number.' : 'Please enter a valid phone number.';
        phoneHelp.classList.toggle('text-success', isValidPhone);
        phoneHelp.classList.toggle('text-danger', !isValidPhone);
    }
}

function setMaxGuests(availability) {
    const guestsInput = document.getElementById('guests');
    const currentGuestsInputValue = guestsInput.value;

    currentAvailability = availability; // Ensure the global variable is up-to-date

    if (availability === 0) {
        guestsInput.setAttribute('min', 0);
        guestsInput.setAttribute('max', 0);
        guestsInput.value = 0;
        button.setAttribute('disabled', true);
    }

    if (availability > maxGuestsPerReservation) {
        guestsInput.setAttribute('max', maxGuestsPerReservation);
    } else {
        guestsInput.setAttribute('max', availability);
    }
    
    if (availability < currentGuestsInputValue) {
        guestsInput.value = availability;
    }
    
    guestsInput.setAttribute('min', 0);
}

function setCharsLeft() {
    const charsTyped = textarea.value.length;
    const charsLeft = maxChars - charsTyped;

    if (charsLeft >= 0) {
        counterDisplay.textContent = `${charsLeft} characters left`;
    } else {
        counterDisplay.textContent = `0 characters left`;
        textarea.value = textarea.value.slice(0, maxChars); // Truncate excess characters
    }

    if (charsLeft < maxChars) {
        textarea.disabled = false;
    }
}

function redirectToRestaurant(restaurantId) {
    var form = document.getElementById('reservation-form');
    if (form.checkValidity()) {
        window.location.href = '/yummy/restaurant?id=' + restaurantId;
    } else {
        alert("Please fill in all required fields.");
    }
}

document.getElementById('session').addEventListener('change', updateAvailability);
window.addEventListener('load', updateAvailability);
phoneInput.addEventListener('input', checkPhoneValidity);
textarea.addEventListener('input', setCharsLeft);