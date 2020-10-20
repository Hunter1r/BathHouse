<?php

//    include_once 'DB.php';
// класс DB подключается с помощью autoload.php как и остальные классы
    
    class Good {
 
    public function goodget($id){
        return DB::getRow("SELECT * FROM goods WHERE id = :id",['id'=>(int)$id]);
    }

    public function goodgetindex(){
        return DB::Select("SELECT goods.id AS id, goods.title AS title, goods.short_info AS short_info, goods.full_info AS full_info, goods.count AS count,goods.active AS active, goods.photo_name AS photo_name,goods.price AS price  FROM goods"); //WHERE goods.active = 1
    }

    public function goodDelById($id){
        return DB::Delete("DELETE FROM Goods Where id=:id",['id'=>(int)$id]);

    }

    public function goodAdd($arrayParam){

        return DB::Insert("INSERT INTO goods (title, short_info, full_info, count,photo_name,price)
        VALUES (:title,:short_info,:full_info,:count,:photo_name,:price)",$arrayParam);
    }

        public function goodUpdate($arrayParam){
        if(isset($arrayParam['photo_name'])){
            //меняем только картинку товара
            return DB::Update("UPDATE goods SET photo_name=:photo_name WHERE id=:id",$arrayParam);

        }elseif(count($arrayParam)>0){
            //меняем все, кроме картинки товара
        return DB::Update("UPDATE goods SET title =:title, short_info=:short_info, full_info=:full_info, count=:count,
active=:active, price=:price WHERE id=:id",$arrayParam);

        }
        }

        public function createArrayParam($source=[]){
            //если есть содержимое в суперглобальном массиве, то берем данные оттуда
            if(count($_POST)>0){
                $source = $_POST;
            }elseif (!$source){
                return array();
            }
            $arrayParam = array();
            if(isset($_POST['id'])){
                $arrayParam['id'] = $_POST['id'];
                $arrayParam['title'] = $_POST['title'];
                $arrayParam['short_info'] = $_POST['short_info'];
                $arrayParam['full_info'] = $_POST['full_info'];
                $arrayParam['count'] = $_POST['count'];
                $arrayParam['active'] = (bool)$_POST['active'];
                $arrayParam['price'] = $_POST['price'];
            }
            return $arrayParam;
        }

        public function changeImage(){
            if ( !empty( $_FILES['path_image']['name'] ) ) {
                $path_small = 'whisk/small/'.$_FILES['path_image']['name'];
                $path_big = 'whisk/big/'.$_FILES['path_image']['name'];
                $uploaded_small = move_uploaded_file( $_FILES['path_image']['tmp_name'], $path_small );
                $uploaded_big = move_uploaded_file( $_FILES['path_image_b']['tmp_name'], $path_big );
                if ( $uploaded_small && $uploaded_big ) {
                    //запишем новое имя файла в БД
                    $file_name = $_FILES['path_image']['name'];
                    $arrayParam['photo_name'] = $file_name;
                    // только если файл успешно загружен, то сформируем id Для записи данных в базу
                    if(isset($_POST['id'])){
                        $arrayParam['id'] = $_POST['id'];
                    }else{
                        //exit('отсутствует id товара');
                        return array();
                    }
                } else {
                    return array();
                }
            }else{ $arrayParam = array();
            }
            return $arrayParam;
        }

}

