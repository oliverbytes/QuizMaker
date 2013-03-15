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

	$question = new Question();
	$question->group_id 	= $session->user_group_id;
	$question->text 		= $_POST['text'];
	$question->identification 	= $_POST['identification'];
	$question->difficulty 	= $_POST['difficulty'];
	$question->answer 		= $_POST['answer'];
	$question->choice_a 	= $_POST['choice_a'];
	$question->choice_b 	= $_POST['choice_b'];
	$question->choice_c 	= $_POST['choice_c'];
	$question->file 		= $_POST['file'];

	$type = "text";

	if(!empty($question->file))
	{
		$ext = pathinfo($question->file, PATHINFO_EXTENSION);

		if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif")
		{
			$type = "image";
		}
		else if ($ext == "mp4" || $ext == "3gp" || $ext == "wmv" || $ext == "flv")
		{
			$type = "video";
		}
		else if ($ext == "mp3" || $ext == "wav" || $ext == "aac")
		{
			$type = "audio";
		}
	}

	$question->type 		= $type;
	$question->points 		= $_POST['points'];
	$question->timer 		= $_POST['timer'];
	$question->create();

}
else if($_POST['oper']=='edit')
{
	
	$question = Question::get_by_id($_POST['id']);
	$question->group_id 	= $session->user_group_id;
	$question->text 		= $_POST['text'];
	$question->identification 	= $_POST['identification'];
	$question->difficulty 	= $_POST['difficulty'];
	$question->answer 		= $_POST['answer'];
	$question->choice_a 	= $_POST['choice_a'];
	$question->choice_b 	= $_POST['choice_b'];
	$question->choice_c 	= $_POST['choice_c'];
	$question->file 		= $_POST['file'];
	
	$type = "text";

	if(!empty($question->file))
	{
		$ext = pathinfo($question->file, PATHINFO_EXTENSION);

		if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif")
		{
			$type = "image";
		}
		else if ($ext == "mp4" || $ext == "3gp" || $ext == "wmv" || $ext == "flv")
		{
			$type = "video";
		}
		else if ($ext == "mp3" || $ext == "wav" || $ext == "aac")
		{
			$type = "audio";
		}
	}

	$question->type 		= $type;
	$question->points 		= $_POST['points'];
	$question->timer 		= $_POST['timer'];
	$question->update();

}
else if($_POST['oper']=='del')
{
	Question::get_by_id($_POST['id'])->delete();
}

?>