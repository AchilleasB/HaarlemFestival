async function handleEditRestaurant(restaurantId) {
    const restaurantDetailed = await fetchRestaurantDetailed(restaurantId);
    const editRestaurantContainer = document.getElementById(`edit-restaurant-container-${restaurantId}`);

    const cuisines = await fetch(cuisineAPIendpoint);
    const cuisinesData = await cuisines.json();

    const sessions = await fetch(sessionAPIendpoint);
    const sessionsData = await sessions.json();

    // Populate form with restaurant details
    populateFormWithRestaurantDetails(editRestaurantContainer, restaurantDetailed, cuisinesData, sessionsData);

    // Setup event listeners for form interactions
    setupFormEventListeners(editRestaurantContainer, restaurantId, restaurantDetailed);
}

function populateFormWithRestaurantDetails(editRestaurantContainer, restaurantDetailed, cuisinesData, sessionsData) {
    editRestaurantContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-restaurant-form" style="margin-top: 6px">
                <h3>Edit Restaurant's Information</h3>
                <div class="mb-3">
                    <label for="is_recommended" class="form-label">Recommended?</label>
                    <div>
                        <input type="radio" id="is_recommended_true" name="is_recommended" value="true" required>
                        <label for="is_recommended_true">Yes</label>
                        <input type="radio" id="is_recommended_false" name="is_recommended" value="false" required>
                        <label for="is_recommended_false">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" rows="3" value="${restaurantDetailed.id}"></input>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="${restaurantDetailed.name}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="restaurant-banner" class="form-label">Upload Restaurant Banner</label>
                    <input type="file" class="form-control" id="restaurant-banner-file" name="restaurant-banner" accept="image/png">
                    <input type="hidden" id="current-banner" name="current-banner" value="${restaurantDetailed.banner}">
                    <img id="banner-preview" src="/../images/yummy/banners/${restaurantDetailed.banner}" alt="Image of ${restaurantDetailed.name}" style="max-width: 100px; height: auto;">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="5" class="form-control" required>${restaurantDetailed.description}</textarea>
                </div>
                <div class="mb-3">
                    <label for="stars" class="form-label">Stars</label>
                    <select class="form-select" id="stars" name="stars" required>
                        ${generateStarOptions(restaurantDetailed.numberOfStars)}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="seats" class="form-label">Seats</label>
                    <input type="number" id="seats" min="1" name="seats" value="${restaurantDetailed.numberOfSeats}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="location" value="${restaurantDetailed.location}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="cuisines" class="form-label">Cuisines (min. 1)</label>
                    ${generateCuisineCheckboxes(cuisinesData, restaurantDetailed.cuisines)}
                </div>
                <div class="mb-3">
                    <label for="sessions" class="form-label">Sessions (min. 1)</label>
                    ${generateSessionCheckboxes(sessionsData, restaurantDetailed.sessions)}
                </div>
                <button type="submit" class="btn btn-primary" id="update-restaurant-button">Update</button>
                <button type="button" class="btn btn-danger" id="close-restaurant-button">Close</button>
            </form>
        </div>
    </div>`;

    // Set the recommended status
    if (restaurantDetailed.isRecommended) {
        document.getElementById('is_recommended_true').checked = true;
    } else {
        document.getElementById('is_recommended_false').checked = true;
    }
}

function generateStarOptions(numberOfStars) {
    let optionsHtml = '<option value="">Select Stars</option>'; // Default prompt option

    for (let i = 1; i <= 5; i++) {
        // Check if the current iteration matches the restaurant's star rating
        const isSelected = i === numberOfStars ? 'selected' : '';
        optionsHtml += `<option value="${i}" ${isSelected}>${i} Star${i !== 1 ? 's' : ''} </option>`;
    }

    return optionsHtml;
}

function setupFormEventListeners(editRestaurantContainer, restaurantId, restaurantDetailed) {
    // Update button
    const updateRestaurantButton = document.getElementById("update-restaurant-button");
    updateRestaurantButton.addEventListener("click", function (e) {
        e.preventDefault();
        const form = document.getElementById('edit-restaurant-form');
        if (form.checkValidity() && validateCheckkboxes()) {
            updateRestaurantData();
            editRestaurantContainer.innerHTML = '';
        } else {
            alert("Please fill in all fields.");
        }
    });

    // Close button
    const closeEventFormButton = document.getElementById("close-restaurant-button");
    closeEventFormButton.addEventListener("click", function () {
        editRestaurantContainer.innerHTML = '';
    });

    // File input for banner preview
    setupFilePreview();
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

async function fetchRestaurantDetailed(restaurantId) {
    const response = await fetch(`${restaurantAPIendpoint}?id=${encodeURIComponent(restaurantId)}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    });
    const data = await response.json();

    return data;
}

async function updateRestaurantData() {
    const formData = new FormData(document.getElementById('edit-restaurant-form'));

    const response = await fetch(restaurantAPIendpoint, {
        method: "POST",
        body: formData
    });

    const data = await response.json();

    itemsListContainer.innerHTML = "";
    loadItems(restaurantAPIendpoint, "restaurant");

    location.reload();
}
