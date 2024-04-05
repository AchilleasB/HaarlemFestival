const restaurantAPIendpoint = "http://localhost/api/restaurant";
const sessionAPIendpoint = "http://localhost/api/session";
const cuisineAPIendpoint = "http://localhost/api/cuisine";
const reservationAPIendpoint = "http://localhost/api/reservation";
const galleryAPIendpoint = "http://localhost/api/gallery";

const itemsListContainer = document.getElementById("items-list");
const restaurantRadioButton = document.getElementById("restaurant-radio-btn");
const sessionRadioButton = document.getElementById("session-radio-btn");
const cuisineRadioButton = document.getElementById("cuisine-radio-btn");
const reservationRadioButton = document.getElementById("reservation-radio-btn");

const addItemFormContainer = document.getElementById("add-item-form-container");

// Function to generate dynamic button
function generateButton(buttonText, identifier) {
    const button = document.createElement("button");
    button.textContent = buttonText;
    button.classList.add("btn", "btn-outline-success", "btn-lg");
    button.id = `add-${identifier}-button`;
    const container = document.getElementById("dynamic-add-button-container");
    container.innerHTML = '';
    container.appendChild(button);
}

// Function to generate button based on initially selected radio button
function generateButtonOnLoad() {
    var selectedRadio = document.querySelector('.btn-check:checked');
    var labelText = document.querySelector('label[for="' + selectedRadio.id + '"]').textContent.slice(0, -1);
    // Extract the identifier from the radio button's id or another attribute
    var identifier = selectedRadio.id.replace("-radio-btn", "");
    // Now call generateButton with both the button text and the identifier
    generateButton("Add " + labelText.toLowerCase(), identifier.toLowerCase());
}

// Event listener for radio buttons
var radioButtons = document.querySelectorAll('.btn-check');
radioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function (event) {
        var selectedRadio = event.target;
        if (selectedRadio.checked && selectedRadio.id !== 'reservation-radio-btn') { // Check if it's not the "Reservations" radio button
            var labelText = document.querySelector('label[for="' + selectedRadio.id + '"]').textContent.slice(0, -1);
            generateButton("Add " + labelText.toLowerCase(), labelText.toLowerCase());
        } else if (selectedRadio.checked && selectedRadio.id === 'reservation-radio-btn') {
            document.getElementById("dynamic-add-button-container").innerHTML = ''; // Clear the button if "Reservations" radio button is selected
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    loadItems(restaurantAPIendpoint, "restaurant");

    restaurantRadioButton.addEventListener("click", function () {
        loadItems(restaurantAPIendpoint, "restaurant");
        addItemFormContainer.innerHTML = '';
    });

    sessionRadioButton.addEventListener("click", function () {
        loadItems(sessionAPIendpoint, "session");
        addItemFormContainer.innerHTML = '';
    });

    cuisineRadioButton.addEventListener("click", function () {
        loadItems(cuisineAPIendpoint, "cuisine");
        addItemFormContainer.innerHTML = '';
    });

    reservationRadioButton.addEventListener("click", function () {
        loadItems(reservationAPIendpoint, "reservation");
        addItemFormContainer.innerHTML = '';
    });
});

async function loadItems(apiEndpoint, itemType) {
    itemsListContainer.innerHTML = '';

    const itemHeader = createItemHeader(itemType);
    const itemList = document.createElement("div");

    try {
        const response = await fetch(apiEndpoint, {
            method: 'GET',
        });
        // const responseData = await response.text(); // Get response body as text
        // console.log(responseData); // Log response body
        const data = await response.json();
        data.forEach(item => {
            const itemCard = createItemCard(item, itemType);
            itemList.appendChild(itemCard);
        });

        itemsListContainer.appendChild(itemHeader);
        itemsListContainer.appendChild(itemList);
    } catch (error) {
        console.log(error);
    }
}

// Generate button on page load
generateButtonOnLoad();

