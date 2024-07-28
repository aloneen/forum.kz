
<?php 
    require_once('connect.php');
    if(!$_SESSION['logged']) {
        header('Location: index.php');
    }

    $auth = $_SESSION['logged']['login'];
    $log_id = $_SESSION['logged']['id'];

    $articles = mysqli_query($connect, "SELECT * FROM `article` WHERE `author` = '$auth' ");

    $categories = mysqli_query($connect, "SELECT * FROM `categories`");

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
                

                    if (!$_SESSION['logged']['avatar']) {
                        if (isset($_POST['sign_ava'])) {
                            
                            if($_FILES['avatar']['name'] != '') {

                                //echo $_FILES['avatar']['name'];
                                $path = 'uploads/' . time() . $_FILES['avatar']['name'];

                                if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {

                                    echo '<div style="color: red; margin: 12px;">Ошибка загрузки</div>';
                                    // code...
                                }
                                mysqli_query($connect, "UPDATE `user` SET `avatar` = '$path' WHERE `user`.`id` = '$log_id' ");


                                //Тут нужен код для добавления аватарки в сессию...
                                $_SESSION['logged']['avatar'] = $path;

                                header('Location: about.php');

                                
                            }else {
                                echo '<div style="color: red; margin: 12px; margin-top: 120px;">Ошибка загрузки</div>';
                            
                            }
                        }
                        ?>

                            <form class="form" action="about.php" method="post" enctype="multipart/form-data">
                                <div class="avatar">
                                    <h2>Хотите добавить вашу фотографию?</h2>
                                    <input type="file" name="avatar"> <br>
                                    <button class="btn" name="sign_ava" type="submit" id="btnn">сохранить</button>
                                </div>
                            </form>

                        <?php
                    }else {
                        ?>
                            <img id="ava" src="<?php echo $_SESSION['logged']['avatar'];  ?>" height="100" width="100">
                            
                        <?php
                    }
                ?>
                <div class="about__title">
                    <?php 
                        $login = $_SESSION['logged']['login'];

                        echo $login;                   
                    ?>
                </div>
                <div class="about__email">
                    <?php echo $_SESSION['logged']['email']; ?>
                </div>




                <div class="logout__btn">
                    <a href="logout.php" class="logout">Выйти</a>
                </div>



            </div>
        </div>
    </div>



    <div class="my__art">
        <div class="container">
            <div class="my_art_inner">
                <h2 >
                    Мои статьи:
                </h2>
                <?php 
                    while($art = mysqli_fetch_assoc($articles)) {
                        ?>
                        <div class="art__inf">
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
                            <div class="art__navs">
                                <a href="article.php?id=<?php echo $art['id']; ?>" class="last_q"><?php echo $art['author'] . ': ' . $art['title']; ?></a>
                                <form action="remove_art.php" method="post">
                                    <input class="input_none" value="<?php echo $art['id']; ?>" name="art_id">
                                    <button id="del" type="submit" name="del_btn">удалить</button>
                                </form>
                            </div>
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
                        <div class="art__prew">
                            <?php echo mb_substr($art['text'], 0, 50, 'utf-8') . '...'; ?>
                        </div>

                        <?php
                    }
                    ?>

            </div>
        </div>
    </div>
    
                

    <style type="text/css">
        .input_none {
            display: none;
        }
        .art__navs {
            display: flex;
            justify-content: space-between;
        }
        #del {
            text-align: right;
            margin-left: 20px;
            color: red;
            padding: 0;
            border: 0;
            font-weight: bold;
            transition: opacity .2s linear;
        }
        #del:hover {
            opacity: .7;
        }
        }
        .text_to_update {
            margin:  15px;
        }
        .form {
            margin-top: 130px;
        }
        #ava {
            margin-top: 130px;
            border-radius: 50%;
            border: 5px solid blue;
            margin-bottom: 15px;
        }
        #btnn {
            margin: 10px 0px;
            font-size: 14px;
        }
        .avatar {
            margin:  20px;
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
            font-size: 25px;
            font-weight: 600;
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
    </style>


        
        <?php require 'block/footer.php'; ?>

    </body>

</html>