<?php $conn = openCon(); ?>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email Address</th>
            <th>Role</th>
            <th colspan="4">Actions</th>
        </tr>
        </thead>

        <tbody>

        <?php

        $query = "SELECT * FROM `users`";
        $get_users = $conn->query($query);

        while($row = $get_users->fetch_assoc()){

        $user_id  = $row['user_id'];
        $username  = $row['username'];
        $password  = $row['password'];
        $user_firstname  = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_email  = $row['user_email'];
        $user_image  = $row['user_image'];
        $user_role = $row['user_role'];

        ?>

        <tr>
            <td><?php echo $user_id ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $user_firstname ?></td>

            <td><?php echo $user_lastname ?></td>
            <td><?php echo $user_email ?></td>
            <td><?php echo $user_role ?></td>
            <td><?php echo "<a class='btn btn-warning' href='users.php?remove_admin=$user_id'>Make Subscriber</a>" ?></td>
            <td><?php echo "<a class='btn btn-success' href='users.php?make_admin=$user_id'>Make Admin</a>" ?></td>
            <td><?php echo "<a class='btn btn-primary' href='edit_user.php?edit_user=$user_id'>Edit</a>" ?></td>
            <td><?php echo "<a class='btn btn-danger' href='users.php?delete=$user_id'>Delete</a>" ?></td>
        </tr>
        </tbody>

        <?php } ?>
    </table>

<?php
if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $query = "DELETE FROM `users` WHERE `user_id`='$delete_id'";

    $delete_comment = $conn->query($query);

    header('Location: users.php');
}

if(isset($_GET['make_admin'])) {
    $user_id = $_GET['make_admin'];

    $query = "UPDATE `users` SET `user_role`='admin' WHERE `user_id`='$user_id'";

    $make_admin = $conn->query($query);

    header('Location: users.php');
}

if(isset($_GET['remove_admin'])) {
    $user_id = $_GET['remove_admin'];

    $query = "UPDATE `users` SET `user_role`='subscriber' WHERE `user_id`='$user_id'";

    $remove_admin = $conn->query($query);

    header('Location: users.php');
}

closeCon($conn);