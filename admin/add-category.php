<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');
?>
    <div class="container">
        <div class="row">
          <div class="col md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0" for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter category name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="slug">Slug</label>
                                <input type="text" id="slug" name="slug" placeholder="Enter slug" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="description">Description</label>
                            <textarea row=3 id="description" name="description" placeholder="Enter description" class="form-control mb-2"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-0" for="image">Upload Image</label>
                            <input type="file" id="image" name="image" placeholder="Enter slug" class="form-control mb-2">
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
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0" for="status">Status</label>
                                <input type="checkbox" id="status" name="status" >
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0" for="popular">Popular</label>
                                <input type="checkbox" id="popular" name="popular" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary" name="add_category_btn" type="Submit">Save</button>
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