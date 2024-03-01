<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/dance.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require __DIR__ . '/../../config/imgconfig.php';

    ?>
    <main>
        <div class="dance-container">
            <div class="image-container">
                <img src="/../images/dance_event.png" alt="Dance Event" class="dance-image">
                <div class="image-primary-text position-absolute top-0 start-0">
                    <h1 class="text fw-bold">HAARLEM</h1>
                    <h1>FESTIVAL</h1>
                    <h1 class="text fw-bold bg-black d-inline-block w-auto">DANCE!</h1>
                </div>
                <div class="image-secondary-text position-absolute top-0 end-0 ">
                    <h1 class="">27.07 / 28.07 / 29.07</h1>
                    <button id="getTicketsBtn" class="fw-bold bg-danger d-inline-block">GET YOUR TICKETS NOW!</button>
                </div>
            </div>
            <div class="dance-events-section">
                <h2 class="section-title">EVENTS</h2>
                <div class="date-buttons"></div>
                <div class="dance-events-container"></div>
            </div>
            <div class="buy-tickets-container">
                <button id="getTicketsBtn" class="buy-tickets-btn">GET YOUR TICKETS NOW!</button>
            </div>
            <div class="venues-section">
                <h2 class="section-title">VENUES</h2>
                <div class="venues-container"></div>
            </div>
            <div class="buy-tickets-container">
                <button id="getTicketsBtn" class="buy-tickets-btn">GET YOUR TICKETS NOW!</button>
            </div>
            <div class="schedule-section">
                <h2 class="section-title">SCHEDULE</h2>
                <div class="schedule-container"></div>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>

    <script type="module" src="../scripts/dance/index.js"></script>
    <script> var imageBasePath = "<?php echo $imageBasePath; ?>";</script>
    <script>
        document.querySelectorAll('.buy-tickets-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                window.location.href = '/dance/tickets';
            });
        });
    </script>