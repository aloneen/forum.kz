<?php 
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'dias2005', 'forumdb');
    if (!$connect) {
        die('Error connect to db');
    }


?>