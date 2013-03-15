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
    if($session->user_level > 0)
    {
        redirect_to("index.php");
    }
}

if($_POST['oper']=='add')
{

	$group = new Group();
	$group->name = $_POST['name'];
	$group->description = $_POST['description'];
	$group->banner = $_POST['banner'];
	$group->create();

}
else if($_POST['oper']=='edit')
{
	
	$group = Group::get_by_id($_POST['id']);
	$group->name = $_POST['name'];
	$group->description = $_POST['description'];
	$group->banner = $_POST['banner'];
	$group->update();

}
else if($_POST['oper']=='del')
{
	Group::get_by_id($_POST['id'])->delete();
}

?>