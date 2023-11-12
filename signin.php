<?php
require 'config/constant.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabbit Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style27.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body class="box-in1">
    <img src="<?= ROOT_URL ?>/assets/cover2.jpg">
<section class="box-1">    
        <span class="borderline1"></span>
        
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <h1>Sign In</h1>
            <?php if (isset($_SESSION['signup-success'])) : ?>
            <div class="alert__message success">
                <p>
                    <?php echo $_SESSION['signup-success'];
                    unset($_SESSION['signup-success']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['signin'])) : ?>
        <div class="alert__message error">
                <p>
                    <?php echo $_SESSION['signin'];
                    unset($_SESSION['signin']); 
                    ?>
                </p>
        </div>
        <?php endif ?>
            <div class="inputBox">
            <input type="text" required="required" name="username_email" value="<?= $username_email ?>">
            <span>Username or Email</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="password" required="required" name="password" value="<?= $password ?>">
            <span>Password</span>
            <i></i>
            </div>
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Don't have account? <a href="signup.php">Sign Up</a></small>
        </form>
</section>


</body>
</html>