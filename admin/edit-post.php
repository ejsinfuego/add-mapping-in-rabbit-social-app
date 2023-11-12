<?php 
require('partials/header.php');

// fetch the categories from  database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query); 


// fetch the post data from the database
if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>




<section class="form__section">
    <div class="container form__section-container">
        <a href="<?= ROOT_URL ?>admin/edit-post.php"><h2><i class="fas fa-arrow-left"></i> Edit Post</h2></a>
        
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $post['body'] ?></textarea>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                <label for="is_featured" >Featured</label>
            </div>
            <?php if(isset($_SESSION['user_is_admin']) == 2) : ?>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <?php endif ?>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>




<?php 
require('../partials/footer.php');
?>