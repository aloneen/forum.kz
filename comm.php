
<?php 
    require_once('connect.php');


    $comm_text = $_POST['text'];
    $comm_auth = $_SESSION['logged']['login'];
    $art_id = $_POST['art_id'];


    if($comm_text == '') {
        $_SESSION['message'] = 'Введите текст';
        header('Location: article.php?id=' . $art_id);
    }else {
        $comment = mysqli_query($connect, "INSERT INTO `comments` (`author`, `text`, `article_id`) VALUES ('$comm_auth', '$comm_text', '$art_id')");

        header('Location: article.php?id=' . $art_id);
    }

    

?>