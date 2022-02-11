<?php $conn = openCon(); ?>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>Response to</th>
            <th>Date</th>
            <th colspan="4">Action</th>
        </tr>
        </thead>

        <tbody>

        <?php

        $query = "SELECT * FROM `comments`";
        $get_comments = $conn->query($query);

        while($row = $get_comments->fetch_assoc()){

        $comment_id  = $row['comment_id'];
        $comment_post_id  = $row['comment_post_id'];
        $comment_author  = $row['comment_author'];
        $comment_content  = $row['comment_content'];
        $comment_email  = $row['comment_email'];
        $comment_status  = $row['comment_status'];
        $comment_date  = $row['comment_date'];

        ?>

        <tr>
            <td><?php echo $comment_id ?></td>
            <td><?php echo $comment_author ?></td>
            <td><?php echo $comment_content ?></td>

<!--            --><?php
//            $query = "SELECT * FROM `comments` WHERE `comment_post_id` = '$post_category_id'";
//            $fetch = $conn->query($query);
//            $row = $fetch->fetch_assoc();
//            $cat_title = $row['cat_title'];
//            ?>

            <td><?php echo $comment_email ?></td>
            <td><?php echo $comment_status ?></td>
            <td><?php echo "Some Title" ?></td>
            <td><?php echo $comment_date ?></td>
            <td><?php echo "<a class='btn btn-success' href='edit_post.php?edit='>Approve</a>" ?></td>
            <td><?php echo "<a class='btn btn-warning' href='posts.php?delete='>Disapprove</a>" ?></td>
            <td><?php echo "<a class='btn btn-primary' href='posts.php?delete='>Edit</a>" ?></td>
            <td><?php echo "<a class='btn btn-danger' href='posts.php?delete='>Delete</a>" ?></td>
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