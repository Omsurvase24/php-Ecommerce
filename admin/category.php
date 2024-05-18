<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Categories</h4>
                    </div>
                    <div class="card-body" id="category_table">
                        <?php
                        $category = getAll('categories');

                        if(mysqli_num_rows($category) > 0) {
                        ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($category as $item) {
                                    ?>
                                        <tr>
                                            <td><?= $item['id']?></td>
                                            <td><?= $item['name']?></td>
                                            <td><img src="../uploads/<?= $item['image'];?>" alt="<?= $item['name']?>" style="width:80px; height:50px;"></td>
                                            <td><?= $item['status'] == 0 ? 'Visible' : 'Hidden' ?></td>
                                            <td><a href="edit-category.php?id=<?= $item['id']?>" class="btn btn-primary">Edit</a></td>
                                            <td>
                                                <button class="btn btn-danger delete_category_btn" type="button" value="<?= $item['id']?>">Delete</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        else {
                            echo "No records found.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>