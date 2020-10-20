<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="stylesheet" href="/styles/stylesShop.css">
</head>
<body>

<header>
    <div id="headerInside">
        <div id="logo"></div>
        <div id="companyName">BathHouse</div>
        <div id="navWrap">
            <a href="index.php">Главная</a>

            <?php

            if($_COOKIE['login']): //$_GET['success'] &&
                ?>
                <a href="index.php?c=user&act=logout">Выход (<?=$_COOKIE['login']?>)</a>
                <a href="index.php?c=user&act=info">Личный кабинет</a>
            <?php else:?>
                <a href="index.php?c=user&act=login">Вход</a>
                <a href="index.php?c=user&act=reg">Регистрация</a>
            <?php endif?>


            <a href="index.php?c=basket&act=index">Корзина</a>


            <?php if($isAdmin):?>
                <a href="index.php?c=page&act=adm">Админить товары</a>
                <a href="index.php?c=orders&act=index">Админить заказы</a>
            <?php endif?>

        </div>

    </div>
</header>

<?php //include ("views/v_index.php")?>
<?=$content?>

</body>
</html>
