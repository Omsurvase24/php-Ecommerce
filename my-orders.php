<?php
    include("includes/header.php");
    include('functions/myfunctions.php');
    include('middleware/userMiddleware.php');
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-decoration-none text-white" href="index.php">Home / </a>
            <a class="text-decoration-none text-white" href="my-orders.php">My Orders </a>
        </h6>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $orders = getOrders();

                    if(mysqli_num_rows($orders) > 0) {
                    ?>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No.</th>
                                <th>Price</th>
                                <th>Ordered On</th>
                                <th>View</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                foreach($orders as $item) {
                                ?>
                                    <tr>
                                        <td><?= $item['id']?></td>
                                        <td><?= $item['tracking_id']?></td>
                                        <td><?= $item['total_price']?></td>
                                        <td><?= $item['created_at']?></td>
                                        <td>
                                            <a href="view-order.php?tracking-id=<?= $item['tracking_id']?>" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>


                    <?php
                    }
                    else {
                        echo "No orders found.";
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
    include("includes/footer.php");
?>