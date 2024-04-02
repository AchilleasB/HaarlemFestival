const restaurantAPIendpoint = "http://localhost/api/restaurant";
const sessionAPIendpoint = "http://localhost/api/session";
const cuisineAPIendpoint = "http://localhost/api/cuisine";

const itemsListContainer = document.getElementById("items-list");
const restaurantRadioButton = document.getElementById("restaurant-radio-btn");
const sessionRadioButton = document.getElementById("session-radio-btn");
const cuisineRadioButton = document.getElementById("cuisine-radio-btn");

const addItemFormContainer = document.getElementById("add-item-form-container");

// Function to generate dynamic button
function generateButton(buttonText, identifier) {
    var button = document.createElement("button");
    button.textContent = buttonText;
    button.className = "btn btn-outline-success btn-lg";
    button.classList.add("btn", "btn-outline-success", "btn-lg");
    button.id = "add-" + identifier + "-button";
    document.getElementById("dynamic-add-button-container").innerHTML = "";
    document.getElementById("dynamic-add-button-container").appendChild(button);
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
radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function(event) {
        var selectedRadio = event.target;
        if (selectedRadio.checked) {
            var labelText = document.querySelector('label[for="' + document.querySelector(
                '.btn-check:checked').id + '"]').textContent.slice(0, -1);
            generateButton("Add " + labelText.toLowerCase(), labelText.toLowerCase());
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    loadItems(restaurantAPIendpoint, "restaurant");

    restaurantRadioButton.addEventListener("click", function() {
        loadItems(restaurantAPIendpoint, "restaurant");
    });

    sessionRadioButton.addEventListener("click", function() {
        loadItems(sessionAPIendpoint, "session");
    });

    cuisineRadioButton.addEventListener("click", function() {
        loadItems(cuisineAPIendpoint, "cuisine");
    });
});

async function loadItems(apiEndpoint, itemType) {
    itemsListContainer.innerHTML = "";

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
        cuisine: ["Name"]
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
        ]
    };
    

    const columns = columnConfig[itemType];

    if (columns) {
        const itemData = columns.map(value => `
        <div class="col">
            <span class="item-data-value">${value}</span>
        </div>`).join("");

        itemCard.innerHTML = `
        <div class="row border-bottom">
            <div class="col-sm-6 col-md-8 text-center">
                <div class="row d-flex align-items-center">
                    ${itemData}
                </div>
            </div>
            <div class="col-6 col-md-4 d-flex mb-3 justify-content-end">
                ${htmlGenerateButtons()}
            </div>
        </div>
        <div class="edit-${itemType}-container" id="edit-${itemType}-container-${item.id}">
        </div>`;
    }

    const editButton = itemCard.querySelector(".edit-item-button");

    editButton.addEventListener("click", function() {

        if (itemType === "restaurant") {
            handleEditRestaurant(item.id);
        } else if (itemType === "session") {
            handleEditSession(item);
        } else if (itemType === "cuisine") {
            handleEditCuisine(item);
        }
    });

    const deleteButton = itemCard.querySelector(".delete-item-button");

    deleteButton.addEventListener("click", function() {

        const userConfirmation = confirm(`Are you sure you want to delete this ${itemType}?`);
        if (!userConfirmation) return;

        if (itemType === "restaurant") {
            //handleDeleteDanceEvent(item);
        } else if (itemType === "session") {
            handleDeleteSession(item.id);
        } else if (itemType === "cuisine") {
            handleDeleteCuisine(item.id);
        }
    });

    return itemCard;
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

function displayMessage(message, duration){
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