<?php
//Контроллер главной страницы
//include_once("controllers/C_index.php");
//include_once("controllers/C_User.php");
//include_once("controllers/C_Basket.php");
//include_once("controllers/C_Orders.php");
include_once "autoload.php";




$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

if (isset($_GET['c'])) {
    if ($_GET['c'] == 'page') {
        $controller = new C_index();
    } else if ($_GET['c'] == 'user') {
        $controller = new C_User();
//    } else if ($_GET['c'] == 'good') {
//        $controller = new C_Good();
    } else if ($_GET['c'] == 'basket') {
        $controller = new C_Basket();
    } else if ($_GET['c'] == 'orders') {
        $controller = new C_Orders();
    }
} else {
    $controller = new C_index();
}
$controller->Request($action);