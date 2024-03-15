const usersAPIendpoint = urlBasePath + "api/users";
const itemsListContainer = document.getElementById("items-list");
const addUserButtonContainer = document.getElementById("add-user-button");
const addUserFormContainer = document.getElementById("add-user-form-container")
const filteringContainer = document.getElementById("filtering-container");
let allUsersData = [];

document.addEventListener("DOMContentLoaded", function () {

    loadUsers(usersAPIendpoint);

    htmlFilteringContainer();
    htmlAddUserButton();
    addUserFormContainer.innerHTML = null;

    const searchInput = document.getElementById("searchInput");
    const sort = document.getElementById("sort");

    searchInput.addEventListener("input", function () {
        const searchTerm = this.value.trim().toLowerCase();
        filterUsers(allUsersData, searchTerm);
    });

    sort.addEventListener("change", function () {
        const sortCriterion = sort.value;
        sortUsers(allUsersData, sortCriterion);
    });

    const resetButton = document.getElementById("resetButton");
    resetButton.addEventListener("click", function () {
        resetFilter(allUsersData);
        searchInput.value = "";
        sort.value = "Sort by";
    });

    
});


function htmlAddUserButton() {
    addUserButtonContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center mt-5">
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

        allUsersData.length = 0;
        allUsersData.push(...data);

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
                        <div class="col">
                            <div class="item-data-label border-bottom"><em>Registration date</em></div>
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
                    <div class="col">
                        <span class="item-data-value">${user.registration_date}</span>
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

// filter users section //

function htmlFilteringContainer() {
    filteringContainer.innerHTML = `
        <div class="d-flex justify-content-center align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="Type here to filter" aria-label="Search">
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 5vh;">
            <div class="input-group">
                <select class="form-select" id="sort">
                    <option selected>Sort by</option>
                    <option value="firstname">First name</option>
                    <option value="lastname">Last name</option>
                    <option value="role">Role</option>
                    <option value="registration_date">Registration date</option>
                </select>
            </div>
        </div>
        <button class="btn btn-outline-secondary w-100" id="resetButton">Reset Filters</button>
    `;
}

function filterUsers(userData, searchTerm) {
    const filteredUsers = userData.filter(user => {
        const firstName = user.firstname.toLowerCase();
        const lastName = user.lastname.toLowerCase();
        const email = user.email.toLowerCase();
        const role = user.role.toLowerCase();
        const registration_date = user.registration_date.toLowerCase();	

        return firstName.includes(searchTerm) ||
               lastName.includes(searchTerm) ||
               email.includes(searchTerm) ||
               role.includes(searchTerm) ||
               registration_date.includes(searchTerm);
    });

    renderFilteredUsers(filteredUsers);
}

function sortUsers(userData, selectedSortCriterion) {
    let sortedUsers;

    switch (selectedSortCriterion) {
        case "firstname":
            sortedUsers = userData.sort((a, b) => a.firstname.localeCompare(b.firstname));
            break;
        case "lastname":
            sortedUsers = userData.sort((a, b) => a.lastname.localeCompare(b.lastname));
            break;
        case "role":
            sortedUsers = userData.sort((a, b) => a.role.localeCompare(b.role));
            break;
        case "registration_date":
            sortedUsers = userData.sort((a, b) => {
                // Convert date strings to Date objects for comparison
                const dateA = new Date(
                    a.registration_date.split('-').reverse().join('-')
                );
                const dateB = new Date(
                    b.registration_date.split('-').reverse().join('-')
                );
                return dateA - dateB;
            });
            break;
        default:
            sortedUsers = userData;
            break;
    }

    renderFilteredUsers(sortedUsers);
}

function resetFilter(userData) {
    renderFilteredUsers(userData);
}

function renderFilteredUsers(filteredUsers) {
    itemsListContainer.innerHTML = "";

    const itemsLabel = createItemLabel();
    const itemList = document.createElement("div");

    filteredUsers.forEach(user => {
        const itemElement = createItemElement(user);
        itemList.appendChild(itemElement);
    });

    itemsListContainer.appendChild(itemsLabel);
    itemsListContainer.appendChild(itemList);
}