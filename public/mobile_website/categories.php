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

if(!$session->is_logged_in()){
    redirect_to("login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Categories</title>
        <link rel="stylesheet" href="../css/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="my.css" />
        <link href="../css/jquery.toastmessage.css" rel="stylesheet"/>
        <script src="../js/jquery-1.8.2.js"></script>
        <script src="../js/jquery.mobile-1.1.1.min.js"></script>
        <script src="my.js"></script>
        <script src="../js/jquery.toastmessage.js"></script>
    </head>
    <body>
        <div data-role="page" data-theme="a" id="categories_page">
            <div data-theme="a" data-role="header">
                <h3>
                    BB10 Quiz Maker
                </h3>
            </div>
            <div data-role="content">
                <a id="btn_easy" data-role="button" data-icon="arrow-r" data-iconpos="left" >
                    Easy
                </a>

                <a id="btn_medium" data-role="button" data-icon="arrow-r" data-iconpos="left" >
                    Medium
                </a>

                <a id="btn_hard" data-role="button" data-icon="arrow-r" data-iconpos="left" >
                    Hard
                </a>

                <a id="btn_mixed" data-role="button" data-icon="arrow-r" data-iconpos="left">
                    Mixed
                </a>

                <a id="btn_logout" data-role="button" data-icon="arrow-r" data-iconpos="left">
                    Logout
                </a>
            </div>
        </div>
        <script>

        $(document).ready(function(){

            var mixed_questions = 0;
            var easy_questions = 0;
            var medium_questions = 0;
            var hard_questions = 0;

            var questions_loaded = false;
            var group_id = "<?php echo $session->user_group_id; ?>";

            $.getJSON('../../includes/jsons/get_questions.php?group_id=' + group_id, function(data)
            {
                $.each(data, function(key, val)
                {
                    mixed_questions++;

                    if(val.difficulty == "easy")
                    {
                        easy_questions++;
                    }
                    else if(val.difficulty == "medium")
                    {
                        medium_questions++;
                    }
                    else if(val.difficulty == "hard")
                    {
                        hard_questions++;
                    }
                });

                questions_loaded = true;
            });

            interval_holder = window.setInterval(function () 
            {
                if (questions_loaded) 
                {
                    clearInterval(interval_holder);
                    
                    if(mixed_questions == 0)
                    {
                        $("#btn_mixed").addClass('ui-disabled');
                    }
                    
                    if(easy_questions == 0)
                    {
                        $("#btn_easy").addClass('ui-disabled');
                    }
                    
                    if(medium_questions == 0)
                    {
                        $("#btn_medium").addClass('ui-disabled');
                    }
                    
                    if(hard_questions == 0)
                    {
                        $("#btn_hard").addClass('ui-disabled');
                    }
                }
            }, 50);

            $("#btn_easy").click(function(){
                window.location.href='quiz.php?category=easy';
            });

            $("#btn_medium").click(function(){
                window.location.href='quiz.php?category=medium';
            });

            $("#btn_hard").click(function(){
                window.location.href='quiz.php?category=hard';
            });

            $("#btn_mixed").click(function(){
                window.location.href='quiz.php?category=mixed';
            });

            $("#btn_logout").click(function(){
                window.location.href='../logout.php';
            });
        });

        </script>
    </body>
</html>