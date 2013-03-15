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

$user = User::get_by_id($session->user_id);

$scores = Score::get_by_sql("SELECT * FROM ".T_SCORES." WHERE ".C_SCORE_USER_ID."=".$user->id." ORDER BY ".C_SCORE_DATE);
$highest_score = Score::get_highest_score($user->id);
$recent_score = Score::get_recent_score($user->id);

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
                    My Profile
                </h3>
                <div data-role="navbar" data-iconpos="left">
                    <ul>
                        <li>
                            <a href="categories.php" data-theme="" data-icon="forward">
                                Play
                            </a>
                        </li>
                        <li>
                            <a href="../logout.php" data-theme="" data-icon="">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div data-role="content">
                <div style="display: inline">
                    <img id="img_picture" style="width: 100px; height: 100%" src="<?php echo "../groups/".Group::get_by_id($user->group_id)->name."/files/users/".$user->picture; ?>" />
                </div>
                <h2 id="lbl_name">
                    <?php echo $user->name; ?>
                </h2>
                <h5 id="lbl_highest_score">
                    Highest Score: <?php echo $highest_score; ?>
                </h5>
                <h5 id="lbl_recent_score">
                    Recent Score: <?php echo $recent_score; ?>
                </h5>
                <ul id="list_scores" data-role="listview" data-divider-theme="b" data-inset="true">
                    <li data-role="list-divider" role="heading">
                        Scores
                    </li>
                    <?php

                    foreach ($scores as $s)
                    {
                        echo "<li data-theme='c'>";
                        echo $s->score;
                        echo "</li>";
                    }

                    ?>     
                </ul>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>