<section>
        <div class='row w-75 small'>
            <div class='col-4 d-flex justify-content-end'>
                <ol type="A">
                    <?php foreach ($locations as $index => $location) { ?>
                        <li>
                            <?php echo $location['location_name']; ?>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class='col-8'>
                <img src="/../images/map-history.png" class="img-fluid">
            </div>
        </div>
        <div class='p-4'>
            <p class='text-center'>The tour begins at the <span class="text-success">Green</span> point A (Church of St.
                Bavo) and ends at the <span class="text-danger">Red</span> point I. The break location (Jopenkerk) is
                marked in Blue at point E.</p>
        </div>
    </section>