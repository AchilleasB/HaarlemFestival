<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <style>
    
    </style>
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require_once(__DIR__ . '/../../config/imgconfig.php');
    ?>
    <main>
        <div class="container">
            <h1 class="mt-4 mb-4">Your personal program!</h1>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center align-middle">Event</th>
                        <th class="text-center align-middle">Name</th>
                        <th class="text-center align-middle">Date</th>
                        <th class="text-center align-middle">Location</th>
                        <th class="text-center align-middle">Price Paid</th>
                        <th class="text-center align-middle">People</th>
                        <th class="text-center align-middle">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Yummy!</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo $restaurantBannerPath . 'restaurant-ml-banner.png'?>"
                                    alt="Concert Image" class="img-thumbnail img-fixed mr-3">
                                <div>
                                    <p>Restaurant ML</p>
                                    <p><a href="#" class="btn btn-primary btn-sm">Check event details</a></p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center align-middle">2024-06-14</td>
                        <td class="text-center align-middle">Spaarne 96, 2011 CL Haarlem, Nederland</td>
                        <td class="text-center align-middle">&#8364;50.00</td>
                        <td class="text-center align-middle">2</td>
                        <td class="align-middle">Gluten free</td>
                    </tr>
                    <tr>
                        <td>Dance</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo $imageBasePath . 'venues/club_stalker.png'?>" alt="Concert Image"
                                    class="img-thumbnail img-fixed mr-3">
                                <div>
                                    <p>Garu de Nord</p>
                                    <p><a href="#" class="btn btn-primary btn-sm">Check event details</a></p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center align-middle">2024-06-14</td>
                        <td class="text-center align-middle">Spaarne 96, 2011 CL Haarlem, Nederland</td>
                        <td class="text-center align-middle">&#8364;150.00</td>
                        <td class="text-center align-middle">1</td>
                        <td class="align-middle">SINGLE-CONCER</td>
                    </tr>
                    <tr>
                        <td>Dance</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?php echo $imageBasePath . 'venues/xo_club.png'?>" alt="Concert Image"
                                    class="img-thumbnail img-fixed mr-3">
                                <div>
                                    <p>Some Dance event name</p>
                                    <p><a href="#" class="btn btn-primary btn-sm">Check event details</a></p>
                                </div>
                            </div>
                        </td>
                        <td class="text-center align-middle">2024-06-14</td>
                        <td class="text-center align-middle">Spaarne 96, 2011 CL Haarlem, Nederland</td>
                        <td class="text-center align-middle">&#8364;59.99</td>
                        <td class="text-center align-middle">1</td>
                        <td class="align-middle">SINGLE-CONCER</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>