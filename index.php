<?php

//if (isset($_SESSION)){
	if(isset($_GET['controle']) & isset($_GET['action']) & isset($_GET['id'])){
		try {
			$controle = $_GET['controle'];

			if (!file_exists('./controller/' . $controle . '.php')){
				throw new Exception("Require doesn't exist");
			} else {
				require ('./controller/' . $controle . '.php');
				$cont = new $controle();
				$action= $_GET['action'];
				$id=$_GET['id'];
				$cont->{$action}($id); 
			}
		} catch (Exception $e){
			require("vue/erreur404.html");
		}
	}
	elseif (isset($_GET['controle']) & isset($_GET['action'])) {
		try {
			$controle = $_GET['controle'];

			if (!file_exists('./controller/' . $controle . '.php')){
				throw new Exception("Require doesn't exist");	
			} else {
				require ('./controller/' . $controle . '.php');
				$cont = new $controle();	
				$action= $_GET['action'];
				$cont->{$action}();
			} 

		} catch(Exception $e) {
			require("vue/404.html");
		}
	} else {
        require("vue/layout/login.html");
//        require("vue/layout/edt.html");
	}

//} else {
//    require("vue/layout/login.html");
//    echo $_COOKIE["TestCookie"];
//}

?>
