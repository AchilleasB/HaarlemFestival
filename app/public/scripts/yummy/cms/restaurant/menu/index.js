async function handleManageMenu(restaurantId) {
    const menuItems = await fetch(`${menuAPIendpoint}?restaurantId=${encodeURIComponent(restaurantId)}`);
    const menuItemsData = await menuItems.json();

    const editRestaurantContainer = document.getElementById(`edit-restaurant-container-${restaurantId}`);
    editRestaurantContainer.innerHTML = '';

    if (menuItemsData.food && menuItemsData.food.length > 0) {
        createMenuSection(editRestaurantContainer, 'Food', menuItemsData.food);
    }

    if (menuItemsData.drinks && menuItemsData.drinks.length > 0) {
        createMenuSection(editRestaurantContainer, 'Drink', menuItemsData.drinks);
    }

    const finalHtml = generateLastHtmlLayoutMenu(restaurantId);
    editRestaurantContainer.innerHTML += finalHtml;

    document.getElementById('add-menu-item-button').addEventListener('click', () => handleAddMenuItem(restaurantId));
    document.getElementById('close-menu-button').addEventListener('click', () => closeContainer(editRestaurantContainer));
    const itemTypeSelect = document.getElementById('item-type')
    itemTypeSelect.addEventListener('change', function () {
        togglePriceBottleField(this);
    });
    togglePriceBottleField(itemTypeSelect);

    if (!editRestaurantContainer.hasAttribute('data-listener-added')) {
        editRestaurantContainer.addEventListener('click', function (e) {
            if (e.target && e.target.matches('.delete-menu-item-btn')) {
                const itemId = e.target.getAttribute('data-index');
                handleDeleteMenuItem(itemId, restaurantId);
            }
            else if (e.target && e.target.matches('.edit-menu-item-btn')) {
                const menuItemElement = e.target.closest('.menu-item');
                const itemData = extractMenuItemData(menuItemElement);
                handleEditMenuItem(itemData, restaurantId);
            }
        });
        editRestaurantContainer.setAttribute('data-listener-added', 'true');
    }
}

function createMenuSection(container, sectionTitle, items) {
    const section = document.createElement('div');
    section.className = 'menu-section';
    section.innerHTML = `<h2>${sectionTitle}</h2>`;
    const list = document.createElement('ul');
    list.className = 'menu-list';

    items.forEach(item => {
        const listItem = document.createElement('li');
        listItem.className = 'menu-item';
        listItem.setAttribute('data-item-type', sectionTitle.toLowerCase());
        listItem.innerHTML = menuItemTemplate(item);
        list.appendChild(listItem);
    });

    section.appendChild(list);
    container.appendChild(section);
}

function menuItemTemplate(item) {
    let additionalInfo = '';
    if (item.priceBottle) {
        additionalInfo = `<p class="menu-item-price">Price per Bottle: ${item.priceBottle || 'N/A'}</p>`;
    }

    return `
        <div class="menu-item-content">
            <h3>${item.name}</h3>
            <input type="hidden" class="menu-item-id" value="${item.id}">
            <p class="menu-item-description">${item.description}</p>
            <p class="menu-item-price">Price per Portion: ${item.pricePerPortion || 'N/A'}</p>
            ${additionalInfo}
        </div>
        <div class="button-container" style="margin-top: auto; display: flex; flex-direction: column; align-items: center;">
            <button class="btn btn-outline-primary edit-menu-item-btn" style="width: 100%; margin-bottom: 8px;">Update</button>
            <button class="btn btn-outline-danger delete-menu-item-btn" data-index="${item.id}" style="width: 100%;">Delete</button>
        </div>
    `;
}

function generateLastHtmlLayoutMenu(restaurantId) {
    return `
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success" id="add-menu-item-button">Add menu item</button>
            <button type="button" class="btn btn-danger" id="close-menu-button">Close</button>
        </div>
        <form id="add-menu-item-form" class="mb-3">
            <input type="hidden" id="id" name="id" rows="3" value="${restaurantId}"></input>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="item-type" class="form-label">Item Type</label>
                    <select id="item-type" name="item-type" class="form-select" required>
                        <option value="food">Food</option>
                        <option value="drink">Drink</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="item-name" class="form-label">Name</label>
                    <input type="text" id="item-name" name="item-name" class="form-control" required>
                </div>
                <div class="col-12">
                    <label for="item-description" class="form-label">Description</label>
                    <textarea id="item-description" name="item-description" class="form-control" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="price-per-portion" class="form-label">Price Per Portion</label>
                    <input type="number" step="0.01" min="0" id="price-per-portion" name="price-per-portion" class="form-control" required>
                </div>
                <div class="col-md-6" id="price-per-bottle-group">
                    <label for="price-per-bottle" class="form-label">Price Per Bottle</label>
                    <input type="number" min="1" id="price-per-bottle" name="price-per-bottle" class="form-control">
                </div>
            </div>
        </form>
        <hr class="my-4">
    `;
}

function togglePriceBottleField(itemTypeSelect) {
    const priceBottleGroup = document.getElementById('price-per-bottle-group');
    if (itemTypeSelect.value === 'drink') {
        priceBottleGroup.style.display = '';
    } else {
        priceBottleGroup.style.display = 'none';
    }
}

function extractMenuItemData(menuItemElement) {
    const itemId = menuItemElement.querySelector('.menu-item-id')?.value;
    const name = menuItemElement.querySelector('.menu-item-content h3')?.innerText;
    const description = menuItemElement.querySelector('.menu-item-description')?.innerText;
    const itemType = menuItemElement.getAttribute('data-item-type').toLowerCase();

    let pricePerPortionText, priceBottleText;
    menuItemElement.querySelectorAll('.menu-item-price').forEach(priceElement => {
        if (priceElement.innerText.includes('Price per Portion')) {
            pricePerPortionText = priceElement.innerText.replace('Price per Portion: ', '');
        } else if (priceElement.innerText.includes('Price per Bottle')) {
            priceBottleText = priceElement.innerText.replace('Price per Bottle: ', '');
        }
    });

    let pricePerPortion = parseFloat(pricePerPortionText);
    pricePerPortion = isNaN(pricePerPortion) ? 0 : pricePerPortion;

    let priceBottle = parseInt(priceBottleText, 10);
    priceBottle = isNaN(priceBottle) ? undefined : priceBottle;

    return { id: itemId, name, description, pricePerPortion, priceBottle, itemType };
}
