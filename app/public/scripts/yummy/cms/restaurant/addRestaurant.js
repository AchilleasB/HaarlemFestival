document.addEventListener('DOMContentLoaded', function () {
    const dynamicButtonContainer = document.getElementById('dynamic-add-button-container');

    dynamicButtonContainer.addEventListener('click', function (event) {
        const addRestaurantButton = document.getElementById('add-restaurant-button');

        if (event.target === addRestaurantButton) {
            htmlAddRestaurantForm();

            const saveRestaurant = document.getElementById('save-restaurant-button');
            saveRestaurant.addEventListener('click', function (e) {
                e.preventDefault();
                postRestaurantRequest();
                addItemFormContainer.innerHTML = '';
            });

            const closeAddRestaurantForm = document.getElementById('close-restaurant-form');
            closeAddRestaurantForm.addEventListener('click', function () {
                addItemFormContainer.innerHTML = '';
            });
        }
    });

    generateButtonOnLoad();
});

async function postRestaurantRequest() {
    const formData = new FormData(document.getElementById('add-restaurant-form'));

    const response = await fetch(restaurantAPIendpoint, {
        method: 'POST',
        body: formData
    });

    // Log the raw response text
    const text = await response.text();
    console.log('Raw response:', text);

    // Attempt to parse the text as JSON
    const data = JSON.parse(text);
    displayMessage(data.message, 3000);

    // const data = await response.json();
    // displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = '';
    loadItems(restaurantAPIendpoint, 'restaurant');
}

function htmlAddRestaurantForm() {
    addItemFormContainer.innerHTML = `
    <form id="add-restaurant-form" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="restaurant-banner" class="form-label">Upload Restaurant Banner</label>
            <input type="file" class="form-control" id="restaurant-banner-file" name="restaurant-banner" accept="image/png" required>
            <img id="banner-preview" src="" alt="" style="max-width: 100px; height: auto;">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" rows="5" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="stars" class="form-label">Stars</label>
            <select class="form-select" id="stars" name="stars" required>
            </select>
        </div>
        <div class="mb-3">
            <label for="seats" class="form-label">Seats</label>
            <input type="number" min="1" id="seats" name="seats" class="form-control" value="20" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" name="location" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" id="save-restaurant-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-restaurant-form">Close</button>
    </form>`;

    // Generate options for stars and append to the select element
    const starsSelect = document.getElementById('stars');
    for (let i = 1; i <= 5; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = `${i} Star${i !== 1 ? 's' : ''}`;
        starsSelect.appendChild(option);
    }

    const fileInput = document.getElementById('restaurant-banner-file');
    const bannerPreview = document.getElementById('banner-preview');

    fileInput.addEventListener('change', function (event) {
        if (event.target.files && event.target.files[0]) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                bannerPreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
}
