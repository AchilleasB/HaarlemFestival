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

<body class = "bg-light">
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
        <div class="row w-50 gray-bg p-4">
            <div class="col">
                <h3>1. Church of St. Bavo</h3>
                <p class="text-muted">The St Bavo church was built in 1895–1930 & dedicated in 1948, named for the
                    city's patron saint.
                </p>
                <button>Learn more ></button>
            </div>
            <div class="col">
                <img src="/../images/dance.png" class="img-fluid">
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-center py-3 text-bold">TOUR <span class="text-red">SCHEDULE</span></h2>
    </section>

    <section>
        <h2 class="text-center py-3 text-bold">LOCATIONS <span class="text-red">OVERVIEW</span></h2>
    </section>





    <?php
    include __DIR__ . '/../footer.php';
    ?>



</body>

</html>