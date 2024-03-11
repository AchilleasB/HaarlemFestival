<?php
$path = $qrData;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="border border-white ">
    <main class="border border-white">
<div style="padding:12px; border-style:solid">
<h2><?= $user->getFirstname() . $user->getLastName() ?></h2>
                        <ul style="list-style-type:none; padding-left:0px;">
        <li class="list-group-item border-0 p-0">
 <strong><?= $eventName ?></strong>
  <?php  if ($ticketType != "SINGLE-CONCERT") { ?>
<strong><?= $ticketType ?> <?php }?>
  </li>
<li><?=$dateTime?></li>
        <li class="list-group-item border-0 p-0 pb-2">
        <img src="<?= $base64 ?>"></li>
</ul>
  </div>
</main>
</body>
</html>