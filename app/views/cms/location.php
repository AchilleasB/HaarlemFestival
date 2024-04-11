<ul class="nav nav-tabs" id="locationCrudTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="addLocation-tab" data-bs-toggle="tab" data-bs-target="#add-location"
            type="button" role="tab" aria-controls="add-location" aria-selected="true">Add Location</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="updateLocation-tab" data-bs-toggle="tab" data-bs-target="#update-location"
            type="button" role="tab" aria-controls="update-location" aria-selected="false">Update Location</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="deleteLocation-tab" data-bs-toggle="tab" data-bs-target="#delete-location"
            type="button" role="tab" aria-controls="delete-location" aria-selected="false">Delete Location</button>
    </li>
</ul>

<div class="tab-content" id="locationTabContent">

    <div class="tab-pane fade show active" id="add-location" role="tabpanel" aria-labelledby="add-location-tab">
        <div class="p-5">
            <h2>Add Location</h2>
            <form action="/api/historyTour/createLocation" method="post" enctype="multipart/form-data">
                <label for="add-location-name">Location Name:</label>
                <textarea id="add-location-name" name="location_name"></textarea><br><br>

                <label for="add-address">Address:</label>
                <textarea id="add-address" name="address"></textarea><br><br>

                <label for="add-description">Description:</label><br>
                <textarea id="add-description" name="description"></textarea><br><br>

                <label for="add-links">Links:</label><br>
                <textarea id="add-links" name="links"></textarea><br><br>

                <input type="submit" value="Add Location" class="btn btn-primary">
            </form>
        </div>
    </div>

    <div class="tab-pane fade" id="update-location" role="tabpanel" aria-labelledby="update-location-tab">
        <div class="container">
            <ul class="nav nav-tabs" id="locationTabs" role="tablist">
                <?php foreach ($locations as $location) : ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="location-tab-<?= $location['id'] ?>" data-bs-toggle="tab"
                        data-bs-target="#location-<?= $location['id'] ?>" type="button" role="tab"
                        aria-controls="location-<?= $location['id'] ?>"
                        aria-selected="false"><?= $location['location_name'] ?></button>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="locationTabContent">
                <?php foreach ($locations as $location) : ?>
                <div class="tab-pane fade" id="location-<?= $location['id'] ?>" role="tabpanel"
                    aria-labelledby="location-tab-<?= $location['id'] ?>">
                    <div class="p-5">
                        <h2>Update Location</h2>
                        <form action="/api/historyTour/updateLocation" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $location['id'] ?>">
                            <label for="update-location-name">Location Name:</label>
                            <textarea id="update-location-name" name="location_name" rows="1" cols="50"
                                required><?= $location['location_name'] ?></textarea><br><br>

                            <label for="update-address">Address:</label>
                            <textarea id="update-address" name="address" rows="4"
                                cols="50"><?= $location['address'] ?></textarea><br><br>

                            <label for="update-description">Description:</label><br>
                            <textarea id="update-description" name="description" rows="4"
                                cols="50"><?= $location['description'] ?></textarea><br><br>

                            <label for="update-links">Links:</label><br>
                            <textarea id="update-links" name="links" rows="4"
                                cols="50"><?= $location['links'] ?></textarea><br><br>

                            <input type="submit" value="Update Location" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="delete-location" role="tabpanel" aria-labelledby="delete-location-tab">
        <div class="p-5">
            <h2>Delete Location</h2>
            <form action="/api/historyTour/deleteLocation" method="post">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Location ID</th>
                            <th>Location Name</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Links</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($locations as $location) : ?>
                        <tr>
                            <td><?= $location['id'] ?></td>
                            <td><?= !empty($location['location_name']) ? $location['location_name'] : 'null' ?></td>
                            <td><?= !empty($location['address']) ? $location['address'] : 'null' ?></td>
                            <td><?= !empty($location['description']) ? $location['description'] : 'null' ?></td>
                            <td><?= !empty($location['links']) ? $location['links'] : 'null' ?></td>
                            <td><input type="checkbox" name="locationsToDelete[<?= $location['id'] ?>]"
                                    value="<?= $location['id'] ?>"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="submit" value="Delete Selected Locations" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>