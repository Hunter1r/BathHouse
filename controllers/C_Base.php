<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends Controller
{
    protected $title;		// заголовок страницы
    protected $content;		// содержание страницы

    //
    // Конструктор.
    //
    function __construct()
    {
        $this->title = 'Название сайта';
        $this->content = '';
    }

    //
    // Генерация базового шаблона
    //
    public function render()
    {
        $usr = new User();
        $vars = array('title' => $this->title, 'content' => $this->content,'isAdmin'=>(bool)$usr->isAdmin());
        $page = $this->Template('views/v_main.php', $vars);
        echo $page;
    }
    protected function before()
    {
        $this->title = 'Название сайта';
        $this->content = '';
    }
}

