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

            if(isset($_POST['submit'])) {

                $search = $_POST['search'];

                $search_query = "SELECT * FROM `posts` WHERE `post_tags` LIKE '%$search%'";

                $search_result = $conn->query($search_query);

                if(!$search_result) {
                    echo `Error connecting to database` . $conn->error;
                    closeCon($conn);
                }

                $count = $search_result->num_rows;

                if($count == 0) {

                    echo "<h3>No result found! <a href='index.php'>Back to home</a></h3>";

                } else {

                    $searched_posts = $conn->query($search_query);

                    while($row = $searched_posts->fetch_assoc()){
                        $searched_post_title = $row['post_title'];
                        $searched_post_author = $row['post_author'];
                        $searched_post_date = $row['post_date'];
                        $searched_post_content = $row['post_content'];
                        $searched_post_image = $row['post_image'];

                        ?>

                        <h2>
                            <a href="#"><?php echo $searched_post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $searched_post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $searched_post_date ?></p>
                        <hr>
                        <img width="600" height="300" class="img-responsive" src="images/<?php echo $searched_post_image ?>" alt="">
                        <hr>
                        <p><?php echo $searched_post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr><?php }

                 }

                closeCon($conn);

            } ?>

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