
<?php 
    require_once 'connect.php';

    if($_SESSION['logged']) {
        header('Location: about.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DS</title>
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

        <div class="log">
            <div class="container">
                <div class="log__inner">
                <?php 
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];
                    $btn = $_POST['sign'];

                    $error = '';

                    if(isset($btn)) {
                        if(trim($email) == '') {
                            $error = 'Введите Email';
                        }
                        if(trim($pass) == '') {
                            $error = 'Введите пароль';
                        }
                        if($error == '') {
                            // Тут пишем работу с базой данных

                            $pass = md5($pass);

                            $check = mysqli_query($connect, "SELECT * FROM `user` WHERE `email` = '$email' AND `pass` = '$pass' ");
                            
                            $num = mysqli_num_rows($check);

                            if ($num == 0) {
                                echo '<div style="color: red; margin: 12px;">Ошибка! Прошу перепроверьте данные</div>';
                            }else {

                                $user = mysqli_fetch_assoc($check);
                                
                                $_SESSION['logged'] = [
                                    "id" => $user['id'],
                                    "email" => $user['email'],
                                    "login" => $user['login'],
                                    "avatar" => $user['avatar']
                                ];

                                
                                header('Location: /');

                            }



                        }else {
                            echo '<div style="color: red; margin: 12px;">' . $error[0] . '</div>';
                        }
                    }

                ?>
                    <form action="/log.php" method="post">
                        <h3>Email</h3>
                        <input type="email" name="email" placeholder="Введите Email" class="email"> <br>
                        <h3>Пароль</h3>
                        <input type="password" name="pass" placeholder="Введите пароль" class="pass"> <br>

                        <button type="submit" name="sign" id="btn">отправить</button>
                        <a href="reg.php" style="margin-left:10px;">Нет аккаунта?</a>
                    </form>
                </div>
            </div>
        </div>
        
        <?php require 'block/footer.php'; ?>

    </body>

</html>