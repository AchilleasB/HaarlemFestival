


function displayTicket(ticket) {


  let ticketData = document.querySelector('.ticket');
  let firstname = document.querySelector('.firstname');
  let lastname = document.querySelector('.lastname');
  let event = document.querySelector('.event');
  let datetime = document.querySelector('.datetime');


  if (ticket) {
    $(firstname).html(ticket.firstname);
    $(lastname).html(ticket.lastname);
    if (ticket.type){
    $(event).html(`${ticket.name} ${ticket.type}`);}
    else{
    $(event).html(`${ticket.name}`);}

    
    if (ticket.date != null) {
      $(datetime).html(`${ticket.date} ${ticket.start_time}`);
    }
    else {
      $(datetime).html(`${ticket.start_time}`);
    }
    $(ticketData).show();

  }
  else {

    $(ticketData).hide();

  }

}



//added asynchronous ticket and event data retrieval since the script is updating html content
async function getTicketAndEventData(ticketId) {

  const response = await fetch(`${urlBasePath}api/Ticket/getTicketAndEventData?id=` + ticketId, {
    method: "GET",
    headers: {
      "Content-Type": "application/json"
    }
  });

  const data = await response.json();
  return data;
}




function scan() {

  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
  scanner.addListener('scan', async function (content) {
    var ticketId = content.split("TicketId:")[1];
    const ticket = await getTicketAndEventData(ticketId);
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
