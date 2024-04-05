document.addEventListener('DOMContentLoaded', function () {
    const dynamicButtonContainer = document.getElementById('dynamic-add-button-container');

    dynamicButtonContainer.addEventListener('click', function (event) {
        const addCuisineButton = document.getElementById('add-cuisine-button');

        if (event.target === addCuisineButton) {
            htmlAddCuisineForm();

            const saveCuisine = document.getElementById('save-cuisine-button');
            saveCuisine.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('add-cuisine-form');
                if (form.checkValidity()) {
                    postCuisineRequest();
                    addItemFormContainer.innerHTML = '';
                } else {
                    alert("Please fill in all fields.");
                }
            });

            const closeAddCuisineForm = document.getElementById('close-cuisine-form');
            closeAddCuisineForm.addEventListener('click', function () {
                addItemFormContainer.innerHTML = '';
            });
        }
    });

    generateButtonOnLoad();
});

async function postCuisineRequest() {
    const response = await fetch(cuisineAPIendpoint, { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: document.getElementById('name').value                   
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = '';
    loadItems(cuisineAPIendpoint, 'cuisine');
}

function htmlAddCuisineForm() {
    addItemFormContainer.innerHTML = `
    <form id="add-cuisine-form" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary" id="save-cuisine-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-cuisine-form">Close</button>
    </form>`;
}
