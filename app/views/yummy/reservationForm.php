<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/yummy/restaurant.css">
    <link rel="stylesheet" href="../styles/yummy/index.css">
    <link rel="stylesheet" href="../styles/yummy/reservation.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require_once(__DIR__ . '/../../config/imgconfig.php');
    ?>

    <div class="container mt-3 mb-3">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-1">
                <div class="back-button position-fixed top-1 start-0 mt-3 ms-3">
                    <a href="/yummy/restaurant?id=<?php echo htmlspecialchars($restaurant->getId()); ?>" class="mt-auto"><i class="fas fa-arrow-left arrow"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="reservation-row px-5 py-3 rounded">
                    <h1 class="text-center mb-4">Reservation form</h1>
                    <form id="reservation-form" action="/yummy/reservation" method="POST">
                        <?php if (!is_null($user)) : ?>
                            <!-- Render user name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <p class="reservantion-name">
                                    <?php echo htmlspecialchars($user->getLastname() . ' ' . $user->getFirstname()); ?>
                                </p>
                                <p class="tiny-warning"><i class="fas fa-exclamation-circle"></i> For the safety of our
                                    customers, reservation can be made only on the account holder's name.</p>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone number<span class="asterisk-symbol">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                            <small id="phone-help-message" class="form-text">Please enter a valid phone number.</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <label for="session" class="form-label">Session<span class="asterisk-symbol">*</span></label>
                                <div class="flex-grow-1"></div>
                                <p id="availability" class="mb-0 small-message"></p>
                            </div>
                            <select class="form-select" id="session" name="session_id" required>
                                <?php foreach ($restaurant->getSessions() as $session) : ?>
                                    <?php
                                    $sessionDate = $session['date'];
                                    list($start, $end) = explode(', ', $sessionDate);
                                    ?>
                                    <option value="<?php echo $session['id']; ?>"><?php echo $start; ?> till
                                        <?php echo $end; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Guests (max 20)<span class="asterisk-symbol">*</span></label>
                            <input type="number" min="1" max="20" class="form-control" id="guests" name="guests" value="1" required>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <label for="remark" class="form-label">Remarks (max 1000 chars)</label>
                                <div class="flex-grow-1"></div>
                                <p id="characters-left" class="mb-0 small-message">1000 characters left</p>
                            </div>
                            <textarea class="form-control" id="remark" name="remark" rows="2"></textarea>
                        </div>
                        <div>
                            <p class="small-message mb-2">* Fields are required</p>
                            <p class="reservation-fee-message my-4"><i class="fa-regular fa-credit-card card-icon"></i>&euro;10 fee for reservation will be
                                added per person.</p>
                            <button id="add-to-cart-button" type="submit" class="btn btn-custom">Add to cart</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div id="selectedRestaur" class="reservation-restaurant p-5 rounded better-border text-center" data-restaurant-id="<?php echo $restaurant->getId(); ?>">
                    <div class="mb-4">
                        <h4 class="mb-0"><?php echo htmlspecialchars($restaurant->getName()); ?></h4>
                        <div class="star-spacing">
                            <?php for ($i = 0; $i < $restaurant->getNumberOfStars(); $i++) : ?>
                                <i class="fas fa-star fa-2x star-icon"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-4">
                        <img src="<?php echo $restaurantBannerPath . htmlspecialchars($restaurant->getBanner()) ?>" class="img-fluid rounded-stylish-border" alt="Image of <?php echo htmlspecialchars($restaurant->getName()) ?>">
                    </div>
                    <div class="mb-4 d-flex">
                        <i class="fas fa-map-marker-alt text-danger me-2" style="font-size: 1.5rem;"></i>
                        <p class="mb-0"><?php echo htmlspecialchars($restaurant->getLocation()); ?></p>
                    </div>
                </div>
            </div>

        </div>

        <script src="/../scripts/yummy/index.js"></script>
</body>