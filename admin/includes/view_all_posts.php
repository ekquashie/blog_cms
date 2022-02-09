<?php $conn = openCon(); ?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Dates</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>

    <tbody>

    <?php

    $query = "SELECT * FROM `posts`";
    $get_posts = $conn->query($query);

    while($row = $get_posts->fetch_assoc()){

    $post_id  = $row['post_id'];
    $post_category_id  = $row['post_category_id'];
    $post_title  = $row['post_title'];
    $post_author  = $row['post_author'];
    $post_date  = $row['post_date'];
    $post_image  = $row['post_image'];
    $post_content  = $row['post_content'];
    $post_tags  = $row['post_tags'];
    $post_status  = $row['post_status'];
    $post_comment_count = $row['post_comment_count'];

    ?>

    <tr>
        <td><?php echo $post_id ?></td>
        <td><?php echo $post_author ?></td>
        <td><?php echo $post_title ?></td>
        <?php
            $query = "SELECT * FROM `categories` WHERE `cat_id` = '$post_category_id'";
            $fetch = $conn->query($query);
            $row = $fetch->fetch_assoc();
            $cat_title = $row['cat_title'];


        ?>
        <td><?php echo $cat_title ?></td>
        <td><?php echo $post_status ?></td>
        <td><?php echo "<img width='60' height='50' alt='post_image' src='../images/$post_image'>"?></td>
        <td><?php echo $post_tags ?></td>
        <td><?php echo $post_comment_count ?></td>
        <td><?php echo $post_date ?></td>
        <td><?php echo "<a class='btn btn-primary' href='edit_post.php?edit=$post_id'>Edit</a>" ?></td>
        <td><?php echo "<a class='btn btn-danger' href='posts.php?delete=$post_id'>Delete</a>" ?></td>
    </tr>
    </tbody>
    <?php } ?>
</table>

<?php
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $query = "DELETE FROM `posts` WHERE `post_id`='$delete_id'";

        $delete_post = $conn->query($query);

        header('Location: posts.php');
    }

    closeCon($conn);