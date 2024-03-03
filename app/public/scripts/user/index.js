const usersAPIendpoint = "http://localhost/api/users";
const itemsListContainer = document.getElementById("items-list");
const addUserButtonContainer = document.getElementById("add-user-button");
const addUserFormContainer = document.getElementById("add-user-form-container")

document.addEventListener("DOMContentLoaded", function () {
    htmlAddUserButton();
    loadUsers(usersAPIendpoint);
    addUserFormContainer.innerHTML = null;
});

function htmlAddUserButton() {
    addUserButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height: 10vh;">
            <button id="add-user-button" class="btn btn-outline-success btn-lg">Add user</a>
        </div>
    `;
}

async function loadUsers(usersAPIendpoint) {
    itemsListContainer.innerHTML = "";

    const itemsLabel = createItemLabel();
    const itemList = document.createElement("div");

    try {
        const response = await fetch(usersAPIendpoint);
        const data = await response.json();
        data.forEach(user => {
            const itemElement = createItemElement(user);
            itemList.appendChild(itemElement);
        });

        itemsListContainer.appendChild(itemsLabel);
        itemsListContainer.appendChild(itemList);
    } catch (error) {
        console.log(error);
    }

}

function createItemLabel() {
    const itemLabel = document.createElement("div");
    itemLabel.classList.add("label", "mb-5", "mt-5");

    itemLabel.innerHTML = `
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-8 text-center">
                    <div class="row d-flex align-items-center border-botttom">
                        <div class="col">
                            <div class="item-data-label border-bottom"><em>First name</em></div>
                        </div>
                        <div class="col">
                            <div class="item-data-label border-bottom"><em>Last name</em></div>
                        </div>
                        <div class="col">
                            <div class="item-data-label border-bottom"><em>Email</em></div>
                        </div>
                        <div class="col">
                            <div class="item-data-label border-bottom"><em>Role</em></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    return itemLabel;
}

function createItemElement(user) {
    const itemElement = document.createElement("div");
    itemElement.classList.add("item", "mb-5", "mt-5");

    let userData = "";

    userData = `
        <div class="row border-bottom">
            <div class="col-sm-6 col-md-8 text-center">
                <div class="row d-flex align-items-center">
                    <div class="col">
                    <span class="item-data-value">${user.firstname}</span>
                    </div>
                    <div class="col">
                        <span class="item-data-value">${user.lastname}</span>
                    </div>
                    <div class="col">
                        <span class="item-data-value">${user.email}</span>
                    </div>
                    <div class="col">
                        <span class="item-data-value">${user.role}</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 d-flex mt-3 mb-3 ">
                ${htmlGenerateButtons()}
            </div>
        </div>
        <div class="container" id="edit-user-container-${user.id}">
        </div>
    `;

    itemElement.innerHTML = userData;

    const editButton = itemElement.querySelector(".edit-user-button");
    editButton.addEventListener("click", function () {
        handleEditUser(user);
    });

    const deleteButton = itemElement.querySelector(".delete-user-button");
    deleteButton.addEventListener("click", function () {
        handleDeleteUser(user);

    });

    return itemElement;
}

function htmlGenerateButtons() {
    return `
        <div class="row">
            <div class="col">
                <span class="item-data-value">
                    <button class="btn btn-outline-primary edit-user-button">Edit</button>
                </span>
            </div>
            <div class="col">
                <span class="item-data-value">
                    <button class="btn btn-outline-danger delete-user-button">Delete</button>
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