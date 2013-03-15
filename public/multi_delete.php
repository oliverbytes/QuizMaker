<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../includes/initialize.php");

$what = $_POST['what'];
$ids = $_POST['ids'];

$response = "error";

global $session;

if(!$session->is_logged_in())
{
	die("you can't touch this page");
}

if($what == "user")
{

	foreach ($ids as $id) 
	{
		User::get_by_id($id)->delete();
	}

	$response = "success";

}else if($what == "question")
{

	foreach ($ids as $id) 
	{
		Question::get_by_id($id)->delete();
	}

	$response = "success";

}
else if($what == "group")
{

	foreach ($ids as $id) 
	{
		Group::get_by_id($id)->delete();
	}

	$response = "success";

}
else if($what == "score")
{

	foreach ($ids as $id) 
	{
		Score::get_by_id($id)->delete();
	}

	$response = "success";

}

echo $response;

?>