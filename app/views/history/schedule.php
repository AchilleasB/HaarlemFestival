<section class="text-center py-3">
    <div class="container">
        <?php if (!empty($organizedTours)) : ?>
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-bordered custom-table text-center">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <?php foreach ($organizedTours as $date => $tourData) : ?>
                            <th scope="col"><?php echo date('d F', strtotime($date)); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($times as $time) : ?>
                        <tr>
                            <td><?php echo date('H:i', strtotime($time)); ?></td>
                            <?php foreach ($organizedTours as $tour) : ?>
                            <td>
                                <?php
                                            if (isset($tour[$time])) {
                                                if (is_array($tour[$time])) {
                                                    foreach ($tour[$time] as $guide) {
                                                        echo $guide . "<br>";
                                                    }
                                                } else {
                                                    echo $tour[$time];
                                                }
                                            }
                                            ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else : ?>
        <p>No history tours found.</p>
        <?php endif; ?>
    </div>
</section>