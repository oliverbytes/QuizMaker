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
else
{
    if($session->user_level > 1)
    {
        redirect_to("index.php");
    }
}

if($_POST['oper']=='add')
{

	$score = new Score();
	$score->score 				= $_POST['score'];
	$score->user_id 			= $_POST['user_id'];
	$score->time_elapsed 		= $_POST['time_elapsed'];
	$score->correct_answers 	= $_POST['correct_answers'];
	$score->create();

}
else if($_POST['oper']=='edit')
{
	
	$score = Score::get_by_id($_POST['id']);
	$score->score 				= $_POST['score'];
	$score->user_id 			= $_POST['user_id'];
	$score->time_elapsed 		= $_POST['time_elapsed'];
	$score->correct_answers 	= $_POST['correct_answers'];
	$score->update();

}
else if($_POST['oper']=='del')
{
	Score::get_by_id($_POST['id'])->delete();
}

?>