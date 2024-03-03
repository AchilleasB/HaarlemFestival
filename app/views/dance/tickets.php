<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dance Tickets</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../styles/danceTickets.css">
<link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';

    require __DIR__ . '/../../config/imgconfig.php';

    if (!isset($_SESSION['user_id'])) {
        echo '<script>window.location.href = "/login";</script>';
    } else {
        echo '<script>const user_id = ' . $_SESSION['user_id'] . ';</script>';
    }

    ?>
    <main>
        <div class="red-line"></div>
        <div class="tickets-container">
            <h1 class="header mb-5">GET YOUR TICKETS</h1>
            <div class="tickets-menu" role="group" aria-label="Basic radio toggle button group"></div>
            <div class="container-lg" id="tickets-list"></div>
        </div>
    </main>

    <?php
    include __DIR__ . '/../footer.php';
    ?>

    <script type="module" src="../scripts/dance/tickets.js"></script>
    <script> var imageBasePath = "<?php echo $imageBasePath; ?>";</script>