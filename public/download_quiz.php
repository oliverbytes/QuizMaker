<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

	require_once("../includes/initialize.php");

	include "zipper.php";

	$myFile = "groups/".Group::get_by_id($session->user_group_id)->name."/files/questions/questions.json";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$questions = Question::get_all_by_group_id($session->user_group_id);
	$stringData = json_encode($questions);
	fwrite($fh, $stringData);
	fclose($fh);

	$files_to_zip = array();

	$group = Group::get_by_id($session->user_group_id);

	$directory = PUBLIC_PATH.DS.'groups' .DS. $group->name .DS.'files'.DS.'questions'.DS.'*';

	foreach(glob($directory) as $file)
	{
		$name = basename($file);
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$item = "groups/".Group::get_by_id($session->user_group_id)->name."/files/questions/".$name;
		array_push($files_to_zip, $item);
	}

	$result = create_zip($files_to_zip,"groups/".Group::get_by_id($session->user_group_id)->name."/files/quiz.zip", true);

	chmod("groups/".Group::get_by_id($session->user_group_id)->name, 0777);
	chmod("groups/".Group::get_by_id($session->user_group_id)->name."/files", 0777);
	chmod("groups/".Group::get_by_id($session->user_group_id)->name."/files/quiz.zip", 0777);

	if($result == true)
	{
		// $filename = "groups/".Group::get_by_id($session->user_group_id)->name."/files/quiz.zip"; 
		// header('Content-type: application/zip'); 
		// header("Content-length: " . filesize($filename));  
		// header('Content-Disposition: attachment; filename="' . $filename . '"'); 
		// readfile($filename); 

		header("Location: groups/".Group::get_by_id($session->user_group_id)->name."/files/quiz.zip");
		//header("Location: download.php");
	}
	else
	{
		echo "error";
	}

?>