<?php

session_start();

require 'myfunctions.php';

if(isset($_SESSION['auth'])) {
    if(isset($_POST['placeOrderBtn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);

        $tracking_id = "phpecommerce".rand(1111, 9999).substr($phone, 2).substr($email, 5);
        $user_id = $_SESSION['auth_user']['user_id'];

        $cart_items = getCartItems();

        if(mysqli_num_rows($cart_items) > 0) {
            $totalPrice = 0;
            foreach($cart_items as $item) {
                $totalPrice += $item['selling_price'] * $item['product_qty'];
            }
        }

        $insert_query = "INSERT INTO orders (tracking_id, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_id', '$user_id', '$name', '$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id')";
        $insert_query_run = mysqli_query($conn, $insert_query);

        if($insert_query_run) {
            $order_id = mysqli_insert_id($conn);

            foreach($cart_items as $item) {
                $product_id = $item['product_id'];
                $product_qty = $item['product_qty'];
                $price = $item['price'];

                $insert_item_query = "INSERT INTO order_items (order_id, product_id, qty, price) VALUES ('$order_id', '$product_id', '$product_qty', '$price')";
                $insert_item_query_run = mysqli_query($conn, $insert_item_query);

                $product_query = "SELECT * FROM products WHERE id = '$product_id' LIMIT 1";
                $product_query_run = mysqli_query($conn, $product_query);
                $product_data = mysqli_fetch_array($product_query_run);

                if($product_data) {
                    $current_qty = $product_data['qty'];
                    $updated_qty = $current_qty - $product_qty;

                    $update_query = "UPDATE products SET qty = '$updated_qty' WHERE id = '$product_id'";
                    $update_query_run = mysqli_query($conn, $update_query);
                }
            }   

            $delete_query = "DELETE FROM carts WHERE user_id = '$user_id'";
            $delete_query_run = mysqli_query($conn, $delete_query);

            if($delete_query_run) {
                redirect('Order placed successfully.', '../my-orders.php');
            }
            else {
                redirect('Something went wrong. Please try again.', '../checkout.php');
            }
        }
    }
}
else {
    redirect('You are not authorized to access this page.', 'index.php');
}

?>