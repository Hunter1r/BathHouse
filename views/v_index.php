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

       <div class='good'>
           <div class='goodContent'>
               <p class='goodName'><a class='goodNameRef' href="index.php?c=page&act=good&id=<?=$el['id']?>"> <?=$el['title']?></a></p>

               <a href="index.php?c=page&act=good&id=<?=$el['id']?>"><img class="photo_name" src="whisk/small/<?=$el['photo_name']?>" alt="goodFoto"></a>

               <p class='goodTitle'><?=$el['short_info']?></p>

           </div>

           <div class='goodFooter'>
               <div>
                   <span>Цена:</span>
                   <span class='goodPrice'><?=$el['price']?> руб.</span>
                   </div>
               <div class='toBasket'>
                   <a class = 'toBasketBtn' href="index.php?c=basket&act=add&id=<?=$el['id']?>" class="buyBtn">В корзину</a>
                   </div>
           </div>
       </div>

       <?php endforeach;?>

   </div>
