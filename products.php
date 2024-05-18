<?php
    include("includes/header.php");
    include('functions/myfunctions.php');

    if(isset($_GET['category'])) {
        $category_slug = $_GET['category'];
        $category_data = getBySlugActive('categories', $category_slug);
        $category = mysqli_fetch_array($category_data);

        if($category) {
        ?>
            <div class="py-3 bg-primary">
                <div class="container">
                    <h6 class="text-white">
                        <a class="text-decoration-none text-white" href="index.php">Home / </a>
                        <a class="text-decoration-none text-white" href="categories.php">Collections / </a>
                        <?=$category['name']; ?> </h6>
                </div>
            </div>
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1><?=$category['name'];?></h1>
                            <hr>
                            <div class="row">

                                <?php
                                    $products = getProductsByCategory($category['id']);

                                    if(mysqli_num_rows($products) > 0) {
                                        foreach($products as $item) {
                                        ?>
                                            <div class="col-md-3 mb-2">
                                                <div class="card shadow">
                                                    <a href="product-view.php?product=<?= $item['slug'];?>" style="text-decoration:none;" class="text-dark">
                                                        <div class="card-body">
                                                            <img src="uploads/<?= $item['image'];?>" alt="<?= $item['name'];?>" class="w-100 mb-2 custom-img">
                                                            <h4 class="text-center"><?= $item['name'];?></h4>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                    else {
                                        echo "No products available.";
                                    }
                                ?>
                            </div>
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
                    <?php echo "Category not found.";  ?>
                </div>
            <div>
        <?php    
        }
    }
    else {
    ?>
        <div class="py-3">
            <div class="container">
                <?php echo "Category not found.";  ?>
            </div>
        <div>
    <?php 
    }

    include("includes/footer.php");
?>