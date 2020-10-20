<?php

class C_Basket extends C_Base{
    function __construct()
    {
        $this->title = '';
        $this->content = '';
    }

    protected function before()
    {
        $this->title = 'Корзина';
        $this->content = '';
    }

    public function action_index(){
        $msg = '';
        //$this->title = 'Корзинка';
        $get_bsk = new Basket();
        $this->content = $this->Template('views/v_basket.php', array('title'=>$this->title, 'content' => $get_bsk->getBasket()));
        if($this->IsPost()){
            //проверить залогинен ли пользователь
            $user = new User();
            $login = $user->isLogIn();

            if($login){
                //оформляем заказ на пользователя
                $user->createOrder($login);
                $msg = 'Спасибо за заказ';
            }else{
                //надо залогинить пользователя
                if(isset($_POST['login'])){
                    if(isset($_POST['tel'])){
                        $array = array('pass1'=>$_POST['tel'],'pass2'=>$_POST['tel']);
                        $login = $_POST['login'];
                        $user->newR($login,$array);
                        //после того как создали пользователя, надо выполнить процедуру входа
                        $rez = $user->login($login,$_POST['tel']);
                        //header("location:index.php?c=basket&act=index");
                        $usr = $user->get($login);

                        $user->createOrder($usr);
                        $msg = 'Спасибо за заказ';
                    }
                }
            }
            $this->content = $this->Template('views/v_basket.php', array('title'=>$this->title, 'content' => $get_bsk->getBasket(),'msg'=>$msg));
        }
    }

    public function action_add(){
        if(isset($_GET['id'])){
            $bsk = new Basket();
            $bsk->add($_GET['id']);

            $con = new GetContent();
            $arr = $con->getget();
            $this->content = $arr;
            $this->content = $this->Template('views/v_index.php', array('content' => $arr));
        }
    }

    public function action_inc(){
        $bsk = new Basket();
        if(isset($_GET['id'])){
            $res = $bsk->inc((int)$_GET['id']);
            $this->content = $this->Template('views/v_basket.php',['title'=>$this->title, 'content'=>$bsk->getBasket()]);
        }
    }

    public function action_dec(){
        $bsk = new Basket();
        if(isset($_GET['id'])){
            $res = $bsk->dec((int)$_GET['id']);
            $this->content = $this->Template('views/v_basket.php',['title'=>$this->title, 'content'=>$bsk->getBasket()]);
        }
    }

}