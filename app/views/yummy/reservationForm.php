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
        .back-button {
            position: relative;
            width: 50px;
            /* Adjust size as needed */
            height: 50px;
            /* Adjust size as needed */
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Shadow effect */
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .back-button .arrow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

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

        .small-message {
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
            <div class="col-md-1">
                <div class="back-button position-fixed top-1 start-0 mt-3 ms-3">
                    <a href="/yummy/restaurant?id=<?php echo htmlspecialchars($restaurant->getId()); ?>" class="mt-auto"><i class="fas fa-arrow-left arrow"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="reservation-row px-5 py-3 rounded">
                    <h1 class="text-center mb-4">Reservation form</h1>
                    <form id="reservation-form" action="/yummy/reservation" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <p class="reservantion-name">
                                <?php echo htmlspecialchars($_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']); ?>
                            </p>
                            <p class="tiny-warning"><i class="fas fa-exclamation-circle"></i> For the safety of our
                                customers, reservation can be made only on the account holder's name.</p>
                        </div>
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

        <script>
            const reservationAPIendpoint = "http://localhost/api/reservation";
            const phoneInput = document.getElementById('phone');
            const maxGuestsPerReservation = 20;
            const textarea = document.getElementById('remark');
            const counterDisplay = document.getElementById('characters-left');
            const maxChars = 1000;

            async function updateAvailability() {
                var restaurantId = document.querySelector('.reservation-restaurant').dataset.restaurantId;
                var sessionId = document.getElementById('session').value;

                const response = await fetch(`${reservationAPIendpoint}?restaurantId=${restaurantId}&sessionId=${sessionId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();
                var availabilityParagraph = document.getElementById('availability');
                availabilityParagraph.textContent = "Availability: " + data;
                setMaxGuests(data);
            }

            function checkPhoneValidity() {
                // Get the value of the input
                const phoneValue = phoneInput.value.trim();

                // Define a regular expression pattern to match a simple phone number format
                // Min 7 digits, optional + at the beginning
                const phonePattern = /^\+?\d{7,}$/;

                // Test the input value against the pattern
                const isValidPhone = phonePattern.test(phoneValue);

                // Get the small element to display validation message
                const phoneHelp = document.getElementById('phone-help-message');

                const button = document.getElementById('add-to-cart-button');

                // Update the validation message based on the result
                if (isValidPhone) {
                    button.removeAttribute('disabled');
                    phoneHelp.textContent = 'Valid phone number.';
                    phoneHelp.classList.remove('text-danger');
                    phoneHelp.classList.add('text-success');
                } else {
                    button.setAttribute('disabled', true);
                    phoneHelp.textContent = 'Please enter a valid phone number.';
                    phoneHelp.classList.remove('text-success');
                    phoneHelp.classList.add('text-danger');
                }
            }

            function setMaxGuests(availability) {
                const guestsInput = document.getElementById('guests');
                const currentGuestsInputValue = guestsInput.value;

                if (availability > maxGuestsPerReservation) {
                    guestsInput.setAttribute('max', maxGuestsPerReservation);
                    return;
                }
                if (availability < currentGuestsInputValue) {
                    guestsInput.value = availability;
                }
                guestsInput.setAttribute('max', availability);
            }

            function setCharsLeft() {
                const charsTyped = textarea.value.length;
                const charsLeft = maxChars - charsTyped;

                if (charsLeft >= 0) {
                    counterDisplay.textContent = `${charsLeft} characters left`;
                } else {
                    counterDisplay.textContent = `0 characters left`;
                    textarea.value = textarea.value.slice(0, maxChars); // Truncate excess characters
                }

                if (charsLeft < maxChars) {
                    textarea.disabled = false;
                }
            }

            function redirectToRestaurant(restaurantId) {
                var form = document.getElementById('reservation-form');
                if (form.checkValidity()) {
                    window.location.href = '/yummy/restaurant?id=' + restaurantId;
                } else {
                    alert("Please fill in all required fields.");
                }
            }

            document.getElementById('session').addEventListener('change', updateAvailability);
            window.addEventListener('load', updateAvailability);
            phoneInput.addEventListener('input', checkPhoneValidity);
            textarea.addEventListener('input', setCharsLeft);
        </script>
</body>