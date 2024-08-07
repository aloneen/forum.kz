<?php 
    require_once('connect.php');
    $cat_id = $_GET['id'];
    $categorie = mysqli_query($connect, "SELECT * FROM `categories` WHERE `id` = $cat_id");
    $cat = mysqli_fetch_assoc($categorie);
    $articles = mysqli_query($connect, "SELECT * FROM `article` WHERE `categorie_id` = $cat_id");
    $num = mysqli_num_rows($articles);
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
        
        <?php require 'block/header.php'; ?>


        <div class="about">
            <div class="container">
                <div class="about__inner">
                    <div class="about__title">
                        <?php echo $cat['title']; ?>
                    </div>
                    <div class="last__inner">
                        <?php

                        if($num == 0) {
                            echo 'Здесь пока нету статьи';
                        }else {
                            $user = mysqli_query($connect, "SELECT * FROM `user`");

                            while($art = mysqli_fetch_assoc($articles)) {
                                ?>
                                <div class="art__inf">
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
                                    <a href="article.php?id=<?php echo $art['id']; ?>" class="last_q"><?php echo $art['author'] . ': ' . $art['title']; ?></a>
                                </div>
                                <div class="art__prew">
                                    <?php echo mb_substr($art['text'], 0, 50, 'utf-8') . '...'; ?>
                                </div>
    
                                <?php
                            }
                        }
                        ?>
                
                    </div>
                </div>
            </div>

        </div>

        <style>
            .about {
                width: 100%;
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
            }
        </style>
        
        
        <?php require 'block/footer.php'; ?>

    </body>

</html>