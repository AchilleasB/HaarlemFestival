
//added asynchronous ticket data retrieval since the script is updating html content
async function getTicketById(id) {

    const response = await fetch(`${urlBasePath}api/Ticket/getTicketById?id=` + id, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    return data;
}



//added asynchronous event data retrieval since the script is updating html content
async function getEventDataByTicketId($id) {

    const response = await fetch(`${urlBasePath}api/OrderItem/getProductData?id=` + $id, {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        }
    });

    const data = await response.json();
    return data;
}




//reload updated ticket amount data asynchronously so the changes can be loaded without scrolling the page backward
function updateTicketQuantity(orderItemData) {

    $.ajax({
        type: "POST",
        url: `${urlBasePath}api/Ticket/UpdateTicketQuantity`,
        data: orderItemData,
        success: function () {

            window.location.reload();

        }
    });


}



//reload available dance tickets data asynchronously so the changes can be loaded without scrolling the page backward

function updateAvailableTicketsForDanceEvent(eventData) {

    $.ajax({
        type: "POST",
        url: `${urlBasePath}api/Ticket/UpdateAvailableTicketsForDanceEvent`,
        data: eventData,
        success: function () {
            window.location.reload();
        }
    });

}




//reload available tour tickets data asynchronously  so the changes can be loaded without scrolling the page backward

function updateAvailableTicketsForTourEvent(eventData) {

    $.ajax({
        type: "POST",
        url: `${urlBasePath}api/Ticket/UpdateAvailableTicketsForTourEvent`,
        data: eventData,
        success: function () {
            window.location.reload();
        }
    });

}


//reload available reservations  data asynchronously so the changes can be loaded without scrolling the page backward

function updateAvailableReservationsForYummyEvent(eventData) {
    $.ajax({
        type: "POST",
        url: `${urlBasePath}api/Ticket/UpdateAvailableReservationsForYummyEvent`,
        data: eventData,
        success: function () {
            window.location.reload();
        }
    });

}







//Function that handles update available tickets for various events
//Handles the update based on the various sql queries used for update 
function setOrderItemsData() {

    let btns = document.querySelectorAll('.updateQuantity');

    let selectors = document.querySelectorAll(".quantityValues");

    let orderItemIds = document.querySelectorAll(".itemId");

    btns.forEach(async (btn, i) => {

        var orderItemId = orderItemIds[i].textContent;
        var item = selectors[i].querySelectorAll(".quantity");
        const ticketData = await getTicketById(orderItemId);
        const eventData = await getEventDataByTicketId(orderItemId);

        btn.addEventListener('click', () => {


            calculateTicketQuantities(ticketData, eventData, item[0].value);
            updateTicketQuantity(ticketData);

            if (ticketData['dance_event_id'] !== null) {
                eventData.event_id = ticketData['dance_event_id'];
                updateAvailableTicketsForDanceEvent(eventData);
            }


            if (ticketData['history_tour_id'] !== null) {
                eventData.event_id = ticketData['history_tour_id'];
                updateAvailableTicketsForTourEvent(eventData);

            }

            if (ticketData['reservation_id'] !== null) {
                updateAvailableReservationsForYummyEvent(eventData);
            }


        });

    });

}



function calculateTicketQuantities(orderItem, event, input) {
    var initialValue = orderItem.amount;
    var updatedQuantity = orderItem.amount - input;
    orderItem.amount = input;

    if (orderItem.amount > initialValue) {
        var availableTickets = event.tickets_available - Math.abs(updatedQuantity);
    }
    else {
        var availableTickets = event.tickets_available + updatedQuantity;
    }

    event.tickets_available = availableTickets;

    if (availableTickets < 0) {

        orderItem.amount = (orderItem.amount - Math.abs(availableTickets));
        event.tickets_available = 0;

    }

}








function displayPaidTickets() {

    paidTickets.forEach(async (ticket, i) => {
        var eventData = await getEventDataByTicketId(ticket.id);

        var day = eventData.date_time.match('[1-9]{2}|[12]\d|3[01]');

        var time = eventData.date_time.match('[0-9]{2}:[0-9]{2}').toString().split(":");
        time = eventData.date_time.match('[0-9]{2}:[0-9]{2}').toString().split(":")[0];

        if (time < 12) {
            var td = document.querySelectorAll(`.hour${time}am`);
        }
        else { var td = document.querySelectorAll(`.hour${time}pm`); }


        if ($(td[0]).find(`.${day}July`).length > 0) {

            $(td[0]).find(`.${day}July`).text(eventData.name);

        }


    });


}

setOrderItemsData();
displayPaidTickets();

