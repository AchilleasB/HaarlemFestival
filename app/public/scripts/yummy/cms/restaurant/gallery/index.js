async function handleManageGallery(restaurantId) {
    const images = await fetch(`${galleryAPIendpoint}?restaurantId=${encodeURIComponent(restaurantId)}`);
    const imagesData = await images.json();

    const editRestaurantContainer = document.getElementById(`edit-restaurant-container-${restaurantId}`);
    editRestaurantContainer.innerHTML = '';

    const masonryGrid = document.createElement('div');
    masonryGrid.id = 'masonryGrid';
    editRestaurantContainer.appendChild(masonryGrid);

    imagesData.forEach((img) => {
        const item = document.createElement('div');
        item.classList.add('masonry-item');
        item.innerHTML = `
            <img src="${restaurantImagesPath}${img.image}" style="width:100%; display: block;">
            <button class="btn btn-outline-danger delete-btn" data-index="${img.id}">Delete</button>
        `;
        masonryGrid.appendChild(item);

        if (!editRestaurantContainer.hasAttribute('data-listener-added')) {
            editRestaurantContainer.addEventListener('click', function (e) {
                if (e.target && e.target.matches('.delete-btn')) {
                    const imgId = e.target.getAttribute('data-index');
                    handleDeleteImage(imgId, restaurantId);
                }
            });
            editRestaurantContainer.setAttribute('data-listener-added', 'true');
        }
    });

    const finalHtml = generateLastHtmlLayoutGallery(restaurantId);
    editRestaurantContainer.innerHTML += finalHtml;

    document.getElementById('add-image-button').addEventListener('click', () => handleAddImage(restaurantId));
    document.getElementById('close-gallery-button').addEventListener('click', () => closeContainer(editRestaurantContainer));

    setupFilePreview('restaurant-image-file', 'image-preview');
}

function generateLastHtmlLayoutGallery(restaurantId) {
    return `
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success" id="add-image-button">Add image</button>
            <button type="button" class="btn btn-danger" id="close-gallery-button">Close</button>
        </div>
        <form id="add-image-form" class="mb-3">
            <div class="mb-3">
                <label for="restaurant-image" class="form-label">Upload Image To Gallery</label>
                <input type="hidden" id="id" name="id" rows="3" value="${restaurantId}"></input>
                <input type="file" class="form-control" id="restaurant-image-file" name="restaurant-image" accept="image/png" required>
                <img id="image-preview" src="" alt="" style="max-width: 100px; height: auto;">
            </div>
        </form>
        <hr class="my-4">
    `;
}