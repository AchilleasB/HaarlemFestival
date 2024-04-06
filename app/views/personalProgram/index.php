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

  <?php $paidTickets=$this->paidTickets;?>
    <div class="grid pt-5" style="--bs-columns: 10; --bs-gap: 1rem;">
      <div class="g-col-12">
        <h1>Your personal program</h1>
        <div class="grid py-2 pb-5" style="row-gap: 0;">
    <div class="g-col-2">Share your personal program</div>
    <div class="g-col-8"><img class="pr-2" src="/../icons/facebook.svg"><img class="px-2" src="/../icons/instagram.svg"><img class="px-2" src="/../icons/twitter.svg"></div>

  </div>

  <h2 class="text-center">July</h2>

  <table class="table text-center">
            <thead>
              <tr class="border-bottom border-dark">
                <th></th>
                <th><div>MON</div><div>22</div> </th>
                <th><div>TUE</div><div>23</div> </th>
                <th><div>WED</div><div>24</div> </th>
                <th style="color:red"><div>THU</div><div>25</div> </th>
                <th style="color:red"><div>FRI</div><div>26</div> </th>
                <th style="color:red"><div>SAT</div><div>27</div> </th>
                <th style="color:red"><div>SUN</div><div>28</div> </th>
              </tr>
            </thead>
            <tbody>
            <tr class="hour10am mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">10am</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour11am mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">11am</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour12pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">12pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour13pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">1pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>


          <tr class="hour14pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">2pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour15pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">3pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour16pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">4pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour17pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">5pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour18pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">6pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour19pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">7pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour20pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">8pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour21pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">9pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour22pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">10pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

          <tr class="hour23pm mt-2">
            <td class="border border-dark border-start-0 mt-3 p-3">11pm</td>
            <td class="22July border border-dark mt-3 p-3"></td>
            <td class="23July border border-dark mt-3 p-3"></td>
            <td class="24July border border-dark mt-3 p-3"></td>
            <td class="25July border border-dark mt-3 p-3"></td>
            <td class="26July border border-dark mt-3 p-3"></td>
            <td class="27July border border-dark mt-3 p-3"></td>
            <td class="28July border border-dark mt-3 p-3"></td>

          </tr>

      

          </tbody>
</table>
        <div class="table-responsive">
          <h5>Your items</h5>
          <table id="orderItemsTable" class="table">
            <thead>
              <tr>
                <th></th>
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

                 if ($eventImage = $this->products[$orderItem]['Event']->getArtistImage() != NULL){
                  $eventImage = $this->products[$orderItem]['Event']->getArtistImage();}
                else if ($eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage() != NULL){
                  $eventImage = $this->products[$orderItem]['Event']->getHistoryTourImage();}

                  else if ($eventImage = $this->products[$orderItem]['Event']->getYummyEventImage() != NULL){
                    $eventImage = $this->products[$orderItem]['Event']->getYummyEventImage();}

                $datetime = $this->products[$orderItem]['Event']->getDateTime();

                  $locationName = $this->products[$orderItem]['Event']->getLocationName();

                $locationAddress = $this->products[$orderItem]['Event']->getLocationAddress();
                
                $ticketAmount = $this->currentOrderItems[$orderItem]->getAmount();

                if ( $this->products[$orderItem]['Event']->getTicketPrice()){
                $ticketPrice = $this->products[$orderItem]['Event']->getTicketPrice();}
                else
                {
                  $ticketPrice = $this->currentOrderItems[$orderItem]->getTicketPrice();
                }

                $pricePerItem = $ticketPrice * $ticketAmount;

                $totalPrice = $this->orderTotal;
                $totalVAT = $this->orderVAT;?>

                <td class="align-middle">
                <form method="POST" action="/personalProgram/removeItem">
                    <button class="btn border-0" style="padding:25px;"
                      type=submit name=removeItem
                      value=<?=$orderItem?>>
                      <span id="item<?= $orderItemId ?>"> <img src="/../icons/wishListItem.svg"></span>
                      
                  </button>
                  </form>

                </td>
                
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
                        
                      </ul>
                    </div>
                  </div>
                </td>
                <td class="col-md-2 align-middle">
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
                  <form method="POST" action="/personalProgram/updateTicketQuantity">

                    <input type="number" id="quantity" name="quantity" class="quantity"
                      value=<?= $ticketAmount ?> min="1"
                    max="10">

                    <button id="updateQuantity" class="updateQuantity" type=submit name=update
                      value=<?=$orderItem?>>Save</button>
                    
                    </form>
                </td>
                <td class="align-middle">
                  &euro;
                  <?= $pricePerItem ?>

                </td>
                <td class="align-middle">
                  <form method="POST" action="/personalProgram/addToCart">
                    <button class="rounded-0"
                      id="item<?= $orderItemId ?>" type=submit name=addToCart
                      value=<?=$orderItem?>>Add to cart</button>
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
        <div class="col-md-auto d-flex justify-content-end" > <form  method="" action="/personalProgram/addAllToCart">
          <input class="rounded-0 border py-3 px-5 border border-dark" type=submit name=action id="addAllToCart" value="Add all to cart" />
        </form></div>
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
<script>var paidTickets = <?php echo json_encode($paidTickets); ?>;</script>

<script src="/scripts/orderItem/personalProgram.js"></script>



</html>