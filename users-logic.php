<?php
    require "config/database.php";
    if(isset($_SESSION['unique_id'])) {
        $outgoing_id = filter_var($_SESSION['unique_id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE NOT unique_id=$outgoing_id ORDER BY is_admin ASC";
        $sql = mysqli_query($connection, $query);
        $output = "";
    }
    if(mysqli_num_rows($sql) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($sql) > 0){
        require "data.php";
    }
    echo $output;
?>