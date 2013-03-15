<?php

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("../initialize.php");
$message = "";
if(isset($_GET['confirmation_code'])){
	$confirmation_code = $_GET['confirmation_code'];
	$user = User::get_by_confirm($confirmation_code);
	if($user){
		if($user->status == "unconfirmed"){
			$user->status = "confirmed";
			$message = "Successfully Confirmed!";
		}else{
			$message = Member::get_by_strid($user->member_id)->name . " is lready Confirmed!";
		}
		$user->update();
	}else{
		$message = "Invalid Confirmation Code";
	}
}
?>

<link href="../../public/stylesheets/others.css" rel="stylesheet" />
<link href="../../public/stylesheets/dialog.css" rel="stylesheet" />
<link href="../../public/stylesheets/button.css" rel="stylesheet" />
<link href="../../public/stylesheets/nav_bar.css" rel="stylesheet" />

<script src="../../public/javascripts/jquery.js"></script>
<script src="../../public/javascripts/functions.js"></script>
<?php
include_public_layout("dialog.php");
echo "<script> popup('{$message}'); </script>"; 
?>

<a href="../../public/index.php">Go back to main page.</a>