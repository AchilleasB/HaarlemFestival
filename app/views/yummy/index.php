<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/yummy/index.css">
</head>

<body>

    <?php
    include_once(__DIR__ . '/../header.php');
    require_once(__DIR__ . '/../../config/imgconfig.php');
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
                <?php foreach ($restaurantsRecommended as $restaurantRecommended) : ?>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="<?php echo $restaurantBannerPath . htmlspecialchars($restaurantRecommended->getBanner()) ?>" class="img-fluid card-img-top" alt="Image of <?php echo htmlspecialchars($restaurantRecommended->getName()); ?>">
                        </div>
                        <div class="col-md-8 d-flex flex-column justify-content-between pl-md-5">
                            <div>
                                <h3 class="text-decoration-underline">
                                    <?php echo htmlspecialchars($restaurantRecommended->getName()); ?></h3>
                                <p><?php echo htmlspecialchars($restaurantRecommended->getDescription()); ?></p>
                                <p>
                                    <?php for ($i = 0; $i < $restaurantRecommended->getNumberOfStars(); $i++) : ?>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    <?php endfor; ?>
                                </p>
                                <ul>
                                    <li>
                                        <?php
                                        $cuisineNames = array_map(function ($cuisine) {
                                            return $cuisine['name'];
                                        }, $restaurantRecommended->getCuisines());

                                        $cuisineList = implode(', ', $cuisineNames);
                                        echo htmlspecialchars($cuisineList);
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <a href="/yummy/restaurant?id=<?php echo htmlspecialchars($restaurantRecommended->getId()); ?>" class="btn custom-more-info-btn mt-auto">More Info</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2 class="mb-3 all">All Restaurants</h2>
            <div class="row">
                <?php foreach ($restaurants as $restaurant) : ?>
                    <div class="col-md-3 mb-3 d-flex">
                        <div class="card custom-shadow flex-fill">
                            <img src="<?php echo $restaurantBannerPath . htmlspecialchars($restaurant->getBanner()) ?>" class="img-fluid card-img-top" alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($restaurant->getName()); ?></h5>
                                <p class="card-text">
                                    <?php for ($i = 0; $i < $restaurant->getNumberOfStars(); $i++) : ?>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    <?php endfor; ?>
                                </p>
                                <ul class="mb-3" style="padding-left: 5%;">
                                    <li>
                                        <?php
                                        $cuisineNames = array_map(function ($cuisine) {
                                            return $cuisine['name'];
                                        }, $restaurant->getCuisines());

                                        $cuisineList = implode(', ', $cuisineNames);
                                        echo htmlspecialchars($cuisineList);
                                        ?>
                                    </li>
                                </ul>
                                <a href="/yummy/restaurant?id=<?php echo htmlspecialchars($restaurant->getId()); ?>" class="btn custom-more-info-btn mt-auto">More Info</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <?php
    include_once(__DIR__ . '/../footer.php');
    ?>
</body>

</html>