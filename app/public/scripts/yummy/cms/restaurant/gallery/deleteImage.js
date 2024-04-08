async function handleDeleteImage(imageId, restaurantId) {
    if (!confirmDeletion("image")) return;

    const response = await fetch(`${galleryAPIendpoint}?id=${encodeURIComponent(imageId)}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    handleManageGallery(restaurantId);
}