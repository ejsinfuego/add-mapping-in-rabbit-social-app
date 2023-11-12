<?php 
require('partials/header.php');

// fetch the data from the database
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id ORDER BY is_admin ASC";
$users = mysqli_query($connection, $query);
?>


<section class="dashboard">
    
        <?php if (isset($_SESSION['add-user-success'])) : // shows if add user was success?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-user-success'])) : // shows if add user was success?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-user'])) : // shows if edit was not success?>
            <div class="alert__message error container">
                <p>
                    <?= $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-user'])) : // shows if delete was not success?>
            <div class="alert__message error container">
                <p>
                    <?= $_SESSION['delete-user'];
                    unset($_SESSION['delete-user']); 
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-user-success'])) : // shows if delete was success?>
            <div class="alert__message success container">
                <p>
                    <?= $_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']); 
                    ?>
                </p>
            </div>
        <?php endif ?>
        
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="index.php"><i class="uil uil-user"></i>
                        <h5>Profile</h5>
                    </a>
                </li>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Add Post</h5>
                    </a>
                </li>
                <?php if(isset($_SESSION['user_is_admin'])): ?>
                <li>
                    <a href="add-user.php"><i class="uil uil-user-plus"></i>
                        <h5>Add User</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
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
        <style class="text/css">
                    tbody .mm{
                        width: 60px;
                        height: 60px;
                        border: 2px solid black;
                    }
                    h2{
                        color: white;
                    }
                    .cc:hover{
                        color: black;
                    }
        </style>
            <h2>Manage Users</h2>
            <?php if(mysqli_num_rows($users) > 0) : ?>
            <table>
                
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>User Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><img src="<?= ROOT_URL . 'images/' . $user['avatar'] ?>" class="mm"></td>
                        <td><a href="<?= ROOT_URL ?>admin/get-profile.php?id=<?= $user['id'] ?>" class="cc"><?= ucwords( "{$user['firstname']} {$user['lastname']}") ?></a></td>
                        <td><?= $user['username'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm"><img src="<?= ROOT_URL ?>assets/edit.png"  class="edit"></a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger"><img src="<?= ROOT_URL ?>assets/delete.png"  class="delete"></a></td>
                        <td><?php if ($user['is_admin']==0) {
                            echo "Admin";
                        } elseif ($user['is_admin']==3) {
                            echo "User";
                        }   elseif ($user['is_admin']==2) {
                            echo "Breeder";
                        }
                         ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else : ?>
                <div class="alert_message error">
                    <?= "No users found" ?>
                </div>
            <?php endif ?>
        </main>
    </div>
</section>



<?php 
require('../partials/footer.php');
?>
