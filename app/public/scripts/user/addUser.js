
document.addEventListener("DOMContentLoaded", async function () {

    const addUserButton = document.getElementById("add-user-button");

    addUserButton.addEventListener("click", function () {

        const roles = ["Admin", "Customer", "Employee"];

        htmlAddUserForm(roles);

        const saveUser = document.getElementById("save-user-button");
        saveUser.addEventListener("click", function (e) {
            e.preventDefault();
            saveUserDataToDatabase();
            addUserFormContainer.innerHTML = null;

        });

        const closeUserForm = document.getElementById("close-user-form");
        closeUserForm.addEventListener("click", function () {
            addUserFormContainer.innerHTML = null;
        });

    })
});


function htmlAddUserForm(roles) {

    addUserFormContainer.innerHTML = `
    <form id="add-user-form">
        <div class="mb-3">
            <label for="firstname" class="form-label">First name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" id="email" name="email" rows="3" required></input>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled selected>Select a role</option>
                ${generateRolesInput(roles)}

            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock" required>
        </div>
        <button type="submit" class="btn btn-primary" id="save-user-button">Save</button>
        <button type="submit" class="btn btn-danger" id="close-user-form">Close</button>
    </form>
`;
}


async function saveUserDataToDatabase() {
    const currentDate = new Date();

    const formattedDate = `${currentDate.getDate().toString().padStart(2, '0')}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${currentDate.getFullYear()}`;

    const response = await fetch(`/api/users`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            firstname: document.getElementById("firstname").value,
            lastname: document.getElementById("lastname").value,
            email: document.getElementById("email").value,
            role: document.getElementById("role").value,
            password: document.getElementById("password").value,
            $registration_date: formattedDate
        })
    });
    
    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadUsers(usersAPIendpoint);
}

function generateRolesInput(roles) {
    return roles.map(role => `<option value="${role}">${role}</option>`).join("");
}