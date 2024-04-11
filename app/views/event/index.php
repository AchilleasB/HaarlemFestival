<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/event.css">
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>
    <main>
        <div class="event-container">
            
            <?php if ($event) {
            ?>
            <div class="event-content">

                <header class="header-body">
                    <div class="p-5 text-center header-style">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <div class="text-uppercase">
                                <h1 class="text-white fw-bold display-4 text-shadow"><?php echo $event->getTitle(); ?>
                                </h1>
                                <h4 class="bg-light d-inline-block p-2 shadow-lg"><?php echo $event->getSubTitle(); ?>
                                </h4>
                            </div>
                        </div>
                </header>

                <section class="gray-bg">
                    <div class="container w-75 py-5">
                        <div class="col">
                            <?php echo $event->getDescription();?>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="container w-75 py-5">
                        <div class="col">
                            <p class="small text-justify"><?php echo $event->getInformation();?></p>
                        </div>
                    </div>
                </section>
            </div>
            <?php
            } else {
            ?>
            <div class="event-not-found">
                <p>Page not found.</p>
            </div>
            <?php
            }
            ?>
        </div>
    </main>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>

</html>