<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Content Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cms.css">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/history/historyCmsStyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/dacel3kg9auup3593i648va8wcvi2j7ybudwbv0qmqbz74lc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <?php include __DIR__ . '/../header.php'; ?>

    <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="post">
          <div class="btn-group custom-btn-group" role="group" aria-label="Button group">
          <button type="submit" class="btn <?php echo isset($_POST['location']) ? 'active' : ''; ?>" name="location">Location</button>
            <button type="submit" class="btn <?php echo isset($_POST['guide']) ? 'active' : ''; ?>" name="guide">Guide</button>
            <button type="submit" class="btn <?php echo isset($_POST['tour']) ? 'active' : ''; ?>" name="tour">Tour</button>
          </div>
          </div>
        </form>
      </div>
    </div>
      <div>
      <?php
          $active_button = isset($_POST['location']) ? 'location' : (isset($_POST['guide']) ? 'guide' : (isset($_POST['tour']) ? 'tour' : 'location'));       
          include $active_button . '.php';
        ?>
      </div>  
    </div>
    <script>
    function initializeTinyMCE() {
        tinymce.init({
            selector: 'textarea',
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300
        });
    }
    window.addEventListener('DOMContentLoaded', initializeTinyMCE);
</script>

    <?php include __DIR__ . '/../footer.php'; ?>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio3">Guides</label>
            </div>
            <div class="content-container">
                <div class="add-event-container mt-5 mb-5" id="add-location-button">
                </div>
                </div>
                <div class=" add-event-form container-lg" id="add-location-form-container">
                </div>
                <div class="items-list container-lg" id="items-list">
                </div>
            </div>
        </div>
    </main>
    <?php
    include __DIR__ . '/../backToTop.php';
    include __DIR__ . '/../footer.php';
    ?>

    <script> const urlBasePath = "<?php echo $urlBasePath; ?>";</script>
    <script src="/../scripts/history/cms/index.js"></script>
    <script src="/../scripts/history/cms/addLocations.js"></script>

