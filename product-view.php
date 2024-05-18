<?php
    include("includes/header.php");
    include('functions/myfunctions.php');

    if(isset($_GET['product'])) {
        $product_slug = $_GET['product'];
        $product_data = getBySlugActive('products', $product_slug);
        $product = mysqli_fetch_array($product_data);

        if($product) {
            $category_data = getCategoryNameById($product['category_id']);
            $category = mysqli_fetch_array($category_data);
        ?>
            <div class="py-3 bg-primary">
                <div class="container">
                    <h6 class="text-white">
                        <a class="text-white" href="index.php">Home / </a>
                        <a class="text-white" href="categories.php">Collections / </a>
                        <a class="text-white" href="products.php?category=<?=$category['slug']; ?>"><?=$category['name']; ?></a> /
                        <a class="text-white" href=""><?=$product['name']; ?></a>
                </div>
            </div>
            <div class="py-5 bg-light">
                <div class="container product_data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="shadow">
                                <img src="uploads/<?=$product['image']; ?>" alt="<?= $product['name']?>" class="w-100">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="fw-bold">
                                <?= $product['name']?>
                                <span class="float-end text-danger">
                                    <?php 
                                        if($product['trending']) { echo "Trending"; }
                                    ?>
                                </span>
                            </h4>
                            <hr>
                            <p><?= $product['small_description']?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="text-success">Rs. <?= $product['selling_price']?></h4>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-danger">Rs. <s><?= $product['original_price']?></s></h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="input-group mb-3" style="width:130px">
                                        <button  class="input-group-text decrement-btn">-</button>
                                        <input type="text" class="form-control text-center bg-white product-qty" disabled value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <input type="hidden" class="product-selling-price" value="<?= $product['selling_price']; ?>">
                                    <button class="btn btn-primary px-4 add-to-cart-btn" value="<?= $product['id']?>"><i class="fa fa-shopping-cart me-2"></i> Add to cart</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i> Add to wishlist</button>
                                </div>
                            </div>

                            <hr>
                            <h6>Description</h6>
                            <p><?= $product['description']?></p>

                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
        else {
        ?>
            <div class="py-3">
                <div class="container">
                    <?php echo "Product not found.";  ?>
                </div>
            <div>
        <?php    
        }
    }
    else {
    ?>
        <div class="py-3">
            <div class="container">
                <?php echo "Product not found.";  ?>
            </div>
        <div>
    <?php 
    }

    include("includes/footer.php");
?>