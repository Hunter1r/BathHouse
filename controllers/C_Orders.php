<?php

class C_Orders extends C_Base{
    function __construct()
    {
        $this->title = '';
        $this->content = '';
    }

    protected function before()
    {
        $this->title = 'Заказы';
        $this->content = '';
    }

    public function action_index(){
        $msg = '';
        $orders = new Orders();
        $content = $orders->getOrders();

        $this->content = $this->Template('views/v_orders.php', array('title'=>$this->title, 'content' => $content));
    }

    public function action_del(){
        if(isset($_GET['id'])){
            //найти все заказы в корзине с именем пользователя и удалить их
            $ord = new Orders();
            $ord->deleteOrderByUserId($_GET['id']);
            $content = $ord->getOrders();
            $this->content = $this->Template('views/v_orders.php', array('title'=>$this->title, 'content' => $content));
        }
    }

}