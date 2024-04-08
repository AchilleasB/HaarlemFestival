<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Stroll Through History</title>
    <script src="/../scripts/history/index.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/history/historyStyle.css">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <?php
    include __DIR__ . '/../header.php';
    if (isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];}
        else {$user_id=NULL;}
  
    ?>

    <header class="header-body">
        <div class="p-5 text-center bg-image header-image"
            style="background-image: url('../../images/history-image.png');">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-uppercase">
                    <h1 class="text-white fw-bold display-4 text-shadow"><?php echo $event->getTitle(); ?></h1>
                    <h4 class="bg-light d-inline-block p-2 shadow-lg"><?php echo $event->getSubTitle(); ?></h4>
                    <div class="p-5"><button class="btn btn-lg btn-danger shadow-lg" id="getTicketsBtn"
                            onclick="scrollToTickets()">GET YOUR TICKETS</button></div>
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
                    <p class="small text-justify"><?php echo $event->getDescription(); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="gray-bg">
        <div class="container w-75 py-5 bold-headers">
            <div class="row text-center pb-3">
                <h3><?php echo $event->getTitle(); ?></h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="inline-text text-red">General Information</h4>
                </div>
                <div class="col-md-8">
                    <ul class="small text-muted">
                        <?php echo $event->getInformation(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-center py-3 text-bold">FEATURED <span class="text-red">LOCATIONS</span></h2>
    </section>

    <?php
    include __DIR__ . '/../history/locations.php';
    ?>

    <section>
        <h2 class="text-center py-3 text-bold">TOUR <span class="text-red">SCHEDULE</span></h2>
    </section>

    <?php
    include __DIR__ . '/../history/schedule.php';
    ?>

    <section id="ticketSection">
        <h2 class="text-center py-3 text-bold">GET YOUR <span class="text-red">TICKETS</span></h2>
    </section>

    <?php
    include __DIR__ . '/../history/tickets.php';
    ?>
    <section>
        <h2 class="text-center py-3 text-bold ">LOCATIONS <span class="text-red">OVERVIEW</span></h2>
    </section>

    <?php
    include __DIR__ . '/../history/locations_overview.php';

    include __DIR__ . '/../footer.php';
    ?>

</body>

</html>