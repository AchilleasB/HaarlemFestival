async function handleDeleteCuisine(cuisineId) {
    const response = await fetch(`/api/cuisine?id=${cuisineId}`, {
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