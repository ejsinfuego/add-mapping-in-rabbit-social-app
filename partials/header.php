<?php
require 'config/database.php';

// fetch current user from database

if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
    $_SESSION['unique_id'] = $avatar['unique_id'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rabbit Website</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/rabbit7.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/css3.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style27.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style012.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css\style5.css">
    <!-- CUSTOM STYLESHEET -->
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="admin/chatapp/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo"> RABBIT WEBOOK</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>home.php">Home</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <!-- <li><a href="<?= ROOT_URL ?>contact.php">Contact Us</a></li> -->
                <li><a href="<?= ROOT_URL ?>admin/users.php">Message</a></li>
                
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php?logout_id=<?php echo $avatar['unique_id']; ?>">Logout</a></li>
                    </ul>
                </li>
                <?php else : ?>
                  <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
                <?php endif ?>
            </ul>

            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--====================== END OF NAV ====================-->
<style type="text/css">
  .wrapper{
    border: 5px solid #876a44;
  }
</style>
<!-- //check if the url is users.php -->
<?php if($_SERVER['REQUEST_URI'] != '/rabbit2/admin/users.php') : ?>
<div id="chatSection" class="l">
    <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            if(isset($_SESSION['unique_id'])) {
              $unique_id = filter_var($_SESSION['unique_id'], FILTER_SANITIZE_NUMBER_INT);
              $query = "SELECT * FROM users WHERE unique_id=$unique_id";
              $result = mysqli_query($connection, $query);
              $row = mysqli_fetch_assoc($result);
            }
          ?>    
        
        <?php if(isset($row['unique_id'])):?>
          <img src="./images/<?php echo $row['avatar']; ?>" alt="">
          <div class="details">
            <span><?php echo ucfirst($row['firstname']). " " . $row['lastname'] ?></span>
            <p><?php echo ucfirst($row['status']); ?></p>
          </div>
          <?php endif ?>
        </div>

      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <a href=".users-logic.php" id="openChat">
      <div class="users-list">
  
      </div>
      </a>
    </section>
  </div>
</div>
<script src="javascript/users.js"></script>
<!-- append the user chat here when click -->

<?php endif; ?>
    
    <script>
        $(document).ready(function(){
            $("#chat").click(function(){
                if($("#chatSection").is(":visible") == true){
                    $("#chatSection").hide();
                }else{
                    $("#chatSection").show();
                }
            });

            $("openChat").click(function(){

                    $("#singleChat").append(text);
                    $("#chatSection").hide();
                    $("#singleChat").show();
            });
        });
    </script>
