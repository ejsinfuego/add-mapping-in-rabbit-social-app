<?php
require 'partials/header.php';
// //fetch post from database
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'home.php');
    die();
}

?>



    <section class="singlepost">
        <div class="container singlepost__container">
        <i class="fas fa-arrow-left"></i><a href="index.php"><h2> <?= $post['title'] ?></h2></a>
            <div class="post__author">
                    <?php
                        // fetch author from users tbale using author_id
                        $author_id = $post['author_id'];
                        $author_query = "SELECT *FROM users WHERE id=$author_id";
                        $author_result = mysqli_query($connection, $author_query);
                        $author = mysqli_fetch_assoc($author_result);

                    ?>
                <style type="text/css">
                            .cc, h5, h2{
                                color: #fff;
                                cursor: pointer;
                             }

                        </style>
                        <div class="post__author-avatar">
                            <img src="<?= ROOT_URL?>images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                        <h5>By: <a href="get-profile.php?id=<?= $author['id'] ?>" class="cc"><?= ucwords( "{$author['firstname']} {$author['lastname']}") ?></a></h5>
                        <small><?= date("M d, Y - h:i a", strtotime($post['date_time'])) ?></small>
                    </div>
            </div>
            <div class="singlepost__thumbnail">
                <img src="./images/<?= $post['thumbnail'] ?>">
            </div>
            <p><?= $post['body'] ?></p><br>
            <p>Population: <?= $post['population'] ?></p>
            <p>Age: <?= $post['age'] ?></p>
            <p>Gender: <?= $post['gender'] ?></p>
            <p>Color: <?= $post['color'] ?></p>
            <!DOCTYPE html>
<html>
<head>
	
	
	  <script src="vendors/jquery-1.7.2.min.js"></script>
    <script src="vendors/bootstrap.js"></script>


</head>
<body>
	<div id="container">
		
					<form method="post" action="submitComment.php"> 
					<input type="hidden" name="post_id" value="<?php echo $id; ?>">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user-id'] ?? ''; ?>">
					<textarea name="comment" rows="7" cols="64" style="" placeholder=".........Write Someting........" required></textarea>
					<br>
                    <?php if(isset($_SESSION['user-id'])): ?>
					<button type="submit" name="post">&nbsp;POST</button>
                    <?php else: ?>
                    <a href="login.php" class="btn">Login to comment</a>
                    <?php endif; ?>
					<br>
					<hr>
					</form>
							<?php 
								$comment_query = mysqli_query($connection,"SELECT * ,UNIX_TIMESTAMP() - date_posted AS TimeSpent FROM comments LEFT JOIN users on users.id = comments.user_id where post_id = '$id'") or die (mysqli_error());
								while ($comment_row=mysqli_fetch_array($comment_query)){
								$comment_id = $comment_row['comment_id'];
								$comment_by = $comment_row['firstname']." ".  $comment_row['lastname'];
							?>
					<br><a href="#"><?php echo $comment_by; ?></a> - <?php echo $comment_row['comment']; ?>
					<br>
							<?php				
								$days = floor($comment_row['TimeSpent'] / (60 * 60 * 24));
								$remainder = $comment_row['TimeSpent'] % (60 * 60 * 24);
								$hours = floor($remainder / (60 * 60));
								$remainder = $remainder % (60 * 60);
								$minutes = floor($remainder / 60);
								$seconds = $remainder % 60;
								if($days > 0)
								echo date('F d, Y - H:i:sa', $comment_row['date_posted']);
								elseif($days == 0 && $hours == 0 && $minutes == 0)
								echo "A few seconds ago";		
								elseif($days == 0 && $hours == 0)
								echo $minutes.' minutes ago';
							?>
					<br>
							<?php
							}
							?>
					<hr>
					

</body>

  <?php //include('comment/footer.php');?>

</html>
        </div>

    </section>
    
    <!--====================== END OF SINGLE POST ====================-->






<?php
require 'partials/footer.php';

?>
