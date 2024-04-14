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
    <?php include __DIR__ . '/../header.php'; 
    require __DIR__ . '/../../config/urlconfig.php';
    ?>

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

