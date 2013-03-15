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

$folder = $_GET['folder'];
$file_name = $_POST['file_name'];

$path = "groups/".Group::get_by_id($session->user_group_id)->name."/files/".$folder."/".$file_name;

$result = "ERROR";

if(unlink($path))
{
	$result = "success";
}

echo $folder.", ".$path;

?>