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

                $query = "SELECT * FROM `posts`";
                $posts_results = $conn->query($query);

                while($row = $posts_results->fetch_assoc()){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_image = $row['post_image'];

                ?>

                <h2>
                    <a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
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

            <!-- Blog Sidebar Widgets Column -->

            </div>

            <?php include 'includes/sidebar.php'; ?>
        </div>
        <!-- /.row -->

        <hr>
    </div>

    <?php include 'includes/footer.php' ?>

</body>

</html>