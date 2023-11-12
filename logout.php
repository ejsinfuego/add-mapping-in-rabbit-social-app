<?php 

require 'config/constant.php';
//destroy all session and redirect user to hompage page

      
    session_destroy();
                header('location: ' . ROOT_URL);
                die();
?>


