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

$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];

$count = count(Score::get_by_sql("SELECT * FROM " . T_SCORES));

if($count > 0 && $limit > 0)
{ 
    $total_pages = ceil($count / $limit); 
}
else
{ 
    $total_pages = 0; 
} 
 
if ($page > $total_pages) $page = $total_pages;
 
$start = $limit*$page - $limit;
 
if($start <0) $start = 0;
if(!$sidx) $sidx =1;

$ops = array(
        'eq'=>'=', 
        'ne'=>'<>',
        'lt'=>'<', 
        'le'=>'<=',
        'gt'=>'>', 
        'ge'=>'>=',
        'bw'=>'LIKE',
        'bn'=>'NOT LIKE',
        'in'=>'LIKE', 
        'ni'=>'NOT LIKE', 
        'ew'=>'LIKE', 
        'en'=>'NOT LIKE', 
        'cn'=>'LIKE', 
        'nc'=>'NOT LIKE' 
    );

if(isset($_GET['searchString']) && isset($_GET['searchField']) && isset($_GET['searchOper']))
{
    $searchString = $_GET['searchString'];
    $searchField = $_GET['searchField'];
    $searchOper = $_GET['searchOper'];

    foreach ($ops as $key=>$value)
    {
        if ($searchOper==$key)
        {
            $ops = $value;
        }
    }

    if($searchOper == 'eq' ) $searchString = $searchString;
    if($searchOper == 'bw' || $searchOper == 'bn') $searchString .= '%';
    if($searchOper == 'ew' || $searchOper == 'en' ) $searchString = '%'.$searchString;
    if($searchOper == 'cn' || $searchOper == 'nc' || $searchOper == 'in' || $searchOper == 'ni') $searchString = '%'.$searchString.'%';

    $where = "$searchField $ops '$searchString'"; 

    if($session->user_group_id == 0)
    {
        $scores = Score::get_by_sql("SELECT * FROM " . T_SCORES . " WHERE ".$where." ORDER BY $sidx $sord LIMIT $start , $limit");
    }
    else
    {
        $scores = Score::get_by_sql("SELECT * FROM " . T_SCORES . " WHERE ".C_SCORE_USER_ID." IN (SELECT ".C_USER_UNIQUE_ID." FROM ".T_USERS." WHERE ".C_USER_GROUP_ID." = ".$session->user_group_id.") AND ".$where." ORDER BY $sidx $sord LIMIT $start , $limit");
    }
}
else
{
    if($session->user_group_id == 0)
    {
        $scores = Score::get_by_sql("SELECT * FROM " . T_SCORES . " ORDER BY $sidx $sord LIMIT $start , $limit");
    }
    else
    {
        $scores = Score::get_by_sql("SELECT * FROM " . T_SCORES . " WHERE ".C_SCORE_USER_ID." IN (SELECT ".C_USER_UNIQUE_ID." FROM ".T_USERS." WHERE ".C_USER_GROUP_ID." = ".$session->user_group_id.") ORDER BY $sidx $sord LIMIT $start , $limit");
    }
    
}

header("Content-type: text/xml;charset=utf-8");
 
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";
 
foreach($scores as $score) 
{
    $s .= "<row id='". $score->id ."'>";
    $s .= "<cell></cell>";
    $s .= "<cell>". $score->score ."</cell>";            
    $s .= "<cell>". $score->user_id ."</cell>";
    $s .= "<cell>". $score->time_elapsed ."</cell>";
    $s .= "<cell>". $score->correct_answers ."</cell>";
    $s .= "<cell>". $score->date ."</cell>";
    $s .= "</row>";
}

$s .= "</rows>"; 
 
echo $s;
?>