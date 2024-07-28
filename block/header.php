<?php 
    $connect = mysqli_connect('localhost', 'root', 'dias2005', 'forumdb');
    if (!$connect) {
        die('Error connect to db');
    }

    session_start();
    

?>
<header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="index.php" class="header__logo">
                    DS
                </a>

            <?php 
                if( isset($_SESSION['logged']) ) {
                    ?>                   
                    <div class="header__navs">
                        <a href="index.php" class="nav__links">Главная</a>
                        <a href="articles_sign.php" class="nav__links">Вопрос</a>
                        <a href="about.php" class="nav__links" id="sign">Профиль</a>
                    </div>
                    <?php
                }else {
                ?> 
                <div class="header__navs">
                    <a href="index.php" class="nav__links">Главная</a>
                    <a href="articles_sign.php" class="nav__links">Вопросы</a>
                    <a href="log.php" class="nav__links" id="sign">Войти</a>
                </div>
           <?php } ?>

       </div>
    </div>
</header>