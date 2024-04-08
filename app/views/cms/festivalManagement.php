<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>


    <div class="edit-form-container">
        <h2 class="text-center p-5">Festival Page Main content</h2>

        <ul class="nav nav-tabs" id="eventTabs" role="tablist">
            <?php foreach ($events as $index => $event): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>"
                    id="tab-<?php echo $event->getId(); ?>" data-bs-toggle="tab"
                    data-bs-target="#event-<?php echo $event->getId(); ?>" type="button" role="tab"
                    aria-controls="event-<?php echo $event->getId(); ?>"
                    aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                    <?php echo $event->getTitle(); ?>
                </button>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content" id="eventTabsContent">
            <?php foreach ($events as $index => $event): ?>
            <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>"
                id="event-<?php echo $event->getId(); ?>" role="tabpanel"
                aria-labelledby="tab-<?php echo $event->getId(); ?>">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="event-details p-5">
                            <form action="/cms/updateEventDetails" method="post" class="row g-3">
                                <div class="col-md-6">
                                    <label for="title<?php echo $event->getId(); ?>" class="form-label">Event
                                        Title</label>
                                    <textarea id="title<?php echo $event->getId(); ?>"
                                        name="events[<?php echo $event->getId(); ?>][title]"><?php echo $event->getTitle(); ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="subTitle<?php echo $event->getId(); ?>" class="form-label">Event Sub
                                        Title</label>
                                    <textarea id="subTitle<?php echo $event->getId(); ?>"
                                        name="events[<?php echo $event->getId(); ?>][subTitle]"><?php echo $event->getSubTitle(); ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="description<?php echo $event->getId(); ?>" class="form-label">Event
                                        Description</label>
                                    <textarea id="description<?php echo $event->getId(); ?>"
                                        name="events[<?php echo $event->getId(); ?>][description]"><?php echo $event->getDescription(); ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="locations<?php echo $event->getId(); ?>"
                                        class="form-label">Locations</label>
                                    <textarea id="locations<?php echo $event->getId(); ?>"
                                        name="events[<?php echo $event->getId(); ?>][locations]"><?php echo $event->getLocations(); ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="schedule<?php echo $event->getId(); ?>"
                                        class="form-label">Schedule</label>
                                    <textarea id="schedule<?php echo $event->getId(); ?>"
                                        name="events[<?php echo $event->getId(); ?>][schedule]"><?php echo $event->getSchedule(); ?></textarea>
                                </div>
                                
                                <input type="hidden" name="events[<?php echo $event->getId(); ?>][id]"
                                    value="<?php echo $event->getId(); ?>">
                                <div>
                                    <input type="submit" value="Save" class="btn btn-lg btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    <?php foreach ($events as $event): ?>
    tinymce.init({
        selector: "#title<?php echo $event->getId(); ?>, #subTitle<?php echo $event->getId(); ?>, #description<?php echo $event->getId(); ?>, #locations<?php echo $event->getId(); ?>, #schedule<?php echo $event->getId(); ?>",
        plugins: 'autolink lists link',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
        height: 400,
        width: 500,
    });
    <?php endforeach; ?>
    </script>


    <?php
    include __DIR__ . '/../footer.php';
    ?>

</body>

<?php

?>