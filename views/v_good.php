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

       <?php if($content):?>

       <div class="goodCard">
           <div class="image">
               <img class="goodImage" src="/whisk/big/<?=$content['photo_name']?>" alt="<?=$content['photo_name']?>">
           </div>
           <div class="other">
               <div class="info">
                   <p class="infoParagraph"><?=$content['full_info']?></p>
               </div>
               <div class="toBasket">
                   <a class = "toBasketBtn" href="index.php?c=basket&act=add&id=<?=$content['id']?>" class="buyBtn">В корзину</a>
               </div>
           </div>
       </div>

       <?php endif;?>

   </div>
