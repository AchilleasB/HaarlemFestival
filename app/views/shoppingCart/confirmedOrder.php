<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body class="border border-white ">
    <?php
    include __DIR__ . "/../header.php";
    ?>
    <main class="border border-white">
        <div class="text-center pt-5 orderConfirmed">
            <div>
                <h2>Thank you for your purchase!</h2>
            </div>
            <img src="https://img.icons8.com/?size=96&id=sz8cPVwzLrMP&format=png">
            <div>
                <h5><strong>The tickets should arrive in a few minutes in your email.</strong></h5>
            </div>
            <form method="" action="/personalProgram">
                <input class="rounded-0 py-3 px-5" type=submit name=action id="checkoutBtn"
                    value="See your personal program" />
            </form>
            <div>
                <h5><strong>or</strong></h5>
            </div>
            <form method="" action="/festival">
                <input class="rounded-0 py-3 px-5" type=submit name=action id="checkoutBtn"
                    value="Return to the events" />
            </form>
        </div>
    </main>
    <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
</html>