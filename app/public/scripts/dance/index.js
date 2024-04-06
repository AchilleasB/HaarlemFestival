document.addEventListener('DOMContentLoaded', async function () {
    await displayDateButtons();
    displayVenues();
    displaySchedule();
});

export async function getDanceEventsFromAPI() {
    try {
        const response = await fetch(urlBasePath + 'api/danceEvents');
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const danceEvents = await response.json();
        // return only the events that have a type of single-concert
        const filteredEvents = danceEvents.filter(event => event.type === 'SINGLE-CONCERT');
        // console.log(filteredEvents);
        return filteredEvents;
    } catch (error) {
        console.error(error);
        return [];
    }
}

async function displayDateButtons() {
    const danceEvents = await getDanceEventsFromAPI();
    const uniqueDates = [...new Set(danceEvents.map(event => event.date))];

    const dateButtons = document.querySelector('.date-buttons');
    dateButtons.innerHTML = '';

    uniqueDates.forEach((fullDate) => {
        const shortDate = fullDate.split(' ').slice(1).join(' ');
        const button = document.createElement('button');
        button.className = 'date-button';
        button.textContent = shortDate;

        // display the first date's events by default   
        if (fullDate === uniqueDates[0]) {
            button.classList.add('active');
            displayDanceEvents(fullDate);
        }

        button.addEventListener('click', async () => {
            const allButtons = document.querySelectorAll('.date-button');
            allButtons.forEach((btn) => {
                btn.classList.remove('active');
            });

            button.classList.add('active');

            await displayDanceEvents(fullDate);
        });

        dateButtons.appendChild(button);
    });

}

// dance events section //
async function displayDanceEvents(date) {
    const danceEvents = await getDanceEventsFromAPI();
    const danceEventsContainer = document.querySelector('.dance-events-container');
    danceEventsContainer.innerHTML = '';

    const selectedEvents = danceEvents.filter(event => event.date === date);
    selectedEvents.forEach((danceEvent) => {
        const danceEventCard = renderDanceEventCard(danceEvent);

        danceEventsContainer.appendChild(danceEventCard);
    });

}

function renderDanceEventCard(danceEvent) {
    const eventCardContainer = document.createElement('div');
    eventCardContainer.classList.add('dance-event-card');

    const eventTimeContainer = document.createElement('div');
    eventTimeContainer.classList.add('event-time');

    const eventTime = htmlEventTime(danceEvent);
    eventTimeContainer.appendChild(eventTime);

    const venueNameContainer = document.createElement('div');
    venueNameContainer.classList.add('venue-name');

    const venueName = htmlVenueName(danceEvent);
    venueNameContainer.appendChild(venueName);

    const artistsContainer = document.createElement('div');
    artistsContainer.classList.add('artist-container', 'd-flex', 'w-100', 'justify-content-center', 'align-items-center');

    const eventArtists = renderEventArtists(danceEvent);
    artistsContainer.appendChild(eventArtists);

    const eventSessionContainer = document.createElement('div');
    eventSessionContainer.classList.add('event-session');

    const eventSession = htmlEventSession(danceEvent);
    eventSessionContainer.appendChild(eventSession);

    eventCardContainer.appendChild(eventTimeContainer);
    eventCardContainer.appendChild(venueNameContainer);
    eventCardContainer.appendChild(artistsContainer);
    eventCardContainer.appendChild(eventSessionContainer);

    return eventCardContainer;
}

function htmlEventTime(danceEvent) {
    const eventTime = document.createElement('h4');
    eventTime.classList.add('event-time');
    eventTime.innerHTML = danceEvent.start_time + ` - ` + danceEvent.end_time;

    return eventTime;
}

function htmlVenueName(danceEvent) {
    const venueName = document.createElement('h4');
    venueName.classList.add('venue-name');
    venueName.innerHTML = danceEvent.venue_name;

    return venueName;
}

function htmlEventSession(danceEvent) {
    const eventSession = document.createElement('h4');
    eventSession.classList.add('event-session', 'mb-5');
    eventSession.innerHTML = danceEvent.session;

    return eventSession;
}


// event artists section //
function renderEventArtists(danceEvent) {
    const eventArtistsContainer = document.createElement('div');
    eventArtistsContainer.classList.add('event-artists');

    danceEvent.artists.forEach(artist => {
        const artistCard = renderArtistCard(artist);
        eventArtistsContainer.appendChild(artistCard);
    });

    return eventArtistsContainer;

}

