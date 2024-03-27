<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
  <script src="http://code.jquery.com/jquery-migrate-1.1.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <link rel="stylesheet" href="../styles/main.css">
</head>
<body class="border border-white ">
<?php
    include __DIR__ . '/../header.php';
    require __DIR__ . '/../../config/urlconfig.php';

    ?>
  <main class="border border-white">
  <video id="preview"><img src="/../public/tickets/qr/qr0.png"></video>

  <div class="g-col-6 px-5 text-center">
  

    <h2 class="mt-5 mb-5">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
  <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
  <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
  <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
  <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
  <path d="M12 9h2V8h-2z"/>
</svg> <strong> Scan ticket </strong></h2>
</div>
<div class="g-col-6 px-5 ticket">

        <div class="border-bottom">
          <p class="h5">Ticket information</p>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-3  text-start"><strong>First name:</strong></div>
          <div class="g-col-8  text-start firstname"></div>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-3  text-start "><strong>Last name:</strong></div>
          <div class="g-col-8  text-start lastname"></div>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-3  text-start"><strong>Event:</strong></div>
          <div class="g-col-8  text-start event"></div>
        </div>
        <div class="grid py-2 px-2" style="row-gap: 0;">
          <div class="g-col-3  text-start"><strong>Date and time:</strong></div>
          <div class="g-col-8 text-start datetime"></div>
        </div>
       
       
      </div>
      
</div>
  </main>
  <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
<script> var urlBasePath = "<?php echo $urlBasePath; ?>";</script>
<script src="/scripts/qrCodeChecker/qrCodeChecker.js"></script>

</html>