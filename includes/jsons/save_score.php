<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../initialize.php");

$user_id = $_GET["user_id"];
$user_access_token = $_GET["user_access_token"];

$user = User::get_by_id($user_id);

$users = array();

if($user != null){

	if($user_access_token == $user->access_token){
		array_push($users, $user);
		$score = new Score();
		$score->user_id = $user->id;
		$score->score = $_GET["score"];
		$score->time_elapsed = $_GET["time_elapsed"];
		$score->correct_answers = $_GET["correct_answers"];
		$score->create();
	}
}

echo json_encode($users);

?>