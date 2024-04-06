document.addEventListener('DOMContentLoaded', function () {
    const addEventButton = document.getElementById('add-event-button');

    addEventButton.addEventListener('click', async function () {

        const events = await fetch(danceEventsAPIendpoint);
        const eventsData = await events.json();
        
        const venues = await fetch(venuesAPIendpoint);
        const venuesData = await venues.json();

        const artists = await fetch(artistsAPIendpoint);
        const artistsData = await artists.json();
        
        htmlAddEventForm(eventsData, venuesData, artistsData);

        const saveEvent = document.getElementById('save-event-button');
        saveEvent.addEventListener('click', function (e) {
            e.preventDefault();
            saveEventToDatabase();
            addEventFormContainer.innerHTML = '';
        });

        const closeAddEventForm = document.getElementById('close-event-form');
        closeAddEventForm.addEventListener('click', function () {
            addEventFormContainer.innerHTML = '';
        });
    });
});


async function saveEventToDatabase() {

    const selectedArtists = Array.from(document.querySelectorAll('input[name="artist"]:checked')).map(artist => artist.value);
    console.log(selectedArtists);
    const response = await fetch(danceEventsAPIendpoint, { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            date: document.getElementById('date').value,
            start_time: document.getElementById('start-time').value,
            end_time: document.getElementById('end-time').value,
            session: document.getElementById('session').value,
            tickets_available: parseInt(document.getElementById('tickets').value),
            price: parseFloat(document.getElementById('price').value),
            venue_id: parseInt(document.getElementById('venue').value),
            type: document.getElementById('type').value,
            artists: selectedArtists.map(artist => parseInt(artist)),
            venue_name: document.getElementById('venue').options[document.getElementById('venue').selectedIndex].text                     
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = '';
    loadItems(danceEventsAPIendpoint, 'danceEvents');
}

function htmlAddEventForm(eventsData, venuesData, artistsData) {
    addEventFormContainer.innerHTML = `
    <form id="add-event-form">
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" id="date" name="date" required>
    </div>
    <div class="mb-3">
        <label for="start-time" class="form-label">Start time</label>
        <input class="form-control" id="start-time" name="start-time" rows="3" required></input>
    </div>
    <div class="mb-3">
        <label for="end-time" class="form-label">End time</label>
        <input class="form-control" id="end-time" name="end-time" rows="3" required></input>
    </div>
    <div class="mb-3">
        <label for="session" class="form-label">Session</label>
        <input class="form-control" id="session" name="session" rows="3" required></input>
    </div>
    <div class="mb-3">
        <label for="tickets" class="form-label">no. Tickets</label>
        <input class="form-control" id="tickets" name="tickets" rows="3" required></input>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input class="form-control" id="price" name="price" rows="3" required></input>
    </div>
    <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <select class="form-select" id="venue" name="venue_id" required>
                <option value="" disabled selected>Select a venue</option>
                ${generateEventVenueOptions(venuesData)}
            </select>
    </div>
    <div class="mb-3">
            <label for="type" class="form-label">Concert type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="" disabled selected>Select a concert type</option>
                ${generateEventTypeOptions(eventsData)}
            </select>
    </div>
    <div class="mb-3">
            <label for="artists" class="form-label">Select artists</label>
            ${generateEventArtistsCheckboxes(artistsData)}
    </div>
    <button type="submit" class="btn btn-primary" id="save-event-button">Save</button>
    <button type="submit" class="btn btn-danger" id="close-event-form">Close</button>
</form>
`;

console.log(artistsData)
}

function generateEventVenueOptions(venuesData) {
    return venuesData.map(venue => `<option value="${venue.id}">${venue.name}</option>`).join('');
}

function generateEventTypeOptions(eventsData) {
    const uniqueTypesSet = new Set();
    const uniqueOptions = [];

    for (const event of eventsData) {
        if (!uniqueTypesSet.has(event.type)) {
            uniqueTypesSet.add(event.type);
            uniqueOptions.push(`<option value="${event.type}">${event.type}</option>`);
        }
    }

    return uniqueOptions.join('');
}

function generateEventArtistsCheckboxes(artistData) {
    return artistData.map(artist => `
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="${artist.id}" name="artist">
            <label class="form-check-label">${artist.name}</label>
        </div>
    `).join('');
}
