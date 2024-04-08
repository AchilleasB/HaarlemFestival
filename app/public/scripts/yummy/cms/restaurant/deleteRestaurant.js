async function handleDeleteRestaurant(restaurantId) {
    const response = await fetch(`${restaurantAPIendpoint}?id=${encodeURIComponent(restaurantId)}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    
    itemsListContainer.innerHTML = "";
    loadItems(restaurantAPIendpoint, "restaurant")
}