
document.addEventListener('DOMContentLoaded', async function () {
    const artist = await getArtistInfoFromAPI();
    
    const artistPageImgContainer = document.getElementById('artistPageImg');
    const artistImgElement = document.createElement('img');
    artistImgElement.src = imageBasePath + artist.page_img;
    artistImgElement.alt = artistName;
    artistPageImgContainer.appendChild(artistImgElement);

    const artistDescriptionElement = document.getElementById('artistDescription');
    artistDescriptionElement.innerHTML = artist.description.toUpperCase();

    const careerHighlightTitleElement = document.getElementById('careerHighlightTitle');
    careerHighlightTitleElement.innerHTML = artist.career_highlight_title;

    const careerHighlightImgContainer = document.getElementById('careerHighlightImgContainer');
    const careerHighlightImgElement = document.createElement('img');
    careerHighlightImgElement.src = imageBasePath + artist.career_highlight_img;
    careerHighlightImgElement.alt = artistName;
    careerHighlightImgContainer.appendChild(careerHighlightImgElement);

    const careerHighlightTextElement = document.getElementById('careerHighlightText');
    careerHighlightTextElement.innerHTML = artist.career_highlight_text.toUpperCase();

    const artistLatestReleases = document.getElementById('artistLatestReleases');
    artistLatestReleases.innerHTML = artist.latest_releases;

    const artistAppearances = document.getElementById('artistAppearances');
    const danceEventsForArtist = await getDanceEventsForArtist(artist.artist_id);
    const artistAppearanceCards = displayAppearances(danceEventsForArtist);
    // console.log(artist.artist_id);
    artistAppearances.appendChild(artistAppearanceCards);
});

async function getDanceEventsForArtist(artistId) {
    try {
        const response = await fetch(urlBasePath + 'api/artists/artistAppearances/?id=' + artistId);

        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const danceEventsForArtist = await response.json();
        console.log(danceEventsForArtist);
        return danceEventsForArtist;

    } catch (error) {
        return [];
    }

}

async function getArtistInfoFromAPI() {
    try {
        const urlParams = new URLSearchParams(window.location.search);
        const artistId = urlParams.get('id');

        if (!artistId) {
            throw new Error('Artist ID not found');
        }

        const response = await fetch(urlBasePath + `api/artists/artistPage/?id=${artistId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        const artistInfo = await response.json();
        // return the only object provided in the json set 
        const artist = artistInfo[0];
        console.log(artist);
        return artist;
    } catch (error) {
        console.error(error);
    }
}

function displayAppearances(danceEventsForArtist) { 
    const artistAppearancesContainer = document.createElement('div');
    artistAppearancesContainer.classList.add('artistAppearancesContainer');

    danceEventsForArtist.forEach(event => {
        const danceEventCard = renderDanceEventCard(event);
        artistAppearancesContainer.appendChild(danceEventCard);
    });

    return artistAppearancesContainer;
}

function renderDanceEventCard(event) {

    const danceEventCard = document.createElement('div');
    danceEventCard.classList.add('danceEventCard');

    const danceEventDate = document.createElement('h4');
    danceEventDate.classList.add('danceEventDate');
    danceEventDate.innerHTML = event.event_date;
    danceEventCard.appendChild(danceEventDate);

    const venueImg = document.createElement('img');
    venueImg.classList.add('venueImg');
    venueImg.src = imageBasePath + event.venue_image;
    venueImg.alt = event.venue_name;
    danceEventCard.appendChild(venueImg);

    const danceEventTime = document.createElement('h4');
    danceEventTime.classList.add('danceEventTime');
    danceEventTime.innerHTML = event.event_start_time + ' - ' + event.event_end_time;
    danceEventCard.appendChild(danceEventTime);

    const danceEventVenue = document.createElement('h4');
    danceEventVenue.classList.add('danceEventVenue');
    danceEventVenue.innerHTML = event.venue_name;
    danceEventCard.appendChild(danceEventVenue);

    const danceEventAddress = document.createElement('h4');
    danceEventAddress.classList.add('danceEventAddress');
    danceEventAddress.innerHTML = event.venue_address;
    danceEventCard.appendChild(danceEventAddress);

    return danceEventCard;
}





