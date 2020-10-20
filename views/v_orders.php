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
        <th>Пользователь</th>
        <th>Содержание заказа</th>
        <th>Сумма заказа</th>
    <?php

    foreach ($content as $el=>$val):?>

            <?php
            $total = 0;
            $user_id = '';
            ?>
            <tr>
                <td><?=$el?></td>

                <td>
                    <?php foreach ($val as $item){
                    $arr = json_decode($item['order'],true);
                    $total += $item['amount'];
                    $user_id = $item['user_id'];
                    echo $arr['title'] . '(' .$arr['good_count'] . 'x' . $arr['price'] .');';
                }
                    ?>
                </td>
                <td>
                    <?=$total?>
                </td>
                <td><a href="index.php?c=orders&act=del&id=<?=$user_id?>">Удалить</a></td>
                <?php endforeach;?>
            </tr>
    </table>

    <?php else:?>
        <?php $message = ($msg) ? $msg : 'Ваша корзина пуста';?>
        <h2><?=$message?></h2>
    <?php endif;?>

</div>


