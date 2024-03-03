async function handleDeleteVenue(venue) {
    const response = await fetch(`/api/venues`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: venue.id,
            name: venue.name,
            image: venue.venue_image
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(venuesAPIendpoint, "venues");
}