<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dance Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/dance/tickets.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];}
    else {$user_id=NULL;}
    require __DIR__ . '/../../config/imgconfig.php';
    require __DIR__ . '/../../config/urlconfig.php';
    ?>
    <main>
        <div class="tickets-container">
            <h1 class="header mb-5">GET YOUR TICKETS</h1>
            <div class="tickets-menu" role="group" aria-label="Basic radio toggle button group"></div>
            <div class="container-lg" id="tickets-list"></div>
        </div>
    </main>

    <?php
    include __DIR__ . '/../backToTop.php';
    include __DIR__ . '/../footer.php';
    ?>

    <script>
        const imageBasePath = "<?php echo $imageBasePath; ?>";
        const user_id = <?php echo json_encode($user_id) ?>;
        const urlBasePath = "<?php echo $urlBasePath; ?>";
    </script>
    <script type="module" src="../scripts/dance/tickets.js"></script>