<?php
$pageTitle = 'testing';
require_once(__DIR__ . '/../../views/header.php');
echo '<link rel="stylesheet" href="../../styles/main.css">';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">';
?>
<h1><?php echo $pageTitle; ?></h1>
<h2>g1</h2>
<p><p>g2</p></p>
<p><p>g3</p></p>
<?php require_once(__DIR__ . '/../../views/footer.php'); ?>
