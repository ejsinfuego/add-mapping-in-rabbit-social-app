<?php

require 'config/database.php';

//get form data if submit button was clicked

if(isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], 
    FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], 
    FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], 
    FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], 
    FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], 
    FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], 
    FILTER_SANITIZE_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    

    //validate input values
    if(!$firstname) {
        $_SESSION['add-user'] = "Please enter your Firstname";
    } elseif (!$lastname) {
        $_SESSION['add-user'] = "Please enter your Lastname";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter a valid email";
    } elseif (!$is_admin) {
        $_SESSION['add-user'] = "Please select your role";
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = "Password should be 8+ characters";
    } elseif (!$avatar['name']) {
        $_SESSION['add-user'] = "Please add avatar";
    } else {
        if ($createpassword !== $confirmpassword) {
            $_SESSION['add-user'] = "Password do not match";
        } else {
        //hash pass
        $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
        echo $createpassword, '<br/>';
        echo $hashed_password;
        }
        //check if username is already exist
        $user_check_querry = "SELECT * FROM users WHERE username='$username' OR email= '$email' ";
        $user_check_result= mysqli_query($connection, $user_check_querry);
        if(mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['add-user'] = "Username or Email already Exist";
        } else {
            //avatar
            $time = time();
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = '../images/' . $avatar_name;
            } 
            
            //make sure it is image
            $allowed_file = ['png', 'jpeg', 'jpg'];
            $extension = explode('.', $avatar_name);
            $extension = end($extension);
            if(in_array($extension, $allowed_file)) {
                //make sure its not too big
                if($avatar['size'] < 1000000) {
                    move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                } else {
                    $_SESSION['add-user']= 'File size is too big. Should be less than 1mb';
                }
            } else {
                $_SESSION['add-user'] = "File should be png, jpg, jpeg";
            }

        }

    // redirect back to sign up if there is problem
if(isset($_SESSION['add-user'])) {
    $_SESSION['add-user-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
} else {
    //insert new user into user table
    $insert_user_querry = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=$is_admin ";
    $insert_user_result = mysqli_query($connection, $insert_user_querry);
    
    if(!mysqli_errno($connection)) {
        //redirect to log in page
        $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully.";
        header('location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
}

} else {
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}