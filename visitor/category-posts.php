<?php
require 'partials/header.php';


//fetch post if id is set
if(isset($_GET['id']) ) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
    

}else {
    header('location: ' . ROOT_URL . 'visitor/home.php');
    die();
}

?>





    <header class="category__title">
        <h2>
        <?php 
            $category_id = $id;
            $category_query = "SELECT * FROM categories WHERE id=$id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            echo $category['title']
        ?>
        </h2>
        
    </header>
    <!--====================== END OF CATEGORY TITLE ====================-->


<?php if(mysqli_num_rows($posts) > 0) : ?>
    <section class="posts">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="<?= ROOT_URL?>images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                    <?= substr($post['body'], 0, 150) ?>...
                    </p>
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
                                color: #000;
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
                </div>
            </article>
            <?php endwhile ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert_message lg">
        <p>No posts found for this category</p>
    </div>
<?php endif ?>
<!--====================== END OF POSTS ====================-->




<section class="category__buttons">
        <div class="container category__buttons-container">
            <?php 
                $all_categories_query = "SELECT * FROM categories";
                $all_categories = mysqli_query($connection, $all_categories_query)
            ?>
            <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>
<!--====================== END OF CATEGORY BUTTONS ====================-->





<?php
require 'partials/footer.php';

?>
