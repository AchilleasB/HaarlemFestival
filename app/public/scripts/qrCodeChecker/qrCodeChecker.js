


function displayTicket(ticket){


    let ticketData = document.querySelector('.ticket');
    let firstname = document.querySelector('.firstname');
    let lastname = document.querySelector('.lastname');
    let event = document.querySelector('.event');
    let datetime = document.querySelector('.datetime');


        if (ticket){
            $(firstname).html(ticket.firstname);
            $(lastname).html(ticket.lastname);
            $(event).html(ticket.name);
            if(ticket.date != null){
            $(datetime).html(`${ticket.date} ${ticket.start_time}`);
            }
            else 
            {
              $(datetime).html(`${ticket.start_time}`);
            }
            $(ticketData).show();

        }
        else {

            $(ticketData).hide();

        }

}



function getTicketAndEventData($ticketId) {

    var res;

    $.ajax({
        url: `${urlBasePath}api/Ticket/getTicketAndEventData?id=` + $ticketId,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (jsonStr) {
            res = jsonStr;
        }
    });
    return res;
}





function scan() {

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      var ticketId = content.split("TicketId:")[1];
      var ticket = getTicketAndEventData(ticketId);
       displayTicket(ticket);
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });


}
 displayTicket(false);
 scan();
