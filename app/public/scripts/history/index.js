document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('ticketForm');

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            checkForTour();
        });
    } else {
        console.error('Ticket form not found in the document.');
    }

    function checkForTour() {
        const language = document.getElementById('languageSelect').value;
        const date = document.getElementById('dateSelect').value;
        const time = document.getElementById('timeSelect').value;
        const ticketType = document.getElementById('ticketTypeSelect').value;
        const quantity = document.getElementById('quantitySelect').value;
        const user_id = form.getAttribute('data-user-id');

        const formData = {
            language: language,
            date: date,
            time: time,
            ticketType: ticketType,
            quantity: quantity,
            user_id: user_id
        };

        fetch('/api/historyTour/generateTicket', {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            displayMessage(data.message);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            displayMessage('An error occurred. Please try again later.');
        });
    }

    function displayMessage(message) {
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message-container');
        messageContainer.textContent = message;

        document.body.appendChild(messageContainer);
        setTimeout(() => {
            document.body.removeChild(messageContainer);
        }, 3000);
    }
});
