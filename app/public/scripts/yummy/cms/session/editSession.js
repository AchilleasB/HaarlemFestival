async function handleEditSession(session) {

    const editSessionContainer = document.getElementById(`edit-session-container-${session.id}`);
    editSessionContainer.innerHTML = `
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="edit-session-form" style="margin-top:6px">
                <h3>Edit Sessions's Information</h3>
                <div class="mb-3">
                    <label for="start-time" class="form-label">Start time</label>
                    <input type="datetime-local" id="edit-session-start-date" name="start_date" value="${formatStartDatetoDateTimeLocal(session.startDate)}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end-time" class="form-label">End time</label>
                    <input type="datetime-local" id="edit-session-end-date" name="end_date" value="${formatEndDatetoDateTimeLocal(session.endDate)}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" id="update-session-button">Update</button>
                <button type="submit" class="btn btn-danger" id="close-session-button">Close</button>
            </form>
        </div>
    </div>
    `;

    const updateSessionButton = document.getElementById("update-session-button");

    updateSessionButton.addEventListener("click", function (e) {
        e.preventDefault();
        updateSessionData(session);
        editSessionContainer.innerHTML = null;
    });

    const closeEventFormButton = document.getElementById("close-session-button");

    closeEventFormButton.addEventListener("click", function () {
        editSessionContainer.innerHTML = null;
    });
}

async function updateSessionData(session) {

    const response = await fetch(`/api/session`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: session.id,
            start_date: document.getElementById('edit-session-start-date').value,
            end_date: document.getElementById('edit-session-end-date').value
        })
    });

    const data = await response.json();
    displayMessage(data.message, 3000);

    itemsListContainer.innerHTML = "";
    loadItems(sessionAPIendpoint, "session");
}

function formatStartDatetoDateTimeLocal(startDateStr) {
    let [date, time] = startDateStr.split(' - ');
    let [day, month, year] = date.split('.');
    let formattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}T${time}`;
    return formattedDate;
}

function formatEndDatetoDateTimeLocal(endDateStr) {
    let [time, date] = endDateStr.split(' - ');
    let [day, month, year] = date.split('.');
    let formattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}T${time}`;
    return formattedDate;
}
