<?php
    include("includes/header.php");
    include('functions/myfunctions.php');
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-decoration-none text-white" href="index.php">Home / </a>
            <a class="text-decoration-none text-white" href="categories.php">Collections </a>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our Collections</h2>
                <hr>
                <div class="row">

                    <?php
                        $categories = getAllActive('categories');

                        if(mysqli_num_rows($categories) > 0) {
                            foreach($categories as $item) {
                            ?>
                                <div class="col-md-3 mb-2">
                                    <div class="card shadow">
                                        <a href="products.php?category=<?= $item['slug'];?>" style="text-decoration:none;" class="text-dark">
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
                            echo "No categories available.";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include("includes/footer.php");
?>