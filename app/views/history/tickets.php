 <div class="container">
        <form id="ticketForm" class="mt-5">
            <div class="row mb-3">
                <div class="col">
                    <label for="languageSelect" class="form-label">Language</label>
                    <select class="form-select" id="languageSelect" name="language">
                        <option value="" selected>Select Language</option>
                        <?php
                            $repository = new HistoryTourRepository();
                            $languages = $repository->getLanguages();
                            foreach ($languages as $language) {
                                echo "<option value='$language'>$language</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="dateSelect" class="form-label">Date</label>
                    <select class="form-select" id="dateSelect" name="date">
                        <option value="" selected>Select Date</option>
                        <?php
                            $dates = $repository->getDates();
                            foreach ($dates as $date) {
                                echo "<option value='$date'>$date</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="timeSelect" class="form-label">Time</label>
                    <select class="form-select" id="timeSelect" name="time">
                        <option value="" selected>Select Time</option>
                        <?php
                            $times = $repository->getTimes();
                            foreach ($times as $time) {
                                echo "<option value='$time'>$time</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="quantitySelect" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantitySelect" name="quantity" min="1" value="1">
                </div>
                <div class="col">
                    <label for="ticketTypeSelect" class="form-label">Ticket Type</label>
                    <select class="form-select" id="ticketTypeSelect" name="ticketType">
                        <option value="single" selected>Single (12 EUR)</option>
                        <option value="family">Family (60 EUR)</option>
                    </select>
                </div>
            </div>
            <div class="row p-5">
                <div class="col text-center">
                    <button type="submit" class="btn btn-warning text-white">Add to Cart</button>
                </div>
            </div>
        </form>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    