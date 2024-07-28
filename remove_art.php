<?php 
	require_once("connect.php");

	$article_id = $_POST['art_id'];

	$art = mysqli_query($connect, "DELETE FROM `article` WHERE `id` = '$article_id' ");

	header('Location: about.php');



?>