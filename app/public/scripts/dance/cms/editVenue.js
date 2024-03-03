function handleEditVenue(venue) {
    const editVenueContainerId = `edit-venue-container-${venue.id}`;
    const editVenueContainer = document.getElementById(editVenueContainerId);

    editVenueContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-venue-form" style="margin-top:6px">
                <h3>Edit ${venue.name}'s Information</h3>
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" rows="3" value="${venue.id}"></input>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" id="name" name="name" rows="3" value="${venue.name}" required></input>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input class="form-control" id="address" name="address" rows="3" value="${venue.address}" required></input>
                </div>
                <div class="mb-3">
                    <label for="venue_image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="venue_image" name="venue_image" accept="image/*" required>
                    <input type="hidden" id="venue_image" name="venue_image" value="${venue.venue_image}">
                </div>
                <button type="submit" class="btn btn-primary" id="update-venue-button">Update</button>
                <button type="button" class="btn btn-danger" id="close-venue-button">Close</button>
            </form>
        </div>
    </div>
`;

    const updateVenueButton = document.getElementById('update-venue-button');

    updateVenueButton.addEventListener('click', function (e) {
        e.preventDefault();
        updateVenueData();
        editVenueContainer.innerHTML = '';
    });

    const closeVenueFormButton = document.getElementById('close-venue-button');
    closeVenueFormButton.addEventListener('click', function () {
        editVenueContainer.innerHTML = '';
    });
}

async function updateVenueData() {
    const formData = new FormData(document.getElementById('edit-venue-form'));

    const response = await fetch(`/api/venues`, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = '';
    loadItems(venuesAPIendpoint, 'venues');
}

