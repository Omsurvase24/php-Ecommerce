<?php
    include("includes/header.php");
    include("includes/slider.php");
    include("functions/myfunctions.php");
?>

<?php if(isset($_SESSION['message'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo $_SESSION['message']; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
unset($_SESSION['message']);
} 
?>

<div class="pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <hr>
                <div class="row">
                    <div class="owl-carousel">
                        <?php
                            $trending_products = getAllTrending();

                            if(mysqli_num_rows($trending_products) > 0 ) {
                                foreach($trending_products as $item) {
                                ?>
                                    <div class="item">
                                        <div class="card shadow-xs">
                                            <a href="product-view.php?product=<?= $item['slug'];?>" style="text-decoration:none;" class="text-dark">
                                                <div class="card-body">
                                                    <img src="uploads/<?= $item['image'];?>" alt="<?= $item['name'];?>" class="w-100 mb-2 custom-img" height="100px" width="100px">
                                                    <h6 class="text-center"><?= $item['name'];?></h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container bg-light p-3">
        <div class="row">
            <div class="col-md-12">
                <h4>About Us</h4>
                <hr>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, dignissimos amet doloribus nihil voluptate harum sit velit nam voluptatum ipsa laudantium enim commodi nisi, quisquam repellendus. Nulla quam accusamus cumque.
                </p>
            </div>
        </div>
    </div>
</div>

<?php
    include("includes/footer.php");
?>

<script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
</script>