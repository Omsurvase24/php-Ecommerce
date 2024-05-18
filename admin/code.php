<?php

include('../functions/myfunctions.php');

if(isset($_POST['add_category_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = '../uploads';
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$image_extension;

    $insert_category_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image) VALUES ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$popular', '$filename')";

    $insert_category_query_run = mysqli_query($conn, $insert_category_query);

    if($insert_category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect('Category added successfully.', 'add-category.php');
    }
    else {
        redirect('Something went wrong. Please try again.', 'add-category.php');
    }
} 
else if(isset($_POST['update_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "") {
        $image_extension = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_extension;
    }
    else {
        $update_filename = $old_image;
    }

    
    $update_query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";
    
    $update_query_run = mysqli_query($conn, $update_query);
    
    $path = '../uploads';

    if($update_query_run) {
        if($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)) {
                unlink("../uploads/".$old_image);
            }
        }
        redirect('Category updated successfully.', 'edit-category.php?id='.$category_id);
    }    
    else {
        redirect('Something went wrong. Please try again.', 'edit-category.php?id='.$category_id);
    }
}
else if(isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    
    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);


    $delete_query = "DELETE FROM categories WHERE id='$category_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run) {
        if(file_exists("../uploads/".$category_data['image'])) {
            unlink("../uploads/".$category_data['image']);
        }

        echo 200;
    }
    else {
        echo 500;
    }
}
else if(isset($_POST['add_product_btn'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = '../uploads';
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;

    $insert_product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price, qty, status, trending, meta_title, meta_keywords, meta_description, image) VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price', '$qty', '$status', '$trending', '$meta_title', '$meta_keywords', '$meta_description', '$filename')";

    $insert_product_query_run = mysqli_query($conn, $insert_product_query);

    if($insert_product_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect('Product added successfully.', 'add-product.php');
    }
    else {
        redirect('Something went wrong. Please try again.', 'add-product.php');
    }
}
else if(isset($_POST['update_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $small_description = mysqli_real_escape_string($conn, $_POST['small_description']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $path = '../uploads';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "") {
        $image_extension = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_extension;
    }
    else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id='$category_id', name='$name', slug='$slug', small_description='$small_description', description='$description', original_price='$original_price', selling_price='$selling_price', qty='$qty', status='$status', trending='$trending', meta_title='$meta_title', meta_keywords='$meta_keywords', meta_description='$meta_description', image='$update_filename' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if($update_product_query_run) {
        if($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)) {
                unlink("../uploads/".$old_image);
            }
        }
        redirect('Product updated successfully.', 'edit-product.php?id='.$product_id);
    }
    else {
        redirect('Something went wrong. Please try again.', 'edit-product.php?id='.$product_id);
    }
}
else if(isset($_POST['delete_product_btn'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);


    $delete_query = "DELETE FROM products WHERE id='$product_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run) {
        if(file_exists("../uploads/".$product_data['image'])) {
            unlink("../uploads/".$product_data['image']);
        }

        echo 200;
    }
    else {
        echo 500;
    }
}
else if(isset($_POST['update_order_btn'])) {
    $tracking_id = mysqli_real_escape_string($conn, $_POST['tracking_id']);
    $order_status = mysqli_real_escape_string($conn, $_POST['order_status']);

    $update_query = "UPDATE orders SET status = '$order_status' WHERE tracking_id = '$tracking_id'";
    $update_query_run = mysqli_query($conn, $update_query);

    if($update_query_run) {
        redirect('Order status updated successfully.', "view-order.php?tracking-id=$tracking_id");
    }
    else {
        redirect('Something went wrong. Please try again.', "view-order.php?tracking-id=$tracking_id");
    }
}
else {
    header('Location: ../index.php');
}

?>