function createItemHeader(itemType) {
    const itemHeader = document.createElement("div");
    itemHeader.classList.add("row", "mb-5", "mt-5");

    const itemConfig = {
        restaurant: ["Banner", "Name", "Stars"],
        session: ["Start date", "End date"],
        cuisine: ["Name"],
        reservation: ["Name", "Restaurant", "Session", "Phone", "Status"]
    };

    const columns = itemConfig[itemType];

    if (columns) {
        const html = `
        <div class="col-sm-6 col-md-8 text-center">
            <div class="row d-flex align-items-end">
                ${columns.map(column => `
                    <div class="col border-bottom">
                        <div><em>${column}</em></div>
                    </div>
                `).join("")}
            </div>
        </div>`;
        itemHeader.innerHTML = html;
    }

    return itemHeader;
}

function createItemCard(item, itemType) {
    const itemCard = document.createElement("div");
    itemCard.classList.add("container", "mb-5");

    if (itemType === "reservation" && !item.isActive) {
        itemCard.classList.add("inactive-row");
    }

    const columnConfig = {
        restaurant: [
            `<img src="${restaurantBannerPath}${item.banner}" class="img-thumbnail" style="max-width: 100px; height: auto;">`,
            item.name,
            createStars(item.numberOfStars)
        ],
        session: [
            item.startDate,
            item.endDate
        ],
        cuisine: [
            item.name
        ],
        reservation: [
            item.userLastname,
            formatRestaurantNameForReservations(item.restaurantName),
            formatSessionTimesForReservation(item.sessionStartTime, item.sessionEndTime),
            item.mobileNumber,
            formatIsActiveForReservation(item.isActive)
        ]
    };


    const columns = columnConfig[itemType];

    if (columns) {
        const itemData = columns.map(value => `
        <div class="col text-center d-flex align-items-center">
            <span class="item-data-value">${value}</span>
        </div>`).join("");

        itemCard.innerHTML = `
        <div class="row border-bottom align-items-center">
            <div class="col-sm-8">
                <div class="row">
                    ${itemData}
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-end align-items-center">
                ${htmlGenerateButtons(itemType, itemType === 'reservation' ? item.isActive : undefined)}
            </div>  
        </div>
        <div class="edit-${itemType}-container" id="edit-${itemType}-container-${item.id}">
        </div>`;
    }

    const editButton = itemCard.querySelector(".edit-item-button");

    editButton.addEventListener("click", function () {

        if (itemType === "restaurant") {
            handleEditRestaurant(item.id);
        } else if (itemType === "session") {
            handleEditSession(item);
        } else if (itemType === "cuisine") {
            handleEditCuisine(item);
        } else if (itemType === "reservation") {
            handleEditReservation(item);
        }
    });

    const deleteButton = itemCard.querySelector(".delete-item-button");
    const activationButton = itemCard.querySelector(".activation-item-button");
    const manageGalleryButton = itemCard.querySelector(".manage-gallery-button");
    const manageMenuButton = itemCard.querySelector(".manage-menu-button");

    if (deleteButton) {
        deleteButton.addEventListener("click", function () {

            const userConfirmation = confirm(`Are you sure you want to delete this ${itemType}?`);
            if (!userConfirmation) return;

            if (itemType === "restaurant") {
                handleDeleteRestaurant(item.id);
            } else if (itemType === "session") {
                handleDeleteSession(item.id);
            } else if (itemType === "cuisine") {
                handleDeleteCuisine(item.id);
            }
        });
    }

    if (activationButton) {
        activationButton.addEventListener("click", function () {
            const userConfirmation = confirm(`Are you sure you want to ${item.isActive ? 'deactivate' : 'activate'} this reservation?`);
            if (!userConfirmation) return;

            handleActivationReservation(item.id);
        });
    }

    if (manageGalleryButton) {
        manageGalleryButton.addEventListener("click", function () {
            handleManageGallery(item.id);
        });
    }

    if (manageMenuButton) {
        manageMenuButton.addEventListener("click", function () {
            handleManageMenu(item.id);
        });
    }

    return itemCard;
}

