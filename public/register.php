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

$result = "all fields are required";

if(!empty($_GET['group_id']) && !empty($_GET['name']) && !empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['email']))
{
	$user 	= new User();
	$user->name 		= htmlentities(trim($_GET['name']));
	$user->group_id 	= htmlentities(trim($_GET['group_id']));
	$user->username 	= htmlentities(trim($_GET['username']));
	$user->password 	= htmlentities(trim($_GET['password']));
	$user->email 		= htmlentities(trim($_GET['email']));
	$user->access_token = md5($user->username);
	$user->picture 		= "default.png";
	$user->level 		= 2;
	$user->access 		= 1;

	if(Group::group_exists($user->group_id))
	{
		if(User::username_exists($user->username, $user->group_id)){
			$result = "Username: " . $user->username . " already exists";
		}
		else
		{
			$user->create();
			$session->login($user);
			$result = "success";
		}
	}
	else
	{
		$result = "the group you are trying to register does not exist";
	}
}

echo $result;

?>