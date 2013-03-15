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

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Manage Question Files</title>
<link href="css/bb10theme/css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="js/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />

<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.0.custom.js"></script>
<script src="js/browserplus.js"></script>
<script src="js/plupload/plupload.js"></script>
<script src="js/plupload/plupload.gears.js"></script>
<script src="js/plupload/plupload.silverlight.js"></script>
<script src="js/plupload/plupload.flash.js"></script>
<script src="js/plupload/plupload.browserplus.js"></script>
<script src="js/plupload/plupload.html4.js"></script>
<script src="js/plupload/js/plupload.html5.js"></script>
<script src="js/plupload/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<style>
.buttons a, .buttons button{
    display:block;
    float:left;
    /*margin:0 7px 0 0;*/
    font-family:"Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
    font-size:100%;
    line-height:130%;
    text-decoration:none;
    font-weight:bold;
    color:#d2d2d2;
    cursor:pointer;
    padding:5px 10px 6px 7px; /* Links */
}
.buttons a:hover{
    color: white;
}
.buttons button{
    width:auto;
    overflow:visible;
    padding:4px 10px 3px 7px; /* IE6 */
}
.buttons button[type]{
    padding:5px 10px 5px 7px; /* Firefox */
    line-height:17px; /* Safari */
}
*:first-child+html button[type]{
    padding:4px 10px 3px 7px; /* IE7 */
}
.buttons button img, .buttons a img{
    margin:0 3px -3px 0 !important;
    padding:0;
    border:none;
    width:30px;
    height:30px;
}
</style>

<style>

	table
	{
		width: 800px;
	}

	table tr td
	{
		padding: 5px;
	}

	.click-button {
	    -moz-box-shadow:inset 0px 1px 0px -18px #caefab;
	    -webkit-box-shadow:inset 0px 1px 0px -18px #caefab;
	    box-shadow:inset 0px 1px 0px -18px #caefab;
	    background-color:#b9e356;
	    -moz-border-radius:42px;
	    -webkit-border-radius:42px;
	    border-radius:42px;
	    border:1px solid #268a16;
	    display:inline-block;
	    color:#ffffff;
	    font-family:arial;
	    font-size:15px;
	    font-weight:bold;
	    padding:6px 24px;
	    text-decoration:none;
	    text-shadow:1px 1px 0px #aade7c;
	}.click-button:hover {
	    background-color:#a5cc52;
	}.click-button:active {
	    position:relative;
	    top:1px;
	}

</style>
</head>
<body style="background-color:black;">

<ul id="nav-bar" style="background-color:black; margin-bottom:40px;">
    <div class="buttons">
    	<a href="app.php">
            <img src="images/home.png"/> 
            Back
        </a>  
        <a onclick="window.open('mobile_website/quiz.php?category=mixed', '_blank', 'width=450,height=650')">
            <img src="images/run.png"/> 
            Run
        </a>    
        <a href="download_quiz.php">
	        <img src="images/download.png"/>
	        Download Quiz Data
	    </a>
	    <a onclick="alert('still in development. Follow me on twitter to be updated: @NemOry')" style="color:#3B3B3B">
	        <img src="images/download.png"/>
	        Build Cascades App
	    </a>
	    <a onclick="alert('still in development. Follow me on twitter to be updated: @NemOry')" style="color:#3B3B3B">
	        <img src="images/download.png"/>
	        Build PhoneGap App
	    </a>
	    <a onclick="alert('still in development. Follow me on twitter to be updated: @NemOry')" style="color:#3B3B3B">
	        <img src="images/download.png"/>
	        Build WebWorks App
	    </a>
        <a href="upload_questions.php">
            <img src="images/files.png"/> 
            Files
        </a> 
        <a href="">
            <img src="images/reload.png"/>
            Reload
        </a>
        <a href="https://twitter.com/NemOry">
            <img src="images/contact.png"/>
            Contact Developer
        </a>
        <a href="logout.php">
            <img src="images/logout.png"/>
            Logout
        </a>
        .
    </div>
</ul>

<a href="phonegapTemplate.zip" style="color:white; padding-left:20px;">
    Download PhoneGap Template
</a>
<a href="webworksTemplate.zip" style="color:white; padding-left:20px;">
    Download WebWorks Template
</a>
<a onclick="alert('still in development. Follow me on twitter to be updated: @NemOry')" style="color:#3B3B3B; padding-left:20px;">
    Download Cascades Template
</a>

<div id="accordion">

    <h3>Upload Files</h3>
    <div>
        <div id="uploader">
			<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
		</div>
    </div>

    <h3>Files Uploaded</h3>
    <div>
    	<table>
		<?php

		$group = Group::get_by_id($session->user_group_id);

		$directory = PUBLIC_PATH.DS.'groups' .DS. $group->name .DS.'files'.DS.'questions'.DS.'*';

		foreach(glob($directory) as $file)
		{
			$name = basename($file);
			$ext = pathinfo($file, PATHINFO_EXTENSION);

			$item = "<tr>";
			$item .= "<td><a href='groups/".Group::get_by_id($session->user_group_id)->name."/files/questions/".$name."'>".$name."</a></td>";
			$item .= "<td><a class='click-button' title=".$name.">Delete</a></td>";
			$item .= "</tr>";
			
			echo $item;
		}

		?>
		</table>
    </div>
</div>

<script>

$(function() {

	$(".click-button").click(function(){

		var file_name = $(this).attr("title");

		if(confirm("Are you sure you want to delete this file?"))
		{
			$.ajax({
                type:"POST",
                url:"delete_file.php?folder=questions",
                data: {file_name:file_name},
                success: function(result){
                    if(result == "success"){
                        alert(result);
                    }else{
                        alert(result);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert("error");
                }
            });
		}
	});

	$( "#accordion" ).accordion({
        collapsible: true,
        heightStyle: "content"
    });

	$("#uploader").plupload({

		runtimes : 'flash,html5,browserplus,silverlight,gears,html4',
		url : 'upload.php?folder=questions',
		max_file_size : '50mb',
		max_file_count: 20, // user can add no more then 20 files at a time
		chunk_size : '1mb',
		unique_names : false,
		multiple_queues : true,
		resize : {width : 300, height : 150, quality : 100},
		rename: false,
		sortable: true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png,jpeg"},
			{title : "Audio files", extensions : "mp3,aac,wav"},
			{title : "Video files", extensions : "mp4,wmv,3gp,flv"},
		],
		flash_swf_url : 'js/plupload/plupload.flash.swf',
		silverlight_xap_url : 'js/plupload/plupload.silverlight.xap'
	});
});
</script>
</body>
</html>