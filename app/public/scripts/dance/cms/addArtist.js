
document.addEventListener("DOMContentLoaded", function () {

    const addArtistButton = document.getElementById("add-artist-button");

    addArtistButton.addEventListener("click", function () {

        htmlAddArtistForm();

        const saveArtist = document.getElementById("save-artist-button");
        saveArtist.addEventListener("click", function (e) {
            e.preventDefault();
            saveArtistDataToDatabase();
            addArtistFormContainer.innerHTML = null;

        });

        const closeUserForm = document.getElementById("close-artist-form");
        closeUserForm.addEventListener("click", function () {
            addArtistFormContainer.innerHTML = null;
        });

    })
});

async function saveArtistDataToDatabase() {

    const formData = new FormData(document.getElementById("add-artist-form"));
    const response = await fetch(artistsAPIendpoint, {
        method: "POST",
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(artistsAPIendpoint, "artists");
}

function htmlAddArtistForm() {
    addArtistFormContainer.innerHTML = `
    <form id="add-artist-form" method="POST" enctype="multipart/form-data>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary" id="save-artist-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-artist-form">Close</button>
    </form>
`;
}