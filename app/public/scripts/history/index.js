
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
                alert(xhr.responseText);
            }
        };
        
        xhr.send(JSON.stringify(formData));
    }

