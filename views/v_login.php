<?php
/**
 * Шаблон регистрации
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
?>

<h1><?=$title?></h1>
<div class="content" style="display: inherit">

        <form method="post" style="visibility: <?=$vis?>">
            <div class="wrap">
                <div class="label_lk">
                    <label for="login">Введите логин:</label>
                </div>
                <input class="input_lk" type="text" name="login" placeholder="ваш логин">
            </div>
            <div class="wrap">
                <div class="label_lk">
                    <label for="pass1">Введите пароль:</label>
                </div>
                <input class="input_lk" type="password" name="pass1" placeholder="ваш пароль">
            </div>

            <input  class="submit" type="submit" value="Войти">
        </form>

        <p><?=$msg?></p>



</div>


