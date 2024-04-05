async function handleActivationReservation(reservationId) {
    const response = await fetch(`${reservationAPIendpoint}?id=${encodeURIComponent(reservationId)}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(reservationAPIendpoint, "reservation")
}
