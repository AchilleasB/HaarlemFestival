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
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>

    <?php
    include __DIR__ . '/../header.php';
    ?>

    <h2 class= "text-center p-5">Manage Events</h2>
    
    <ul class="nav nav-tabs" id="eventPageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="addEventPageTab" data-bs-toggle="tab" data-bs-target="#addEventPage"
                type="button" role="tab" aria-controls="addEventPage" aria-selected="true">Add Page</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="editEventPageTab" data-bs-toggle="tab" data-bs-target="#editEventPage"
                type="button" role="tab" aria-controls="editEventPage" aria-selected="false">Edit Page</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deleteEventPageTab" data-bs-toggle="tab" data-bs-target="#deleteEventPage"
                type="button" role="tab" aria-controls="deleteEventPage" aria-selected="false">Delete
                Page</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="viewAllEventsTab" data-bs-toggle="tab" data-bs-target="#viewAllEvents"
                type="button" role="tab" aria-controls="viewAllEvents" aria-selected="false">View Page</button>
        </li>
    </ul>

    <div class="tab-content" id="eventPageTabContent">
        <div class="tab-pane fade show active" id="addEventPage" role="tabpanel" aria-labelledby="addEventPageTab">
            <div class="p-5">
                <form action="/api/eventPage/createEventPage" method="post">
                    <label for="title">Title:</label>
                    <textarea type="text" id="title" name="title"></textarea><br><br>

                    <label for="subtitle">Subtitle:</label>
                    <textarea type="text" id="subtitle" name="subtitle"></textarea><br><br>

                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" class="tinymce-field" rows="4"
                        cols="50"></textarea><br><br>

                    <label for="information">Information:</label><br>
                    <textarea id="information" name="information" class="tinymce-field" rows="4"
                        cols="50"></textarea><br><br>

                    <input type="submit" value="Create Event Page" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="editEventPage" role="tabpanel" aria-labelledby="editEventPageTab">
            <div class="container mt-4">
                <ul class="nav nav-tabs" id="eventPageTabsNested" role="tablist">
                    <?php foreach ($events as $event) : ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="eventPage-tab-<?= $event->getId() ?>" data-bs-toggle="tab"
                            data-bs-target="#eventPage-<?= $event->getId() ?>" type="button" role="tab"
                            aria-controls="eventPage-<?= $event->getId() ?>"
                            aria-selected="false"><?= $event->getTitle() ?></button>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content" id="eventPageTabContentNested">
                    <?php foreach ($events as $event) : ?>
                    <div class="tab-pane fade" id="eventPage-<?= $event->getId() ?>" role="tabpanel"
                        aria-labelledby="eventPage-tab-<?= $event->getId() ?>">
                        <div class="p-5">
                            <h3>Edit Page: <?= $event->getTitle() ?></h3>
                            <form action="/api/eventPage/updateEventPage" method="post">
                                <input type="hidden" name="event_id" value="<?= $event->getId() ?>">
                                <div class="mb-3">
                                    <label for="title<?= $event->getId() ?>" class="form-label">Title</label>
                                    <textarea class="form-control tinymce-field" id="title<?= $event->getId() ?>"
                                        name="title" rows="3"><?= $event->getTitle() ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle<?= $event->getId() ?>" class="form-label">Subtitle</label>
                                    <textarea class="form-control tinymce-field" id="subtitle<?= $event->getId() ?>"
                                        name="subtitle" rows="3"><?= $event->getSubTitle() ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description<?= $event->getId() ?>"
                                        class="form-label">Description</label>
                                    <textarea class="form-control tinymce-field" id="description<?= $event->getId() ?>"
                                        name="description" rows="3"><?= $event->getDescription() ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="information<?= $event->getId() ?>"
                                        class="form-label">Information</label>
                                    <textarea class="form-control tinymce-field" id="information<?= $event->getId() ?>"
                                        name="information" rows="3"><?= $event->getInformation() ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="deleteEventPage" role="tabpanel" aria-labelledby="deleteEventPageTab">
            <div class="p-5">
                <form action="/api/eventPage/deleteEventPage" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event ID</th>
                                <th>Title</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event) : ?>
                            <tr>
                                <td><?= $event->getId() ?></td>
                                <td><?= $event->getTitle() ?></td>
                                <td><input type="checkbox" name="eventsToDelete[<?= $event->getId() ?>]"
                                        value="<?= $event->getId() ?>"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Delete Selected Events" class="btn btn-danger">
                </form>
            </div>
        </div>

        <div class="tab-pane fade" id="viewAllEvents" role="tabpanel" aria-labelledby="viewAllEventsTab">
            <div class="p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($events as $event) : ?>
                    <?php if ($event->getId() > 2) : ?>
                        <tr>
                            <td><?= $event->getTitle() ?></td>
                            <td>
                                <button class="btn btn-primary"
                                        onclick="viewEvent(<?= $event->getId() ?>)">View</button>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <script src="/../scripts/event/index.js"></script>
    <?php include __DIR__ . '/../footer.php'; ?>


</body>