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

                    if(isset($_POST['create_user'])) {

                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $user_email = $_POST['user_email'];
                        $user_role = $_POST['user_role'];

                        $user_image = $_FILES['user_image']['name'];
                        $user_image_tmp = $_FILES['user_image']['tmp_name'];

                        move_uploaded_file($user_image_tmp, "images/$user_image");

                        $query = "INSERT INTO `users` (`username`, `password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_randSalt`) VALUES ('$username', '$password', '$user_firstname', '$user_lastname','$user_email', '$user_image', '$user_role', '')";
                        $insert_user = $conn->query($query);

                        if(!$insert_user) {
                            echo "Query Failed! " . $conn;
                        }

                    }

                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="username">Username
                                <input type="text" class="form-control" name="username">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="password">Password
                                <input type="text" class="form-control" name="password">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_role"></label><select name="user_role" id="user_role">
                                <option value="subscriber">Select Options</option>
                                <option value="subscriber" >Subscriber</option>
                                <option value="admin" >Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_firstname">Firstname
                                <input type="text" class="form-control" name="user_firstname">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname
                                <input type="text" class="form-control" name="user_lastname">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="user_email">Email Address
                                <input type="email" class="form-control" name="user_email">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Image
                                <input type="file" name="user_image">
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
                        </div>

                    </form>

                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php'; ?>