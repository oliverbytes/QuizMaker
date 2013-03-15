<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../initialize.php"); 

global $session;

if($session->is_logged_in()){
	if(isset($_GET['user_unique_id'])){
		$user_unique_id = $_GET['user_unique_id'];
		$user = User::get_by_strid($user_unique_id);
		if($user->status == "unconfirmed"){
			$user->status = "confirmed";
		}else{
			$user->status = "unconfirmed";	
		}
		$user->update();
	}
}

redirect_to("../../public/admin/index.php");

?>