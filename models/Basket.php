<?php
//	include_once 'DB.php';

	class Basket {

		public $user_id, $user_login, $user_name, $user_password;


		public function getGoodId () {
			return DB::Select('SELECT good_id, count FROM cart WHERE in_order=0');
		}

        public function getGoodIdById ($good_id) {
            return DB::getRow('SELECT good_id, count FROM cart WHERE in_order=0 AND good_id = :good_id',['good_id'=>(int)$good_id]);
        }

        public function getInfo ($good_id) {
            return DB::Select('SELECT id,title,price FROM goods WHERE active = true AND id= :good_id',['good_id'=>$good_id]);
        }

        public function inc($good_id){
		    return DB::Update('UPDATE cart SET count = count + 1 WHERE good_id = :good_id AND in_order = 0',['good_id'=>(int)$good_id]);
        }

        public function dec($good_id){
		    //сначала надо проверить можно ли уменьшать кол-во. Может это последняя штука в корзине
            $good_info = $this->getGoodIdById($good_id); //получаем товар с id в корзине. его может не быть.
            if($good_info['count']>=2){
                return DB::Update('UPDATE cart SET count = count - 1 WHERE good_id = :good_id AND in_order = 0',['good_id'=>$good_id]);
            }else{
                return DB::Delete('DELETE FROM cart WHERE good_id = :good_id AND in_order = 0',['good_id'=>$good_id]);
            }
        }
         public function add($good_id){
		    //если такой товар в корзинке уже есть, то добавим к нему единицу
             $goodId = $this->getGoodIdById($good_id);
            // var_dump($goodId);
             if($goodId){
                 $this->inc($goodId['good_id']);
             }else{
                 //если такого товара нет, то добавим. НО сначала проверим есть ли такой товар в каталоге.
                 $item = $this->getInfo($good_id);
                 if($item){
                     return DB::Insert("INSERT INTO cart (good_id, count, in_order) VALUES (:good_id,1,0)",['good_id'=>(int)$item[0]['id']]);
                 }
             }
         }

        public function getBasket(){
		    $arrBasket = $this->getGoodId();
		    $i = 0;
		    $content = array();
            foreach($arrBasket as $item){
                $good_info = $this->getInfo($item['good_id']);
            foreach ($good_info as $el){
                $content[$i] = array('id'=>$item['good_id'],'title'=>$el['title'],'price'=>$el['price'],'count'=>$item['count']);
            }
            $i++;
        }
        return $content;
        }
	}

?>