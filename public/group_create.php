<?php

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../includes/initialize.php");
$message = "";

if($session->is_logged_in()){
	redirect_to("app.php");
}

if(isset($_POST)){

	$response = "";
	$username_valid = false;
	$group_name_valid = false;

	$group 	= new Group();
	$group->name = preg_replace('/\s+/', '', strtolower(htmlentities($_POST['group_create_name'])));

	$user = new User();
	$user->username 	= htmlentities(trim($_POST['group_create_username']));
	$user->password 	= htmlentities(trim($_POST['group_create_password']));
	$user->email 		= "";
	$user->access_token = md5($user->username);
	$user->level 		= 1;
	$user->access 		= 1;



	if(Group::group_exists($group->name)){
		$response = "Group: " . $group->name . " already exists!";
	}else{
		$group_name_valid = true;
	}

	if(User::username_exists($user->username)){
		$response = "Username:" . $user->username . " already exists!";
	}else{
		$username_valid = true;
	}

	if($username_valid && $group_name_valid){

		$group->create();
		$user->group_id = Group::getLastID();
		$user->create();

		$folder_path = "groups/".  $group->name . "/";

		if (!mkdir($folder_path, 0700)) {
	    	die("Folder" .  $group->name . " already exists!");
		}else{
			mkdir($folder_path . "files", 0700);
			mkdir($folder_path . "files/users", 0700);
			mkdir($folder_path . "files/questions", 0700);
		}

		$session->login($user);

		$response = "success";
	}

	echo $response;
}
?>