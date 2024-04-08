const locationsAPIendpoint = urlBasePath + 'api/locations';

const itemsListContainer = document.getElementById("items-list");
const locationsRadioButton = document.getElementById("btnradio1");

const addLocationButtonContainer = document.getElementById("add-location-button");
const addLocationFormContainer = document.getElementById("add-location-form-container");

document.addEventListener("DOMContentLoaded", function () {
    loadItems(locationsAPIendpoint, "locations");
    htmlAddLocationButton();

    locationsRadioButton.addEventListener("click", function () {
        loadItems(locationsAPIendpoint, "locations");
        htmlAddLocationButton();
        addLocationFormContainer.innerHTML = null;
    });
});

async function loadItems(apiEndpoint, itemType) {
    itemsListContainer.innerHTML = "";

    const itemsLabel = createItemLabel(itemType);
    const itemList = document.createElement("div");

    try {
        const response = await fetch(apiEndpoint);
        const data = await response.json();
        data.forEach(item => {
            const itemElement = createItemElement(item, itemType);
            itemList.appendChild(itemElement);
        });

        itemsListContainer.appendChild(itemsLabel);
        itemsListContainer.appendChild(itemList);
    } catch (error) {
        console.log(error);
    }
}

function htmlAddLocationButton() {
    addLocationButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <button id="add-location-button" class="btn btn-outline-success btn-lg">Add Location</a>
        </div>
    `;
}

function createItemLabel(itemType) {
    const itemLabel = document.createElement("div");
    itemLabel.classList.add("label", "mb-5", "mt-5");

    if (itemType === "locations") {
        itemLabel.innerHTML = `
            <div class="labels-container">
                <div class="row">
                    <div class="col">
                        <div class="item-data-label border-bottom"><em>Location Name</em></div>
                    </div>
                    <div class="col">
                        <div class="item-data-label border-bottom"><em>Address</em></div>
                    </div>
                    <div class="col">
                        <div class="item-data-label border-bottom"><em>Type</em></div>
                    </div>
                    <!-- Add more labels as needed -->
                </div>
            </div>
        `;
    }

    return itemLabel;
}

function createItemElement(item, itemType) {
    const itemElement = document.createElement("div");
    itemElement.classList.add("container", "mb-5");

    if (itemType === "locations") {
        const itemData = `
            <div class="row border-bottom">
                <div class="row d-flex align-items-center">
                    <div class="col">
                        <span class="item-data-value">${item.location_name}</span>
                    </div>
                    <div class="col">
                        <span class="item-data-value">${item.address}</span>
                    </div>
                    <div class="col">
                        <span class="item-data-value">${item.location_type}</span>
                    </div>
                    <!-- Add more item data as needed -->
                </div>
                <div class="col-6 col-md-4 d-flex align-items-center mt-3 mb-3">
                    ${htmlGenerateButtons()}
                </div>
            </div>
        `;
        itemElement.innerHTML = itemData;
    }

    return itemElement;
}

function htmlGenerateButtons() {
    return `
        <div class="row">
            <div class="col">
                <span class="item-data-value">
                    <button class="btn btn-outline-primary edit-item-button">Edit</button>
                </span>
            </div>
            <div class="col">
                <span class="item-data-value">
                    <button class="btn btn-outline-danger delete-item-button">Delete</button>
                </span>
            </div>
        </div>
    `;
}

function displayMessage(message, duration) {
    const messageContainer = document.createElement("div");
    messageContainer.className = "message-container";
    messageContainer.innerText = message;

    document.body.appendChild(messageContainer);

    setTimeout(() => {
        document.body.removeChild(messageContainer);
    }, duration);
}