function renderArtistCard(artist) {
    const artistCard = document.createElement('div');
    artistCard.classList.add('artist-card');

    const artistImage = htmlArtistImage(artist);
    const artistName = htmlArtistName(artist);
    const artistGenre = htmlArtistGenre(artist);

    artistCard.appendChild(artistImage);
    artistCard.appendChild(artistName);
    artistCard.appendChild(artistGenre);

    return artistCard;
}

function htmlArtistImage(artist) {
    const artistImage = document.createElement('img');
    artistImage.classList.add('artist-image');
    artistImage.src = imageBasePath + artist.artist_image;

    // Create a link to the artist page
    const artistLink = document.createElement('a');
    artistLink.href = '/dance/artist/?id=' + artist.id;
    artistLink.appendChild(artistImage);

    artistLink.addEventListener('click', function(event) {
        event.preventDefault();
        // Redirect to the artist page
        window.location.href = artistLink.href;
    });

    return artistLink;
}

function htmlArtistName(artist) {
    const artistName = document.createElement('h4');
    artistName.classList.add('artist-name', 'mb-3');
    artistName.innerHTML = artist.name;

    return artistName;
}

function htmlArtistGenre(artist) {
    const artistGenre = document.createElement('h4');
    artistGenre.classList.add('artist-genre', 'mb-3');
    artistGenre.innerHTML = artist.genre;

    return artistGenre;
}

// venues section //

async function getVenuesFromAPI() {
    try {
        const response = await fetch(urlBasePath + 'api/venues');
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const venues = await response.json();
        return venues;
    } catch (error) {
        console.error(error);
        return [];
    }

}

async function displayVenues() {
    const venues = await getVenuesFromAPI();
    // console.log(venues);
    const venueContainer = document.querySelector('.venues-container');
    venueContainer.innerHTML = '';

    venues.forEach((venue) => {
        const venueCard = renderVenueCard(venue);
        venueContainer.appendChild(venueCard);
    });
}

function renderVenueCard(venue) {
    const venueCard = document.createElement('div');
    venueCard.classList.add('venue-card');
    const venueImage = htmlVenueImage(venue);
    const venueName = htmlVenue(venue);
    const venueAddress = htmlVenueAddress(venue);

    venueCard.appendChild(venueImage);
    venueCard.appendChild(venueName);
    venueCard.appendChild(venueAddress);

    return venueCard;
}

function htmlVenueImage(venue) {
    const venueImage = document.createElement('img');
    venueImage.classList.add('venue-image', 'object-fit-cover', 'mb-3');
    venueImage.src = imageBasePath + venue.venue_image;

    return venueImage;
}

function htmlVenue(venue) {
    const venueName = document.createElement('h4');
    venueName.classList.add('venue-card-name', 'mb-3', 'w-50', 'text-center', 'text-wrap');
    venueName.innerHTML = venue.name;

    return venueName;
}

function htmlVenueAddress(venue) {
    const venueAddress = document.createElement('h4');
    venueAddress.classList.add('venue-address', 'mb-3', 'w-50', 'text-center', 'text-wrap');
    venueAddress.innerHTML = venue.address;

    return venueAddress;
}

// schedule section //

async function displaySchedule() {
    const danceEvents = await getDanceEventsFromAPI();
    const scheduleContainer = document.querySelector('.schedule-container');
    scheduleContainer.innerHTML = '';

    const uniqueDates = [...new Set(danceEvents.map(event => event.date))];

    uniqueDates.forEach((date) => {
        const dateSchedule = renderDateSchedule(danceEvents, date);
        scheduleContainer.appendChild(dateSchedule);
    });
}

function renderDateSchedule(danceEvents, date) {
    const dateScheduleCard = document.createElement('div');
    dateScheduleCard.classList.add('date-schedule-card');

    const dayCardTitle = document.createElement('div');
    dayCardTitle.classList.add('schedule-date');
    dayCardTitle.innerHTML = date;

    dateScheduleCard.appendChild(dayCardTitle);

    danceEvents.filter(event => event.date === date).forEach((event) => {


        const artists = document.createElement('div');
        artists.classList.add('schedule-artists');
        artists.innerHTML = event.artists.map(artist => artist.name).join(' / ');

        const venue = document.createElement('div');
        venue.classList.add('schedule-venue');
        venue.innerHTML = event.venue_name;

        const time = document.createElement('div');
        time.classList.add('schedule-time');
        time.innerHTML = event.start_time + ' - ' + event.end_time;

        dateScheduleCard.appendChild(artists);
        dateScheduleCard.appendChild(venue);
        dateScheduleCard.appendChild(time);

    });

    return dateScheduleCard;

}



