<!--
    Creator: Oliver Martinez A.K.A. NemOry
    Email, facebook, paypal: nemoryoliver@gmail.com
    Twitter: @NemOry
    if you want to contribute to the System or copy the system and build your own.
    I hope you can please just notify me 1st. :)
-->

<?php

require_once("../../includes/initialize.php");

global $session;

if($session->is_logged_in())
{
    redirect_to("categories.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login</title>
        <link rel="stylesheet" href="../css/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="my.css" />
        <link href="../css/jquery.toastmessage.css" rel="stylesheet"/>
        <script src="../js/jquery-1.8.2.js"></script>
        <script src="../js/jquery.mobile-1.1.1.min.js"></script>
        <script src="my.js"></script>
        <script src="../js/jquery.toastmessage.js"></script>
    </head>
    <body>
        <!-- Difficulty -->
        <div data-role="page" data-theme="a" id="login_page">
            <div data-theme="a" data-role="header">
                <h3>
                    QuizMaker
                </h3>
            </div>
            <div data-role="content">
                <form action="" method="POST" id="loginForm">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="username">
                                Username
                            </label>
                            <input name="login_username" id="login_username" placeholder="" value="" type="text" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="password">
                                Password
                            </label>
                            <input name="login_password" id="login_password" placeholder="" value="" type="password" />
                        </fieldset>
                    </div>
                    <input id="btn_login" type="submit" data-icon="arrow-r" data-iconpos="right" value="Login" />
                </form>
            </div>
        </div>
        <script>
            $(function() 
            {
                $("#btn_login").click(function()
                {
                    $.ajax({
                        type:"POST",
                        url:"../login.php?",
                        data: $('#loginForm').serialize(),
                        success: function(result)
                        {
                            if(result == "success")
                            {
                                window.location.href = "categories.php";
                            }
                            else
                            {
                                alert(result);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            alert("error");
                        }
                    });

                    return false;
                });
            });  
        </script>
    </body>
</html>