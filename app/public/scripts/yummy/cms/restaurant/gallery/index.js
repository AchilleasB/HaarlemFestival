async function handleManageGallery(restaurantId) {
    const images = await fetch(`${galleryAPIendpoint}?restaurantId=${encodeURIComponent(restaurantId)}`);
    const imagesData = await images.json();
    
    console.log(imagesData);
}