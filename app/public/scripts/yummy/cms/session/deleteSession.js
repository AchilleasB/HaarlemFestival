async function handleDeleteSession(sessionId) {
    const response = await fetch(`/api/session?id=${sessionId}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(sessionAPIendpoint, "session")
}