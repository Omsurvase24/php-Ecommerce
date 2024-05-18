<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');
?>
    <div class="container">
        <div class="row">
          <div class="col md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-0" for="name">Select Category</label>
                                <select name="category_id" class="form-control mb-2" style="padding-left:10px; padding-right:10px;">
                                    <option disabled selected>Select category</option>
                                    <?php 
                                        $categories = getAll('categories');

                                        if(mysqli_num_rows($categories) > 0) {
                                            foreach($categories as $item) {
                                                ?>
                                                    <option value="<?= $item['id']?>"><?= $item['name']?></option>
                                                <?php
                                            }
                                        }
                                        else {
                                            echo "No category available";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter product name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" placeholder="Enter slug" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="small_description">Small Description</label>
                            <textarea row=3 id="small_description" name="small_description" placeholder="Enter small description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="description">Description</label>
                            <textarea row=3 id="description" name="description" placeholder="Enter description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <label class="mb-0" for="original_price">Original Price</label>
                                    <input type="text" id="original_price" name="original_price" placeholder="Enter original price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="selling_price">Selling Price</label>
                                <input type="text" id="selling_price" name="selling_price" placeholder="Enter selling price" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="image">Upload Image</label>
                            <input type="file" id="image" name="image" placeholder="Enter slug" class="form-control mb-2">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mb-0" for="qty">Quantity</label>
                                <input type="number" id="qty" name="qty" placeholder="Enter quantity" class="form-control mb-2">
                            </div>
                            <div class="col-md-4">
                                <label class="mb-0" for="status">Status</label><br>
                                <input type="checkbox" id="status" name="status" >
                            </div>
                            <div class="col-md-4">
                                <label class="mb-0" for="trending">Trending</label><br>
                                <input type="checkbox" id="trending" name="trending" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" placeholder="Enter meta title" class="form-control mb-2">
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="meta_description">Meta Description</label>
                            <textarea row=3 id="meta_description" name="meta_description" placeholder="Enter meta description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="meta_keywords">Meta Keywords</label>
                            <textarea row=3 id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" name="add_product_btn" type="Submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>