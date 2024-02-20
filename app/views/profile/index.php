<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';

    if (isset($_SESSION['user_firstname'])) {
        $firstname = $_SESSION['user_firstname'];
    }

    if (isset($_SESSION['user_lastname'])) {
        $lastname = $_SESSION['user_lastname'];
    }

    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
    }

    ?>
    <main>
        <div class="profile-container">
            <div class="container fluid mt-4">
                <h5 class="header mb-5">You may update your personal information here</h5>
                <?php
                if (isset($_SESSION['errorMessage'])) {
                    echo '<div class="alert alert-danger" id="alert" role="alert">' . $_SESSION['errorMessage'] . '</div>';
                    unset($_SESSION['errorMessage']);
                }
                if (isset($_SESSION['successMessage'])) {
                    echo '<div class="alert alert-success" id="alert" role="alert">' . $_SESSION['successMessage'] . '</div>';
                    unset($_SESSION['successMessage']);
                }
                ?>
                <form action="/profile/updateProfile" method="POST">
                    <div class="mb-3">
                        <label for="inputFirstname" class="form-label">First name</label>
                        <input type="text" value="<?php echo $firstname ?>" class="form-control" id="inputFirstname"
                            name="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="inputLastname" class="form-label">Last name</label>
                        <input type="text" value="<?php echo $lastname ?>" class="form-control" id="inputLastname"
                            name="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" value="<?php echo $email ?>" class="form-control" id="inputEmail"
                            name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 mb-3">Submit</button>
                </form>
                <br />
                <form action="/profile/sendEmail" method="POST">
                    <button type="submit" class="btn btn-secondary mt-2 mb-3">
                        <em>I want to reset my password</em>
                    </button>
                </form>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>

    <script>
        setTimeout(function () {
            document.getElementById('alert').style.display = 'none';
        }, 3000);
    </script>