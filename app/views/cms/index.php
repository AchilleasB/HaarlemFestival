<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';

    ?>
    <main>
        <div class="red-line"></div>
        <div class="cms-container">
            <h1 class="header mb-5">Content Management System</h1>
            <div class="cms-buttons-container">
                <a href="/cms/historyManagement" class="cms-btn d-inline-block">History</a>
                <a href="/cms/danceManagement" class="cms-btn d-inline-block">Dance</a>
                <a href="yummie" class="cms-btn d-inline-block">Yummie</a>
                <a href="/cms/userManagement" class="cms-btn d-inline-block">Users</a>
                <a href="/cms/orderManagement" class="cms-btn d-inline-block">Orders</a>

            </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
    
    