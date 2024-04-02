function getTicketById($id) {

    var res;

    $.ajax({
        url: `${urlBasePath}api/Ticket/getTicketById?id=` + $id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (jsonStr) {
            res = jsonStr;
        }
    });
    return res;
}



function getEventDataByTicketId($id) {

    var res;

    $.ajax({
        url: `${urlBasePath}api/OrderItem/getProductData?id=` + $id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (jsonStr) {
            res = jsonStr;
        }
    });
    return res;
}



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


function getRestaurantIdByName(eventData) {

    var res;
    $.ajax({
        type: "GET",
        async:false,
        url: `${urlBasePath}api/Restaurant/GetRestaurantIdByName`,
        data: eventData,
        success: function (jsonStr) {
            res=jsonStr;
        }
    });    

    return res;
}


//Function that handles update available tickets for various events
//Handles the update based on the various sql queries used for update 
function setOrderItemsData() {

    let btns = document.querySelectorAll('.updateQuantity');

    let selectors = document.querySelectorAll(".quantityValues");

    let orderItemIds = document.querySelectorAll(".itemId");

    btns.forEach((btn, i) => {

        btn.addEventListener('click', function (event) {

             var orderItemId = orderItemIds[i].textContent;
             var item = selectors[i].querySelectorAll(".quantity");
             var ticketData = getTicketById(orderItemId);
            var eventData = getEventDataByTicketId(orderItemId);
            var updatedQuantity = calculateTicketQuantities(ticketData, eventData, item[0].value);
            updateTicketQuantity(ticketData);

            if (ticketData['dance_event_id']!==null){
            eventData.event_id=ticketData['dance_event_id'];
            updateAvailableTicketsForDanceEvent(eventData);}
            

            if (ticketData['history_tour_id']!==null){
                eventData.event_id=ticketData['history_tour_id'];
                if ((Math.sign(updatedQuantity)) === -1){
                    eventData.tickets_to_subtract=Math.abs(updatedQuantity);
                    }
                    else {
                        eventData.tickets_to_subtract=-Math.abs(updatedQuantity);
                }
                updateAvailableTicketsForTourEvent(eventData);
                
            }

            if (ticketData['reservation_id']!==null){
                var restaurantId=getRestaurantIdByName(eventData);
                eventData.event_id=restaurantId;
                updateAvailableReservationsForYummyEvent(eventData);
            }
           
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

            orderItem.amount=(orderItem.amount - Math.abs(availableTickets));
            event.tickets_available = 0;

        }


return updatedQuantity;

}








function displayPaidTickets(){   
   paidTickets.forEach((ticket, i) => {
    var eventData = getEventDataByTicketId(ticket.id);

    if (ticket['dance_event_id'] != null){
        var day=eventData.date_time.match('[0-9]{1,}');}
    else if (ticket['history_tour_id'] != null){
        var day=eventData.date_time.match('[1-9]{2}|[12]\d|3[01]');
    }
    
    var time=eventData.date_time.match('[0-9]{2}:[0-9]{2}').toString().split(":");
    time=eventData.date_time.match('[0-9]{2}:[0-9]{2}').toString().split(":")[0];

    if (time <12 ){
    var td = document.querySelectorAll(`.hour${time}am`);
    }
    else 
    {var td = document.querySelectorAll(`.hour${time}pm`);}


    if ($(td[0]).find(`.${day}July`).length > 0){
        
        $(td[0]).find(`.${day}July`).text(eventData.name);
    
     }
   

   });


}

 setOrderItemsData();
 displayPaidTickets();
