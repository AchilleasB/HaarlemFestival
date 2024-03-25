<section class="text-center py-3">
    <div class="container">
        <?php if (!empty($organizedTours)) : ?>
            <div class="row justify-content-center">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <?php foreach ($organizedTours as $tour) : ?>
                                    <th scope="col"><?php echo $tour['formatted_date']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class>
                            <?php $times = ['10:00', '13:00', '16:00']; ?>
                            <?php foreach ($times as $time) : ?>
                                <tr>
                                    <td><?php echo $time; ?></td>
                                    <?php foreach ($organizedTours as $tour) : ?>
                                        <td><?php echo $tour[$time] ?? ''; ?></td>
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