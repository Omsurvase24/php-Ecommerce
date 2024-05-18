<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');

    if(isset($_GET['tracking-id'])) {
        $tracking_id = $_GET['tracking-id'];

        $order_data = validateTrackingIdAdmin($tracking_id);
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
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

                                            $order_query = "SELECT o.id as oid, o.tracking_id, o.user_id, oi.*, oi.qty as order_qty, p.* FROM orders o, order_items oi, products p WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.tracking_id = '$tracking_id'";
                                            $order_query_run = mysqli_query($conn, $order_query);
                                            
                                            if(mysqli_num_rows($order_query_run) > 0) {
                                                foreach($order_query_run as $item) {
                                                ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="../uploads/<?= $item['image']?>" alt="<?= $item['name']?>" width="50px" height="50px">
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
                                <div class="p-1 mb-3">
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="tracking_id" value="<?= $data['tracking_id']?>">
                                        <select name="order_status" class="form-select px-2 border">
                                            
                                            <option value="0" <?= $data['status'] == 0 ? 'selected' : ''?>>Under Process</option>
                                            <option value="1" <?= $data['status'] == 1 ? 'selected' : ''?>>Completed</option>
                                            <option value="2" <?= $data['status'] == 2 ? 'selected' : ''?>>Canceled</option>
                                        </select>
                                        <button class="btn btn-primary mt-3" type="submit" name="update_order_btn">Update Status</button>
                                    </form>
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