async function handleDeleteMenuItem(menuItemId, restaurantId) {
    if (!confirmDeletion("menu item")) return;

    const response = await fetch(`${menuAPIendpoint}?id=${encodeURIComponent(menuItemId)}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    handleManageMenu(restaurantId);
}