<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include_once(__DIR__ . '/../header.php');
    require_once(__DIR__ . '/../../config/imgconfig.php');
    ?>

    <main>
        <div class="red-line"></div>
        <div class="yummy-cms-container">
            <h1 class="header mb-5">Yummy Content Management</h1>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="restaurant-radio-btn" autocomplete="off"
                    checked>
                <label class="btn btn-outline-primary" for="restaurant-radio-btn">Restaurants</label>

                <input type="radio" class="btn-check" name="btnradio" id="session-radio-btn" autocomplete="off">
                <label class="btn btn-outline-primary" for="session-radio-btn">Sessions</label>

                <input type="radio" class="btn-check" name="btnradio" id="cuisine-radio-btn" autocomplete="off">
                <label class="btn btn-outline-primary" for="cuisine-radio-btn">Cuisines</label>

                <input type="radio" class="btn-check" name="btnradio" id="reservation-radio-btn" autocomplete="off">
                <label class="btn btn-outline-primary" for="reservation-radio-btn">Reservations</label>
            </div>

            <div class="content-container">
                <div id="dynamic-add-button-container"
                    class="d-flex justify-content-center align-items-center mt-5 mb-5" style="height: 10vh;">
                </div>
            </div>
            <div class="add-item-form container-lg" id="add-item-form-container">
            </div>
            <div class="items-list container-lg" id="items-list">
            </div>
        </div>
        </div>
    </main>

    <?php
    include_once(__DIR__ . '/../backToTop.php');
    include_once(__DIR__ . '/../footer.php');
    ?>

    <script>
    const restaurantBannerPath = <?php echo json_encode($restaurantBannerPath); ?>;
    const restaurantImagesPath = <?php echo json_encode($restaurantImagesPath); ?>;
    </script>

    <script src="/../scripts/yummy/cms/index.js"></script>

    <script src="/../scripts/yummy/cms/cuisine/deleteCuisine.js"></script>
    <script src="/../scripts/yummy/cms/cuisine/editCuisine.js"></script>
    <script src="/../scripts/yummy/cms/cuisine/addCuisine.js"></script>

    <script src="/../scripts/yummy/cms/session/deleteSession.js"></script>
    <script src="/../scripts/yummy/cms/session/editSession.js"></script>
    <script src="/../scripts/yummy/cms/session/addSession.js"></script>

    <script src="/../scripts/yummy/cms/restaurant/deleteRestaurant.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/editRestaurant.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/addRestaurant.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/gallery/index.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/gallery/deleteImage.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/gallery/addImage.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/menu/index.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/menu/addMenuItem.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/menu/deleteMenuItem.js"></script>
    <script src="/../scripts/yummy/cms/restaurant/menu/editMenuItem.js"></script>

    <script src="/../scripts/yummy/cms/reservation/activationReservation.js"></script>
    <script src="/../scripts/yummy/cms/reservation/editReservation.js"></script>
