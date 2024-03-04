
function handleEditUser(user){

    const roles = ["Admin", "Customer", "Employee"];

    const editUserContainerId = `edit-user-container-${user.id}`;
    const editUserContainer = document.getElementById(editUserContainerId);

    editUserContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-user-form" style="margin-top:6px">
                <h3>Edit ${user.firstname}'s Information</h3>
                <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" id="edit-user-firstname" name="${user.firstname}" value="${user.firstname}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">First name</label>
                    <input type="text" id="edit-user-lastname" name="${user.lastname}" value="${user.lastname}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="edit-user-email" name="${user.email}" value="${user.email}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="edit-user-password" name="password" value="${user.password}">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" value="********" class="form-control" disabled>
                </div>
                <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="edit-user-role" name="role" required>
                <option value="${user.role}" disabled selected>${user.role}</option>
                ${generateRolesInput(roles)}

            </select>
        </div>
                <button type="submit" class="btn btn-primary" id="update-user-button">Update</button>
                <button type="submit" class="btn btn-danger" id="close-user-button">Close</button>
            </form>
        </div>
    </div>
    `;

    const updateUserButton = document.getElementById("update-user-button");

    updateUserButton.addEventListener("click", function (e) {
        e.preventDefault();
        updateUserData(user);
        editUserContainer.innerHTML = null;
    });

    const closeUserFormButton = document.getElementById("close-user-button");

    closeUserFormButton.addEventListener("click", function () {
        editUserContainer.innerHTML = null;
    });
           
}

async function updateUserData(user) {
    const response = await fetch(`/api/users`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: user.id,
            firstname: document.getElementById("edit-user-firstname").value,
            lastname: document.getElementById("edit-user-lastname").value,
            email: document.getElementById("edit-user-email").value,
            password: document.getElementById("edit-user-password").value,
            role: document.getElementById("edit-user-role").value
        })
    });

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadUsers(usersAPIendpoint);
}