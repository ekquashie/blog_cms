<?php ob_start() ?>

<?php include 'includes/admin_header.php'; ?>


<?php

    $conn = openCon();

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }
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

                    $query = "SELECT * FROM `users` WHERE `username` = '$username'";
                    $select_user = $conn->query($query);

                    $user_id = $username = $password = $user_role = $user_firstname = $user_lastname = $user_email = '';

                    while($row = $select_user->fetch_assoc()) {
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $password = $row['password'];
                        $user_role = $row['user_role'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_image = $row['user_image'];
                    }

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
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>

                    </form>
                    <?php
                        if(isset($_POST['update_profile'])){
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $user_role = $_POST['user_role'];
                            $user_firstname = $_POST['user_firstname'];
                            $user_lastname = $_POST['user_lastname'];
                            $user_email = $_POST['user_email'];

                            $user_query = "UPDATE `users` SET `username`='$username', `password`='$password', `user_role`='$user_role', `user_firstname`='$user_firstname', `user_lastname`='$user_lastname', `user_email`='$user_email', `user_image`='$user_image' WHERE `user_id`='$user_id'";

                            $update_profile = $conn->query($user_query);

                            header("Location: profile.php");

                            if(!$update_profile) {
                                echo "Could not update profile ". $conn->connect_error;
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

<?php include 'includes/admin_footer.php'; ?><?php
