
<?php 
    require_once('connect.php');
    if(!$_SESSION['logged']) {
        header('Location: log.php');
    }

    $author = $_SESSION['logged']['login'];

    $categorie = mysqli_query($connect, "SELECT * FROM `categories`");
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
                    Создать статью
                </div>
                <form action="articles_sign.php" class="form" method="POST">
                    <br>
                    <small class="cattext">Введите заголовок:</small><br>
                    <br>
                    <input type="text" class="title" name="title" placeholder="Заголовок"><br>
                    <small class="cattext">Введите текст:</small><br>
                    <br>
                    <textarea name="text" id="text" cols="30" rows="5" placeholder="Текст"></textarea><br>
                    <small class="cattext">Выберите категорию:</small><br>
                    <select name="cat_id" id="cat_id">
                        <option value="none"></option>
                        <?php 
                            while($cat = mysqli_fetch_assoc($categorie)) {
                                echo '<option value="' . $cat['id'] . '">' . $cat['title'] . '</option>';
                            }
                        ?>
                    </select>
                    <button class="btn" id="btn_1" type="submit" name="btn">Отправить</button>

                </form>

                <?php 
                    $errors = array();
                    $title = $_POST['title'];
                    $text = $_POST['text'];
                    $cat_id = $_POST['cat_id'];
                    
                    
                    
                    if(isset($_POST['btn'])){

                        if($title == '') {
                            $errors[] = 'Введите зоголовок';
                        }
                        if($text == '') {
                            $errors[] = 'Введите текст';
                        }
                        if($cat_id == 'none') {
                            $errors[] = 'Выберите категорию';
                        }

                        if(empty($errors)) {
                            
                            $nw_article = mysqli_query($connect, "INSERT INTO `article` (`title`, `text`, `categorie_id`, `author`) VALUES ('$title', '$text', '$cat_id', '$author') ");

                            header('Location: index.php');

                        }else {
                            echo '<div style="color: red; margin: 12px;">' . $errors[0] . '</div>';
                        }
                    }
                ?>

            </div>
        </div>
    </div>

    <style type="text/css">
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
        
        .title {
            border-radius: 6px;
            margin: 10px;
            padding: 10px;
            width: 100vh;
        }
        #btn_1 {
            margin: 10px;
        }
        
        .cattext {
            padding: 10px;
            margin: 10px;
        }

        #text {
            border-radius: 6px;
            margin: 0px 10px;
            padding: 10px;
            width: 100vh;
        }

        #cat_id {
            margin: 10px;
            border-radius: 6px;
            padding: 10px;
        }

        .about__title {
            margin-top: 130px;
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