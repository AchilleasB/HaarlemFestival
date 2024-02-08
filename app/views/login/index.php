<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>
    <main>
        <div class="login-container">
            <div class="container fluid mt-5 mb-5">
                <h2 class="header mb-5">Log in</h2>
                <?php
                if (isset($_SESSION['errorMessage'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['errorMessage'] . '</div>';
                    unset($_SESSION['errorMessage']);
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="inputEmail">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input name="password" type="password" id="inputPassword" class="form-control"
                            aria-describedby="passwordHelpBlock">
                        <div id="passwordHelpBlock" class="form-text">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not
                            contain spaces,
                            special characters, or emoji.
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdyLWspAAAAAD2F0-rClAJA92KmKYyh80ELuyRq"></div> <br />
                    <div class="success">
                        <?php if (isset($captchaMessage)) { ?> <span style="color: red">
                                <?= $captchaMessage ?>
                            </span>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>