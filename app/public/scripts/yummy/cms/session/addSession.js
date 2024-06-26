document.addEventListener('DOMContentLoaded', function () {
    const dynamicButtonContainer = document.getElementById('dynamic-add-button-container');

    dynamicButtonContainer.addEventListener('click', function (event) {
        const addSessionButton = document.getElementById('add-session-button');

        if (event.target === addSessionButton) {
            htmlAddSessionForm();

            const saveSession = document.getElementById('save-session-button');
            saveSession.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('add-session-form');
                const startDateInput = document.getElementById('start-date').value;
                const endDateInput = document.getElementById('end-date').value;
            
                const startDate = new Date(startDateInput);
                const endDate = new Date(endDateInput);
            
                if (form.checkValidity() && endDate > startDate) {
                    postSessionRequest();
                    addItemFormContainer.innerHTML = '';
                } else if (endDate <= startDate) {
                    alert("End time must be after start time.");
                } else {
                    alert("Please fill in all fields.");
                }
            });

            const closeAddCuisineForm = document.getElementById('close-session-form');
            closeAddCuisineForm.addEventListener('click', function () {
                addItemFormContainer.innerHTML = '';
            });
        }
    });

    generateButtonOnLoad();
});

async function postSessionRequest() {
    const response = await fetch(sessionAPIendpoint, { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            start_date: document.getElementById('start-date').value,
            end_date: document.getElementById('end-date').value                   
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = '';
    loadItems(sessionAPIendpoint, 'session');
}

function htmlAddSessionForm() {
    addItemFormContainer.innerHTML = `
    <form id="add-session-form" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Start</label>
            <input type="datetime-local" class="form-control" id="start-date" name="start" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">End</label>
            <input type="datetime-local" class="form-control" id="end-date" name="end" required>
        </div>
        <button type="submit" class="btn btn-primary" id="save-session-button">Save</button>
        <button type="button" class="btn btn-danger" id="close-session-form">Close</button>
    </form>`;
}
