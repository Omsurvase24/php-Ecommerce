<?php
    include('../middleware/adminMiddleware.php');
    include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                    <a href="orders-history.php" class="btn btn-primary float-end"><i class="fa fa-history me-2"></i> Orders History</a>
                </div>
                <div class="card-body">
                <?php
                    $orders = getAllOrders();
                    if(mysqli_num_rows($orders) > 0) {
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
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
                                        <td><?= $item['name']?></td>
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
</div>


<?php
    include("includes/footer.php");
?>