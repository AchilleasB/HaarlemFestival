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
    require __DIR__ . '/../../config/urlconfig.php';

    ?>
  <main style="margin-bottom:100px;">
    <div class="grid pt-5" style="--bs-columns: 10; --bs-gap: 1rem;">
      <div class="g-col-7">
        <div class="table-responsive">
          <h5>Your items</h5>
          <table id="orderItemsTable" class="table">
            <thead>
              <tr>
                <th class="text-start">Attraction/Event</th>
                <th>Date & Location </th>
                <th>Quantity</th>
                <th>Total price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($this->products as $orderItem=>$i) {    ?>
              <tr class="product bg-white">
                <?php $product = $this->products[$orderItem]['Event']->getName();

                $orderItemId = $this->currentOrderItems[$orderItem]->getId();

                if ($eventImage = $this->products[$orderItem]['Event']->getArtistImage() != NULL) {
                  $eventImage = $this->products[$orderItem]['Event']->getArtistImage();
                } else if ($eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage() != NULL) {
                  $eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage();
                } else if ($eventImage = $this->products[$orderItem]['Event']->getYummyEventImage() != NULL) {
                  $eventImage = $this->products[$orderItem]['Event']->getYummyEventImage();
                }

                $locationName = $this->products[$orderItem]['Event']->getLocationName();

                $locationAddress = $this->products[$orderItem]['Event']->getLocationAddress();

                $datetime = $this->products[$orderItem]['Event']->getDateTime();

                $ticketAmount = $this->currentOrderItems[$orderItem]->getAmount();

                if ($this->products[$orderItem]['Event']->getTicketPrice()) {
                  $ticketPrice = $this->products[$orderItem]['Event']->getTicketPrice();
                } else {
                  $ticketPrice = $this->currentOrderItems[$orderItem]->getTicketPrice();
                }

                $pricePerItem = $ticketPrice * $ticketAmount;

                $ticketsAvailableForEvent = $this->products[$orderItem]['Event']->getTicketsAvailable();

                $totalPrice = $this->orderTotal;

                $totalVAT = $this->orderVAT; ?>
                
                <td class="itemId" style="display:none"><?= $orderItemId ?></td>
                <td class="col-md-4 text-start align-middle">
                  <div class="grid py-2">
                    <div class="g-col-4"><img id="productImg"
                        src="/images/<?= $eventImage?>"
                        class="img-fluid rounded-0" alt="...">
                    </div>
                    <div class="g-col-4">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ">
                          <strong>
                            <?= $product ?>
                          </strong>
                        </li>
                        <li class="list-group-item border-0 pt-5">
                          <span class=" text-decoration-underline"> <a href="" class="text-dark"> Click here for event
                              details</a> </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </td>
                <td class="col-md-2">
                  <ul class="list-group ">
                    <li class="list-group-item border-0">
                      <?php  if ($locationName != "" AND $locationAddress !=NULL) { ?>
                    <li class="list-group-item border-0 pt-5">
                      <strong>
                        <?= $locationName ?>
                      </strong>,
                      <?= $locationAddress ?>
                    </li>
                    <?php }
                    else if ($locationName != NULL){ ?>
                    <li class="list-group-item border-0 pt-5">
                      <strong>
                        <?= $locationName ?>
                      </strong>
                    </li>
                    <?php } ?>
                    <li class="list-group-item border-0 pt-5">
                      <?= $datetime ?>
                    </li>
                  </ul>
                </td>
                <td class="align-middle">
                  <div class="quantityValues m-1">
                  <form method="POST" action="/shoppingCart/updateTicketQuantity">

                    <input type="number" id="quantity" name="quantity" class="quantity"
                      value=<?= $ticketAmount ?> min="1"
                    max="10">

                    <button id="updateQuantity" class="updateQuantity" type=submit name=update
                      value=<?=$orderItem?>>Save</button>
                    
                    </form>
                    <?php  if ($ticketsAvailableForEvent > 0) {?>
                    <div>Only
                      <?= $ticketsAvailableForEvent ?> left
                    </div>
                    <?php } 
                  else {?>
                    <div> Sold out</div>
                    <div>You can't purchase more tickets than the quantity selected</div>
                    <?php }?>
                </td>
                <td class="align-middle">
                  &euro;
                  <?= $pricePerItem; ?>
                </td>
                <td class="align-middle">
                  <form method="POST" action="/shoppingCart/removeItem">
                    <button class="btn border-0" style="padding:25px;" type=submit name=removeItem value=<?=$orderItem?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                      </svg></button>
                  </form>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <?php  if (count($this->currentOrderItems) > 0) {?>
        <div class="px-3 col-md-auto border-bottom text-end">
          <h5>Total: &euro;
            <?= $this->orderTotal ?>
          </h5>
        </div>
        <?php }
        else {?>
        <div class="px-3 col-md-auto border-bottom text-start">
          <h5 style="margin-left:100px">None
          </h5>
        </div>
        <?php } ?>
        <a href="/festival">
          <button class="rounded-0 px-5 py-2 mt-5" type=submit name=browse id="browse">Continue
            browsing</button>
        </a>
      </div>
      <div class="g-col-3 bg-light text-center" style="row-gap: 0; height: 200px">
      <order-summary-component></order-summary-component>

        <form method="" action="/shoppingCart/selectPaymentMethod">
          <input class="rounded-0 py-3 w-100 " type=submit name=action id="checkoutBtn" value="CHECKOUT NOW" />
        </form>
        <div>
       <payment-methods-component></payment-methods-component>
        </div>
        </div>
      </div>
    </div>
  </main>
  <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
<script> var urlBasePath = "<?php echo  $urlBasePath; ?>";</script>
<script> var totalPrice = "<?php echo $totalPrice; ?>";</script>
<script> var totalVAT= "<?php echo $totalVAT; ?>";</script>
<script src="/scripts/orderItem/orderItem.js"></script>
<script src="/scripts/orderItem/components/paymentMethods.js"></script>
<script src="/scripts/orderItem/components/orderSummary.js"></script>

</html>