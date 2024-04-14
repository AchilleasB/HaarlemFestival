<ul class="nav nav-tabs" id="tourCrudTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="addTour-tab" data-bs-toggle="tab" data-bs-target="#add-tour" type="button"
            role="tab" aria-controls="add-tour" aria-selected="true">Add Tour</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="updateTour-tab" data-bs-toggle="tab" data-bs-target="#update-tour" type="button"
            role="tab" aria-controls="update-tour" aria-selected="false">Update Tour</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="deleteTour-tab" data-bs-toggle="tab" data-bs-target="#delete-tour" type="button"
            role="tab" aria-controls="delete-tour" aria-selected="false">Delete Tour</button>
    </li>
</ul>
<div class="tab-content" id="tourTabContent">
    <div class="tab-pane fade show active" id="add-tour" role="tabpanel" aria-labelledby="add-tour-tab">
        <div class="p-5">
            <h2>Add Tour</h2>
            <form action="/api/historyTour/createTour" method="post" enctype="multipart/form-data">
                <label for="add-date">Date:</label>
                <input type="date" class="form-control" id="add-date" name="date" required>

                <label for="add-time">Time:</label>
                <input type="time" class="form-control" id="add-time" name="time" required>

                <label for="add-guide">Guide:</label>
                <select class="form-control" id="add-guide" name="guide" required>
                    <?php foreach ($guides as $guide) : ?>
                    <option value="<?= $guide['id'] ?>"><?= $guide['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="form-group pb-4">
                    <label for="add-seats">Seats:</label>
                    <input type="number" class="form-control" id="add-seats" name="seats" required min="0">
                </div>


                <input type="submit" value="Add Tour" class="btn btn-primary">
            </form>
        </div>
    </div>

    <div class="tab-pane fade" id="update-tour" role="tabpanel" aria-labelledby="update-tour-tab">
        <div class="container">
            <ul class="nav nav-tabs" id="tourTabs" role="tablist">
                <?php foreach ($tours as $tour) : ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tour-tab-<?= $tour['id'] ?>" data-bs-toggle="tab"
                        data-bs-target="#tour-<?= $tour['id'] ?>" type="button" role="tab"
                        aria-controls="tour-<?= $tour['id'] ?>" aria-selected="false">
                        <?= date('M d, Y - H:i', strtotime($tour['date'] . ' ' . $tour['time'])) ?>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="tourTabContent">
                <?php foreach ($tours as $tour) : ?>
                <div class="tab-pane fade" id="tour-<?= $tour['id'] ?>" role="tabpanel"
                    aria-labelledby="tour-tab-<?= $tour['id'] ?>">
                    <div class="p-5">
                        <h2>Update Tour</h2>
                        <form action="/api/historyTour/updateTour" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $tour['id'] ?>">

                            <div class="form-group">
                                <label for="update-date">Date:</label>
                                <input type="date" class="form-control" id="update-date" name="date"
                                    value="<?= date('Y-m-d', strtotime($tour['date'])) ?>" required>
                            </div>

                            <label for="update-time">Time:</label>
                            <input type="time" class="form-control" id="update-time" name="time"
                                value="<?= date('H:i', strtotime($tour['time'])) ?>" required>

                            <div class="form-group">
                                <label for="update-guide">Guide:</label>
                                <select class="form-control" id="update-guide" name="guide" required>
                                    <?php foreach ($guides as $guide) : ?>
                                    <option value="<?= $guide['id'] ?>"
                                        <?php if ($tour['guide'] == $guide['id']) echo 'selected'; ?>>
                                        <?= $guide['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group pb-4">
                                <label for="update-seats">Seats:</label>
                                <input type="number" class="form-control" id="update-seats" name="seats"
                                    value="<?= $tour['seats'] ?>" required min="0">
                            </div>

                            <input type="submit" value="Update Tour" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="delete-tour" role="tabpanel" aria-labelledby="delete-tour-tab">
        <div class="p-5">
            <h2>Delete Tour</h2>
            <form action="/api/historyTour/deleteTour" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tour ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Guide</th>
                            <th>Seats</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour) : ?>
                        <tr>
                            <td><?= $tour['id'] ?></td>
                            <td><?= $tour['date'] ?></td>
                            <td><?= $tour['time'] ?></td>
                            <td>
                                <?php
                                $guideName = '';
                                foreach ($guides as $guide) {
                                    if ($guide['id'] == $tour['guide']) {
                                        $guideName = $guide['name'];
                                        break;
                                    }
                                }
                                echo $guideName;
                                ?>
                            </td>
                            <td><?= $tour['seats'] ?></td>
                            <td><input type="checkbox" name="toursToDelete[<?= $tour['id'] ?>]"
                                    value="<?= $tour['id'] ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="submit" value="Delete Selected Tours" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>