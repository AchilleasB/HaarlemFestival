function getTicketById($id) {

    var res;

    $.ajax({
        url: "http://localhost/api/Ticket/getDanceTicketById?id=" + $id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (jsonStr) {
            res = jsonStr;
        }
    });
    return res;
}



function getEventDataByEventId($id) {

    var res;

    $.ajax({
        url: "http://localhost/api/ShoppingCart/getProductData?id=" + $id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (jsonStr) {
            res = jsonStr;
        }
    });
    return res;
}



function updateDanceTicketQuantity(orderItemData) {

    $.ajax({
        type: "POST",
        url: "http://localhost/api/Ticket/UpdateDanceTicketQuantity",
        data: orderItemData,
        success: function () {
            window.location.reload();

        }
    });
    

}



function updateAvailableTickets(eventData) {

    $.ajax({
        type: "POST",
        url: "http://localhost/api/Ticket/UpdateAvailableTicketsForDanceEvent",
        data: eventData,
        success: function () {
            window.location.reload();
        }
    });    
}



function setOrderItemsData() {
    let btns = document.querySelectorAll('.updateQuantity');

    let selectors = document.querySelectorAll(".quantityValues");

    btns.forEach((btn, i) => {

        btn.addEventListener('click', function (event) {

            var orderItemId = parseInt($(this).parent().find('#orderItemId').text());
            var item = selectors[i].querySelectorAll(".quantity");
            var ticketData = getTicketById(orderItemId);
            var eventData = getEventDataByEventId(ticketData['event_id']);
            eventData.event_id=ticketData['event_id'];
            calculateTicketQuantities(ticketData, eventData, item[0].value);
            ticketData.id=orderItemId;
            updateDanceTicketQuantity(ticketData);
            updateAvailableTickets(eventData);

           
        });

    }); 

}


function calculateTicketQuantities(orderItem, event, input)
{
       

        var initialValue = orderItem.amount;
        var updatedQuantity = orderItem.amount - input;
        orderItem.amount = input;

        if (orderItem.amount > initialValue){
            var availableTickets = event.tickets_available - Math.abs(updatedQuantity);
            }
    else{
            var availableTickets = event.tickets_available + updatedQuantity;
        }

        event.tickets_available = availableTickets;
        
        if (availableTickets < 0){

            orderItem.amount= (orderItem.ticket - Math.abs(availableTickets));
            event.availableTickets = 0;

        }


}




function deleteDanceTicket($id) {

    $.ajax({
        url: "http://localhost/api/Ticket/deleteDanceTicket?id=" + $id,
        type: "DELETE",
        success: function () {
            window.location.reload();

        }
    });
}








function onClickDeleteProduct() {

    var products = document.querySelectorAll(".product");

    var btns = document.querySelectorAll('.removeItem');



        products.forEach((product, i) => {
   
                var itemIdString = btns[i].attributes[1].value;
                var itemId = itemIdString.match(/\d+/g);

                btns[i].addEventListener('click', function () {
                deleteDanceTicket(itemId);

            });
    });

}



 setOrderItemsData();
 onClickDeleteProduct();
