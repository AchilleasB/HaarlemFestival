
document.addEventListener('DOMContentLoaded', async () => {
    // console.log('user_id: ', user_id);
    const ticketsMenu = await renderTicketsMenu();
    document.querySelector('.tickets-menu').appendChild(ticketsMenu);

    // make the first button active to populate the tickets-list,
    // .querySelector gets the first element that matches the selector 
    const firstButton = document.querySelector('.menu-btn');
    if (firstButton) {
        firstButton.classList.add('active');
        firstButton.style.backgroundColor = '#A60303';
        fetchAndDisplayTickets(firstButton.value);
    }
});

async function getDanceEventsFromAPI() {
    try {
        const response = await fetch('http://localhost/api/danceEvents');
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const danceEvents = await response.json();
        return danceEvents;
    } catch (error) {
        console.error(error);
        return [];
    }
}

async function getEventTypes() {
    const danceEvents = await getDanceEventsFromAPI();
    const uniqueTypes = [...new Set(danceEvents.map(event => event.type))];
    return uniqueTypes;
}

// render the tickets menu section //
async function renderTicketsMenu() {
    const btnGroup = document.createElement('div');
    btnGroup.classList.add('btn-group');

    const eventTypes = await getEventTypes();

    eventTypes.forEach(eventType => {
        const button = htmlButton(eventType);
        btnGroup.appendChild(button);
    });

    return btnGroup;
}

function htmlButton(value) {
    const button = document.createElement('button');
    button.type = 'button';
    button.classList.add('menu-btn');
    button.value = value;
    button.textContent = value;

    button.addEventListener('click', () => {
        // Remove 'active' class from all buttons
        document.querySelectorAll('.menu-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.style.backgroundColor = '#B5ADAD';
        });

        // Add 'active' class to the clicked button
        button.classList.add('active');
        button.style.backgroundColor = '#A60303';
        fetchAndDisplayTickets(value);
    });

    return button;
}

// render the tickets list section //

async function fetchAndDisplayTickets(eventType) {
    const danceEvents = await getDanceEventsFromAPI();
    const filteredEvents = danceEvents.filter(event => event.type === eventType);
    const uniqueDates = [...new Set(filteredEvents.map(event => event.date))];
    const ticketsList = document.getElementById('tickets-list');
    ticketsList.innerHTML = '';

    uniqueDates.forEach(date => {
        const dayContainer = document.createElement("div");
        dayContainer.classList.add('day-container');

        const shortDate = date.split(' ').slice(1).join(' ');
        dayContainer.innerHTML = `<h3 class="day-title">${shortDate}</h3>`;

        const eventsForDate = filteredEvents.filter(event => event.date === date);
        eventsForDate.forEach(event => {
            const ticket = htmlDisplayTicket(event, eventType);
            dayContainer.appendChild(ticket);
        });

        ticketsList.appendChild(dayContainer);
    });
}

function htmlDisplayTicket(event, eventType) {
    const ticket = document.createElement("div");
    ticket.classList.add('ticket-container');

    let ticketData = `
            <div class="row">
                <div class="col text-center">
                    <div class="row d-flex align-items-center">
                        <div class="col">
                            <div class="ticket-details">
                                <h5 class="ticket-title">${showArtistsNamesOrDayPass(event.artists, eventType)}</h5>
                                <p class="ticket-text">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    ${showDateAndTime(event.date, event.start_time)}</br>
                                    <i class="fa-solid fa-location-dot"></i>
                                    ${event.venue_name}
                                </p>
                                <div class="row">
                                    <div class="col">
                                        <p class="ticket-price">€ ${event.price}</p>
                                        <div class="ticket-action">
                                            <input type="number" class="ticket-amount" placeholder="0" min="1">
                                            <button class="addToCart-button">Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-images">
                                ${showEventImages(event.artists, eventType)}
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>   
        `;

    ticket.innerHTML = ticketData;

    const addToCart = ticket.querySelector(".addToCart-button");
    addToCart.addEventListener("click", function () {
        const amount = ticket.querySelector(".ticket-amount").value;
        handleAddToCart(event.id, amount);
        fetchAndDisplayTickets(eventType);
    });

    return ticket;
}

async function handleAddToCart(event_id, amount) {
    const response = await fetch('http://localhost/api/danceEvents/tickets', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            amount: parseInt(amount),
            event_id: event_id,
            user_id: user_id
        })
    });

    console.log('user_id: ', user_id);
    console.log('event_id: ', event_id);
    console.log('tickets_amount: ', amount);

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
}

function showArtistsNamesOrDayPass(artists, eventType) {

    if (eventType === 'SINGLE-CONCERT') {
        return artists.map(artist => artist.name).join(' & ');
    }

    if (eventType === '1-DAY-PASS') {
        return '1-DAY ALL ACCESS PASS';
    }

    if (eventType === '3-DAY-PASS') {
        return '3-DAY ALL ACCESS PASS';
    }
}

function showDateAndTime(date, time) {
        const shortDate = date.split(' ').slice(0).join(' ');
        return shortDate + '</br><i class="fa-regular fa-clock"></i> ' + time;
}

function showEventImages(artists, eventType) {
    if (eventType === 'SINGLE-CONCERT') {
        console.log(eventType)
        return artists.map(artist => `<img src="${imageBasePath}${artist.artist_image}" class="ticket-image" >`).join('');
    } else {
        console.log(imageBasePath)
        return `<img src="${imageBasePath}dance_event.png" class="ticket-image">`;
    }
}

function displayMessage(message, duration) {
    const messageContainer = document.createElement("div");
    messageContainer.className = "message-container";
    messageContainer.innerText = message;

    document.body.appendChild(messageContainer);

    setTimeout(() => {
        document.body.removeChild(messageContainer);
    }, duration);
}

