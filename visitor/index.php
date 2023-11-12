<?php
include 'partials/header.php';

//fetch featured post from database
$query = "SELECT * FROM posts WHERE is_featured=1";
$result = mysqli_query($connection, $query);
$featured = mysqli_fetch_assoc($result);

// fetch 9 post from post table
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";
$posts = mysqli_query($connection , $query);
?>
    <!-- show the featured post if there is any -->
    <?php if(mysqli_num_rows($result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail-x">
                <img src="<?= ROOT_URL ?>images/<?= $featured['thumbnail'] ?>">
            </div>
            <div class="post__info">
                <?php 
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['body'], 0, 150) ?>...

                </p>
                <div class="post__author">
                    <?php
                        // fetch author from users tbale using author_id
                        $author_id = $featured['author_id'];
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
                        <small><?= date("M d, Y - h:i a", strtotime($featured['date_time'])) ?></small>
                    </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
    <?php endif ?>
    <!--====================== END OF FEATURED ====================-->

    <section class="posts <?= $featured ? '' : 'section_extra-margin' ?>">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="<?= ROOT_URL ?>images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                <?php 
                    $category_id = $post['category_id'];
                    $category_query = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $category_query);
                    $category = mysqli_fetch_assoc($category_result);
                ?>
                    <a href="category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                    <?= substr($post['body'], 0, 150) ?>...
                    </p>
                    <div class="post__author">
                    <?php
                        // fetch author from users table using author_id
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



<?php include 'partials/footer.php' ?>;


    