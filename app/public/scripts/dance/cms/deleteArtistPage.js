async function handleDeleteArtistPage(artist) {
const artistInfo = await fetch(`/api/artists/artistPage/${artist.id}`);
const artistsData = await artistInfo.json();
console.log(artistsData); 

artistsData.forEach(async artistPageData => {
    if (artist.id === artistPageData.artist_id) {
        console.log(artistPageData.artist_id)

        const response = await fetch(`/api/artists/artistPage`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                artist_id: artist.id,
                page_img: artistPageData.page_img,
                career_highlight_img: artistPageData.career_highlight_img
            })
        });
        
        const data = await response.json();
        console.log(data);
        displayMessage(data.message, 3000);
        itemsListContainer.innerHTML = "";
        loadItems(artistsAPIendpoint, "artists");
    }
});

}