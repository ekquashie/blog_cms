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

                    if(isset($_POST['create_post'])) {

                        $post_title = $_POST['post_title'];
                        $post_category_id = $_POST['post_category_id'];
                        $post_author = $_POST['post_author'];
                        $post_tags = $_POST['post_tags'];
                        $post_content = $_POST['post_content'];
                        $post_status = $_POST['post_status'];

                        $post_image = $_FILES['post_image']['name'];
                        $post_image_tmp = $_FILES['post_image']['tmp_name'];

                        $post_date = Date('d-m-y');
                        $post_comment_count = 4;

                        move_uploaded_file($post_image_tmp, "../images/$post_image");

                        $query = "INSERT INTO `posts` (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ('$post_category_id', '$post_title', '$post_author', '$post_date','$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";
                        $insert_post = $conn->query($query);

                        if(!$insert_post) {
                            echo "Query Failed! " . $conn;
                        }

                    }

                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">Post Title
                                <input type="text" class="form-control" name="post_title">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Category Id
                                <input type="text" class="form-control" name="post_category_id">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Author
                                <input type="text" class="form-control" name="post_author">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Status
                                <input type="text" class="form-control" name="post_status">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Image
                                <input type="file" name="post_image">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Tags
                                <input type="text" class="form-control" name="post_tags">
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="title">Post Content
                                <textarea class="form-control" name="post_content"></textarea>
                            </label>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
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