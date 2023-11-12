<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    //get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //check for valid input
    if(!$firstname || !$lastname || !$email) {
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } else {
        // update user
        $query = "UPDATE users SET firstname= '$firstname', lastname= '$lastname',
        username = '$username', email = '$email', contact = '$contact', address = '$address' WHERE id= $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)) {
            $_SESSION['edit-user'] = "Failed to update user.";
        } else {
            $_SESSION['edit-user-success'] = "User $firstname $lastname updated successfully.";
        }
    }
}

header('location: ' . ROOT_URL .  'admin/index.php');
die();