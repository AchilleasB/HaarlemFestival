    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($restaurant->getName()); ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../styles/main.css">
        <link rel="stylesheet" href="../styles/yummy/restaurant.css">
    </head>

    <body>

        <?php
        include_once(__DIR__ . '/../header.php');
        require_once(__DIR__ . '/../../config/imgconfig.php');
        $_SESSION['restaurant_id'] = $restaurant->getId();
        ?>

        <div class="container pt-5">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-3 heading">
                        <h1 class="mb-0"><?php echo htmlspecialchars($restaurant->getName()); ?></h1>
                        <div class="star-spacing">
                            <?php for ($i = 0; $i < $restaurant->getNumberOfStars(); $i++) : ?>
                                <i class="fas fa-star fa-2x star-icon"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p><?php echo htmlspecialchars($restaurant->getDescription()); ?></p>
                    <h4>Offered Cuisines</h4>
                    <ul>
                        <?php foreach ($restaurant->getCuisines() as $cuisine) : ?>
                            <li>
                                <?php echo htmlspecialchars($cuisine); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <img src="<?php echo $restaurantBannerPath . htmlspecialchars($restaurant->getBanner()) ?>" class="img-fluid rounded-stylish-border" alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                </div>
            </div>

            <?php
            $foodItems = $restaurant->getMenu('food');
            $drinkItems = $restaurant->getMenu('drinks');
            ?>
            <?php if (!empty($foodItems) || !empty($drinkItems)) : ?>
                <!-- Render menus -->
                <div class="row mt-5 mb-3 menu">
                    <div>
                        <h3 class="heading">Menu</h3>
                        <ul class="list-unstyled">
                            <?php if (!empty($foodItems)) : ?>
                                <?php foreach ($foodItems as $menuItem) : ?>
                                    <li>
                                        <div class="container mt-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="menu-item-container">
                                                        <span class="menu-title"><?php echo htmlspecialchars($menuItem->getName()); ?></span>
                                                        <div class="dotted-line"></div>
                                                        <span class="menu-prices">
                                                            <?php
                                                            $pricePerPortion = $menuItem->getPricePerPortion();
                                                            echo ($pricePerPortion !== null) ? '&#8364;' . htmlspecialchars($pricePerPortion) : 'Price not available';
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="menu-description">
                                                        <?php echo htmlspecialchars($menuItem->getDescription()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!empty($drinkItems)) : ?>
                                <h3 class="heading mt-5 d-flex align-items-center">Drinks</h3>
                                <?php foreach ($drinkItems as $menuItem) : ?>
                                    <li>
                                        <div class="container mt-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="menu-item-container">
                                                        <span class="menu-title"><?php echo htmlspecialchars($menuItem->getName()); ?></span>
                                                        <div class="dotted-line"></div>
                                                        <div class="menu-prices">
                                                            <span class="me-3">
                                                                <?php
                                                                $pricePerPortion = $menuItem->getPricePerPortion();
                                                                echo ($pricePerPortion !== null) ? '<i class="fas fa-wine-glass"></i> &#8364;' . htmlspecialchars($pricePerPortion) : '';
                                                                ?>
                                                            </span>
                                                            <span>
                                                                <i class="fas fa-wine-bottle"></i>
                                                                &#8364;<?php echo htmlspecialchars($menuItem->getPriceBottle()); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="menu-description">
                                                        <?php echo htmlspecialchars($menuItem->getDescription()); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($restaurant->getImages())) : ?>
                <!-- Render gallery -->
                <div class="row">
                    <div class="col-md-12">
                        <h4>Gallery</h4>
                        <div class="row">
                            <?php foreach ($restaurant->getImages() as $imagePath) : ?>
                                <div class="col-md-4 mb-3">
                                    <img src="<?php echo $restaurantImagesPath . $imagePath; ?>" class="img-fluid rounded-stylish-border" alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mb-5">
                <div class="col-md-8 schedule">
                    <h3>Schedule</h3>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($restaurant->getSessions() as $session) : ?>
                                    <?php
                                    $sessionDate = $session['date'];
                                    list($start, $end) = explode(', ', $sessionDate);
                                    ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $start; ?></td>
                                        <td><?php echo $end; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3>Location</h3>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-danger me-2" style="font-size: 1.5rem;"></i>
                        <p class="mb-0"><?php echo htmlspecialchars($restaurant->getLocation()); ?></p>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <button class="btn btn-custom" onclick="window.location.href='/yummy/reservationForm'">Reserve</button>
                </div>
            </div>
        </div>
        <?php
        include_once(__DIR__ . '/../footer.php');
        ?>
    </body>

    </html>