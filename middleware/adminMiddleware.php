<?php
    session_start();

    include('../functions/myfunctions.php');

    if(isset($_SESSION['auth'])) {
        if($_SESSION['role_as'] != 1) {
            redirect('You are not authrized to access the page.', '../index.php');
            exit;
        }
    }
    else {
        redirect('Login to continue.', '../login.php');
    }

?>