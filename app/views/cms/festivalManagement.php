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
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>

<div id="editFormsContainer" class="container m-5">
        <div class="btn-group" role="group" aria-label="Edit Options">
            <input type="radio" class="btn-check" name="editOption" id="editEvent" autocomplete="off" value="event" checked>
            <label class="btn btn-outline-primary" for="editEvent">Edit Event</label>

            <input type="radio" class="btn-check" name="editOption" id="editOverview" autocomplete="off" value="overview">
            <label class="btn btn-outline-primary" for="editOverview">Edit Events Overview</label>
        </div>

        <div id="editEventContainer" class="edit-form-container">
            <?php renderEditForm("Edit Event Title", "title", $event->getTitle(), $event->getId()); ?>
            <?php renderEditForm("Edit Event Sub Title", "subTitle", $event->getSubTitle(), $event->getId()); ?>
            <?php renderEditForm("Edit Event Description", "description", $event->getDescription(), $event->getId()); ?>
        </div>

        <div id="editOverviewContainer" class="edit-form-container" style="display: none;">
            <?php foreach ($events as $event): ?>
                <?php renderEditForm("Edit Event Title Overview", "titleOverview", $event->getTitle(), $event->getId()); ?>
                <?php renderEditForm("Edit Event Description Overview", "descriptionOverview", $event->getDescription(), $event->getId()); ?>
                <?php renderEditForm("Edit Event Schedule Overview", "schedule", $event->getSchedule(), $event->getId()); ?>
                <?php renderEditForm("Edit Event Location Overview: " . $event->getTitle(), "location", $event->getLocations(), $event->getId()); ?>
            <?php endforeach; ?>
        </div>
    </div>
   <?php
    include __DIR__ . '/../footer.php';
    ?>
       <script src="/../scripts/festival/festivalCms.js"></script>
 
</body>  

<?php
function renderEditForm($title, $name, $value, $eventId) {
    echo '<div class="container">';
    echo '<h2 class = "text-center p-4">' . $title . '</h2>';
    echo '<form action="/cms/updateEvent' . ucfirst($name) . '" method="post">';
    echo '<textarea id="' . $name . '" name="' . $name . '" class="tinymce-field" required>' . $value . '</textarea><br><br>';
    echo '<input type="hidden" name="event_id" value="' . $eventId . '">';
    echo '<input type="submit" value="Save" class="btn btn-primary">';
    echo '</form>';
    echo '</div>';
}
?>