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

                    $post_title = '';
                    $post_category_id = '';
                    $post_author = '';
                    $post_tags = '';
                    $post_content = '';
                    $post_status = '';
                    $post_image = '';

                    if(isset($_GET['edit'])) {

                        $post_id = $_GET['edit'];

                        $query = "SELECT * FROM `posts` WHERE `post_id`='$post_id'";
                        $get_post = $conn->query($query);

                        if($row = $get_post->fetch_assoc()) {
                            
                            $post_title = $row['post_title'];
                            $post_category_id = $row['post_category_id'];
                            $post_author = $row['post_author'];
                            $post_tags = $row['post_tags'];
                            $post_content = $row['post_content'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];

                        }

                    }

                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Post Title
                                <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="post_category"></label><select name="post_category" id="post_category">
                                <?php
                                    $category_id = '';
                                    $category_title = '';

                                    $categories_query = "SELECT * FROM `categories`";
                                    $select_categories = $conn->query($categories_query);

                                    while($row = $select_categories->fetch_assoc()){
                                        $category_id = $row['cat_id'];
                                        $category_title = $row['cat_title'];?>

                                        <option value="<?php echo $category_id ?>" ><?php echo $category_title ?></option>

                                    <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Author
                                <input value="<?php echo $post_author ?>" type="text" class="form-control" name="post_author">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Status
                                <input value="<?php echo $post_status ?>" type="text" class="form-control" name="post_status">
                            </label>
                        </div>

                        <div class="form-group">
                            <img width="80" height="60" src="../images/<?php echo $post_image; ?>" alt="post_image">
                            <input type="file" name="post_image">
                        </div>

                        <div class="form-group">
                            <label for="title">Post Tags
                                <input value="<?php echo $post_tags ?>" type="text" class="form-control" name="post_tags">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Content
                                <textarea rows="4" cols="50" class="form-control" name="post_content"><?php echo $post_content ?></textarea>
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
                        </div>

                    </form>

                    <?php
                        if(isset($_POST['update_post'])){
                            $post_title = $_POST['post_title'];
                            $post_category_id = $_POST['post_category_id'];
                            $post_author = $_POST['post_author'];
                            $post_tags = $_POST['post_tags'];
                            $post_content = $_POST['post_content'];
                            $post_status = $_POST['post_status'];
                            $post_image = $_FILES['post_image']['name'];
                            $post_image_tmp = $_FILES['post_image']['tmp_name'];

                            move_uploaded_file($post_image_tmp, "../images/$post_image");

                            if(empty($post_image)) {
                                $image_query = "SELECT * FROM `posts` WHERE `post_id`='$post_id'";
                                $select_image = $conn->query($image_query);

                                while($row = $select_image->fetch_assoc()){
                                $post_image = $row['post_image'];}
                            }

                            $post_query = "UPDATE `posts` SET `post_title`='$post_title', `post_author`='$post_author', `post_category_id`='$post_category_id', `post_tags`='$post_tags',`post_content` = '$post_content', `post_date` = 'now()',`post_status` = '$post_status',`post_image` = '$post_image' WHERE `post_id`='$post_id'  ";

                            $update_post = $conn->query($post_query);

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
<?php closeCon($conn); ?>

<?php include 'includes/admin_footer.php'; ?>