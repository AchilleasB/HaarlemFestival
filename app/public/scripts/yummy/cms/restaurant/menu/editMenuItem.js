async function handleEditMenuItem(item, restaurantId) {
    const editRestaurantContainer = document.getElementById(`edit-restaurant-container-${restaurantId}`);

    populateFormWithMenuItemData(editRestaurantContainer, item);

    const updateMenuItemButton = document.getElementById("update-menu-item-button");
    updateMenuItemButton.addEventListener("click", function (e) {
        e.preventDefault();
        const form = document.getElementById('edit-menu-item-form');
        if (form.checkValidity()) {
            updateMenuItemData(item.id);
            handleManageMenu(restaurantId);
        } else {
            alert("Please fill in all fields.");
        }
    });

    const closeMenuItemButton = document.getElementById("close-menu-item-button");
    closeMenuItemButton.addEventListener("click", function () {
        editRestaurantContainer.innerHTML = '';
    });

}

function populateFormWithMenuItemData(editRestaurantContainer, item) {
    let formHTML = `
        <form id="edit-menu-item-form" class="mb-3">
            <h3>Edit ${item.name} Information</h3>
            <input type="hidden" id="edit-menu-item-type" name="type" value="${item.itemType}">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="item-name" class="form-label">Name</label>
                    <input type="text" id="edit-menu-item-name" name="item-name" class="form-control" value="${item.name}" required>
                </div>
                <div class="col-12">
                    <label for="item-description" class="form-label">Description</label>
                    <textarea id="edit-menu-item-description" name="item-description" class="form-control" required>${item.description}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="price-per-portion" class="form-label">Price Per Portion</label>
                    <input type="number" step="0.01" min="0" id="edit-menu-item-price-per-portion" name="price-per-portion" class="form-control" value="${item.pricePerPortion}" required>
                </div>
    `;

    if (item.itemType === 'drink') {
        formHTML += `
            <div class="col-md-6" id="price-per-bottle-group">
                <label for="price-per-bottle" class="form-label">Price Per Bottle</label>
                <input type="number" min="1" id="edit-menu-item-price-per-bottle" name="price-per-bottle" class="form-control" value="${item.priceBottle || ''}">
            </div>
        `;
    }

    formHTML += `
            </div>
        </form>
        <button type="submit" class="btn btn-primary" id="update-menu-item-button">Update</button>
        <button type="button" class="btn btn-danger" id="close-menu-item-button">Close</button>
        <hr class="my-4">
    `;

    editRestaurantContainer.innerHTML = formHTML;
}

async function updateMenuItemData(menuItemId) {
    const response = await fetch(menuAPIendpoint, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: menuItemId,
            name: document.getElementById('edit-menu-item-name').value,
            description: document.getElementById('edit-menu-item-description').value,
            pricePerPortion: document.getElementById('edit-menu-item-price-per-portion').value,
            priceBottle: document.getElementById('edit-menu-item-price-per-bottle')?.value,
            itemType: document.getElementById('edit-menu-item-type').value
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
}