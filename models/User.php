<?php
	include_once 'DB.php';

	class User {

		public $user_id, $user_login, $user_name, $user_password;



		public function pass ($name, $password) {
			//return strrev(md5($name)) . md5($password);
            return md5($name) . md5($password);
		}

		public function get ($login) {
			return DB::GetRow('SELECT * FROM users WHERE login = :log', ['log' => $login]);
		}

		public function newR ($login, $array) {
		    $pass1 = $array['pass1'];
		    $pass2 = $array['pass2'];
            if($pass1 != $pass2){
                return false;
            }
			$user = DB::GetRow('SELECT * FROM users WHERE login = :login', ['login' => $login]);
			if (!$user) {
				DB::Insert('INSERT INTO users (`login`, `pass`)  VALUES (:login, :password)', ['login' => $login, 'password' => $this->pass($login, $pass1)]);
				return true;
			}
			return false;

		}

		public function isLogIn(){
		    if(isset($_COOKIE['login'])){
		        return $this->get($_COOKIE['login']);
            }else {
                return false;
            }
        }

        public function isAdmin(){
		    $usr = $this->isLogIn();
		    if($usr){
                return DB::GetRow('SELECT * FROM users WHERE role=1 AND login = :log', ['log' => $usr['login']]);
            }else{
		        return 0;
            }
        }
		public function login ($login, $password) {
			$user = DB::GetRow('SELECT * FROM users WHERE login = :login', ['login' => $login]);

			if ($user) {
				if ($user['pass'] == $this->pass($user['login'], strip_tags($password))) {
    				//$_SESSION['user_id'] = $user['id'];
                    setcookie("login", $user['login'],time()+3600);
                    setcookie("pass", $user['pass'],time()+3600);
    				return 'ok';
				} else {
					return 'Пароль не верный!';
				}
			} else {
				return 'Пользователь с таким логином не зарегистрирован!';
			}
		}

		public function logout () {
		    if(isset($_COOKIE['login'])){
                setcookie('login','',time()-3600);
            }
            if(isset($_COOKIE['pass1'])){
                setcookie('pass1','',time()-3600);
            }
		}

		public function createOrder($user){
		    return DB::Update('UPDATE cart SET user_id = :user_id ,in_order=1 WHERE in_order=0',['user_id'=>(int)$user['id']]);
        }
	}
?>