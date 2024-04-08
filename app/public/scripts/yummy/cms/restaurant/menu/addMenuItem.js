async function handleAddMenuItem(restaurantId) {
    const form = document.getElementById('add-menu-item-form');
    if (form.checkValidity()) {
        await postMenuItemRequest();
        await handleManageMenu(restaurantId);
    } else {
        alert("Please fill in all fields.");
    }
}

async function postMenuItemRequest() {
    const formData = new FormData(document.getElementById('add-menu-item-form'));

    const response = await fetch(menuAPIendpoint, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
}