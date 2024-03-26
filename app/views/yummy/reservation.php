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
    <style>
        .reservation-row {
            background-color: #f8f9fa;
        }

        label {
            font-weight: bold;
            color: #A60303;
        }

        .asterisk-symbol {
            color: black;
            margin-left: 5px;
        }

        .asterisk-message {
            font-size: 0.8rem;
            font-style: italic;
        }

        .reservation-fee-message {
            font-size: 1rem;
            font-weight: bold;
        }

        .card-icon {
            font-size: 1.5rem;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require_once(__DIR__ . '/../../config/imgconfig.php');
    ?>
    <div class="container mt-3 mb-3">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-6">
                <div class="reservation-row px-5 py-3 rounded">
                    <h1 class="text-center mb-4">Reservation form</h1>
                    <form action="/yummy/reservation" method="POST">
                        <div class="mb-3">
                            <label for="date" class="form-label">Name</label>
                            <p class="reservantion-name">
                                <?php echo htmlspecialchars($_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']); ?>
                            </p>
                            <p class="tiny-warning"><i class="fas fa-exclamation-circle"></i> For the safety of our
                                customers, reservation can be made only on the account holder's name.</p>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Phone number<span class="asterisk-symbol">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Session<span class="asterisk-symbol">*</span></label>
                            <select class="form-select" id="stars" name="stars" required>
                                <?php foreach ($restaurant->getSessions() as $session) : ?>
                                    <?php
                                    $sessionDate = $session['date'];
                                    list($start, $end) = explode(', ', $sessionDate);
                                    ?>
                                    <option value="<?php echo $session['id']; ?>"><?php echo $start; ?> till <?php echo $end; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Guests (max 20)<span class="asterisk-symbol">*</span></label>
                            <input type="number" min="1" max="20" class="form-control" id="guests" name="guests" value="1" required>
                        </div>
                        <div>
                            <label for="message" class="form-label">Remarks (max 1000 chars)</label>
                            <textarea class="form-control" id="not" name="message" rows="3"></textarea>
                        </div>
                        <div>
                            <p class="asterisk-message mb-2">* Fields are required</p>
                            <p class="reservation-fee-message my-4"><i class="fa-regular fa-credit-card card-icon"></i>&euro;10 fee for reservation will be added per person.</p>
                            <button type="submit" class="btn btn-custom">Add to card</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="reservation-restaurant p-5 rounded better-border text-center">
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
</body>