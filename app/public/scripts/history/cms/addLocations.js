document.addEventListener("DOMContentLoaded", function () {

    const addLocationButton = document.getElementById("add-location-button");

    addLocationButton.addEventListener("click", function () {

        htmlAddLocationForm();

        const saveLocation = document.getElementById("save-location-button");
        saveLocation.addEventListener("click", function (e) {
            e.preventDefault();
            saveLocationDataToDatabase();
            addLocationFormContainer.innerHTML = null;

        });

        const closeLocationForm = document.getElementById("close-location-form");
        closeUserForm.addEventListener("click", function () {
            addLocationFormContainer.innerHTML = null;
        });

    })
});

async function saveLocationDataToDatabase() {

    const formData = new FormData(document.getElementById("add-location-form"));
    const response = await fetch(locationAPIendpoint, {
        method: "POST",
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(locationAPIendpoint, "location");
}

function htmlAddLocationForm() {
    addLocationFormContainer.innerHTML = `
    <form id="add-location-form" method="POST" enctype="multipart/form-data>
        <div class="mb-3">
            <label for="location_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="location_name" location_name="location_name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div><div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text-area" class="form-control" id="description" name="description" required>
        </div>
        </div><div class="mb-3">
            <label for="links" class="form-label">Link</label>
            <input type="text-area" class="form-control" id="links" name="links" required>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="images" name="images" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary" id="save-artist-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-artist-form">Close</button>
    </form>
`;
}