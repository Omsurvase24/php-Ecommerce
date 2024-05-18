<?php

session_start();
include('functions/myfunctions.php');

if(isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    unset($_SESSION['role_as']);

    redirect('Logged out successfully.', 'index.php');
}

?>