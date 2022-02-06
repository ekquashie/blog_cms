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

                    <!--Add Category Form-->
                    <div class="col-md-6">
                        <form action="includes/add_categories.php" method="POST">
                            <div class="form-group">
                                <label for="cat_title">Category Title
                                    <input class="form-control" type="text" name="cat_title">
                                </label>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div><!--Add Category Form-->

                    <!--Update Category Form-->
                    <div class="col-md-6">
                        <form method="POST">
                            <div class="form-group">
                                <label for="cat_title">Category Title

                                    <?php
                                    if(isset($_GET['edit'])) {

                                        $edit_id = $_GET['edit'];

                                        $query = "SELECT * FROM `categories` WHERE `cat_id` = '$edit_id'";
                                        $get_categories = $conn->query($query);

                                        while($row = $get_categories->fetch_assoc()) {
                                            $the_cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title']; ?>

                                            <input value='<?php if(isset($cat_title)){ echo $cat_title; } ?>' class="form-control" type="text" name="cat_title">

                                        <?php }
                                    }

                                        if(isset($_POST['update_cat'])) {
                                            $new_cat_title = $_POST['cat_title'];

                                            $update_query = "UPDATE `categories` SET `cat_title` = '$new_cat_title' WHERE `cat_id` = '$the_cat_id'";

                                            if($conn->query($update_query)){
                                                header("Location: categories.php");
                                            }
                                        }

                                    ?>

                                </label>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
                            </div>
                        </form>
                    </div><!--Update Category Form-->

                    <?php
                    $query = "SELECT * FROM `categories`";
                    $result = $conn->query($query);
                    ?>

                    <div class="col-xs-6">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = $result->fetch_assoc()) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            ?>
                            <tr>
                                <td><?php echo $cat_id; ?></td>
                                <td><?php echo $cat_title; ?></td>
                                <td><a href='categories.php?edit=<?php echo $cat_id; ?>'>Edit</a></td>
                                <td><a style="color:red;" href='categories.php?delete=<?php echo $cat_id; ?>'>Delete</a></td>
                            </tr>
                                <?php
                                    if(isset($_GET['delete'])) {
                                        $delete_id = $_GET['delete'];

                                        $delete_query = "DELETE FROM `categories` WHERE `cat_id` = '$delete_id'";

                                        if($conn->query($delete_query)) {
                                            header("Location: categories.php");
                                        } else {
                                            echo "Could not connect to database " . $conn->connect_error;
                                        }
                                    }
                                ?>
                            <?php } closeCon($conn); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'; ?>