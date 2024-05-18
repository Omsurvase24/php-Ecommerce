<?php

session_start();

include("../config/dbcon.php");
include('myfunctions.php');

if(isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $email_exist_query = "SELECT email FROM users WHERE email = ?";
    $email_exist_query_stmt = mysqli_prepare($conn, $email_exist_query);
    mysqli_stmt_bind_param($email_exist_query_stmt, "s", $email);
    mysqli_stmt_execute($email_exist_query_stmt);
    mysqli_stmt_store_result($email_exist_query_stmt);  

    if(mysqli_stmt_num_rows($email_exist_query_stmt) > 0) {
        redirect('Email already registered.', '../register.php');
    }

    if($password == $cpassword) {
        $insert_query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";

        $insert_query_run = mysqli_query($conn, $insert_query);

        if($insert_query_run) {
            redirect('Registered successfully.', '../login.php');
        }
        else {
            redirect('Something went wrong. Please try again.', '../register.php');
        }
    }
    else {
        redirect('Password do not match.', '../register.php');
    }

}
else if(isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $login_query_run = mysqli_query($conn, $login_query);

    if(mysqli_num_rows($login_query_run) > 0) {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run);

        $_SESSION['auth_user'] = [
            'user_id' => $userdata['id'],
            'name' => $userdata['name'],
            'email' => $userdata['email']
        ];

        $_SESSION['role_as'] = $userdata['role_as'];

        if($userdata['role_as'] == 1) {
            redirect('Welcome to admin dashboard.', '../admin/index.php');
        }
        else {
            redirect('Logged in successfully.', '../index.php');
        }
    } 
    else {
        redirect('Invalid credentials.', '../login.php');
    }
}

?>