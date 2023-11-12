<?php
require 'partials/header.php';

if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}

//fetch user's posts from database
$current_user_id = $_GET['id'];
$query = "SELECT * FROM posts WHERE author_id=$current_user_id ORDER BY id DESC ";
$posts = mysqli_query($connection, $query);
$current_user_id = $_GET['id'];
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
    color: #000;
}
.sa {
    color: blue;
}
a:hover{
    text-decoration: none;
    color: black;
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
</head>
<body>

<div class="container">
<div class="main-body">

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
<a href="admin/users.php?"><button class="btn">Message</button></a>
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


</div>
</div>
</div>
</div>
<div class="row gutters-sm">
<div class="col-sm-6 mb-3">
<div class="card h-100">

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
require 'partials/footer.php';

?>