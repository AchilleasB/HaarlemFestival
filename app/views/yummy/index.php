<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <style>
    .banner-image {
        height: 694px;
        background: url('/../images/yummy/yummy.png') center center no-repeat;
        background-size: cover;
    }

    .info-box {
        background-color: #EED899;
        padding: 20px;
    }

    body {
        background-color: #EAE2E2;
    }

    .custom-shadow {
        box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.5);
    }

    .custom-more-info-btn {
        width: 60%;
        border-radius: 0;
        background-color: #A60303;
        border-color: #A60303;
        color: white;
        font-size: 1.50rem;
    }

    .card-img-top {
        height: 300px;
        width: 100%;
        object-fit: cover;
    }

    .all {
        position: relative;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
    }

    .all::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: currentColor;
        display: block;
    }

    .recommendations {
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <?php
    include __DIR__ . '/../header.php';
    ?>
    <div class="banner-image d-flex justify-content-center align-items-center">
        <h1 class="text-white display-1">YUMMY!</h1>
    </div>

    <main class="mx-lg-5 px-lg-5">
        <div class="info-box text-center">
            <h1>HAARLEM FESTIVAL</h1>
            <p>The Netherlands' lovely city, Haarlem, is hosting a festival which will be spread in multiple parts like
                history, jazz, dance, and food. During this Festival, Haarlem offers both regional and foreign cuisine.
                You
                can taste a variety of dishes from a lot of the participating restaurants. On this website, you can find
                more details about the participating restaurants and their menus. A reservation will be needed in order
                to
                participate.</p>
        </div>
        <section class="bg-white pt-4 px-5 pb-5">
            <div class="container my-5">
                <h2 class="mb-3 recommendations">Our most recommended restaurants</h2>
                <?php foreach ($restaurantsRecommended as $restaurantRecommended): ?>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <img src="/../../public/images/yummy/banners/<?php echo htmlspecialchars($restaurantRecommended->getBanner()) ?>"
                            class="img-fluid card-img-top"
                            alt="Image of <?php echo htmlspecialchars($restaurantRecommended->getName()); ?>">
                    </div>
                    <div class="col-md-8 d-flex flex-column justify-content-between pl-md-5">
                        <div>
                            <h3 class="text-decoration-underline">
                                <?php echo htmlspecialchars($restaurantRecommended->getName()); ?></h3>
                            <p><?php echo htmlspecialchars($restaurantRecommended->getDescription()); ?></p>
                            <p>
                                <?php for($i = 0; $i < $restaurantRecommended->getNumberOfStars(); $i++): ?>
                                <i class="fas fa-star" style="color: gold;"></i>
                                <?php endfor; ?>
                            </p>
                            <ul>
                                <li>
                                    <p><?php echo htmlspecialchars($restaurantRecommended->getCuisines()); ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <a href="restaurant-details.php?id=<?php echo htmlspecialchars($restaurantRecommended->getId()); ?>"
                                class="btn custom-more-info-btn mt-auto">More Info</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <h2 class="mb-3 all">All Restaurants</h2>
            <div class="row">
                <?php foreach ($restaurants as $restaurant): ?>
                <div class="col-md-3 mb-3 d-flex">
                    <div class="card custom-shadow flex-fill">
                        <img src="/../../public/images/yummy/banners/<?php echo htmlspecialchars($restaurant->getBanner())?>"
                            class="img-fluid card-img-top"
                            alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($restaurant->getName()); ?></h5>
                            <p class="card-text">
                                <?php for($i = 0; $i < $restaurant->getNumberOfStars(); $i++): ?>
                                <i class="fas fa-star" style="color: gold;"></i>
                                <?php endfor; ?>
                            </p>
                            <ul class="mb-3" style="padding-left: 5%;">
                                <li>
                                    <p class="card-text"><?php echo htmlspecialchars($restaurant->getCuisines()); ?>
                                    </p>
                                </li>
                            </ul>
                            <a href="/yummy/restaurant"
                                class="btn custom-more-info-btn mt-auto">More Info</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>

</html>