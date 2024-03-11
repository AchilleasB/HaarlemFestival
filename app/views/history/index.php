<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Stroll Through History</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../historyStyle.css">
    <link rel="stylesheet" href="../styles.css">
    
   
</head>

<body class="bg-light">
    <?php
    include __DIR__ . '/../header.php';
    ?>

    <header class="header-body">
        <div class="p-5 text-center bg-image header-image"
            style="background-image: url('../../images/history-image.png');">
            <div class="d-flex justify-content-center align-items-center shadow h-100">
                <div>
                    <h1 class="text-white fw-bold display-4">A STROLL TROUGH HISTORY</h1>
                    <h4 class="bg-white d-inline-block p-1">Visiting Haarlem's Historical Landmarks</h4>
                    <div><button class = "btn btn-danger" id="getTicketsBtn" >GET YOUR TICKETS</button></div>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container w-75 py-5">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="inline-text text-bold">Experience History</h3>
                </div>
                <div class="col-md-8">
                    <p class="small text-justify"> In this event, we take a walking tour around some of the most
                        historical musems in Haarlem. Participants get to see and learn about the historical sites and
                        how they come to be.
                        <br><br>
                        The tour starts at the Church of St Bavo and ends at Hof van Bakenes. There will be a break in
                        between, at the Jopenkerk where the tourists can enjoy some beer!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="gray-bg">
        <div class="container w-75 py-5 bold-headers">
            <div class="row text-center pb-3">
                <h3>A STROLL THROUGH HISTORY</h3>
                <h4>26th July - 29th July</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="inline-text text-red">General Information</h4>
                </div>
                <div class="col-md-8">
                    <ul class="small text-muted">
                        <li>Due to the nature of the walk, participants must be a minimum of 12 years old and no
                            strollers are allowed.</li>
                        <li>A giant flag will mark the starting location.</li>
                        <li>Groups will consist of 12 participants and 1 tour guide.</li>
                        <li>Every participant can enjoy one drink with the ticket!</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-center py-3 text-bold">FEATURED <span class="text-red">LOCATIONS</span></h2>
    </section>


    <section class="d-flex justify-content-center py-5">
    <div class="container" style="max-width: 800px;">
        <?php foreach ($locations as $index => $location) { ?>
            <div class="row gray-bg p-4 mb-4">
                <div class="col-8">
                    <h3>
                        <?php echo ($index + 1) . '. ' . $location['location_name']; ?>
                    </h3>
                    <p class="text-muted">
                        <?php echo $location['description']; ?>
                    </p>
                    <a href="<?php echo $location['links']; ?>" class="btn btn-outline-secondary" target="_blank">Learn more</a>
                </div>
                <div class="col-4">
                    <?php 
                    $imageSrc = !empty($location['image']) ? "../../images/".$location['image'] : "../../images/no-image.jpg"; 
                    ?>
                    <img src="<?php echo $imageSrc; ?>" class="img-fluid" style="width: 300px; height: 170px;" alt="Location Image">
                </div>
            </div>
        <?php } ?>
    </div>
</section>

    <section>
        <h2 class="text-center py-3 text-bold">TOUR <span class="text-red">SCHEDULE</span></h2>
    </section>

    <section class="text-center">
    <div class="container">
        <?php if (!empty($organizedTours)) : ?>
            <div class="row justify-content-center">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <?php foreach ($organizedTours as $tour) : ?>
                                    <th scope="col"><?php echo $tour['formatted_date']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class>
                            <?php $times = ['10:00', '13:00', '16:00']; ?>
                            <?php foreach ($times as $time) : ?>
                                <tr>
                                    <td><?php echo $time; ?></td>
                                    <?php foreach ($organizedTours as $tour) : ?>
                                        <td><?php echo $tour[$time] ?? ''; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <p>No history tours found.</p>
        <?php endif; ?>
    </div>
</section>

    


    <section>
        <h2 class="text-center py-3 text-bold">LOCATIONS <span class="text-red">OVERVIEW</span></h2>
    </section>

    <section>
        <div class='row w-75 small'>
            <div class='col-4 d-flex justify-content-end'>
                <ol type="A">
                    <?php foreach ($locations as $index => $location) { ?>
                        <li>
                            <?php echo $location['location_name']; ?>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class='col-8'>
                <img src="/../images/map-history.png" class="img-fluid">
            </div>
        </div>
        <div class='p-4'>
            <p class='text-center'>The tour begins at the <span class="text-success">Green</span> point A (Church of St.
                Bavo) and ends at the <span class="text-danger">Red</span> point I. The break location (Jopenkerk) is
                marked in Blue at point E.</p>
        </div>
    </section>

    <section id="ticketSection">
        <h2 class="text-center py-3 text-bold">GET YOUR <span class="text-red">TICKETS</span></h2>
    </section>

    <section class='d-flex justify-content-center p-5'>
    <div class="row gray-bg p-5">
        <div class="col">
            <div class="row dropdown">
                <div class="col p-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Language
                    </button>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <?php foreach ($languages as $language): ?>
                            <a class="dropdown-item" href="#"><?php echo $language; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col p-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Date
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dateDropdown">
                        <?php foreach ($dates as $date): ?>
                            <a class="dropdown-item" href="#"><?php echo $date; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col p-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="timeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Time
                    </button>
                    <div class="dropdown-menu" aria-labelledby="timeDropdown">
                        <?php foreach ($times as $time): ?>
                            <a class="dropdown-item" href="#"><?php echo $time; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col p-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="ticketDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ticket
                    </button>
                    <div class="dropdown-menu" aria-labelledby="ticketDropdown">
                       <!-- Dummy values -->
                       <a class="dropdown-item" href="#">Ticket 1</a>
                        <a class="dropdown-item" href="#">Ticket 2</a>
                    </div>
                </div>
            </div>
            <div class='row mt-5'>
                <div class='col text-center'>
                    <button type="button" class="btn btn-warning btn-block">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
    include __DIR__ . '/../footer.php';
    ?>

<script>
       
            $('#getTicketsBtn').click(function() {
                $('html, body').animate({
                    scrollTop: $('#ticketSection').offset().top
                }, 1000);
            });
        });
    </script>
</body>

</html>