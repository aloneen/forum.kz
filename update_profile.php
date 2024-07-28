
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

                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                    <h3>Изменить аву</h3>
                    <input type="file" name="avatar"> <br>
                    <h3>Изменить логин</h3>
                    <input type="text" name="login">
                    <h3>Изменить email</h3>
                    <input type="email" name="email">
                    <h3>Изменить пароль</h3>
                    <input type="password" name="pass">
                    <h3>Подтвердите пароль</h3>
                    <input type="password" name="pass_2"><br>
                    <button type="submit" class="btn">
                        Редактировать
                    </button>
                </form>


            </div>
        </div>
    </div>



                

    <style type="text/css">
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
        .about__inner {
            margin-top: 100px;
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