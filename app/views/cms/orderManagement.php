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
  <link rel="stylesheet" href="../styles/main.css">
</head>
<body class="border border-white ">
  <?php
    include __DIR__ . '/../header.php';
    require __DIR__ . '/../../config/hostnameConfig.php';

    ?>
  <main class="border border-white mb-5">
      <div class="g-col-12">
        <div class="table-responsive">
          <h5>Orders</h5>
          <table id="orderItemsTable" class="table text-center">
            <thead>
              <tr>
                <th class="text-start">Id</th>
                <th>Date</th>
                <th>Payment status</th>
                <th>Total price</th>
                <th>Invoice</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($orders as $orderCount=>$i) {    ?>
              <tr class="order bg-white">
                <?php $order = $orders[$orderCount]?>
                <td class="col-1 text-start">
                  <?= $order->getId()?>
                </td>
                <td class="col-sm-2">
                <?= $order->getDateTime()?>

                </td>
                <td class="col-sm-2">
                  <?= $order->getPaymentStatus() ?>
                </td>
               
                <td class="col-sm-2">
                  &euro;
                  <?= $order->getTotalPrice() ?>
                </td>
                <td>
                <button href="/" class="cms-btn d-inline-block downloadInvoice">Download<span id="orderId"
                        style="display:none">
                        <?= $order->getId() ?>
                      </span></button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        
      </div>
      <button class="cms-btn d-inline-block exportOrders">Export orders </button>
  </main>
  <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
<script> var host = "<?php echo $hostname; ?>";</script>
<script src="/scripts/order/order.js"></script>
</html>