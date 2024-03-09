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
                    <div><button>GET YOUR TICKETS</button></div>
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
                        <button class="info-button">Learn more ></button>
                    </div>
                    <div class="col-4">
                        <img src="../../images/history<? if (!empty($location['images'])) {
                            echo $location['images'];
                        } else
                            echo "no-image.jpg"; ?>" class="img-fluid" style="width: 100%; height: 80%;">
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <section>
        <h2 class="text-center py-3 text-bold">TOUR <span class="text-red">SCHEDULE</span></h2>
    </section>

    <!--
 <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
         
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($historyTours as $tour) {
                ?>
                <tr>
                    <td><?php echo date('d F Y', strtotime($tour['date'])); ?></td>
                    <td><?php echo date('H:i', strtotime($tour['time'])); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
        -->
    <section>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">THURSDAY</th>
                    <th scope="col">FRIDAY</th>
                    <th scope="col">SATURDAY</th>
                    <th scope="col">SUNDAY</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">10:00</th>
                    <td>lalalala</td>
                    <td>lalalala</td>
                    <td>lalalala</td>
                    <td>lalalala</td>
                </tr>
                <tr>
                    <th scope="row">13:00</th>
                    <td>lalalala</td>
                    <td>Thornton</td>
                    <td>lalalala</td>
                    <td>lalalala</td>
                </tr>
                <tr>
                    <th scope="row">16:00</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>lalalala</td>
                </tr>
            </tbody>
        </table>

    </section>

    <section class='d-flex justify-content-center p-5'>
        <div class='row dropdown'>
            <div class="col">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Language</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Date</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Time</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ticket</button>
            </div>
        </div>
        <div class='row'>
            <button type="button" class="btn btn-warning">Add to cart</button>
            <button></button>
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
        <!-- !! -->
        <div class='p-4'>
            <p class='text-center'>The tour begins at the <span class="text-success">Green</span> point A (Church of St.
                Bavo) and ends at the <span class="text-danger">Red</span> point I. The break location (Jopenkerk) is
                marked in Blue at point E.</p>
        </div>
    </section>




    <?php
    include __DIR__ . '/../footer.php';
    ?>



</body>

</html>