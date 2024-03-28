<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet" />
</head>
<body class="border border-white ">
  <main class="border border-white">
    <div class="grid pt-5" style="--bs-columns: 10; --bs-gap: 1rem;">
      <div class="g-col-4">
        <h2>Invoice</h2>
        <div>Invoice number:
          <?= $order->getId() ?>
        </div>
        <div>Date:
          <?= date( 'd-m-Y') ?>
        </div>
        <div>To:
          <?= $user->getFirstname() . $user->getLastName() ?>
        </div>
        <div>User address</div>
        <div class="table-responsive pt-5">
          <h5>Your items</h5>
          <table id="orderItemsTable" style="text-align:center">
            <thead>
              <tr>
                <th>Attraction/Event</th>
                <th>Quantity</th>
                <th>Total price</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $orderItem=>$i) { 
                      $eventName =  $products[$orderItem]['Event']->getName();

                      $ticketAmount = $orderItems[$orderItem]->amount;

                        $pricePerItem = $orderItems[$orderItem]->calc_price;

                      $ticketType = $products[$orderItem]['Event']->getTicketType();
                      ?>
                <tr class="product">
                <td class="col-md-4">
                  
                <strong><?= $eventName ?></strong>
                </td>
                <td class="align-middle">
                  <div>
                    <?= $ticketAmount ?>
                  </div>
                </td>
                <td class="align-middle">
                  &euro;
                  <?= $pricePerItem?>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
      </div>
      <div class="px-3 col-md-auto  text-end">
        <h5>VAT: &euro;
          <?= $order->getTotalPrice() * 0.21 ?>
        </h5>
        <h5>Total: &euro;
          <?= $order->getTotalPrice()?>
        </h5>
      </div>
    </div>
    </div>
  </main>
</body>
</html>