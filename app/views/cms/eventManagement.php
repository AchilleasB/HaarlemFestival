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

<form action="/cms/create" method="post">
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


   <?php
    include __DIR__ . '/../footer.php';
    ?>

<script>
    tinymce.init({
        selector: '.tinymce-field',
        plugins: 'autolink lists link',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
        height: 300
    });
</script>
</body>  

