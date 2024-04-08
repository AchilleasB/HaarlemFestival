<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/festivalStyle.css">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>

    <header class="header-body">
        <div class="p-5 text-center bg-image header-image"
            style="background-image: url('../../images/festival-image.png');">
            <div class="d-flex justify-content-center align-items-center shadow h-100">
                <div class="text-uppercase">
                    <h1 class="text-white fw-bold display-4 text-shadow"><?php echo $event->getTitle(); ?></h1>
                    <h4 class="d-inline-block shadow-lg"><?php echo $event->getSubTitle(); ?></h4>
                </div>
            </div>
        </div>
    </header>

    <section class="wine-bg">
        <div class="container text-white w-75 py-5">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="inline-text">The <span class="gold-text">Summer Festival</span></h3>
                    <h5>Fun events for everyone!</h5>
                </div>
                <div class="col-md-8">
                    <p class="small text-justify"><?php echo $event->getDescription(); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php foreach ($events as $event): ?>
    <section class="d-flex justify-content-center">
        <div class="col-6 my-4 border-bottom border-3 pb-4">
            <div class="row text-uppercase">
                <h2><i class="bi bi-bookmark-star-fill"></i><?php echo $event->getTitle(); ?></h2>
            </div>
            <div class="row">
                <div class="col">
                    <?php 
                    $imageSrc = !empty($event->getImage()) ? "/../images/".$event->getImage() : "../../images/no-image.jpg"; 
                    ?>
                    <img src="<?php echo $imageSrc; ?>" class="img-fluid box-shadow"
                        style="width: 300px; height: 170px;" alt="Event Image">
                </div>
                <div class="col">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab"
                                href="#Description_<?php echo $event->getId(); ?>">DESCRIPTION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"
                                href="#Location_<?php echo $event->getId(); ?>">LOCATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab"
                                href="#Schedule_<?php echo $event->getId(); ?>">SCHEDULE</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="Description_<?php echo $event->getId(); ?>" class="tab-pane fade show active">
                            <h4 class="pt-3"><?php echo $event->getSubTitle(); ?></h4>
                            <p><?php echo $event->getDescription(); ?></p>
                        </div>
                        <div id="Location_<?php echo $event->getId(); ?>" class="tab-pane fade">
                            <h5 class="pt-3"><?php echo $event->getLocations(); ?></h5>
                        </div>
                        <div id="Schedule_<?php echo $event->getId(); ?>" class="tab-pane fade">
                            <h5 class="pt-3"><?php echo $event->getSchedule(); ?></h5>
                        </div>
                    </div>
                    <a href="<?php echo $event->getButton(); ?>" class="info-button">DISCOVER MORE</a>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach; ?>

    <?php include __DIR__ . '/../footer.php'; ?>

</body>

</html>