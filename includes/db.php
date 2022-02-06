<?php

function openCon()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'blog_cms';

    return mysqli_connect($host, $user, $password, $database);
}

function closeCon($conn) {
    $conn->close();
}