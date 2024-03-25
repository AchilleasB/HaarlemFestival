<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php $_SESSION['artist_name']?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/dance/artist.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    var_dump($_SESSION['artist_id']);
    var_dump($_SESSION['artist_name']);
    var_dump($_SESSION['artist_genre']);
    var_dump($_SESSION['artist_description']);
    var_dump($_SESSION['artist_image']);
    include __DIR__ . '/../header.php';

    require __DIR__ . '/../../config/imgconfig.php';

    ?>
    <main>
        <div class="red-line"></div>
        <div class="artist-container">
            <div class="image-container">
                <img src="<?php echo $imageBasePath . $_SESSION['artist_image']?>" alt="DJ image" class="artist-image">
                <div class="image-primary-text position-absolute top-10 start-0">
                    <h1 class="text fw-bold">
                    </h1>
                    <h1 class="text fw-bold bg-black d-inline-block w-auto">AT DANCE!</h1>
                </div>
                <div class="image-secondary-text position-absolute top-10 end-0 ">
                    <h1 class=""><?php $_SESSION['artist_name']?></h1>
                    <button class="buy-tickets-btn fw-bold bg-danger d-inline-block">GET YOUR TICKETS NOW!</button>
                </div>
            </div>
            <div class="artist-description">
                <h1>WHO IS <strong>
                    </strong></h1>
                <p>
                </p>
            </div>

            <div class="career-hightlight-section">
                <h2 class="career-hightlight-title">HIGHTLIGHT TITLE</h2>
                <div class="career-hightlight-image"></div>
                <div class="career-hightlight-text"></div>
            </div>
    </main>

    <?php
    include __DIR__ . '/../footer.php';
    ?>

    <!-- <script type="module" src="../scripts/dance/artist.js"></script> -->