
<?php require "partials/header.php"; ?>
<body class="h">
<link rel="stylesheet" href="<?= ROOT_URL ?>css\style5.css">
<img src="<?= ROOT_URL ?>/assets/cover1.jpg">
<style type="text/css">
  .h img{
    height: 100vh;
    position: relative;
  }
  .wrapper{
    border: 5px solid #876a44;
  }
</style>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            if(isset($_SESSION['unique_id'])) {
              $id = filter_var($_SESSION['unique_id'], FILTER_SANITIZE_NUMBER_INT);
              $query = "SELECT * FROM users WHERE unique_id=$id";
              $result = mysqli_query($connection, $query);
              $row = mysqli_fetch_assoc($result);
            }
          ?>
        <?php if(isset($row['unique_id'])): ?>
          <img src="../images/<?php echo $row['avatar']; ?>" alt="">
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
      <a href="users-logic.php">
      <div class="users-list">
  
      </div>
      </a>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
