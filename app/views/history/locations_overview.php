<section class='py-3'>
    <div class='row w-75 small'>
        <div class='col-4 d-flex justify-content-end'>
            <ol type="A">
                <?php foreach ($locations as $index => $location) { ?>
                <li>
                    <?php echo $location->getLocationName(); ?>
                </li>
                <?php } ?>
            </ol>
        </div>
        <div class='col-8 px-4'>
            <iframe
                src="https://www.google.com/maps/d/u/1/embed?mid=1gbTLEaenCOggNmicRBhyuYjcSll5FDs&ehbc=2E312F&noprof=1"
                width="680" height="520"></iframe>
        </div>
    </div>
    <div class='p-4'>
        <p class='text-center'>The tour begins at the <span class="text-success">Green</span> point A (Church of St.
            Bavo) and ends at the <span class="text-danger">Red</span> point I. The break location (Jopenkerk) is
            marked in Blue at point E.</p>
    </div>
</section>