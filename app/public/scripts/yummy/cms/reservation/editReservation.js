async function handleEditReservation(reservation) {

    const editReservationContainer = document.getElementById(`edit-reservation-container-${reservation.id}`);
    editReservationContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-reservation-form" style="margin-top:6px">
                <h3>Edit Reservations's Information</h3>
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" rows="3" value="${reservation.id}"></input>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">User's last name</label>
                    <p class="reservantion-unchangeable">${reservation.userLastname}</p>
                </div>
                <div class="mb-3">
                    <label for="restaurant" class="form-label">Restaurant name</label>
                    <p class="reservantion-unchangeable">${formatRestaurantNameForReservations(reservation.restaurantName)}</p>
                </div>
                <div class="mb-3">
                    <label for="session" class="form-label">Session</label>
                    <p class="reservantion-unchangeable">${formatSessionTimesForReservation(reservation.sessionStartTime, reservation.sessionEndTime)}</p>
                </div>
                <div class="mb-3">
                    <label for="guests" class="form-label">Number of guests</label>
                    <input type="number" id="guests" min="1" name="guests" value="${reservation.numberOfPeople}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" value="${reservation.mobileNumber}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="remark" class="form-label">Remarks</label>
                    <textarea id="remark" name="remark" rows="5" class="form-control">${reservation.remark}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="update-reservation-button">Update</button>
                <button type="button" class="btn btn-danger" id="close-reservation-button">Close</button>
            </form>
        </div>
    </div>
    `;

    const updateReservationButton = document.getElementById("update-reservation-button");

    updateReservationButton.addEventListener("click", function (e) {
        e.preventDefault();
        const form = document.getElementById('edit-reservation-form');
        if (form.checkValidity()) {
            updateReservationData();
            editReservationContainer.innerHTML = '';
        } else {
            alert("Please fill in all fields.");
        }
    });

    const closeEventFormButton = document.getElementById("close-reservation-button");

    closeEventFormButton.addEventListener("click", function () {
        editReservationContainer.innerHTML = null;
    });
}

async function updateReservationData() {
    const formData = new FormData(document.getElementById('edit-reservation-form'));

    const response = await fetch(reservationAPIendpoint, {
        method: "POST",
        body: formData
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(reservationAPIendpoint, "reservation");
}
