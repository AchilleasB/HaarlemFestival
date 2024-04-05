async function handleEditCuisine(cuisine) {

    const editCuisineContainer = document.getElementById(`edit-cuisine-container-${cuisine.id}`);
    editCuisineContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-cuisine-form" style="margin-top:6px">
                <h3>Edit Cuisines's Information</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="edit-cuisine-name" name="${cuisine.name}" value="${cuisine.name}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" id="update-cuisine-button">Update</button>
                <button type="submit" class="btn btn-danger" id="close-cuisine-button">Close</button>
            </form>
        </div>
    </div>
    `;

    const updateCuisineButton = document.getElementById("update-cuisine-button");

    updateCuisineButton.addEventListener("click", function (e) {
        e.preventDefault();
        updateCuisineData(cuisine);
        editCuisineContainer.innerHTML = null;
    });

    const closeEventFormButton = document.getElementById("close-cuisine-button");

    closeEventFormButton.addEventListener("click", function () {
        editCuisineContainer.innerHTML = null;
    });
}

async function updateCuisineData(cuisine) {
    const response = await fetch(`${cuisineAPIendpoint}?id=${encodeURIComponent(cuisine.id)}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: cuisine.id,
            name: document.getElementById('edit-cuisine-name').value
        })
    });
    
    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(cuisineAPIendpoint, "cuisine");
}