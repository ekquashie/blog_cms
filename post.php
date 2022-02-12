<?php include 'includes/db.php' ?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body>
<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            $conn = openCon();

            $post_id = 1;

            if(isset($_GET['post_id'])) {
                $post_id = $_GET['post_id'];
            }

            $query = "SELECT * FROM `posts` WHERE `post_id`='$post_id'";
            $posts_results = $conn->query($query);

            while($row = $posts_results->fetch_assoc()){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $comment_count = $row['post_comment_count'];

                ?>

                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img width="600" height="300" class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr><?php } ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" role="form" method="POST">

                    <div class="form-group">
                        <label>Author
                            <input class="form-control" type="text" name="comment_author" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Email
                            <input class="form-control" type="text" name="comment_email" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Your Comment
                            <textarea name="comment_content" class="form-control" rows="3" required></textarea>
                        </label>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <?php
                if(isset($_POST['create_comment'])) {
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    $query = "INSERT INTO `comments` (`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ('$post_id', '$comment_author', '$comment_email', '$comment_content', 'Unapproved', now())";
                    $create_comment = $conn->query($query);

                    $get_post_count = "UPDATE `posts` SET `post_comment_count`= post_comment_count+1 WHERE `post_id`='$post_id'";
                    $update_comment_count = $conn->query($get_post_count);

                    if(!$create_comment) {
                        echo "Could not create comment ". $conn->connect_error;
                    }

                }
            ?>

            <h2>Comments</h2>
            <hr>

            <!-- Posted Comments -->

            <?php

                $query = "SELECT * FROM `comments` WHERE `comment_post_id`='$post_id' AND `comment_status`='approved' ORDER BY `comment_id` DESC";
                $get_comments = $conn->query($query);

                while($row = $get_comments->fetch_assoc()) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];
                    $comment_email = $row['comment_email'];
            ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="https://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author ?>
                        <small><?php echo $comment_date ?></small>
                    </h4>
                    <?php echo $comment_content ?>
                </div>
            </div>
            <hr>
            <?php } ?>

            <!-- Blog Sidebar Widgets Column -->

        </div>

        <?php include 'includes/sidebar.php'; ?>
    </div>
    <!-- /.row -->

</div>

<?php include 'includes/footer.php' ?>

</body>

</html>