<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');
?>
    <div class="container">
        <div class="row">
          <div class="col md-12">
            <?php 
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = getById('categories', $id);

                if(mysqli_num_rows($category) > 0) {
                    $data = mysqli_fetch_array($category);
                ?>
                <div class="card">
                    <div class="card-header flex">
                        <h4>Edit Category</h4>
                        <a href="category.php" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="category_id" value="<?= $data['id']?>">
                                    <label for="name">Name</label>
                                    <input type="text" value="<?= $data['name']?>" id="name" name="name" placeholder="Enter category name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="slug">Slug</label>
                                    <input type="text" value="<?= $data['slug']?>" id="slug" name="slug" placeholder="Enter slug" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea row=3 id="description" name="description" placeholder="Enter description" class="form-control"><?= $data['description']?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <label for="image">Current Image</label>
                                <input type="hidden" name="old_image" value="<?= $data['image']?>">
                                <img src="../uploads/<?= $data['image']?>" style="width:80px; height:50px; margin-top:10px;">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" value="<?= $data['meta_title']?>" id="meta_title" name="meta_title" placeholder="Enter meta title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="meta_description">Meta Description</label>
                                <textarea row=3 id="meta_description" name="meta_description" placeholder="Enter meta description" class="form-control"><?= $data['meta_description']?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea row=3 id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"><?= $data['meta_keywords']?></textarea>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <input type="checkbox" id="status" name="status" <?= $data['status'] ? 'checked' : '' ?> >
                                </div>
                                <div class="col-md-6">
                                    <label for="popular">Popular</label>
                                    <input type="checkbox" id="popular" name="popular" <?= $data['popular'] ? 'checked' : '' ?> >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" name="update_category_btn" type="Submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>  
                <?php
                }
                else {
                    echo "Category not found.";
                }
            }
            else {
                echo "Something went wrong. Please try again.";
            }
            ?>
          </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>