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
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

    <?php
    include __DIR__ . '/../header.php';
    ?>
<div class="p-5">
        <ul class="nav nav-tabs justify-content-end" id="pageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="addPageTab" data-bs-toggle="tab" data-bs-target="#addPage" type="button"
                    role="tab" aria-controls="addPage" aria-selected="true">Add Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="editPageTab" data-bs-toggle="tab" data-bs-target="#editPage" type="button"
                    role="tab" aria-controls="editPage" aria-selected="false">Edit Page</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="deletePageTab" data-bs-toggle="tab" data-bs-target="#deletePage" type="button"
                    role="tab" aria-controls="deletePage" aria-selected="false">Delete Page</button>
            </li>
        </ul>
        <div class="tab-content" id="pageTabsContent">
            <div class="tab-pane fade show active" id="addPage" role="tabpanel" aria-labelledby="addPageTab">
                <form action="/cms/createEventPage" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br><br>

                    <label for="subtitle">Subtitle:</label>
                    <input type="text" id="subtitle" name="subtitle"><br><br>

                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" class="tinymce-field" rows="4" cols="50"></textarea><br><br>

                    <label for="information">Information:</label><br>
                    <textarea id="information" name="information" class="tinymce-field" rows="4" cols="50"></textarea><br><br>

                    <input type="submit" value="Create Event Page">
                </form>
            </div>
            <div class="tab-pane fade" id="editPage" role="tabpanel" aria-labelledby="editPageTab">
            <div class="container mt-4">
                <?php foreach ($eventPages as $eventPage): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="/cms/updateEventPage" method="post">
                            <input type="hidden" name="event_id" value="<?= $eventPage['id'] ?>">
                            <div class="mb-3">
                                <label for="title<?= $eventPage['id'] ?>" class="form-label">Title</label>
                                <textarea class="form-control tinymce-field" id="title<?= $eventPage['id'] ?>" name="title" rows="3"><?= $eventPage['title'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="subtitle<?= $eventPage['id'] ?>" class="form-label">Subtitle</label>
                                <textarea class="form-control tinymce-field" id="subtitle<?= $eventPage['id'] ?>" name="subtitle" rows="3"><?= $eventPage['sub_title'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description<?= $eventPage['id'] ?>" class="form-label">Description</label>
                                <textarea class="form-control tinymce-field" id="description<?= $eventPage['id'] ?>" name="description" rows="3"><?= $eventPage['description'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="information<?= $eventPage['id'] ?>" class="form-label">Information</label>
                                <textarea class="form-control tinymce-field" id="information<?= $eventPage['id'] ?>" name="information" rows="3"><?= $eventPage['information'] ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
            <div class="tab-pane fade" id="deletePage" role="tabpanel" aria-labelledby="deletePageTab">
                <form action="/cms/deleteEventPage" method="post" class="page-form">
                    <label for="deleteId">Page ID to Delete:</label>
                    <input type="text" id="deleteId" name="id" required><br><br>

                    <input type="submit" value="Delete Page">
                </form>
            </div>
        </div>
    </div>


    <script>
    function initializeTinyMCE() {
        tinymce.init({
            selector: '.tinymce-field',
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300
        });
    }
    window.addEventListener('DOMContentLoaded', initializeTinyMCE);
</script>

    <?php include __DIR__ . '/../footer.php'; ?>

   
</body>

