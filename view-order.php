<?php
    include("includes/header.php");
    include('functions/myfunctions.php');
    include('middleware/userMiddleware.php');

    if(isset($_GET['tracking-id'])) {
        $tracking_id = $_GET['tracking-id'];

        $order_data = validateTrackingId($tracking_id);
        if(mysqli_num_rows($order_data) < 0) {
        ?>
            <div class="py-3">
                <div class="container">
                    Something went wrong. Please try again.
                </div>
            </div>
        <?php 
            exit;
        }
    }
    else {
    ?>
        <div class="py-3">
            <div class="container">
                Something went wrong. Please try again.
            </div>
        </div>
    <?php
        exit;
    }

    $data = mysqli_fetch_array($order_data);
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-decoration-none text-white" href="index.php">Home / </a>
            <a class="text-decoration-none text-white" href="my-orders.php">My Orders /</a>
            <a class="text-decoration-none text-white" href="">View Order </a>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="text-white fs-4">View Order </span>
                        <a href="my-orders.php" class="btn btn-warning float-end"><i class="fa fa-reply me-2"></i>Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Delivery Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Name</label>
                                        <div class="border p-1">
                                            <?= $data['name']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Email</label>
                                        <div class="border p-1">
                                            <?= $data['email']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Phone</label>
                                        <div class="border p-1">
                                            <?= $data['phone']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Tracking ID</label>
                                        <div class="border p-1">
                                            <?= $data['tracking_id']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Address</label>
                                        <div class="border p-1">
                                            <?= $data['address']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label style="font-weight:500;" for="">Pincode</label>
                                        <div class="border p-1">
                                            <?= $data['pincode']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $user_id = $_SESSION['auth_user']['user_id'];

                                            $order_query = "SELECT o.id as oid, o.tracking_id, o.user_id, oi.*, oi.qty as order_qty, p.* FROM orders o, order_items oi, products p WHERE o.user_id = '$user_id' AND oi.order_id = o.id AND p.id = oi.product_id AND o.tracking_id = '$tracking_id'";
                                            $order_query_run = mysqli_query($conn, $order_query);
                                            
                                            if(mysqli_num_rows($order_query_run) > 0) {
                                                foreach($order_query_run as $item) {
                                                ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="uploads/<?= $item['image']?>" alt="<?= $item['name']?>" width="50px" height="50px">
                                                        </td>
                                                        <td class="align-middle"><?= $item['price']?></td>
                                                        <td class="align-middle">X <?= $item['order_qty']?></td>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>

                                <hr>
                                <h4>Total Price: <span class="float-end">RS. <?= $data['total_price']; ?></span></h4>
                                <hr>

                                <label style="font-weight:500;" for="">Payment Mode</label>
                                <div class="border p-1 mb-3">
                                    <?= $data['payment_mode']?>
                                </div>
                                <label style="font-weight:500;" for="">Status</label>
                                <div class="border p-1 mb-3">
                                    <?php 
                                        if($data['status'] == 0) {
                                            echo "Under Process";
                                        }
                                        else if($data['status'] == 1) {
                                            echo "Completed";
                                        }
                                        else if($data['status'] == 2) {
                                            echo "Canceled";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include("includes/footer.php");
?>