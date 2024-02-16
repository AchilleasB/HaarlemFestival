<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../festivalStyle.css">
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <?php
    include __DIR__ . '/../header.php';
    ?>

    <header class="header-body">
        <div class="p-5 text-center bg-image header-image"
            style="background-image: url('../../images/festival-image.png');">
            <div class="d-flex justify-content-center align-items-center shadow h-100">
                <div>
                    <h1 class="text-white fw-bold display-4">THE FESTIVAL</h1>
                    <h4 class="bg-white d-inline-block p-1">A SUMMER TO REMEMBER</h4>
                </div>
            </div>
        </div>
    </header>

    <section class="wine-bg">
        <div class="container text-white w-75 py-4">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="inline-text">The <span class="gold-text">Summer Festival</span></h3>
                    <h5>Fun events for everyone!</h5>
                </div>
                <div class="col-md-8">
                    <p class="small text-justify"> Get ready for the summer festival with activities for everyone.
                        From jazz to the latest EDM artists, the festival has something for everyone. Foodies, history
                        lovers and kids too!
                        <br><br>
                        Explore our Jazz, Dance, Yummie, A stroll through history, and The secret of Dr. Teyler!
                    </p>
                </div>
            </div>
        </div>
    </section>




    <section class="d-flex justify-content-center">
        <div class="col-6 my-5 border-bottom border-3 pb-5">
            <div class="row">
                <h2>DANCE!</h2>
            </div>
            <div class="row">
                <div class="col">
                    <img src="/../images/dance.png" alt="Haarlem" class="img-fluid box-shadow">
                </div>
                <div class="col">
                    <div class="tab text-white">
                        <button class="tablinks" onclick="openTab(event, 'Description')" id="defaultOpen">DESCRIPTION</button>
                        <button class="tablinks" onclick="openTab(event, 'Location')">LOCATION</button>
                        <button class="tablinks" onclick="openTab(event, 'Schedule')">SCHEDULE</button>
                    </div>
                    <div id="Description" class="tabcontent">
                        <h6 class = "fw-bold pt-3">Description</h6>
                        <p>Lorem ipsum dolor sit amet. Et inventore accusamus et ullam ratione sed incidunt quos in vero omnis et consequatur Quis id esse voluptatem. </p>
                        <button class = "info-button">MORE INFO</button>
                    </div>

                    <div id="Location" class="tabcontent">
                        <h6 class = "fw-bold pt-3">Location</h6>
                        <p></p>
                    </div>

                    <div id="Schedule" class="tabcontent">
                        <h6 class = "fw-bold pt-3">Simple schedule</h6>
                        <p></p>
                    </div>
                </div>

            </div>

        </div>
    </section>




    <?php
    include __DIR__ . '/../footer.php';
    ?>
    <script>

        function openTab(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
    </script>
</body>

</html>