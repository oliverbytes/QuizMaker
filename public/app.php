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
        redirect_to("mobile_website/categories.php");
    }
}

$group = Group::get_by_id($session->user_group_id);

if($group == null)
{
    die("Group: " . $group_id . " does not exists.");
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="Oliver Martinez" content="BB10 Quiz Maker" />
    <title>BB10 Quiz Maker</title>
    <link href="css/fonts.css" rel="stylesheet"/>
    <link href="css/app.css" rel="stylesheet"/>
    <link href="css/bb10theme/css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet" media="screen" />
    <link href="css/ui.jqgrid.css" rel="stylesheet" media="screen" />
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
</head>

<body style="background-color:black;">

    <div id="main_container">
        <section id="main_section">
            <section id="main_content">
                <p style="color:red;">The Dev Alpha Simulator cannot run the quiz very well because of HTML5 audio, but I assure you if it works pretty well in the web simulator, it will really work in a real device, so don't worry that AppWorld will deny your app.</p>
                <ul id="nav-bar" style="background-color:black; margin-bottom:20px;">
                    <div class="buttons">
                        <a onclick="window.open('mobile_website/quiz.php?category=mixed', '_blank', 'width=450,height=650')">
                            <img src="images/run.png"/> 
                            Run
                        </a>    
                        <a href="download_quiz.php">
                            <img src="images/download.png"/>
                            Download Quiz Data
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
                        </a>                        .
                    </div>
                </ul>

                <a href="platform_templates/phonegapTemplate.zip" style="color:white; padding-left:20px;">
                    Download PhoneGap Template
                </a>
                <a href="platform_templates/webworksTemplate.zip" style="color:white; padding-left:20px;">
                    Download WebWorks Template
                </a>
                <a href="platform_templates/cascadesTemplate.zip" style="color:white; padding-left:20px;">
                    Download Cascades Template
                </a>
                <div id="tabs" style="margin-top:10px">
                    <ul>
                        <?php

                        if($session->user_level == 0)
                        {
                            echo '<li id="groups-tab"><a href="groups.php"><span>Groups</span></a></li>';
                            echo '<li><a href="users.php" title="Shows you the users from your group.<br/> This is also the place where you can manage your users."><span>Users</span></a></li>';
                        }

                        ?>
                        <li><a href="questions.php" title="Shows you the questions from your group.<br/> This is also the place where you can manage your questions."><span>Questions</span></a></li>
                    </ul>
                </div>
                
            </section>
            
        </section>
    </div>

    <script src="js/jquery-1.8.2.js"></script>
    <script src="js/jquery-ui-1.9.0.custom.js"></script>
    <script src="js/i18n/grid.locale-en.js"></script>
    <script src="js/jquery.jqGrid.min.js"></script>
    <script src="js/jquery.printPage.js"></script>
    <script src="js/jquery.qrcode.min.js"></script>
    <script src="js/printElement.js"></script>
  
    <script>

    $('#tabs').tabs({
        load: function(event, ui) 
        {
            $(ui.panel).delegate('a', 'click', function(event) 
            {
                $(ui.panel).load(this.href);
                event.preventDefault();
            });
        }
    });

    $(".btnPrint").printPage();

    </script>

</body>
</html>