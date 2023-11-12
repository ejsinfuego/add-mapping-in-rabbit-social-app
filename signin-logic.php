<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    if(!$username_email) {
        $_SESSION['signin'] = "Username or Email required";

    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username= '$username_email' OR email= '$username_email' ";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if(mysqli_num_rows($fetch_user_result) == 1) {
            //convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            //compare form passwordwith database password
            if (password_verify($password, $db_password)) {
                // if user is Active
                $status = "Active now";
                $query = "UPDATE users SET status = '{$status}' WHERE id = {$user_record['id']}";
                $result = mysqli_query($connection, $query);
                // set seesion for access control
                if($result){
                    $_SESSION['user-id'] = $user_record['unique_id'];
                    echo "success";
                }
                $_SESSION['user-id'] = $user_record['id'];
                // set session if user is an admin
                if ($user_record['is_admin'] == 0) {
                    $_SESSION['user_is_admin'] = true;
                    // log user in
                    header('location: ' . ROOT_URL . 'admin/');
                } elseif($user_record['is_admin'] == 3) {
                    $_SESSION['user_is_admin'] = false;
                    // log user in
                    header('location: ' . ROOT_URL . 'visitor/');
                }elseif($user_record['is_admin'] == 2) {
                    $_SESSION['user_is_admin'] = false;
                    // log user in
                    header('location: ' . ROOT_URL . 'breeder/');
                }
                 
            } else {
                $_SESSION['signin'] = "Please check your input";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        } 
    }

    // if any problem, redirect back to sign in page
    if(isset($_SESSION['signin'])) {
        $_SESSION['sign-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}