<?php
include '../../includes/db.php';

$conn = openCon();

if(isset($_POST['submit'])) {
    if($conn) {
        $cat_title = $_POST['cat_title'];

        if(!empty($cat_title)) {
            $query = "INSERT INTO `categories`(`cat_title`) VALUE ('$cat_title')";
            if($conn->query($query)) {
                echo "Successfully created a category";
                header ('location: ../categories.php');
            }
        }

    } else {
        echo "Connection error ". mysqli_connect_error();
    }
    closeCon($conn);
}