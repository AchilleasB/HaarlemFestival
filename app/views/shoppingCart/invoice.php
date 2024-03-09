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
          <?= $invoice->getId() ?>
        </div>
        <div>Date:
          <?= $invoice->getIssueDate() ?>
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
                      $ticketPrice = $products[$orderItem]['Event']->getTicketPrice();
                      $ticketType = $products[$orderItem]['Event']->getTicketType();
                      ?>
                <tr class="product">
                <td class="col-md-4">
                  <?php if ($eventName != '' && $ticketType != "SINGLE-CONCERT"){ ?>
                <div>  <strong><?= $eventName ?></strong>-<?= $ticketType?></div>
            
              <?php } 
              else if ($eventName == ''&& $ticketType != "SINGLE-CONCERT")
              { ?><strong><?= 'Dance!' ?>-<?= $ticketType?></strong><?php }
              
                else 
              { ?><strong><?= $eventName ?></strong><?php } ?>
                </td>
                <td class="align-middle">
                  <div>
                    <?= $ticketAmount ?>
                  </div>
                </td>
                <td class="align-middle">
                  &euro;
                  <?= $ticketPrice * $ticketAmount?>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
      </div>
      <div class="px-3 col-md-auto  text-end">
        <h5>VAT: &euro;
          <?= $invoice->getTotalVAT() ?>
        </h5>
        <h5>Total: &euro;
          <?= $invoice->getTotalCost() ?>
        </h5>
      </div>
    </div>
    </div>
  </main>
</body>
</html>