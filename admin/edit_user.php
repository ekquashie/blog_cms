<?php ob_start() ?>

<?php

include 'includes/admin_header.php';

$conn = openCon();

?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome To Admin
                        <small>Author</small>
                    </h1>


                    <?php

                    $user_id = '';

                    if(isset($_GET['edit_user'])) {
                        $user_id = $_GET['edit_user'];
                    }

                    $select_user = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
                    $get_user = $conn->query($select_user);

                    while($row = $get_user->fetch_assoc()) {
                        $username = $row['username'];
                        $password = $row['password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];

                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="username">Username
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="password">Password
                                <input type="password" class="form-control" name="password" value="<?php echo $password ?>">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_role"></label><select name="user_role" id="user_role">
                                <option value="subscriber">Select Options</option>
                                <option <?php if($user_role=='subscriber'){ echo 'selected';} ?> value="subscriber" >Subscriber</option>
                                <option <?php if($user_role=='admin'){ echo 'selected';}?> value="admin" >Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_firstname">Firstname
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email Address
                                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                            </label>
                        </div>

                        <div class="form-group">
                            <img width="80" height="60" src="images/<?php echo $user_image; ?>" alt="user_image">
                            <input type="file" name="user_image">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
                        </div>

                    </form>
                    <?php } ?>

                    <?php
                    if(isset($_POST['update_user'])){
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $user_role = $_POST['user_role'];
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $user_email = $_POST['user_email'];
                        $user_image = $_FILES['user_image']['name'];
                        $user_image_tmp = $_FILES['user_image']['tmp_name'];

                        move_uploaded_file($user_image_tmp, "images/$user_image");

                        if(empty($user_image)) {
                            $image_query = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
                            $select_image = $conn->query($image_query);

                            while($row = $select_image->fetch_assoc()){
                                $user_image = $row['user_image'];
                            }
                        }

                        $post_query = "UPDATE `users` SET `username`='$username', `password`='$password', `user_role`='$user_role', `user_firstname`='$user_firstname', `user_lastname`='$user_lastname', `user_email`='$user_email', `user_image`='$user_image' WHERE `user_id`='$user_id'";

                        $update_post = $conn->query($post_query);

                        header("Location: users.php");

                        if(!$update_post) {
                            echo "Could not update post ". $conn->connect_error;
                        }
                    }
                    ?>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php'; ?>