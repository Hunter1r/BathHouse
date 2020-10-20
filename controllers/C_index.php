<?php

class C_index extends C_Base{
    function __construct()
    {
        $this->title = '';
        $this->content = '';
    }

    public function action_index(){

        $this->title = 'Каталог товаров';

        $con = new Good();
        $arr = $con->goodgetindex();
        $this->content = $this->Template('views/v_index.php', array('content' => $arr));
    }

    public function action_adm(){
        $usr = new User();
        if(!$usr->isAdmin()){exit();}
        $good = new Good();
        $arrGoods = $good->goodgetindex();
        $this->content = $this->Template('views/v_goodsEdit.php', array('title'=>'Редактирование каталога','content' => $arrGoods));

        //Если нажали Сохранить на карточке товара при администрировании каталога товаров
        if($this->IsPost()){
            $arrayParam = $good->createArrayParam();
            $good->goodUpdate($arrayParam);

            //если вдруг изменили картинку, то применим эти изменения в базе
            $arrayParam = $good->changeImage();
            $good->goodUpdate($arrayParam);

            $arrGoods = $good->goodgetindex();
            $this->content = $this->Template('views/v_goodsEdit.php', array('title'=>'Редактирование каталога','content' => $arrGoods));
        }
    }

    public function action_del(){
        $usr = new User();
        if(!$usr->isAdmin()){exit();}
        if(isset($_GET['id'])){
            $good = new Good();
            $good->goodDelById($_GET['id']);
            $arrGoods = $good->goodgetindex();
            $this->content = $this->Template('views/v_goodsEdit.php', array('title'=>'Редактирование каталога','content' => $arrGoods));

        }
    }

    public function action_add(){
        $arrayParam = array();
        $usr = new User();
        if(!$usr->isAdmin()){exit();}
        $this->content = $this->Template('views/v_goodsAdd.php', array('title'=>'Добавление товара в каталог'));

        $good = new Good();
        $arrayParam = $good->createArrayParam();
        $good->goodUpdate($arrayParam);

        //если вдруг изменили картинку, то применим эти изменения в базе
        $arrayParam = $good->changeImage();
        $good->goodUpdate($arrayParam);

    if(count($arrayParam)>0){
        $good = new Good();
        $stringId = $good->goodAdd($arrayParam);
        $this->content = $this->Template('views/v_goodsAdd.php', array('title'=>'Добавление товара в каталог','msg'=>'Товар добавлен в каталог'));
    }

    }

    public function action_good(){
        if(isset($_GET['id'])){
            //получить данные о товаре
            $good = new Good();
            $item = $good->goodget($_GET['id']);
            //передать их во вьюшку
            $this->content = $this->Template('views/v_good.php', array('title'=>'Карточка товара','content'=>$item));
        }

    }
}