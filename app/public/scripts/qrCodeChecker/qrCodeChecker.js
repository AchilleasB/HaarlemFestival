


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
            $(datetime).html(`${ticket.date} ${ticket.start_time}`);
            $(ticketData).show();

        }
        else {

            $(ticketData).hide();

        }

}



function getTicketByEvent($userName, $eventName) {

    var res;

    $.ajax({
        url: "http://localhost/api/Ticket/getTicketByEvent",
        type: "GET",
        dataType: "JSON",
        data:{ name: $userName, event: $eventName },
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
      var name = content.split("\n")[0].split("Name:")[1];
      var event = content.split("\n")[1].split("Event:")[1];
      var ticket = getTicketByEvent(name, event);
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
