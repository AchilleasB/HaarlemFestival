<section class="container border-secondary">
    <form id="ticketForm" class="mt-5"
        data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
        <div class="row mb-3">
            <div class="col">
                <label for="languageSelect" class="form-label">Language</label>
                <select class="form-select" id="languageSelect" name="language">
                    <option value="" selected disabled>Select Language</option>
                    <?php foreach ($languages as $language) : ?>
                    <option value="<?php echo $language; ?>"><?php echo $language; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="dateSelect" class="form-label">Date</label>
                <select class="form-select" id="dateSelect" name="date">
                    <option value="" selected disabled>Select Date</option>
                    <?php foreach ($dates as $date) : ?>
                    <?php $formattedDate = date('j F', strtotime($date)); ?>
                    <option value="<?php echo $date; ?>"><?php echo $formattedDate; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="timeSelect" class="form-label">Time</label>
                <select class="form-select" id="timeSelect" name="time">
                    <option value="" selected disabled>Select Time</option>
                    <?php foreach ($times as $time) : ?>
                    <?php $formattedTime = date('H:i', strtotime($time)); ?>
                    <option value="<?php echo $time; ?>"><?php echo $formattedTime; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="quantitySelect" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantitySelect" name="quantity" min="1" value="1">
            </div>
            <div class="col">
                <label for="ticketTypeSelect" class="form-label">Ticket Type</label>
                <select class="form-select" id="ticketTypeSelect" name="ticketType">
                    <option value="" selected disabled>Select Ticket</option>
                    <?php foreach ($ticketTypes as $type) : ?>
                    <option value="<?php echo $type['ticket_type']; ?>">
                        <?php echo $type['ticket_type'] . ' - ' . $type['price'] . ' EUR'; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row p-5 mt-5">
            <div class="col text-center">
                <button type="submit" class="btn btn-block btn-warning text-white">Add to Cart <i
                        class="bi bi-cart4"></i></button>
            </div>
        </div>
    </form>
</section>