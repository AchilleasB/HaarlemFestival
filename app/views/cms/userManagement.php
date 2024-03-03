<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    require __DIR__ . '/../../config/imgconfig.php';
    ?>

    <main>
        <div class="red-line"></div>
        <div class="user-cms-container">
            <h1 class="header mb-5">User Content Management</h1>
            <div class="content-container">
                <div class="container mt-5 mb-5" id="add-user-button">
                </div>
                <div class="container-lg" id="add-user-form-container">
                </div>
                <div class="container-lg" id="items-list">
                </div>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../backToTop.php';
    include __DIR__ . '/../footer.php';
    ?>

    <script src="/../scripts/user/index.js"></script>
    <script src="/../scripts/user/addUser.js"></script>
    <script src="/../scripts/user/editUser.js"></script>
    <script src="/../scripts/user/deleteUser.js"></script>