<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

class Session{
	
	private $logged_in;
	public $user_id;
	public $user_level;
	public $user_group_id;
	
	function __construct(){
		session_start();
		$this->check_login();
	}

	private function check_login(){
		if(isset($_SESSION[C_USER_UNIQUE_ID]) && isset($_SESSION[C_USER_LEVEL]) && isset($_SESSION[C_USER_GROUP_ID])){
			$this->user_id 			= $_SESSION[C_USER_UNIQUE_ID];
			$this->user_level 		= $_SESSION[C_USER_LEVEL];
			$this->user_group_id 	= $_SESSION[C_USER_GROUP_ID];
			$this->logged_in 	= true;
		}else{
			unset($this->user_id);
			unset($this->user_level);
			unset($this->user_group_id);
			$this->logged_in = false;
		}
	}
	
	public function is_logged_in(){
		return $this->logged_in;
	}
	
	public function login($user){
		if($user){
			$this->user_id 			= $_SESSION[C_USER_UNIQUE_ID] 	= $user->id;
			$this->user_level 		= $_SESSION[C_USER_LEVEL] 		= $user->level;
			$this->user_group_id 	= $_SESSION[C_USER_GROUP_ID]	= $user->group_id;
		}
	}
	
	public function logout(){
		unset($_SESSION[C_USER_UNIQUE_ID]);
		unset($_SESSION[C_USER_LEVEL]);
		unset($_SESSION[C_USER_GROUP_ID]);
		unset($this->user_id);
		unset($this->user_level);
		unset($this->user_group_id);
		$this->logged_in = false;
	}
}

$session = new Session();

?>