<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $color = filter_var($_POST['color'], FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
    $population = filter_var($_POST['population'], FILTER_SANITIZE_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    // set is_featured to 0 if uncheck
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if(!$title) {
        $_SESSION['add-post']="Enter post Title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] ="Select post Category";
    } elseif (!$body) {
        $_SESSION['add-post'] ="Enter post Body";
    } elseif (!$thumbnail) {
        $_SESSION['add-post'] ="Choose post thumbnail";
    } elseif (!$color) {
        $_SESSION['add-post'] ="Enter Rabbit Color";
    } elseif (!$age) {
        $_SESSION['add-post'] ="Enter Rabbit Age";
    } elseif (!$gender) {
        $_SESSION['add-post'] ="Enter Rabbit Gender";
    } elseif (!$population) {
        $_SESSION['add-post'] ="Enter Rabbit Population Number";
    } else {
        //work on new thumbnail
        //rename new image
        $time = time(); // make each image name uploaded unique using current timestamp
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' . $thumbnail_name;

        //to make sure the file is image
        $allowed_file = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);
        if(in_array($extension, $allowed_file)) {
            // make sure the file is no too large (5mb)
            if($thumbnail['size'] < 5_000_000) {
                //upload avatar
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "Couldn't add post. Thumbnail is too big. Should be less than 5mb";
            }
        } else {
            $_SESSION['add-post'] = "Couldn't add post. Thumbnail should be png, jpg, or jpeg";
        }
    }

    // redirect back if there is a problem
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] =  $_POST;
        header('location: ' . ROOT_URL . 'breeder/add-post.php');
        die();

    } else {
        // set is_featured of all posts to 0 if is_featured for  this post is 1
        if($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // insert post into  database
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured, age, gender, color, population) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured, '$age', '$gender', '$color', '$population' )";
        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . ROOT_URL . 'breeder/dashboard.php');
            die();
        }
    }
}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();