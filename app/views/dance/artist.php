<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $_SESSION['artist_name'] ?> at Haarlem Festival
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../styles/dance/artist.css">
    <link rel="stylesheet" href="/../styles/main.css">
</head>

<body>
    <?php

    include __DIR__ . '/../header.php';

    require __DIR__ . '/../../config/imgconfig.php';
    require __DIR__ . '/../../config/urlconfig.php';

    ?>
    <main>
        <div class="artist-container">
            <div class="image-container">
                <div id="artistPageImg"></div>
                <div class="primary-text ">
                    <span class="artist-name" id="artistName">
                    </span>
                    <h1 class="dance-text">AT DANCE!</h1>
                </div>
                <div class="image-buttons">
                    <button class="get-tickets-btn" id="tickets-btn">GET YOUR TICKETS NOW!</button>
                    <button class="see-appearances-btn" id="appearances-btn">SEE DANCE! APPEARANCES</button>
                </div>
            </div>
            <div class="artist-description">
                <div class="description-title" id="artistDescriptionTitle">
                </div>
                <div id="artistDescription"></div>
            </div>
            <div class="career-hightlight-section">
                <div id="careerHighlightTitle">
                </div>
                <div id="careerHighlightImgContainer">
                </div>
                <div id="careerHighlightText">
                </div>
            </div>
            <div class="latest-realeases-container">
                <h2>LATEST RELEASES</h2>
                <div class="spotify-songs" id="artistLatestReleases">
                </div>
            </div>
            <div class="artist-appearances-section">
                <div class="appearances-title" id="artistAppearancesTitle">
                </div>
                <div id="artistAppearances">
                </div>
            </div>
        </div>
    </main>

    <?php
    include __DIR__ . '/../footer.php';
    ?>

    <script>
        const imageBasePath = "<?php echo $imageBasePath; ?>";
        const urlBasePath = "<?php echo $urlBasePath; ?>";
        const artistName = "<?php echo $_SESSION['artist_name']; ?>";
    </script>
    <script type="module" src="/../scripts/dance/artist.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ticketsButton = document.getElementById('tickets-btn');
            const appearancesButton = document.getElementById('appearances-btn');
            const appearancesSection = document.getElementById('artistAppearances');

            ticketsButton.addEventListener('click', function () {
                window.location.href = urlBasePath + 'dance/tickets';
            });

            appearancesButton.addEventListener('click', function () {
                appearancesSection.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>