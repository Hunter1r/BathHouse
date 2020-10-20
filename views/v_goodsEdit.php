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
        foreach ($content as $el):?>

            <form method="POST" enctype="multipart/form-data">
                <fieldset>
                    <input type="number" name="id" value="<?=$el['id']?>" style="display: none">
                    <div>
                        <label for="title">Наименование</label>
                        <input name="title" id="title" value="<?=$el['title']?>">
                    </div>

                    <div>
                        <input class="photo_name" name="photo_name" type="image" src="whisk/small/<?=$el['photo_name']?>" alt="<?=$el['photo_name']?>">
                    </div>

                    <div>
                        <label for="short_info">Описание короткое</label>
                        <input name="short_info" id="short_info" value="<?=$el['short_info']?>">
                    </div>

                    <div>
                        <label for="full_info">Описание полное</label>
                        <textarea name="full_info" cols="30" rows="10"><?=$el['full_info']?></textarea>
                    </div>

                    <div>
                        <label for="count">Количество</label>
                        <input name="count" id="count" type="number" value="<?=$el['count']?>">
                    </div>


                    <label for="active">Активность</label>
                    <input name="active" id="active" type="checkbox" checked="<?=$el['active']?>">
                    <div>
                        <label for="price">Цена</label>
                        <input name="price" id="price" type="number" value="<?=$el['price']?>">
                    </div>

                    <div>
                        <label for="path_image">small img</label>
                        <input id="path_image" type="file" name="path_image" accept="image/*,image/jpeg">
                    </div>

                    <div>
                        <label for="path_image_b">big img</label>
                        <input id="path_image_b" type="file" name="path_image_b" accept="image/*,image/jpeg">
                    </div>

                    <input type="submit" value="Сохранить">

                    <a href="index.php?c=page&act=del&id=<?=$el['id']?>">Удалить товар</a>
                </fieldset>
            </form>
        <?php endforeach;?>
        <a href="index.php?c=page&act=add">Добавить товар в каталог</a>

</div>


