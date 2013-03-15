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
<link rel="stylesheet" href="css/south-street/jquery-ui-1.9.0.custom.min.css" type="text/css" />
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
<body>

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

			$directory = PUBLIC_PATH.DS.'groups' .DS. $group->name .DS.'files'.DS.'users'.DS.'*';

			foreach(glob($directory) as $file)
			{
				$name = basename($file);
				$ext = pathinfo($file, PATHINFO_EXTENSION);

				$item = "<tr>";
				$item .= "<td><a href='groups/".Group::get_by_id($session->user_group_id)->name."/files/users/".$name."'>".$name."</a></td>";
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
	                url:"delete_file.php?folder=users",
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
			url : 'upload.php?folder=users',
			max_file_size : '1000mb',
			max_file_count: 20, // user can add no more then 20 files at a time
			chunk_size : '1mb',
			unique_names : true,
			multiple_queues : true,
			resize : {width : 320, height : 240, quality : 90},
			rename: true,
			sortable: true,
			filters : [
				{title : "Image files", extensions : "jpg,gif,png,jpeg"}
			],
			flash_swf_url : 'js/plupload/plupload.flash.swf',
			silverlight_xap_url : 'js/plupload/plupload.silverlight.xap'
		});
	});
	</script>
</body>
</html>