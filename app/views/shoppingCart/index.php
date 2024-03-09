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
    ?>
  <main class="border border-white">
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
                <?php $product = $this->products[$orderItem]['Event']->getName()?>
                <td class="col-md-4 text-start">
                  <div class="grid py-2">
                    <div class="g-col-4"><img id="productImg"
                        src="/images/<?= $this->products[$orderItem]['Event']->getArtistImage()?>"
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
                      <?php  if ($this->products[$orderItem]['Event']->getLocationName() != "") { ?>
                    <li class="list-group-item border-0 pt-5">
                      <strong>
                        <?= $this->products[$orderItem]['Event']->getLocationName() ?>
                      </strong>,
                      <?= $this->products[$orderItem]['Event']->getLocationAddress() ?>
                    </li>
                    <?php }
                    else { ?>
                    <li class="list-group-item border-0 pt-5">
                      <strong>
                        <?= $this->products[$orderItem]['Event']->getLocationName() ?>
                      </strong>
                    </li>
                    <?php } ?>
                    <li class="list-group-item border-0 pt-5">
                      <?= $this->products[$orderItem]['Event']->getDateTime() ?>
                    </li>
                  </ul>
                </td>
                <td class="align-middle">
                  <div class="quantityValues m-1">
                  <form method="POST" action="/shoppingCart/UpdateTicketQuantity">

                    <input type="number" id="quantity" name="quantity" class="quantity"
                      value=<?=$this->currentOrderItems[$orderItem]->getAmount()?> min="1"
                    max="10">

                    <button id="updateQuantity" class="updateQuantity" type=submit name=update
                      value=<?=$orderItem?>>Save<span id="orderItemId"
                        style="display:none">
                        <?= $this->currentOrderItems[$orderItem]->getId() ?>
                      </span></button>
                    
                    </form>
                    <?php  if ($this->products[$orderItem]['Event']->getTicketsAvailable() > 0) {?>
                    <div>Only
                      <?= $this->products[$orderItem]['Event']->getTicketsAvailable() ?> left
                    </div>
                    <?php } 
                  else {?>
                    <div> Sold out</div>
                    <?php }?>
                </td>
                <td class="align-middle">
                  &euro;
                  <?= $this->products[$orderItem]['Event']->getTicketPrice() * $this->currentOrderItems[$orderItem]->getAmount() ?>
                </td>
                <td class="align-middle">
                  <form method="POST" action="/shoppingCart/removeItem">
                    <button class="removeItem btn border-0"
                      id="item<?= $this->currentOrderItems[$orderItem]->getId() ?>" type=submit name=removeItem
                      value=<?=$orderItem?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
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
        <a href="/">
          <button class="rounded-0 px-5 py-2 mt-5" type=submit name=browse id="browse">Continue
            browsing</button>
        </a>
      </div>
      <div class="g-col-3 bg-light text-center" style="row-gap: 0; height: 200px">
        <div class="border-bottom">
          <p class="h5">Order summary</p>
        </div>
        <div class="grid py-2" style="row-gap: 0;">
          <div class="g-col-4  text-start">Sub-total(Net)</div>
          <div class="g-col-6  text-end">&euro;
            <?= $this->orderTotal - $this->orderVAT?>
          </div>
        </div>
        <div class="grid py-2" style="row-gap: 0;">
          <div class="g-col-4 text-start">VAT(21%)</div>
          <div class="g-col-6 text-end">&euro;
            <?= $this->orderVAT ?>
          </div>
        </div>
        <div class="grid py-2" style="row-gap: 0;">
          <div class="g-col-4  text-start"><strong>Total:</strong></div>
          <div class="g-col-6 text-end"><strong>&euro;
              <?= $this->orderTotal ?>
            </strong></div>
        </div>
        <form method="" action="/shoppingCart/selectPaymentMethod">
          <input class="rounded-0 py-3 w-100 " type=submit name=action id="checkoutBtn" value="CHECKOUT NOW" />
        </form>
        <div class="grid ">
          <div class="g-col-2 ">Payment methods</div>
          <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266085/ideal.svg" width="64" height="64"></div>
          <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266070/visa.svg" width="64" height="64"></div>
          <div class="g-col-2 "><img src="https://www.svgrepo.com/show/266087/master-card.svg" width="64" height="64">
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php
    include __DIR__ . '/../footer.php';
    ?>
</body>
<script src="/scripts/shoppingcart/shoppingcart.js"></script>
</html>