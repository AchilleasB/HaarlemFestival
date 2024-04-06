<footer class="text-center bg-white border-top text-muted py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div id="navigation-container" class="border-start border-end pe-3">
                    <p class="fw-bold fs-5">NAVIGATION</p>
                    <div class="col-md-12">
                        <p><a href="/festival" class="text-reset text-decoration-none">The Festival</a></p>
                        <p><a href="/history" class="text-reset text-decoration-none">History Stroll</a></p>
                        <p><a href="/dance" class="text-reset text-decoration-none">Dance!</a></p>
                        <p><a href="/yummy" class="text-reset text-decoration-none">Yummy!</a></p>
                    </div>
                </div>
            </div>
            <div id="dynamic-event-page-container"></div>
        </div>
    </div>
    <hr class="my-4">
    <div class="col-md-12">
        <p class="fs-6 fw-light">&copy;2024 ITGR5. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
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
</script>

</body>

</html>