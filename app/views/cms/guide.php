<ul class="nav nav-tabs" id="guideCrudTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="addGuide-tab" data-bs-toggle="tab" data-bs-target="#add-guide" type="button" role="tab" aria-controls="add-guide" aria-selected="true">Add Guide</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="updateGuide-tab" data-bs-toggle="tab" data-bs-target="#update-guide" type="button" role="tab" aria-controls="update-guide" aria-selected="false">Update Guide</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deleteGuide-tab" data-bs-toggle="tab" data-bs-target="#delete-guide" type="button" role="tab" aria-controls="delete-guide" aria-selected="false">Delete Guide</button>
        </li>
    </ul>
    <div class="tab-content" id="guideTabContent">
        <div class="tab-pane fade show active" id="add-guide" role="tabpanel" aria-labelledby="addGuide-tab">
            <div class="p-5">
                <h2>Add Guide</h2>
                <form action="/cms/createGuide" method="post">
                    <label for="add-guide-name">Name:</label>
                    <textarea type="text" id="add-guide-name" name="name"></textarea><br><br>

                    <label for="add-guide-language">Language:</label>
                    <textarea type="text" id="add-guide-language" name="language"></textarea><br><br>

                    <input type="submit" value="Add Guide" class = "btn btn-primary">
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="update-guide" role="tabpanel" aria-labelledby="updateGuide-tab">
        <div class="container">
            <ul class="nav nav-tabs" id="guideTabs" role="tablist">
                <?php foreach ($guides as $guide) : ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guide-tab-<?= $guide['id'] ?>" data-bs-toggle="tab" data-bs-target="#guide-<?= $guide['id'] ?>" type="button" role="tab" aria-controls="guide-<?= $guide['id'] ?>" aria-selected="false"><?= $guide['name'] ?></button>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="guideTabContent">
                <?php foreach ($guides as $guide) : ?>
                    <div class="tab-pane fade" id="guide-<?= $guide['id'] ?>" role="tabpanel" aria-labelledby="guide-tab-<?= $guide['id'] ?>">
                        <div class="p-5">
                            <h2>Update Guide</h2>
                <form action="/cms/updateGuide" method="post">
                <input type="hidden" name="id" value="<?= $guide['id'] ?>">
                <div class="form-group">
                                <label for="update-guide-name">Name:</label>
                                <textarea id="update-guide-name" name="name" rows="1" cols="50"><?= $guide['name'] ?></textarea><br><br>
                            </div>
                            <div class="form-group">
                                <label for="update-guide-language">Language:</label>
                                <textarea id="update-guide-language" name="language" rows="1" cols="50"><?= $guide['language'] ?></textarea><br><br>
                            </div>

                    <input type="submit" value="Update Guide" class = "btn btn-primary">
                </form>
            </div>
        </div>
        <?php endforeach; ?>
            </div>
        </div>
    </div>
        <div class="tab-pane fade" id="delete-guide" role="tabpanel" aria-labelledby="deleteGuide-tab">
            <div class="p-5">
                <h2>Delete Guide</h2>
                <form action="/cms/deleteGuide" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Guide ID</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guides as $guide) : ?>
                                <tr>
                                    <td><?= $guide['id'] ?></td>
                                    <td><?= $guide['name'] ?></td>
                                    <td><?= $guide['language'] ?></td>
                                    <td><input type="checkbox" name="guidesToDelete[]" value="<?= $guide['id'] ?>"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <input type="submit" value="Delete Selected Guides" class = "btn btn-primary">
                </form>
            </div>
        </div>
    </div>