
    function scrollToTickets() {
        document.getElementById('ticketSection').scrollIntoView({ behavior: 'smooth' });
    }
    document.addEventListener('DOMContentLoaded', function () {
        var ticketForm = document.getElementById('ticketForm');
        if (ticketForm) {
            ticketForm.addEventListener('submit', function (event) {
                event.preventDefault();
                checkForTour();
            });
        } else {
            console.error('Ticket form not found in the document.');
        }
    });
    function checkForTour() {
        var language = document.getElementById('languageSelect').value;
        var date = document.getElementById('dateSelect').value;
        var time = document.getElementById('timeSelect').value;
        var ticketType = document.getElementById('ticketTypeSelect').value;
        var quantity = document.getElementById('quantitySelect').value;
        var user_id = document.getElementById('ticketForm').getAttribute('data-user-id');

        var formData = {
            language: language,
            date: date,
            time: time,
            ticketType: ticketType,
            quantity: quantity,
            user_id: user_id 
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/historyTour/generateTicket', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Remove the alert statement
                const data = JSON.parse(xhr.responseText);
                displayMessage(data.message);
            }
        };       
        xhr.send(JSON.stringify(formData));
    }
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('ticketForm');
    
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
    
            const formData = {
                language: document.getElementById('languageSelect').value,
                date: document.getElementById('dateSelect').value,
                time: document.getElementById('timeSelect').value,
                quantity: document.getElementById('quantitySelect').value,
                ticketType: document.getElementById('ticketTypeSelect').value,
                user_id: form.getAttribute('data-user-id')
            };
    
            const response = await fetch('api/historyTour/generateTicket', {
                method: 'POST',
                body: JSON.stringify(formData),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
    
            const data = await response.json();
    
            displayMessage(data.message);
        });
    
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
    