<?php 

/*
	Creator: Oliver Martinez A.K.A. NemOry
	Email, facebook, paypal: nemoryoliver@gmail.com
	Twitter: @NemOry
	if you want to contribute to the System or copy the system and build your own.
	I hope you can please just notify me 1st. :)
*/

require_once("initialize.php");

function redirect_to($location = NULL){
	if($location != NULL){
		header("Location: {$location}");
		exit();
	}
}

function __autoload($class_name){
	$class_name = strtolower($class_name);
	$path = INCLUDES_PATH.DS."{$class_name}.php";
	if(file_exists($path)){
		require_once($path);
	}else{
		die("The file {$path} could not be found.");	
	}
}

function include_public_layout($template=""){
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function send_email($link, $username, $password, $email){
	if(!empty($link)){
		$mail = new PHPMailer();
	
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
			
		$mail->Host     = "smtp.gmail.com";
		$mail->Port 	= 465;
		$mail->Username = "nemoryoliver1@gmail.com";
		$mail->Password = "DhjkLmnOP2";
		
		$mail->From     = "nemoryoliver@gmail.com";
		$mail->AddAddress($email); // for publishing
		$mail->AddAddress("nemoryoliver@gmail.com"); // for development testing
		
		$mail->Subject  = "QuizMaker Group Registration";
		$mail->Body     = "Username:" . $username . "\nPassword: " . $password . "\n\nClick on the link to confirm. \n\n" . $link;
		$mail->WordWrap = 50;
		
		if(!$mail->Send()) {
		  echo 'Message was not sent.';
		  echo 'Mailer error: ' . $mail->ErrorInfo;
		} else {
		  echo 'Message has been sent.';
		}
	}
}

function check_connection(){
	$status = "";
	$conn = @fsockopen("www.itechroom.com", 80, $errno, $errstr, 30);
	if ($conn){
		$status = "yes";
	}else{
		$status = "no";
	}
	return $status;
}

?>