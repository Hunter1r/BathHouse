<?php
//	include_once 'DB.php';
// класс DB подключается с помощью autoload.php как и остальные классы
	class Orders {

		public $user_id, $user_login, $user_name, $user_password;



		public function getGoodId () {
			return DB::Select('SELECT good_id, count FROM cart WHERE in_order=0');
		}



        public function getInfo ($good_id) {
            return DB::Select('SELECT id,title,price FROM goods WHERE active = true AND id= :good_id',['good_id'=>$good_id]);
        }

        public function deleteOrderByUserId($user_id){
            return DB::Delete('DELETE  FROM cart WHERE user_id= :user_id',['user_id'=>(int)$user_id]);
        }

        public function getOrders(){
		    $content = array();

		    $i = 0;
		    $usersInOrders = DB::Select('SELECT distinct user_id,login FROM cart LEFT JOIN users ON cart.user_id=users.id WHERE in_order=1');

            foreach ($usersInOrders as $user) {
                $content[$user['login']] = array();

                $arrOrders = DB::Select('SELECT min(cart.id) cart_id, min(cart.user_id) user_id, min(cart.good_id) good_id,min(cart.in_order) in_order, min(cart.count) good_count,good.title title,min(good.price) price, sum(good.price*cart.count) as amount, user.login login, min(user.role) role FROM cart LEFT JOIN goods as good ON good.id = cart.good_id LEFT JOIN users AS user on user.id=cart.user_id WHERE cart.in_order=1 and user_id = :user_id
group by login, title',['user_id'=>$user['user_id']]);

                $amount = 0;
                $contOrder = '';
                foreach($arrOrders as $order){
                    $amount += $order['amount'];
                    $contOrder = array('good_id'=>$order['good_id'],'title'=>$order['title'],'good_count'=>$order['good_count'],'price'=>$order['price']);
                    $content[$user['login']][] = array('login'=>$order['login'],'order'=>json_encode($contOrder),'amount'=>$order['amount'],'user_id'=>$user['user_id']);
                }
                $i++;
		    }

        return $content;
        }
	}

?>