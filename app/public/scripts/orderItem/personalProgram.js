
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


//Function that handles update ticket amount
function setOrderItemsData() {

    let btns = document.querySelectorAll('.updateQuantity');

    let selectors = document.querySelectorAll(".quantityValues");

    let orderItemIds = document.querySelectorAll(".itemId");

    btns.forEach(async (btn, i) => {

        var orderItemId = orderItemIds[i].textContent;
        var item = selectors[i].querySelectorAll(".quantity");
        const ticketData = await getTicketById(orderItemId);

        btn.addEventListener('click', () => {

            ticketData.amount = item[0].value;
            updateTicketQuantity(ticketData);               
            
            
        });

    });

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

