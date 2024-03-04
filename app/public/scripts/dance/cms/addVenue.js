
document.addEventListener("DOMContentLoaded", function () {

    const addVenueButton = document.getElementById("add-venue-button");

    addVenueButton.addEventListener("click", function () {

        htmlAddVenueForm();

        const saveVenue = document.getElementById("save-venue-button");
        saveVenue.addEventListener("click", function (e) {
            e.preventDefault();
            saveVenueDataToDatabase();
            addArtistFormContainer.innerHTML = null;

        });

        const closeVenueForm = document.getElementById("close-venue-form");
        closeVenueForm.addEventListener("click", function () {
            addVenueFormContainer.innerHTML = null;
        });

    })
});

async function saveVenueDataToDatabase() {

    const formData = new FormData(document.getElementById("add-venue-form"));
    const response = await fetch(venuesAPIendpoint, {
        method: "POST",
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(venuesAPIendpoint, "venues");
}

function htmlAddVenueForm() {
    addVenueFormContainer.innerHTML = `
    <form id="add-venue-form" method="POST" enctype="multipart/form-data>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Venue Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary" id="save-venue-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-venue-form">Close</button>
    </form>
`;
}