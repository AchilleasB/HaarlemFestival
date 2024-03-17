!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Content Management</title>
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
    ?>

    <main>
        <div class="red-line"></div>
        <div class="dance-cms-container">
            <h1 class="header mb-5">History Content Management</h1>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Tours</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Locations</label>

            </div>
            <div class="content-container">
                <div class="add-event-container mt-5 mb-5" id="">
                </div>
                <div class="add-event-container mt-5 mb-5" id="">
                </div>
                <div class="add-event-container mt-5 mb-5" id="">
                </div>
                <div class=" add-event-form container-lg" id="">
                </div>
                <div class=" add-artist-form container-lg" id="">
                </div>
                <div class="add-venue-form container-lg" id="">
                </div>
                <div class="items-list container-lg" id="">
                </div>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../backToTop.php';
    include __DIR__ . '/../footer.php';
    ?>

    <script src="/../scripts/history/cms/index.js"></script>
    <script src="/../scripts/history/cms/addLocation.js"></script>
    <script src="/../scripts/history/cms/addTour.js"></script>
    <script src="/../scripts/history/cms/addInformation.js"></script>
    <script src="/../scripts/history/cms/editLocation.js"></script>
    <script src="/../scripts/history/cms/editTour.js"></script>
    <script src="/../scripts/history/cms/editInformation.js"></script>
    <script src="/../scripts/history/cms/deleteLocation.js"></script>
    <script src="/../scripts/history/cms/deleteTour.js"></script>
    <script src="/../scripts/history/cms/deleteInformation.js"></script>
    <script> var imageBasePath = "<?php echo $imageBasePath; ?>";</script>