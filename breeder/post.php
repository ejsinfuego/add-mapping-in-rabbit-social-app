<?php
require 'partials/header.php';

//fetch post from database
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'breeder/home.php');
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
                            .cc{
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
                <img src="<?= ROOT_URL ?>images/<?= $post['thumbnail'] ?>">
            </div>
            <p><?= $post['body'] ?></p><br>
            <p>Population: <?= $post['population'] ?></p>
            <p>Age: <?= $post['age'] ?></p>
            <p>Gender: <?= $post['gender'] ?></p>
            <p>Color: <?= $post['color'] ?></p>
            
        </div>
    </section>
    <!--====================== END OF SINGLE POST ====================-->






<?php
require 'partials/footer.php';

?>
