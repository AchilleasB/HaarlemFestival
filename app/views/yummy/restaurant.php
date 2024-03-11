<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($restaurant->getName()); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <style>
    .rounded-stylish-border {
        border: 3px solid #c15c5c;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
    }

    .heading {
        position: relative;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    .heading::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: currentColor;
        display: block;
    }

    .star-spacing {
        margin-left: 3%;
    }

    .star-icon {
        color: gold;
        margin-right: 4px;
    }

    .menu {
        background-color: #EAE2E2;
        padding: 20px;
    }

    .menu-item-container {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .menu-title {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 24px;
    }

    .dotted-line {
        flex-grow: 1;
        border-bottom: 2px dotted #000;
        margin: 0 10px;
        position: relative;
        top: 0.5em;
    }

    .menu-prices {
        white-space: nowrap;
        text-align: right;
        font-size: 24px;
        flex-shrink: 0;
    }

    .menu-description {
        margin-top: 5px;
        font-size: 16px;
    }

    .menu-price {
        margin-left: 15px;
    }
    </style>
</head>

<body>

    <?php
    include __DIR__ . '/../header.php';
    ?>

    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3 heading">
                    <h1 class="mb-0"><?php echo htmlspecialchars($restaurant->getName()); ?></h1>
                    <div class="star-spacing">
                        <?php for($i = 0; $i < $restaurant->getNumberOfStars(); $i++): ?>
                        <i class="fas fa-star fa-2x star-icon"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                <p><?php echo htmlspecialchars($restaurant->getDescription()); ?></p>
                <h4>Offered Cuisines</h4>
                <ul class="list-unstyled mb-3">
                    <li>
                        <p><b><?php echo htmlspecialchars($restaurant->getCuisines()); ?></b></p>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <img src="/../../images/yummy/banners/<?php echo htmlspecialchars($restaurant->getBanner())?>"
                    class="img-fluid rounded-stylish-border"
                    alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
            </div>
        </div>
        <div class="row mt-5 menu">
            <div>
                <h3 class="heading">Menu</h3>
                <ul class="list-unstyled">
                    <?php $foodItems = $restaurant->getMenu('food'); ?>
                    <?php if (!empty($foodItems)): ?>
                    <?php foreach ($foodItems as $menuItem): ?>
                    <li>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="menu-item-container">
                                        <span
                                            class="menu-title"><?php echo htmlspecialchars($menuItem->getName()); ?></span>
                                        <div class="dotted-line"></div>
                                        <span
                                            class="menu-prices">&#8364;<?php echo htmlspecialchars($menuItem->getPricePerPortion()); ?></span>
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
                    <?php $drinkItems = $restaurant->getMenu('drinks'); ?>
                    <?php if (!empty($drinkItems)): ?>
                    <h3 class="heading mt-5 d-flex align-items-center">Drinks</h3>
                    <?php foreach ($drinkItems as $menuItem): ?>
                    <li>
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="menu-item-container">
                                        <span
                                            class="menu-title"><?php echo htmlspecialchars($menuItem->getName()); ?></span>
                                        <div class="dotted-line"></div>
                                        <div class="menu-prices">
                                            <span class="me-3">
                                                <i class="fas fa-wine-glass"></i>
                                                &#8364;<?php echo htmlspecialchars($menuItem->getPricePerPortion()); ?>
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
        <div class="row mt-3">
            <div class="col-md-12">
                <h4>Gallery</h4>
                <div class="row">
                    <?php foreach ($restaurant->getImages() as $imagePath): ?>
                    <div class="col-md-4 mb-3">
                        <img src="/../../images/yummy/images/<?php echo $imagePath;?>"
                            class="img-fluid rounded-stylish-border"
                            alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>

</html>