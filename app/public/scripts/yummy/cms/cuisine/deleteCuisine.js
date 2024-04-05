async function handleDeleteCuisine(cuisineId) {
    const response = await fetch(`${cuisineAPIendpoint}?id=${encodeURIComponent(cuisineId)}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
    
    itemsListContainer.innerHTML = "";
    loadItems(cuisineAPIendpoint, "cuisine")
}