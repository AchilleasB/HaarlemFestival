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
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300
        });
    </script>
      <script>
        tinymce.init({
            selector: '#title',
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300
        });
    </script>
</head>
<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>

<div class="container">
        <h1>Edit Event Description</h1>
        <form action="/cms/updateEventDescription" method="post">
            <textarea id="description" name="description" required><?php echo $event->getDescription(); ?></textarea><br><br>
            <input type="hidden" name="event_id" value="<?php echo $event->getId(); ?>">
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
    <div class="container">
        <h1>Edit Event Title</h1>
        <form action="/cms/updateEventTitle" method="post">
            <textarea id="title" name="title" required><?php echo $event->getTitle(); ?></textarea><br><br>
            <input type="hidden" name="event_id" value="<?php echo $event->getId(); ?>"> 
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>

   <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>  