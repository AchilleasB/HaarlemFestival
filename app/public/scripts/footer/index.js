document.addEventListener("DOMContentLoaded", function () {
    loadEventPagesLinks();
});

async function loadEventPagesLinks() {
    const eventPageTitles = await fetch('/api/eventPage');
    const eventPageTitlesData = await eventPageTitles.json();

    generateEventPageColumn(eventPageTitlesData);
}


function generateEventPageColumn(eventPageTitles) {
    if (eventPageTitles.length == 0) return;

    let divCol = createNewColumn();

    eventPageTitles.forEach((eventPage) => {
        addLinkToColumn(divCol, eventPage.title);
    });
}

function createNewColumn() {
    removeNavDivBorders();

    const dynamicEventPageContainer = document.getElementById('dynamic-event-page-container');
    dynamicEventPageContainer.classList.add('col-md-4', 'border-start');
    dynamicEventPageContainer.innerHTML = '';

    const divBorder = document.createElement('div');
    divBorder.classList.add('pe-3');
    dynamicEventPageContainer.appendChild(divBorder);

    const pTitle = document.createElement('p');
    pTitle.classList.add('fw-bold', 'fs-5');
    pTitle.textContent = 'INFORMATION PAGES';
    divBorder.appendChild(pTitle);

    const divCol = document.createElement('div');
    divCol.classList.add('col-md-12');
    divBorder.appendChild(divCol);

    return divCol;
}

function addLinkToColumn(divCol, title) {
    const p = document.createElement('p');
    const a = document.createElement('a');
    a.href = `/customPage/viewPage/${title}`; // Convert title to URL slug
    a.classList.add('text-reset', 'text-decoration-none');
    a.textContent = makeHumanFriendly(title);
    p.appendChild(a);
    divCol.appendChild(p);
}

function removeNavDivBorders() {
    const navigationDiv = document.getElementById('navigation-container');
    navigationDiv.classList.remove('border-start', 'border-end');
}

function makeHumanFriendly(string) {
    return string
        .split('-')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}