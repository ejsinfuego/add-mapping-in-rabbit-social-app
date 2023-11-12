<?php
require 'partials/header.php';

if($_GET){
    $user = $_GET['author-id']; 
    $query = "SELECT * FROM users WHERE id=$user";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);

}else{
    if(isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    
}
}

//fetch current user's posts from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts WHERE author_id=$current_user_id ORDER BY id DESC ";
$posts = mysqli_query($connection, $query);
$current_user_id = $_SESSION['user-id'];
$query = "SELECT * FROM posts WHERE author_id=$current_user_id ORDER BY id DESC ";
$upload = mysqli_query($connection, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
body{
    color: black;
    text-align: left;
    background-color: #fff;    
}
.card-body .row .col-sm-9, .mt-3 h4{
    color: #fff;

}
a {
    color: #fff;
}
.email{
    color: blue;
}
.sa {
    color: blue;
}
a:hover{
    text-decoration: none;
    color: white;
}
.container{
    color: black;
    text-decoration: none;

}
.main-body {
    padding: 15px;
    margin-top: 100px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.7), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #876a44;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.number{
    width: fit-content;
    height: fit-content;
    background: white;
    padding: 3px;
    margin: 2px;
}
.dd{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}
.btn1{
    background: #fff;
    padding: 5px;
    border-radius: 5px 5px 5px 5px;
    outline: 1px solid black;
}.btn1:hover{
    background: #d3b68d;
    transition: 0.5s;
}
main tbody{
    color: #c0b8ae;
}


    </style>
    <section class="dashboard">
    <?php if (isset($_SESSION['delete-post-success'])) : // success message for deleting post ?>
        <div class="alert__message success container">
                <p>
                    <?= $_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']); 
                    ?>
                </p>
        </div>
    <?php elseif (isset($_SESSION['add-post-success'])) : // success message for adding post ?>
        <div class="alert__message success container">
                <p>
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']); 
                    ?>
                </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : // success message for updating post ?>
        <div class="alert__message success container">
                <p>
                    <?= $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']); 
                    ?>
                </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])) : // error message for not successful updating post ?>
        <div class="alert__message error container">
                <p>
                    <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']); 
                    ?>
                </p>
        </div>
        <?php endif ?>
        <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
            
            <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-user"></i>
                        <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="add-post.php" ><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
                    <a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                        <h5>Manage User</h5>
                    </a>
                </li>
                <li>
                    <a href="all-users-post.php"><i class="uil uil-postcard"></i>
                        <h5>Manage Users Posts</h5>
                    </a>
                </li>
                <li>
                    <a href="add-category.php"><i class="uil uil-edit"></i>
                        <h5>Add Breed Type</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                        <h5>Manage Breed Types</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <?php if(mysqli_num_rows($upload) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>BreedType</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                        <!--  get category title of each post from categories table -->
                        <?php
                        $category_id = $post['category_id'];
                        $category_query = "SELECT title FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);

                        ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm"><img src="<?= ROOT_URL ?>assets/edit.png" class="edit"></a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger"><img src="<?= ROOT_URL ?>assets/delete.png" class="delete"></a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert_message error"><?= "No posts found" ?></div>
            
            <?php endif ?>
        </main>
        </div>
        </div>
</section>
</head>
<body>

<div class="container">
<div class="main-body">

<?php if(isset($_SESSION['user-id'])): ?>
<div class="row gutters-sm">
<div class="col-md-4 mb-3">
<div class="card">
<div class="card-body">
<div class="d-flex flex-column align-items-center text-center">
<img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="Admin" class="rounded-circle" width="70">
<div class="mt-3">
<h4><?= ucwords($avatar['firstname'].' '.$avatar['lastname']) ?></h4>
<p class="text-secondary mb-1">#</p>
<p class="text-muted font-size-sm">#</p>
<a class="btn " target="__blank" href="update-bio.php"><img src="<?= ROOT_URL ?>assets/edit.png" class="edit"></a>
</div>
</div>
</div>
</div>

</div>
<div class="col-md-8">
<div class="card mb-3">
<div class="card-body">
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Firstname</h6>
</div>
<div class="col-sm-9 ">
<?= ucwords($avatar['firstname']) ?>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Lastname</h6>
</div>
<div class="col-sm-9 ">
<?= ucwords($avatar['lastname']) ?>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Email</h6>
</div>
<div class="col-sm-9 text-secondary">
<a href="/cdn-cgi/l/email-protection" class="email" data-cfemail="4b2d223b0b213e20263e23652a27"><?= $avatar['email'] ?></a>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Mobile</h6>
</div>
<div class="col-sm-9 ">
<?= $avatar['contact'] ?>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Home Address</h6>
</div>
<div class="col-sm-9 ">
<?= ucwords($avatar['address']) ?>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-3">
<h6 class="mb-0">Farm Address</h6>
</div>
<div class="col-sm-9">
<a href="<?= ROOT_URL ?>map/index.php" class="sa">Visit</a>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-12">

    <a href="<?= ROOT_URL ?>admin/update-profile.php?id=<?= $avatar['id'] ?>" class="btn sm"><img src="<?= ROOT_URL ?>assets/edit.png"  class="edit"></a></td>

</div>
</div>
</div>
</div>
<div class="row gutters-sm">
<div class="col-sm-6 mb-3">
<div class="card h-100">
<div class="card-body">
    <!-- for rabbit colors -->

    <h2>Additional Info:</h2>
<div class="dd">

<small>Since when did you become a rabbit breeder?</small>
<div class="number" >
<div class="number ">120</div>
</div>
<small>How many rabbit you produced per year?</small>
<div class="number">
<div class="number">120</div>
</div>
<small>What's the rabbit breed type you usually raised?</small>
<div class="number" >
<div class="number">120</div>
</div>


<a class="btn " target="__blank" href="update-profile.php"><img src="<?= ROOT_URL ?>assets/edit.png" class="edit"></a>

</div>
</div>
</div>
<div class="col-sm-6 mb-3">

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>

<?php endif ?>

<section class="posts <?= $featured ? '' : 'section_extra-margin' ?>">

        <div class="container posts__container">

            <?php while ($post = mysqli_fetch_assoc($upload)) : ?>
            <article class="post">
                <div class="post__thumbnail-w">
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
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
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
                        <div class="post__author-avatar">
                            <img src="<?= ROOT_URL ?>images/<?= $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?=ucwords( "{$author['firstname']} {$author['lastname']}") ?></h5>
                            <small><?= date("M d, Y - h:i a", strtotime($post['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>
        </div>
</section> 
</body>
</html>

<?php
require '../partials/footer.php';

?>