function htmlGenerateButtons(itemType, isActive) {
    let buttonsHtml = `<div class="button-container">`;

    if (itemType === "reservation") {
        const actionText = isActive ? "Deactivate" : "Activate";
        const buttonClass = isActive ? "btn-outline-warning" : "btn-outline-success";
        buttonsHtml += `
        <div class="button-row">
            <div class="button-col">
                <span class="item-data-value">
                    <button class="btn btn-outline-primary edit-item-button" style="width: 100%;">Update</button>
                </span>
            </div>
            <div class="button-col">
                <span class="item-data-value">
                    <button class="btn ${buttonClass} activation-item-button" style=style="width: 100px; text-align: center;">${actionText}</button>
                </span>
            </div>
        </div>`;
    } else {
        buttonsHtml += `
        <div class="button-row">
            <div class="button-col">
                <span class="item-data-value">
                    <button class="btn btn-outline-primary edit-item-button" style="width: 100%;">Edit</button>
                </span>
            </div>
            <div class="button-col">
                <span class="item-data-value">
                    <button class="btn btn-outline-danger delete-item-button" style="width: 100%;">Delete</button>
                </span>
            </div>
        </div>`;

        if (itemType === "restaurant") {
            buttonsHtml += `
            <div class="button-row">
                <div class="button-col">
                    <span class="item-data-value">
                        <button class="btn btn-outline-info manage-gallery-button" style="width: 100%;">Manage gallery</button>
                    </span>
                </div>
                <div class="button-col">
                    <span class="item-data-value">
                        <button class="btn btn-outline-info manage-menu-button" style="width: 100%;">Manage menu</button>
                    </span>
                </div>
            </div>`;
        }
    }

    buttonsHtml += `</div>`;

    return buttonsHtml;
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

function createStars(numStars) {
    let starsHTML = '';
    for (let i = 0; i < numStars; i++) {
        starsHTML += '<i class="fas fa-star" style="color: gold;"></i>';
    }
    return starsHTML;
}

function formatSessionTimesForReservation(startTime, endTime) {
    if (!startTime || !endTime) {
        return '<span class="no-data"><i class="fas fa-exclamation-circle"></i> NO DATA</span>';
    } else {
        return `${startTime} till ${endTime}`;
    }
}

function formatRestaurantNameForReservations(name) {
    if (!name) {
        return '<span class="no-data"><i class="fas fa-exclamation-circle"></i> NO DATA</span>';
    } else {
        return name;
    }
}

function formatIsActiveForReservation(isActive) {
    if (isActive) {
        return '<span class="active-status"><i class="fas fa-check-circle" style="color: green;"></i> ACTIVE</span>';
    } else {
        return '<span class="inactive-status"><i class="fas fa-times-circle" style="color: red;"></i> INACTIVE</span>';
    }
}

function generateCuisineCheckboxes(cuisinesData, restaurantCuisines = []) {
    // Convert restaurantCuisines into a Set of IDs for faster lookup
    const restaurantCuisineIds = new Set(restaurantCuisines.map(cuisine => cuisine.id));

    return cuisinesData.map((cuisine) => {
        // Check if this cuisine's ID is in the restaurant's cuisines
        const isChecked = restaurantCuisineIds.has(cuisine.id) ? 'checked' : '';

        return `
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="${cuisine.id}" name="cuisine[]" id="cuisine${cuisine.id}" ${isChecked}>
            <label class="form-check-label" for="cuisine${cuisine.id}">
            ${cuisine.name}
            </label>
        </div>
        `;
    }).join('');
}

function generateSessionCheckboxes(sessionsData, restaurantSessions = []) {
    // Convert restaurantSessions into a Set of IDs for faster lookup
    const restaurantSessionIds = new Set(restaurantSessions.map(session => session.id));

    return sessionsData.map((session) => {
        // Check if this session's ID is in the restaurant's sessions
        const isChecked = restaurantSessionIds.has(session.id) ? 'checked' : '';

        return `
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="${session.id}" name="session[]" id="session${session.id}" ${isChecked}>
            <label class="form-check-label" for="session${session.id}">${session.startDate} till ${session.endDate}</label>
        </div>
        `;
    }).join('');
}

function validateCheckkboxes() {
    let cuisinesValid = Array.from(document.querySelectorAll('input[name="cuisine[]"]:checked')).length > 0;
    let sessionsValid = Array.from(document.querySelectorAll('input[name="session[]"]:checked')).length > 0;

    if (!cuisinesValid || !sessionsValid) return false;
    return true;
}