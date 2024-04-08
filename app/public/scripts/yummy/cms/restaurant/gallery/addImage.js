async function handleAddImage(restaurantId) {
    const form = document.getElementById('add-image-form');
    if (form.checkValidity()) {
        await postImageRequest();
        await handleManageGallery(restaurantId); // Refresh the gallery to show the new image
    } else {
        alert("Please fill in all fields.");
    }
}

async function postImageRequest() {
    const formData = new FormData(document.getElementById('add-image-form'));

    const response = await fetch(galleryAPIendpoint, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);
}