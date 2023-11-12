<?php 
require('partials/header.php');

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
?>




<section class="form__section">
        <style type="text/css">
            form h5{
                position: relative;
                color: white;
                margin-bottom: -30px;
            }
        </style>
    <div class="container form__section-container">
    <a href="index.php"><h2><i class="fas fa-arrow-left"></i> Edit Profile</h2></a>
        
        <form action="<?= ROOT_URL ?>admin/edit-profile-logic.php" method="POST">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <h5>First Name</h5>
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
            <h5>Last Name</h5>
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">
            <h5>User Name</h5>
            <input type="text" value="<?= $user['username'] ?>" name="username" placeholder="Username">
            <h5>Email</h5>
            <input type="text" value="<?= $user['email'] ?>" name="email" placeholder="Email">
            <h5>Contact</h5>
            <input type="text" class="c" value="<?= $user['contact'] ?>" name="contact" placeholder="Contact">
            <h5>Address</h5>
            <input type="text" value="<?= $user['address'] ?>" name="address" placeholder="Address">
            <a href="change-password.php?id=<?= $user['id'] ?>" class="btn">Change password?</a>
            <div class="form__control">
                <label for="avatar">Change Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Update Profile</button>
        </form>
    </div>
</section>




<?php 
require('../partials/footer.php');
?>
