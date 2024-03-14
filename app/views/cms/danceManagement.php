<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require __DIR__ . '/../../config/imgconfig.php';
    require __DIR__ . '/../../config/urlconfig.php';
    ?>

    <main>
        <div class="red-line"></div>
        <div class="dance-cms-container">
            <h1 class="header mb-5">Dance Content Management</h1>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Events</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Artists</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio3">Venues</label>
            </div>
            <div class="content-container">
                <div class="add-event-container mt-5 mb-5" id="add-event-button">
                </div>
                <div class="add-event-container mt-5 mb-5" id="add-artist-button">
                </div>
                <div class="add-event-container mt-5 mb-5" id="add-venue-button">
                </div>
                <div class=" add-event-form container-lg" id="add-event-form-container">
                </div>
                <div class=" add-artist-form container-lg" id="add-artist-form-container">
                </div>
                <div class="add-venue-form container-lg" id="add-venue-form-container">
                </div>
                <div class="items-list container-lg" id="items-list">
                </div>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../backToTop.php';
    include __DIR__ . '/../footer.php';
    ?>

    <script>
        const imageBasePath = "<?php echo $imageBasePath; ?>";
        const urlBasePath = "<?php echo $urlBasePath; ?>";
    </script>
    <script src="/../scripts/dance/cms/index.js"></script>
    <script src="/../scripts/dance/cms/addEvent.js"></script>
    <script src="/../scripts/dance/cms/addArtist.js"></script>
    <script src="/../scripts/dance/cms/addVenue.js"></script>
    <script src="/../scripts/dance/cms/editEvent.js"></script>
    <script src="/../scripts/dance/cms/editArtist.js"></script>
    <script src="/../scripts/dance/cms/editVenue.js"></script>
    <script src="/../scripts/dance/cms/deleteEvent.js"></script>
    <script src="/../scripts/dance/cms/deleteArtist.js"></script>
    <script src="/../scripts/dance/cms/deleteVenue.js"></script>