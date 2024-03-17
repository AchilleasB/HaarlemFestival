<section class="d-flex justify-content-center py-5">
    <div class="container" style="max-width: 800px;">
        <?php foreach ($locations as $index => $location) { ?>
            <div class="row gray-bg p-4 mb-4">
                <div class="col-8">
                    <h3>
                        <?php echo ($index + 1) . '. ' . $location['location_name']; ?>
                    </h3>
                    <p class="text-muted">
                        <?php echo $location['description']; ?>
                    </p>
                    <a href="<?php echo $location['links']; ?>" class="btn btn-outline-secondary" target="_blank">Learn more</a>
                </div>
                <div class="col-4">
                    <?php 
                    $imageSrc = !empty($location['image']) ? "../../images/history/".$location['image'] : "../../images/no-image.jpg"; 
                    ?>
                    <img src="<?php echo $imageSrc; ?>" class="img-fluid" style="width: 300px; height: 170px;" alt="Location Image">
                </div>
            </div>
        <?php } ?>
    </div>
</section>