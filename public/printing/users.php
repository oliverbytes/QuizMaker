<?php

require_once("../../includes/initialize.php");

$users = User::get_by_sql("SELECT * FROM ".T_USERS." WHERE ".C_USER_GROUP_ID."=".$session->user_group_id);

$s = "<table>";
$s .= "<tr>";
// $s .= "<td>ID</td>";
$s .= "<td>GROUP</td>";
$s .= "<td>USERNAME</td>";
// $s .= "<td>LEVEL</td>";
// $s .= "<td>PASSWORD</td>";
$s .= "<td>NAME</td>";
$s .= "<td>PICTURE</td>";
// $s .= "<td>ACCESS TOKEN</td>";
$s .= "<td>EMAIL</td>";
// $s .= "<td>ACCESS</td>";
$s .= "</tr>";

foreach($users as $user) {
    $s .= "<tr>"; 
    // $s .= "<td>". $user->id."</td>";
    $s .= "<td>". Group::get_by_id($session->user_group_id)->name."</td>";            
    $s .= "<td>". $user->username."</td>";
    // $s .= "<td>". $user->level."</td>";
    // $s .= "<td>". $user->password."</td>";
    $s .= "<td>". $user->name."</td>";

    $image_source = "../groups/".Group::get_by_id($session->user_group_id)->name. "/files/users/".$user->picture;

    $s .= "<td><img src=".$image_source." height='30' /></td>";
    // $s .= "<td>". $user->access_token."</td>";
    $s .= "<td>". $user->email."</td>";
    // $s .= "<td>". $user->access."</td>";
    $s .= "</tr>";
}

$s .= "</table>";

echo $s;


?>