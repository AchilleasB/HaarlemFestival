// function handleDeleteUser(user){
//     deleteUser(user);
// }

async function handleDeleteUser(user) {
    const response = await fetch(`/api/users`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: user.id,
            firstname: user.firstname
        })
    });

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadUsers(usersAPIendpoint);
}