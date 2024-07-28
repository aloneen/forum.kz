
<?php 
    require_once('connect.php');
    

    $art_id = $_GET['id'];
    $articles = mysqli_query($connect, "SELECT * FROM `article` WHERE `id` = $art_id");
    $categories = mysqli_query($connect, "SELECT * FROM `categories`");
    $comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `article_id` = $art_id");
    $num = mysqli_num_rows($comments);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>forum</title>
        <link rel="stylesheet" href="style.css">

        <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<link rel="manifest" href="img/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

    </head> 

    <body>
        
    <header class="header">
            <div class="container">
                <div class="header__inner">
                    <a href="index.php" class="header__logo">
                        DS
                    </a>
                    <div class="header__navs">
                        <a href="index.php" class="nav__links">Главная</a>
                        <a href="articles_sign.php" class="nav__links">Вопрос</a>
                    </div>
                </div>
            </div>
    </header>

    <div class="about">
        <div class="container">
            <div class="about__inner">
                <?php

                $user = mysqli_query($connect, "SELECT * FROM `user`");

                while($art = mysqli_fetch_assoc($articles)) {
                        ?>
                        <div class="about__title">
                            <?php 
                                foreach($user as $us){
                                    if($us['login'] == $art['author']) {
                                        $art_user = $us;
                                        break;
                                    }
                                }
                            ?>
                            <img  src="<?php if($art_user['avatar'] == ''){ 
                                echo 'img/ava.jpg'; 
                            }else {
                                echo $art_user['avatar'];
                            } ?>" height="50" width="50" class="art_ava">
                            <style type="text/css">
                                .about__title{
                                    display: flex;
                                    align-items: center;
                                }
                                .art_ava {
                                    margin-right: 10px;
                                    border-radius: 50%;
                                    border: 2px solid blue;
                                }
                            </style>
                            <a href="article.php?id=<?php echo $art['id']; ?>" class="last_q"><?php echo $art['author'] . ': ' . $art['title']; ?></a>
                        </div>
                        <div class="art__cat">
                            <?php 
                                $art_cat = false;
                                foreach($categories as $cat) {
                                    if($cat['id'] == $art['categorie_id']){
                                        $art_cat = $cat;
                                        break;
                                    }
                                }
                            ?>
                            <small>Категория: <a href="/categorie.php?id=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="text">
                            <?php echo $art['text']; ?>
                        </div>

                        <?php
                    }
                    ?>
                
                    <?php 
                        if($_SESSION['logged']){
                            ?>
                            <form action="comm.php" method="post" class="comment">
                                <input name="art_id" value="<?php echo $art_id; ?>" id="none"></input>
                                <h3>Написать комментарий</h3>
                    
                                    <textarea name="text" id="text" cols="30" rows="5"></textarea><br>
                                    <button type="submit" id="btn" name="sign_btn" class="btn">
                                        Отправить
                                    </button>
                                    <p class="msg">
                                        <?php 
                                            echo $_SESSION['message'];
                                            unset($_SESSION['message']);
                                        ?>
                                    </p>
                            </form>

                            <?php
                        }else {
                            echo '<h3 class="h3">Чтобы написать комментарий <a id="ah3" href="log.php">авторизуйтесь.</a> </h3>';
                        }
                    ?>


            </div>
        </div>
    </div>


    <div class="commments">
        <div class="container">
            <div class="comm__inner">
                <div class="comm__title">
                    <h2>комментарий:</h2>
                </div>

                <?php 
                    

                    if($num == 0){
                        echo '<h3>Здесь пока нет комментариев</h3>';
                    }else {
                        while($comm = mysqli_fetch_assoc($comments)) {
                            ?>
                        <div class="art__inf">
                            <?php 
                                foreach($user as $us){
                                    if($us['login'] == $comm['author']) {
                                        $art_user = $us;
                                        break;
                                    }
                                }
                            ?>
                            <img  src="<?php if($art_user['avatar'] == ''){ 
                                echo 'img/ava.jpg'; 
                            }else {
                                echo $art_user['avatar'];
                            } ?>" height="30" width="30" class="art_ava">
                            <style type="text/css">
                                .art__inf{
                                    display: flex;
                                    align-items: center;
                                }
                                .art_ava {
                                    margin-right: 10px;
                                    border-radius: 50%;
                                    border: 2px solid blue;
                                }
                            </style>
                            <?php echo $comm['author'] . ': ' . $comm['text']; ?>

                        </div>
                            <?php
                        }
                        
                    }

                    
                ?>

            </div>
        </div>
    </div>


    <style type="text/css">
        #ah3 {
            color: blue;
        }
        .h3 {
            text-align: center;
            align-items: center;
            margin: 100px;
        }
        .msg {
            color: red;
            font-weight: 600;
            padding: 10px;
        }
        #none {
            display: none;
            margin: 0;
            padding: 0;
        }
        .comment {
            margin-top: 30px;
        }
        #btn {
            margin: 10px;
        }
        #text {
            margin: 10px;
            width: 100vh;
            padding: 10px;

        }
        .about {
            width: 100%;
            height: 600px;
            display: flex;
            text-align: left;
            align-items: unset;
            border-bottom: 2px solid black;
            padding: 14px;
            font-size: 18px;
        }

        .about__title {
            margin-top: 130px;
            font-size: 25px;
            font-weight: 600;
            padding: 10px;
        }
        .about__email {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .logout {
            color: red;
            margin: 0 auto;
            text-decoration: none;
            transition: opacity .2s linear;
        }
        .logout:hover {
            opacity: .7;
        }
        .text {
            font-size: 23px;
            padding: 10px;
        }
        small {
            font-size: 18px;
        }
    </style>


        
        <?php require 'block/footer.php'; ?>

    </body>

</html>
