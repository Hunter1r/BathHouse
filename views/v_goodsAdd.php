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

    <?php if(!$msg):?>

        <form method="POST" enctype="multipart/form-data" style="width:500px">
            <fieldset>
                <input type="number" name="id" style="display: none">
                <div>
                    <label for="title">Наименование</label>
                    <input name="title" id="title">
                </div>

                <div>
                    <label for="short_info">Описание короткое</label>
                    <input name="short_info" id="short_info">
                </div>

                <div>
                    <label for="full_info">Описание полное</label>
                    <textarea name="full_info" cols="30" rows="10"></textarea>
                </div>

                <div>
                    <label for="count">Количество</label>
                    <input name="count" id="count" type="number">
                </div>

                <div>
                    <label for="active">Активность</label>
                    <input name="active" id="active" type="checkbox" checked="1">
                </div>

                <div>
                    <label for="price">Цена</label>
                    <input name="price" id="price" type="number">
                </div>
                <div>
                    <label for="path_image">small img</label>
                    <input id="path_image" type="file" name="path_image" accept="image/*,image/jpeg">
                </div>

                <div>
                    <label for="path_image_b">big img</label>
                    <input id="path_image_b" type="file" name="path_image_b" accept="image/*,image/jpeg">
                </div>

                <input type="submit" value="Добавить товар">

            </fieldset>
        </form>

    <?php else:?>
    <div>
        <h2><?=$msg?></h2>
    </div>
    <div>
        <a href="index.php?c=page&act=adm">Продолжить редактирование каталога</a>
    </div>

        <?php endif;?>



</div>


