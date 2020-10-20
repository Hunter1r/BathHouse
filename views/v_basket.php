<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>

<h1><?=$title?></h1>
<div class="content">
    <?php
    if(count($content)>0):?>

    <table>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
    <?php
    $amount = 0;

    foreach ($content as $el):?>

            <?php
            $amount = $amount + $el['count']*$el['price'];
            ?>
            <tr>
                <td><?=$el['title']?></td>
                <td><?=$el['price']?></td>
                <td><?=$el['count']?></td>
                <td><?=$el['count']*$el['price']?></td>
                <td><a href="index.php?c=basket&act=inc&id=<?=$el['id']?>">Добавить</a></td>
                <td><a href="index.php?c=basket&act=dec&id=<?=$el['id']?>">Убавить</a></td>
            </tr>

        <?php endforeach;?>

        <td>Сумма заказа: <?=$amount?></td>
    </table>

    <?php else:?>
        <?php $message = ($msg) ? $msg : 'Ваша корзина пуста';?>
        <h2><?=$message?></h2>
    <?php endif;?>

</div>



<div style="visibility: <?=$vis?>">
    <h2>Оформить заказ в одно нажатие</h2>
    <form method="post">
        <!--             если залогинен, то скроем имя пользователя и пароль-->
        <?php if(!$_COOKIE['login']):?>
            <input type="text" name="login" placeholder="введите вашу фамилию">
            <input type="text" name="tel" placeholder="введите ваш телефон">
        <?php else:?>
            <input style="display: none" type="text" name="logged" value="$_COOKIE['login']">
        <?php endif?>
        <input type="submit" value="Оформить заказ">

    </form>
</div>