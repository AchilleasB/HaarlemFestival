<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>
    <main>
        <div class="reset-password-container">
            <div class="container fluid mt-4">
                <h5 class="header mb-5">You may update your password here</h5>
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
                <form action="/profile/updatePassword" method="POST">
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">New password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control"
                            aria-describedby="passwordHelpBlock">
                        <div id="passwordHelpBlock" class="form-text">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not
                            contain spaces,
                            special
                            characters, or emoji.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputConfirmPassword" class="form-label">Confirm new password</label>
                        <input type="password" id="inputConfirmPassword" name="confirmPassword" class="form-control"
                            aria-describedby="passwordHelpBlock">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdyLWspAAAAAD2F0-rClAJA92KmKYyh80ELuyRq"></div> <br />
                    <div class="success">
                        <?php if (isset($captchaMessage)) { ?> <span style="color: red">
                                <?= $captchaMessage ?>
                            </span>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 mb-3">Submit</button>
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