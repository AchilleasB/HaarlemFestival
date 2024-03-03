async function handleEditDanceEvent(event) {

    const events = await fetch(danceEventsAPIendpoint);
    const eventsData = await events.json();

    const venues = await fetch(venuesAPIendpoint);
    const venuesData = await venues.json();

    const artists = await fetch(artistsAPIendpoint);
    const artistsData = await artists.json();

    const editEventContainerId = `edit-event-container-${event.id}`;
    const editEventContainer = document.getElementById(editEventContainerId);

    editEventContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-event-form" style="margin-top:6px">
                <h3>Edit events's Information</h3>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" id="edit-event-date" name="${event.date}" value="${event.date}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="start-time" class="form-label">Start time</label>
                    <input type="text" id="edit-event-start-time" name="${event.start_time}" value="${event.start_time}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end-time" class="form-label">End time</label>
                    <input type="text" id="edit-event-end-time" name="${event.end_time}" value="${event.end_time}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="session" class="form-label">Session</label>
                    <input type="text" id="edit-event-session" name="${event.session}" value="${event.session}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tickets" class="form-label">no. Tickets</label>
                    <input type="text" id="edit-event-tickets" name="${event.tickets_available}" value="${event.tickets_available}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price €</label>
                    <input type="text" id="edit-event-price" name="${event.price}" value="${event.price}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="venue" class="form-label">Venue</label>
                    <select class="form-select" id="venue" name="venue_id" required>
                        <option value="${event.venue_id}" disabled selected>${event.venue_name}</option>
                        ${generateEventVenueOptions(venuesData)}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Concert type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="${event.type}" disabled selected>${event.type}</option>
                        ${generateEventTypeOptions(eventsData)}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="current-artists" class="form-label">Playing artists:</label></br>
                    ${displayEventArtists(event.artists)}
                </div>
                <div class="mb-3">
                    <label for="artists" class="form-label">Select artists to overwrite the existing ones:</label>
                    ${generateEventArtistsCheckboxes(artistsData)}
                </div>
                <button type="submit" class="btn btn-primary" id="update-event-button">Update</button>
                <button type="submit" class="btn btn-danger" id="close-event-button">Close</button>
            </form>
        </div>
    </div>
    `;

    const updateEventButton = document.getElementById("update-event-button");

    updateEventButton.addEventListener("click", function (e) {
        e.preventDefault();
        updateEventData(event);
        editEventContainer.innerHTML = null;
    });

    const closeEventFormButton = document.getElementById("close-event-button");

    closeEventFormButton.addEventListener("click", function () {
        editEventContainer.innerHTML = null;
    });

}

async function updateEventData(event) {
    $selectedArtists = [];
    $newArtists = Array.from(document.querySelectorAll('input[name="artist"]:checked')).map(artist => artist.value)
    if ($newArtists.length === 0) {
        selectedArtists = event.artists.map(artist => artist.id)
    } else {
        selectedArtists = $newArtists
    }

    const response = await fetch(`/api/danceEvents`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: event.id,
            date: document.getElementById('edit-event-date').value,
            start_time: document.getElementById('edit-event-start-time').value,
            end_time: document.getElementById('edit-event-end-time').value,
            session: document.getElementById('edit-event-session').value,
            tickets_available: document.getElementById('edit-event-tickets').value,
            price: document.getElementById('edit-event-price').value,
            venue_id: parseInt(document.getElementById('venue').value),
            type: document.getElementById('type').value,
            artists: selectedArtists.map(artist => parseInt(artist)),
            venue_name: document.getElementById('venue').options[document.getElementById('venue').selectedIndex].text
        })
    });

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(danceEventsAPIendpoint, "danceEvents");
}

function displayEventArtists(artists) {
    return artists.map(artist => `<p">${artist.name}</p>`).join("");
}