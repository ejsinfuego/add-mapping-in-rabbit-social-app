<?php 
require('partials/header.php');

// fetch the data from the database
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>





<section class="dashboard">

        <?php if (isset($_SESSION['add-category-success'])) : //for success message ?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['add-category'])) : //for not success message ?>
            <div class="alert__message error container">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']); 
                    ?>
                </p>
        </div>
        <?php elseif (isset($_SESSION['edit-category-success'])) : //for success update ?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['edit-category-success'];
                    unset($_SESSION['edit-category-success']); 
                    ?>
                </p>
        </div>
        <?php elseif (isset($_SESSION['edit-category'])) : //for not success update ?>
            <div class="alert__message error container">
                <p>
                    <?= $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']); 
                    ?>
                </p>
        </div>
        <?php elseif (isset($_SESSION['delete-category-success'])) : //for success deleting the category ?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['delete-category-success'];
                    unset($_SESSION['delete-category-success']); 
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
                    <a href="index.php" class="uil uil-user"><i class="uil uil-user"></i>
                        <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="add-post.php" ><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <li>
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
                        <h5>Add Breed Types</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                        <h5>Manage Breed Types</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Breed Types</h2>
            <?php 
                if(mysqli_num_rows($categories) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm"><img src="<?= ROOT_URL ?>assets/edit.png" class="edit"></a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger"><img src="<?= ROOT_URL ?>assets/delete.png" class="delete"></a></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert_message error"><?= "No categories found" ?></div>
                <?php endif ?>
        </main>
    </div>
</section>




<?php 
require('../partials/footer.php');
?>
