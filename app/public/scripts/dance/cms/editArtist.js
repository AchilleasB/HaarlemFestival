function handleEditArtist(artist) {
    const editArtistContainerId = `handle-artist-container-${artist.id}`;
    const editArtistContainer = document.getElementById(editArtistContainerId);

    editArtistContainer.innerHTML = `
    <div class="row justify-content-center border-bottom">
        <div class="col-md-8 mb-3">
            <form id="edit-artist-form" style="margin-top:6px">
                <h3>Edit ${artist.name}'s Information</h3>
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" rows="3" value="${artist.id}"></input>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" id="name" name="name" rows="3" value="${artist.name}" required></input>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input class="form-control" id="genre" name="genre" rows="3" value="${artist.genre}" required></input>
                </div>
                <div class="mb-3">
                    <label for="artist_image" class="form-label">Upload Artist Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    <input type="hidden" id="image" name="artist_image" value="${artist.artist_image}">
                </div>
                <button type="submit" class="btn btn-primary" id="update-artist-button">Update</button>
                <button type="button" class="btn btn-danger" id="close-artist-button">Close</button>
            </form>
        </div>
    </div>
`;

    const updateArtistButton = document.getElementById('update-artist-button');

    updateArtistButton.addEventListener('click', function (e) {
        e.preventDefault();
        updateArtistData();
        editArtistContainer.innerHTML = '';
    });

    const closeArtistFormButton = document.getElementById('close-artist-button');
    closeArtistFormButton.addEventListener('click', function () {
        editArtistContainer.innerHTML = '';
    });
}

async function updateArtistData() {
    // const name = document.getElementById("name").value;
    // const genre = document.getElementById("genre").value;
    // const image = document.getElementById("image");

    // if (name === "" || genre === "" || !image.files[0]) {
    //     displayMessage("Please fill in all fields", 3000);
    //     return;
    // }
    
    const formData = new FormData(document.getElementById('edit-artist-form'));
    const response = await fetch(`/api/artists`, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(artistsAPIendpoint, "artists");
}