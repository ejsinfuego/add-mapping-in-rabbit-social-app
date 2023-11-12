<?php

require 'config/constant.php';

$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabbit Website</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="css/rabbit1.css">
    <link rel="stylesheet" href="css/style27.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="box-in">
<img src="<?= ROOT_URL ?>/assets/cover2.jpg">
<section class="box" >
    
        <span class="borderline"></span>
        
        
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <h1>Sign Up</h1>
            <?php
            if(isset($_SESSION['signup'])): ?> 
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signup']; 
                        unset($_SESSION['signup']);
                        ?>
                        
                    </p>
                    
                </div>
            
            <?php endif ?>
            <div class="inputBox">
            <input type="text" name="firstname" value="<?= $firstname ?>" required >
            <span>First Name</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="text" name="lastname" value="<?= $lastname ?>" required >
            <span>Last Name</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="text" name="username" value="<?= $username ?>" required >
            <span>Username</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="email" name="email" value="<?= $email ?>" required >
            <span>Email</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" required >
            <span>Create Password</span>
            <i></i>
            </div>
            <div class="inputBox">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" required >
            <span>Confirm Password</span>
            <i></i>
            </div>
            <select name="userrole">
                <option value="3">User</option>
                <option value="2">Breeder</option>
            </select>
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" required name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In</a></small>
        </form>
        </div>
    </div>

</section>


</body>
</html>