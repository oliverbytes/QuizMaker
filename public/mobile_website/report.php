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

if(!$session->is_logged_in())
{
    redirect_to("login.php");
}

$question = $_GET['question'];
$answer = $_GET['answer'];

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="../css/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="my.css" />
        <style>
            
        </style>
        <script src="../js/jquery-1.8.2.js"></script>
        <script src="../js/jquery.mobile-1.1.1.min.js"></script>
        <script src="my.js"></script>
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    Report Question
                </h3>
            </div>
            <div data-role="content">
                <form action="">
                    <h5>
                        Question:
                    </h5>
                    <h3 id="lbl_question">
                        <?php echo $question; ?>
                    </h3>
                    <h5>
                        Answer
                    </h5>
                    <h3 id="lbl_answer">
                        <?php echo $answer; ?>
                    </h3>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="txt_answer">
                                The answer must be:
                            </label>
                            <input name="txt_answer" id="txt_answer" placeholder="Write the correct answer you know" value="" type="text" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="txt_comments">
                                Other Comments:
                            </label>
                            <textarea name="txt_comments" id="txt_comments" placeholder="Other comments you may say to this mistake">
                            </textarea>
                        </fieldset>
                    </div>
                    <input id="btn_submit_report" type="submit" value="Submit Report" />
                </form>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>