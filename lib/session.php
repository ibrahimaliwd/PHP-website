<?php 

/**
*Session Class for login panel 
*
**/
class Session{
	public static function init(){
		session_start();
	}
	public static function set($key, $val){
		$_SESSION[$key] = $val; 
		
		}
	public static function get($key){
		if(isset($_SESSION[$key])) {
			return $_SESSION[$key]; 
		}else{
			return false; 
		}
			
	}
	public static function checkSession(){
		self::init(); 
		if (self::get("login")== false){
			self::destory();
			header ("location:index.php");
		}
	}
	
	public static function checkSessionuser(){
		self::init(); 
		if (self::get("login")== false){
			self::destory();
			header ("location:../jobs_login.php");
		}
	}
	public static function destory() {
		session_destroy(); 
		header ("location:index.php");
	}
}

?>