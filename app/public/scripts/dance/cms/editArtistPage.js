async function handleEditArtistPageContent(artist) {
    const editPageContentContainerId = `handle-artist-container-${artist.id}`;
    const editArtistPageContentContainer = document.getElementById(editPageContentContainerId);
    console.log(artist.id)

    const response = await fetch(`/api/artists/artistPage/${artist.id}`);
    const data = await response.json();
    console.log(data)

    let artistData = '';
    data.forEach(artistPageData => {
        if (artist.id === artistPageData.artist_id) {
            artistData = artistPageData;
        }
    });

    console.log(artistData)

    editArtistPageContentContainer.innerHTML = `
    <div class="row justify-content-center border-bottom mb-3">
        <div class="col-md-8">
            <form id="edit-artist-page-form" style="margin-top:6px">
                <h3>Add artist page content</h3>
                <input type="hidden" id="artist_id" name="artist_id" value="${artist.id}">
                <div class="mb-3">
                    <label for="page_img" class="form-label">Page Image</label>
                    <input type="file" class="form-control" id="page_img" name="page_img" accept="image/*" required>
                    <input type="form-control" id="page_img_path" name="page_img_path" value="">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="career_highlight_title" class="form-label">Career Highlight Title</label>
                    <textarea class="form-control" id="career_highlight_title" name="career_highlight_title" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="career_highlight_text" class="form-label">Career Highlight Text</label>
                    <textarea class="form-control" id="career_highlight_text" name="career_highlight_text" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="career_highlight_img" class="form-label">Carreer Highlight Image</label>
                    <input type="file" class="form-control" id="career_highlight_img" name="career_highlight_img" accept="image/*" required>
                    <input type="form-control" id="career_highlight_img_path" name="career_highlight_img_path" value="">
                </div>
                <div class="mb-3">
                    <label for="latest_releases" class="form-label">Latest Releases</label>
                    <textarea class="form-control" class="form-control" id="latest_releases" name="latest_releases" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="edit-artist-page-button">Add</button>
                <button type="button" class="btn btn-danger" id="close-artist-page-button">Close</button>
            </form>
        </div>
    </div>
`;

    if (artistData) {
        document.getElementById('description').value = artistData.description;
        document.getElementById('page_img_path').value = artistData.page_img;
        document.getElementById('career_highlight_title').value = artistData.career_highlight_title;
        document.getElementById('career_highlight_text').value = artistData.career_highlight_text;
        document.getElementById('career_highlight_img_path').value = artistData.career_highlight_img;
        document.getElementById('latest_releases').value = artistData.latest_releases;
    }

    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image',
        toolbar_mode: 'floating',
        height: 300,
        encoding: 'raw'
    });

    const editArtistPageButton = document.getElementById('edit-artist-page-button');

    editArtistPageButton.addEventListener('click', async function (e) {
        e.preventDefault();
        await updateTextAreaValues();
        await addOrUpdateArtistPageContent();
        tinymce.remove();
        editArtistPageContentContainer.innerHTML = '';
    });

    const closeArtistPageFormButton = document.getElementById('close-artist-page-button');
    closeArtistPageFormButton.addEventListener('click', function () {
        tinymce.remove();
        editArtistPageContentContainer.innerHTML = '';
    });
}

async function addOrUpdateArtistPageContent() {
    const formData = new FormData(document.getElementById('edit-artist-page-form'));

    const response = await fetch(`/api/artists/artistPage`, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(artistsAPIendpoint, "artists");
}

async function updateTextAreaValues() {
    const descriptionTextArea = tinymce.get('description');
    const careerHighlightTitleTextArea = tinymce.get('career_highlight_title');
    const careerHighlightTextTextArea = tinymce.get('career_highlight_text');
    const latestReleasesTextArea = tinymce.get('latest_releases');

    // Update textarea values with TinyMCE content
    document.getElementById('description').value = descriptionTextArea.getContent();
    document.getElementById('career_highlight_title').value = careerHighlightTitleTextArea.getContent();
    document.getElementById('career_highlight_text').value = careerHighlightTextTextArea.getContent();
    document.getElementById('latest_releases').value = latestReleasesTextArea.getContent();
}