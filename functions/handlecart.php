<?php

session_start();

include(__DIR__ . '/../config/dbcon.php');

if(isset($_SESSION['auth'])) {
    if(isset($_POST['scope'])) {
        $scope = $_POST['scope'];

        switch($scope)  {
            case 'add':
                $product_id = $_POST['product_id'];
                $product_qty = $_POST['product_qty'];
                $price = $_POST['price'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $product_exist = "SELECT * FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'";
                $product_exist_run = mysqli_query($conn, $product_exist);
                
                if(mysqli_num_rows($product_exist_run) > 0) {
                    echo "existing";
                }
                else {
                    $insert_query = "INSERT INTO carts (user_id, product_id, product_qty, price) VALUES ('$user_id', '$product_id', '$product_qty', '$price')";
                    $insert_query_run = mysqli_query($conn, $insert_query);

                    if($insert_query_run) {
                        echo 201;
                    }
                    else {
                        echo 500;
                    }
                }
                
                break;

            case 'update':
                $product_id = $_POST['product_id'];
                $product_qty = $_POST['product_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $product_exist = "SELECT * FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'";
                $product_exist_run = mysqli_query($conn, $product_exist);

                if(mysqli_num_rows($product_exist_run) > 0) {
                    $update_query = "UPDATE carts SET product_qty = '$product_qty' WHERE user_id = '$user_id' AND product_id = '$product_id'";
                    $update_query_run = mysqli_query($conn, $update_query);

                    if($update_query_run) {
                        echo 200;
                    }
                    else {
                        echo 500;
                    }
                }
                else {
                    echo 500;
                }

                break;

            case 'delete':
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION['auth_user']['user_id'];
                
                $cart_exist = "SELECT * FROM carts WHERE id = '$cart_id' AND user_id = '$user_id'";
                $cart_exist_run = mysqli_query($conn, $cart_exist);

                if(mysqli_num_rows($cart_exist_run) > 0) {
                    $delete = "DELETE FROM carts WHERE id = '$cart_id' AND user_id = '$user_id'";
                    $delete_run = mysqli_query($conn, $delete);

                    if($delete_run) {
                        echo 200;
                    }
                    else {
                        echo 500;
                    }
                }
                else {
                    echo 500;
                }


                break;

            default:
                echo 500;
        }
    }
}
else {
    echo 401;
}

?>