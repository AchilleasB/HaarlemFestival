async function handleDeleteArtist(artist) {
    const response = await fetch(`/api/artists`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: artist.id,
            name: artist.name,
            image: artist.artist_image
        })
    });
    
    const data = await response.json();
    console.log(data);
    displayMessage(data.message, 3000);
    itemsListContainer.innerHTML = "";
    loadItems(artistsAPIendpoint, "artists");
}