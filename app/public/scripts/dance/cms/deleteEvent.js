async function handleDeleteDanceEvent(event) {
    const response = await fetch(`/api/danceEvents`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: event.id,
            venue_id: event.venue_id
        })
    });

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(danceEventsAPIendpoint, "danceEvents");
}