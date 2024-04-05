document.addEventListener('DOMContentLoaded', function () {
    const dynamicButtonContainer = document.getElementById('dynamic-add-button-container');

    dynamicButtonContainer.addEventListener('click', async function (event) {
        const cuisines = await fetch(cuisineAPIendpoint);
        const cuisinesData = await cuisines.json();

        const sessions = await fetch(sessionAPIendpoint);
        const sessionsData = await sessions.json();

        const addRestaurantButton = document.getElementById('add-restaurant-button');

        if (event.target === addRestaurantButton) {
            htmlAddRestaurantForm(cuisinesData, sessionsData);

            const saveRestaurant = document.getElementById('save-restaurant-button');
            saveRestaurant.addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('add-restaurant-form');
                if (form.checkValidity() && validateCheckkboxes()) {
                    postRestaurantRequest();
                    addItemFormContainer.innerHTML = '';
                }
                else {
                    alert("Please fill in all fields.");
                }
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

    // // Log the raw response text
    // const text = await response.text();
    // console.log('Raw response:', text);

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = '';
    loadItems(restaurantAPIendpoint, 'restaurant');
}

function htmlAddRestaurantForm(cuisinesData, sessionsData) {
    addItemFormContainer.innerHTML = `
    <form id="add-restaurant-form" class="mb-3">
        <div class="mb-3">
            <label for="is_recommended" class="form-label">Recommended?</label>
            <div>
                <input type="radio" id="is_recommended_true" name="is_recommended" value="true" required>
                <label for="is_recommended_true">Yes</label>
                <input type="radio" id="is_recommended_false" name="is_recommended" value="false" required checked>
                <label for="is_recommended_false">No</label>
            </div>
        </div>
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
        <div class="mb-3">
            <label for="cuisines" class="form-label">Cuisines (min. 1)</label>
            ${generateCuisineCheckboxes(cuisinesData)}
        </div>
        <div class="mb-3">
            <label for="sessions" class="form-label">Sessions (min. 1)</label>
            ${generateSessionCheckboxes(sessionsData)}
        </div>
        <button type="submit" class="btn btn-primary" id="save-restaurant-button">Save</button>
        <button type="button" class="btn btn-danger" id="close-restaurant-form">Close</button>
    </form>`;

    populateStarsSelect();
    setupFilePreview();
}

function populateStarsSelect() {
    const starsSelect = document.getElementById('stars');
    for (let i = 1; i <= 5; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = `${i} Star${i !== 1 ? 's' : ''}`;
        starsSelect.appendChild(option);
    }
}

function setupFilePreview() {
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

