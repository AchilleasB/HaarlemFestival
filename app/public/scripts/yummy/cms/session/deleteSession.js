async function handleDeleteSession(sessionId) {

    const reservationsData = await loadReservationRelatedData(sessionId);
    if (reservationsData !== null) {
        const userConfirmation = confirm(`WARNING! Deleting this session will also deactivate ${reservationsData.numberOfReservations} reservations for ${reservationsData.numberOfPeople} people in ${reservationsData.numberOfRestaurants} restaurants.`);
    if (!userConfirmation) return;
    }
    const response = await fetch(`/api/session?id=${sessionId}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(sessionAPIendpoint, "session")
}

async function loadReservationRelatedData(sessionId){
    const reservations = await fetch(`${reservationAPIendpoint}?sessionId=${sessionId}`);
    const reservationsData = await reservations.json();

    return reservationsData;
}