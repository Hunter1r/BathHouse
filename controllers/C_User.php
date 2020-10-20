<?php
////	include_once 'models/User.php';

	class C_User extends C_Base {



		public function action_info() {
			
			$get_user = new User();
			$user_info = $get_user->get($_COOKIE['login']);
			$this->content = $this->Template('views/v_lk.php', array('user_info' => $user_info));
		}
		
		public function action_reg() {
			
			$this->title = 'Регистрация';

			$this->content = $this->Template('views/v_reg.php', array('title'=>$this->title,'vis'=>'visible'));

			if($this->isPost()) {
				$new_user = new User();
				$result = $new_user->newR($_POST['login'], array('pass1'=>$_POST['pass1'],'pass2'=>$_POST['pass2']));
				if ($result) {
					//$this->content = $this->Template('views/v_reg.php', array('msg' => "Регистрация прошла успешно!",'vis'=>'hidden'));
                    //Если регистрация прошла успешно, то делаем вход и переход на главную страницу
                    $login = new User();
                    $result = $login->login($_POST['login'], $_POST['pass1']);
                    if($result=='ok'){
                        header("location:index.php");
                    }else{
                        $this->content = $this->Template('views/v_login.php', array('msg' => $result));
                    }
				} else {
				$this->content = $this->Template('views/v_reg.php', array('msg' => "Такой пользователь уже существует!"));
				}
			}
		}

		public function action_login() {
			$this->title = 'Вход в личный кабинет';
			$this->content = $this->Template('views/v_login.php', array('title'=>$this->title));

			if($this->isPost()) {
				$login = new User();
				$result = $login->login($_POST['login'], $_POST['pass1']);
				if($result=='ok'){
                    header("location:index.php");
                }else{
                    $this->content = $this->Template('views/v_login.php', array('msg' => $result));
                }
			}
		}

		public function action_logout() {
			$logout = new User();
			$logout->logout();
			header("location:index.php");
		}
	}
?>