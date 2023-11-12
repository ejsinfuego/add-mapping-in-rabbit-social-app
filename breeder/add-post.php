<?php 
require('partials/header.php');

//fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

// get back form data if form was invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
$age = $_SESSION['add-post-data']['age'] ?? null;
$color = $_SESSION['add-post-data']['color'] ?? null;
$gender = $_SESSION['add-post-data']['gender'] ?? null;
$population = $_SESSION['add-post-data']['population'] ?? null;

//delete form data session
unset($_SESSION['add-post-data'])
?>



<section class="form__section">

    <div class="container form__section-container">

    
    <a href="edit-post.php"><h2><i class="fas fa-arrow-left"></i> Add Post</h2></a>
   
        <?php if (isset($_SESSION['add-post'])) : ?>
        <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']); 
                    ?>
                </p>
        </div>
        <?php endif ?>
        <style type="text/css">
            form h5{
                position: relative;
                color: white;
                margin-bottom: -30px;
            }
            h2{
                color: #fff;
                padding-left: 10px;
            }
        </style>
        <form action="add-post-logic.php" enctype="multipart/form-data" method="POST">
            <h5>Post title or BreedType</h5>
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <h5>Breed Type</h5>
            <select name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Give atleast short introduction"><?= $body ?></textarea>
            <h5>Age</h5>
            <input type="text" name="age" value="<?= $age ?>" placeholder="Age">
            <h5>Color</h5>
            <input type="text" name="color" value="<?= $color ?>" placeholder="Color">
            <h5>Gender</h5>
            <input type="text" name="gender" value="<?= $gender ?>" placeholder="Gender">
            <h5>Population</h5>
            <input type="text" name="population" value="<?= $population ?>" placeholder="Population Number">
            <?php if(isset($_SESSION['user_is_admin'])) : ?>
            
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>



<?php 
include('partials/footer.php');
?>
