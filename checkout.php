<?php
    include("includes/header.php");
    include('functions/myfunctions.php');
    include('middleware/userMiddleware.php');
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-decoration-none text-white" href="index.php">Home / </a>
            <a class="text-decoration-none text-white" href="checkout.php">Checkout </a>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <form action="functions/placeorder.php" method="POST">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-body">
                        <h5 class="mb-0">Basic Details</h5>
                        <hr>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="nameInput" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="nameInput" required placeholder="Enter your full name">
                            </div>
                            <div class="col-md-6">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="emailInput" required placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="phoneInput" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phoneInput" required placeholder="Enter your phone number">
                            </div>
                            <div class="col-md-6">
                                <label for="pinCodeInput" class="form-label">Pin Code</label>
                                <input type="text" name="pincode" class="form-control" id="pinCodeInput" required placeholder="Enter your pin code">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="addressInput" class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="addressInput" required name="" rows="6"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="payment_id" value="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-body">
                        <h5 class="mb-0">Order Details</h5>
                        <hr>
                        <?php

                        $items = getCartItems();
                        if(mysqli_num_rows($items) > 0) {
                            $totalPrice = 0;
                            foreach($items as $item) {
                        ?>

                            <div class="card shadow-xs mb-3 product_data p-2">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="uploads/<?= $item['image']?>" alt="<?= $item['name']?>" class="w-100">
                                    </div>
                                    <div class="col-md-5">
                                        <h6><?= $item['name'] ?></h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6><?= $item['selling_price'] ?></h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6>X <?= $item['product_qty'] ?></h6>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $totalPrice += $item['selling_price'] * $item['product_qty'];
                            }
                        }
                        else{
                            echo "No items in cart.";
                        }
                        ?>
                        <hr>
                        <h5>Total Price: <span class="float-end">RS. <?= $totalPrice;?></span></h5>
                        <input type="hidden" name="payment_mode" value="cod">
                        <div class="mt-2">
                            <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Confirm and Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
    include("includes/footer.php");
?>