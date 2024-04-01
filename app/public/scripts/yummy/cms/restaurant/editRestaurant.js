async function handleEditRestaurant(restaurantId) {
    const restaurantDetailed = await fetchRestaurantDetailed(restaurantId);

    const editRestaurantContainer = document.getElementById(`edit-restaurant-container-${restaurantId}`);
    editRestaurantContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-restaurant-form" style="margin-top: 6px">
                <h3>Edit Restaurant's Information</h3>
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" rows="3" value="${restaurantDetailed.id}"></input>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="${restaurantDetailed.name}" value="${restaurantDetailed.name}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="restaurant-banner" class="form-label">Upload Restaurant Banner</label>
                    <input type="file" class="form-control" id="restaurant-banner" name="restaurant-banner" accept="image/*" required>
                    <input type="hidden" id="banner" name="restaurant-banner" value="${restaurantDetailed.banner}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input class="form-control" id="description" name="description" value="${restaurantDetailed.description}" required>
                </div>
                <div class="mb-3">
                    <label for="stars" class="form-label">Stars</label>
                    <select class="form-select" id="stars" name="stars" required>
                        <option value="">Select Stars</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="seats" class="form-label">Seats</label>
                    <input type="number" id="seats" name="${restaurantDetailed.numberOfSeats}" value="${restaurantDetailed.numberOfSeats}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="${restaurantDetailed.location}" value="${restaurantDetailed.location}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" id="update-restaurant-button">Update</button>
                <button type="submit" class="btn btn-danger" id="close-restaurant-button">Close</button>
        </form>
        </div>
    </div>`;

    // Generate options for stars and append to the select element
    const starsSelect = document.getElementById('stars');
    for (let i = 1; i <= 5; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = `${i} Star${i !== 1 ? 's' : ''}`;
        if (restaurantDetailed.numberOfStars === i) {
            option.selected = true;
        }
        starsSelect.appendChild(option);
    }

    const updateRestaurantButton = document.getElementById("update-restaurant-button");

    updateRestaurantButton.addEventListener("click", function (e) {
        e.preventDefault();
        updateRestaurantData(restaurantDetailed);
        editRestaurantContainer.innerHTML = null;
    });

    const closeEventFormButton = document.getElementById("close-restaurant-button");

    closeEventFormButton.addEventListener("click", function () {
        editRestaurantContainer.innerHTML = null;
    });
}

async function fetchRestaurantDetailed(restaurantId) {
    const response = await fetch(`/api/restaurant?id=${restaurantId}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    });
    
    const data = await response.json();
    console.log(data);

    return data;
}

async function updateRestaurantData(restaurant) {
    const formData = new FormData(document.getElementById('edit-restaurant-form'));

    const response = await fetch(`/api/restaurant?id=${restaurant.id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: formData
    });
    
    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(restaurantAPIendpoint, "restaurant");
}
