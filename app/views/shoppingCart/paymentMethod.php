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
<body>
<?php
    include __DIR__ . '/../header.php';
    ?>
  <main>
  
    <div class="grid pt-5 h-auto" style="--bs-columns: 10; --bs-gap: 1rem;">
      <div class="g-col-6 px-2">
      <?php $user=$this->user; ?>

      <contact-information-component></contact-information-component>

        <form method="POST" action="/shoppingCart/confirmPurchase">
          <div class="border-bottom">
            <p class="h5 pt-5 ">Please select a payment method</p>
          </div>
          <div class="grid py-2 px-2 paymentMethods pb-5" style="row-gap: 0;">
            <div class="g-col-2">
              <div><img src="https://www.svgrepo.com/show/266085/ideal.svg" width="64" height="64"></div>
              <div class="px-3">
                <input value="ideal" class="form-check-input border border-dark ideal" type="radio" name="paymentMethod"
                  id="inlineRadio1" />
              </div>
            </div>
            <div class="g-col-2">
              <div><img src="https://www.svgrepo.com/show/266070/visa.svg" width="64" height="64"></div>
              <div class="px-3"><input value="visa" class="form-check-input border border-dark visa" type="radio"
                  name="paymentMethod" id="inlineRadio1"></div>
            </div>
            <div class="g-col-2">
              <div><img src="https://www.svgrepo.com/show/266087/master-card.svg" width="64" height="64"></div>
              <div class="px-3"><input value="mastercard" class="form-check-input border border-dark mastercard"
                  type="radio" name="paymentMethod" id="inlineRadio1"></div>
            </div>
          </div>
          <input class="rounded-0 py-3 w-25 " type=submit name=action id="checkoutBtn" value="Confirm purchase" />
        </form>
      </div>
      <div class="g-col-4 text-center h-auto" style="row-gap: 0; height: 200px">
        <div class="grid border-bottom py-2" style="row-gap: 0;">
          <div class="h5 g-col-4  text-start">Your items</div>
          <div class="h5 g-col-6 text-end "><a href="/shoppingCart" class="text-decoration-none  text-dark">Edit</a>
          </div>
        </div>

       
        <ul class="list-group">
          <?php foreach ($this->products as $orderItem=>$i) {
            $product = $this->products[$orderItem]['Event']->getName();

            if ($eventImage = $this->products[$orderItem]['Event']->getArtistImage() != NULL) {
              $eventImage = $this->products[$orderItem]['Event']->getArtistImage();
            } else if ($eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage() != NULL) {
              $eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage();
            } else if ($eventImage = $this->products[$orderItem]['Event']->getYummyEventImage() != NULL) {
              $eventImage = $this->products[$orderItem]['Event']->getYummyEventImage();
            }

            $datetime = $this->products[$orderItem]['Event']->getDateTime();

            $ticketAmount = $this->currentOrderItems[$orderItem]->getAmount();

            if ($this->products[$orderItem]['Event']->getTicketPrice()) {
              $ticketPrice = $this->products[$orderItem]['Event']->getTicketPrice();
            } else {
              $ticketPrice = $this->currentOrderItems[$orderItem]->getCalcPrice() / $this->currentOrderItems[$orderItem]->getAmount();
            }

            $totalPrice = $this->orderTotal;

            $totalVAT = $this->orderVAT; ?>

          <li class="list-group-item border-0 ">
            <div class="grid ">
              <div class="g-col-2"><img src="/images/<?= $eventImage ?>"
                  class="img-fluid rounded-0 " alt="...">
              </div>
              <div class="g-col-6 text-start align-middle">
                <ul class="list-group">
                  <li class="list-group-item border-0 p-0">
                    <strong>
                      <?= $product ?>
                    </strong>
                  </li>
                  <li class="list-group-item border-0 p-0 pb-2">
                    <?= $datetime ?>
                  </li>
                  <li class="list-group-item border-0 p-0">
                    <strong> &euro;
                      <?= $ticketPrice * $ticketAmount ?>
                    </strong>
                  </li>
                  <li class="list-group-item border-0 p-0">
                    Qty:
                    <?= $ticketAmount?>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <?php }?>
        </ul>
        <order-summary-component></order-summary-component>
        
      </div>
    </div>
  </main>
  <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
<script>var user = <?php echo json_encode($user); ?>;</script>
<script> var totalPrice = "<?php echo $totalPrice; ?>";</script>
<script> var totalVAT= "<?php echo $totalVAT; ?>";</script>
<script src="/scripts/orderItem/components/contactInformation.js"></script>
<script src="/scripts/orderItem/components/orderSummary.js"></script>

</html>