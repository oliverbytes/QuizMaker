<?php

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("index.php");
}

if($_POST['oper']=='add')
{
	$user = new User();
	$user->group_id 		= $session->user_group_id;
	$user->username 		= $_POST['username'];
	$user->level 			= $_POST['level'];
	$user->password 		= $_POST['password'];
	$user->name 			= $_POST['name'];
	$user->picture 			= $_POST['picture'];
	$user->access_token 	= md5($user->username);
	$user->email 			= $_POST['email'];
	$user->access 			= $_POST['access'];
	$user->create();

}else if($_POST['oper']=='edit')
{

	$user = User::get_by_id($_POST['id']);
	$user->group_id 		= $session->user_group_id;
	$user->username 		= $_POST['username'];
	$user->level 			= $_POST['level'];
	$user->password 		= $_POST['password'];
	$user->name 			= $_POST['name'];
	$user->picture 			= $_POST['picture'];
	$user->access_token 	= md5($user->username);
	$user->email 			= $_POST['email'];

	if($session->user_id != $user->id)
	{
		$user->access = $_POST['access'];
	}
	
	$user->update();

}
else if($_POST['oper']=='del')
{
	if($_POST['id'] != $session->user_id)
	{
		User::get_by_id($_POST['id'])->delete();
	}
}

?>