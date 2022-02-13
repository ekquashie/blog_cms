<?php

include "db.php";
$conn = openCon();

session_start();

$username = '';
$password = '';
$db_username = '';
$db_password = '';
$get_user = '';
$user_role = '';

if(isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $username = $conn->real_escape_string($username);
   $password = $conn->real_escape_string($password);

   $query = "SELECT * FROM `users` WHERE `username`='$username'";
   $get_user = $conn->query($query);

   if(!$get_user) {
    echo "Error connecting to database". $conn->error;
   }
}

while($row = $get_user->fetch_assoc()) {
    $user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_password = $row['password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
}

if($username === $db_username && $password === $db_password && $user_role === 'admin') {

    $_SESSION['username'] = $db_username;
    $_SESSION['user_role'] = $user_role;
    $_SESSION['user_firstname'] = $user_firstname;
    $_SESSION['user_lastname'] = $user_lastname;

    header('Location: ../admin/index.php');

} else {
    header('location: ../index.php');
}

