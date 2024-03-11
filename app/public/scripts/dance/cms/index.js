const danceEventsAPIendpoint = "http://localhost/api/danceEvents";
const artistsAPIendpoint = "http://localhost/api/artists";
const venuesAPIendpoint = "http://localhost/api/venues";

const itemsListContainer = document.getElementById("items-list");
const eventsRadioButton = document.getElementById("btnradio1");
const artistsRadioButton = document.getElementById("btnradio2");
const venuesRadioButton = document.getElementById("btnradio3");

const addEventButtonContainer = document.getElementById("add-event-button");
const addArtistButtonContainer = document.getElementById("add-artist-button");
const addVenueButtonContainer = document.getElementById("add-venue-button");

const addEventFormContainer = document.getElementById("add-event-form-container")
const addArtistFormContainer = document.getElementById("add-artist-form-container")
const addVenueFormContainer = document.getElementById("add-venue-form-container")

document.addEventListener("DOMContentLoaded", function () {
    loadItems(danceEventsAPIendpoint, "danceEvents");
    htmlAddEventButton();

    eventsRadioButton.addEventListener("click", function () {
        loadItems(danceEventsAPIendpoint, "danceEvents");
        htmlAddEventButton();
        addArtistButtonContainer.innerHTML = null;
        addVenueButtonContainer.innerHTML = null;
        addEventFormContainer.innerHTML = null;
        addArtistFormContainer.innerHTML = null;
        addVenueFormContainer.innerHTML = null;
    });
    
    artistsRadioButton.addEventListener("click", function () {
        loadItems(artistsAPIendpoint, "artists");
        htmlAddArtistButton();
        addEventButtonContainer.innerHTML = null;
        addVenueButtonContainer.innerHTML = null;
        addEventFormContainer.innerHTML = null;
        addArtistFormContainer.innerHTML = null;
        addVenueFormContainer.innerHTML = null;
    });

    venuesRadioButton.addEventListener("click", function () {
        loadItems(venuesAPIendpoint, "venues");
        htmlAddVenueButton();
        addEventButtonContainer.innerHTML = null;
        addArtistButtonContainer.innerHTML = null;
        addEventFormContainer.innerHTML = null;
        addArtistFormContainer.innerHTML = null;
        addVenueFormContainer.innerHTML = null;
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

function htmlAddEventButton() {
    addEventButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <button id="add-user-button" class="btn btn-outline-success btn-lg">Add event</a>
        </div>
    `;
}

function htmlAddArtistButton() {
    addArtistButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <button id="add-artist-button" class="btn btn-outline-success btn-lg">Add artist</a>
        </div>
    `;
}

function htmlAddVenueButton() {
    addVenueButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">    
            <button id="add-venue-button" class="btn btn-outline-success btn-lg">Add venue</a>
        </div>
    `;
}

function createItemLabel(itemType) {
    const itemLabel = document.createElement("div");
    itemLabel.classList.add("label", "mb-5", "mt-5");

    if (itemType === "danceEvents") {
        itemLabel.innerHTML = `
            <div class="labels-container">
                <div class="row">
                    <div class="col-sm-6 col-md-8 text-center">
                        <div class="row d-flex align-items-center border-botttom">
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Date</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Venue</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Start time</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>End time</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Session</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>no. Tickets</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Price</em></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else if (itemType === "artists") {
        itemLabel.innerHTML = `
            <div class="labels-container">
                <div class="row">
                    <div class="col-sm-6 col-md-8 text-center">
                        <div class="row d-flex align-items-center border-botttom">
                        <div class="col">
                                <div class="item-data-label border-bottom"><em>Image</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Name</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Genre</em></div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        `;
    }
    else if (itemType === "venues") {
        itemLabel.innerHTML = `
            <div class="labels-container">
                <div class="row">
                    <div class="col-sm-6 col-md-8 text-center">
                        <div class="row d-flex align-items-center border-botttom">
                        <div class="col">
                                <div class="item-data-label border-bottom"><em>Image</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Name</em></div>
                            </div>
                            <div class="col">
                                <div class="item-data-label border-bottom"><em>Address</em></div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    return itemLabel;
}

function createItemElement(item, itemType) {
    const itemElement = document.createElement("div");
    itemElement.classList.add("container", "mb-5");

    if (itemType === "danceEvents") {
        itemData = `
            <div class="row border-bottom">
                <div class="col-sm-6 col-md-8 text-center">
                    <div class="row d-flex align-items-center">
                        <div class="col">
                            <span class="item-data-value">${item.date}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.venue_name}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.start_time}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.end_time}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.session}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.tickets_available}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.price}</span>
                        </div>                        
                    </div>
                </div>
                <div class="col-6 col-md-4 d-flex mt-3 mb-3 ">
                    ${htmlGenerateButtons()}
                </div>
            </div>
            <div class="edit-eventcontainer" id="edit-event-container-${item.id}">
            </div>
        `;
    } else if (itemType === "artists") {
        itemData = `
            <div class="row border-bottom">
                <div class="col-sm-6 col-md-8 text-center">
                    <div class="row d-flex align-items-center">
                    <div class="col">
                            <span class="item-data-value"><img src="${imageBasePath}${item.artist_image}" class="img-thumbnail" style="max-width: 100px; height: auto;"></span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.name}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.genre}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 d-flex mb-3 ">
                    ${htmlGenerateButtons()}
                </div>
            </div>
            <div class="edit-artist-container" id="edit-artist-container-${item.id}">
            </div> 
        `;
    } else if (itemType === "venues") {
        itemData = `
            <div class="row border-bottom">
                <div class="col-sm-6 col-md-8 text-center">
                    <div class="row d-flex align-items-center">
                    <div class="col">
                            <span class="item-data-value"><img src="${imageBasePath}${item.venue_image}" class="img-thumbnail" style="max-width: 100px; height: auto;"></span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.name}</span>
                        </div>
                        <div class="col">
                            <span class="item-data-value">${item.address}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 d-flex mb-3 ">
                    ${htmlGenerateButtons()}
                </div>
            </div>
            <div class="edit-venue-container" id="edit-venue-container-${item.id}">
            </div> 
        `;
    }

    // line 262 : each edit container is given a unique id

    itemElement.innerHTML = itemData;

    const editButton = itemElement.querySelector(".edit-item-button");

    editButton.addEventListener("click", function () {
        
        if (itemType === "danceEvents") {
            handleEditDanceEvent(item);
        } else if (itemType === "artists") {
            handleEditArtist(item);
        } else if (itemType === "venues") {
            handleEditVenue(item);
        }        
    });

    const deleteButton = itemElement.querySelector(".delete-item-button");

    deleteButton.addEventListener("click", function () {

        const userConfirmation = confirm("Are you sure you want to delete this item?");
        if (!userConfirmation) return;

        if (itemType === "danceEvents") {
            handleDeleteDanceEvent(item);
        } else if (itemType === "artists") {
            handleDeleteArtist(item);
            console.log(item);
        } else if (itemType === "venues") {
            handleDeleteVenue(item);
        }
    });

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

function displayMessage(message, duration){
    const messageContainer = document.createElement("div");
    messageContainer.className = "message-container";
    messageContainer.innerText = message;

    document.body.appendChild(messageContainer);

    setTimeout(() => {
        document.body.removeChild(messageContainer);
    }, duration);
}