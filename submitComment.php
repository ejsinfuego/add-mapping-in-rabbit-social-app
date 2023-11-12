<?php 

//connection

require 'config/database.php';


//submit comment
if($_POST){
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];
    $date_posted = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO comments (post_id, user_id, comment, date_posted) VALUES ('$post_id', '$user_id', '$comment', '$date_posted')";
    $result = mysqli_query($connection, $query);
    if($result){
        header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
    } else {
        echo 'error: ' . mysqli_error($connection);
    }
}else{
    header('location: ' . ROOT_URL . 'post.php?id=' . $post_id);
}