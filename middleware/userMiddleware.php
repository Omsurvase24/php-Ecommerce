<?php

    if(!isset($_SESSION['auth'])) {
        redirect('Login to continue.', './login.php');
    }

?>