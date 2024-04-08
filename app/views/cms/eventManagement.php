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

    <ul class="nav nav-tabs" id="eventPageTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="addEventPageTab" data-bs-toggle="tab" data-bs-target="#addEventPage"
                type="button" role="tab" aria-controls="addEventPage" aria-selected="true">Add Event Page</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="editEventPageTab" data-bs-toggle="tab" data-bs-target="#editEventPage"
                type="button" role="tab" aria-controls="editEventPage" aria-selected="false">Edit Event Page</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deleteEventPageTab" data-bs-toggle="tab" data-bs-target="#deleteEventPage"
                type="button" role="tab" aria-controls="deleteEventPage" aria-selected="false">Delete Event
                Page</button>
        </li>
    </ul>

    <div class="tab-content" id="eventPageTabContent">
        <div class="tab-pane fade show active" id="addEventPage" role="tabpanel" aria-labelledby="addEventPageTab">
            <div class="p-5">
                <form action="/cms/createEventPage" method="post">
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
                    <?php foreach ($eventPages as $eventPage) : ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="eventPage-tab-<?= $eventPage['id'] ?>" data-bs-toggle="tab"
                            data-bs-target="#eventPage-<?= $eventPage['id'] ?>" type="button" role="tab"
                            aria-controls="eventPage-<?= $eventPage['id'] ?>"
                            aria-selected="false"><?= $eventPage['title'] ?></button>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content" id="eventPageTabContentNested">
                    <?php foreach ($eventPages as $eventPage) : ?>
                    <div class="tab-pane fade" id="eventPage-<?= $eventPage['id'] ?>" role="tabpanel"
                        aria-labelledby="eventPage-tab-<?= $eventPage['id'] ?>">
                        <div class="p-5">
                            <h3>Edit Event Page: <?= $eventPage['title'] ?></h3>
                            <form action="/cms/updateEventPage" method="post">
                                <input type="hidden" name="event_id" value="<?= $eventPage['id'] ?>">
                                <div class="mb-3">
                                    <label for="title<?= $eventPage['id'] ?>" class="form-label">Title</label>
                                    <textarea class="form-control tinymce-field" id="title<?= $eventPage['id'] ?>"
                                        name="title" rows="3"><?= $eventPage['title'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle<?= $eventPage['id'] ?>" class="form-label">Subtitle</label>
                                    <textarea class="form-control tinymce-field" id="subtitle<?= $eventPage['id'] ?>"
                                        name="subtitle" rows="3"><?= $eventPage['sub_title'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description<?= $eventPage['id'] ?>"
                                        class="form-label">Description</label>
                                    <textarea class="form-control tinymce-field" id="description<?= $eventPage['id'] ?>"
                                        name="description" rows="3"><?= $eventPage['description'] ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="information<?= $eventPage['id'] ?>"
                                        class="form-label">Information</label>
                                    <textarea class="form-control tinymce-field" id="information<?= $eventPage['id'] ?>"
                                        name="information" rows="3"><?= $eventPage['information'] ?></textarea>
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
                <form action="/cms/deleteEventPage" method="post">
                    <label for="deleteId">Enter ID to Delete:</label>
                    <input type="text" id="deleteId" name="id" required><br><br>

                    <input type="submit" value="Delete Event Page" class= "btn btn-primary">
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventPages as $eventPage) : ?>
                        <tr>
                            <td><?= $eventPage['id'] ?></td>
                            <td><?= $eventPage['title'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
    function initializeTinyMCE() {
        tinymce.init({
            selector: 'textarea',
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300
        });
    }
    window.addEventListener('DOMContentLoaded', initializeTinyMCE);
    </script>


    <?php include __DIR__ . '/../footer.php'; ?>


</body>