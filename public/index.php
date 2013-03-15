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

if($session->is_logged_in())
{
    redirect_to("app.php");
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta name="Oliver Martinez" content="BB10 Quiz Maker" />
    <title>BB10 Quiz Maker</title>
    <link href="css/home.css" rel="stylesheet"/>
    <!-- <link href="css/fonts.css" rel="stylesheet"/> -->
    <link href="css/bb10theme/css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet" media="screen" />
    <style>
        #dialog-login-form, #dialog-group-reg-form { font-size: 62.5%; }
        label, input { display:block; color: gray;}
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { margin: .6em 0; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; color: gray;}
        /* This imageless css button was generated by CSSButtonGenerator.com */
    </style>
    <!-- Start WOWSlider.com HEAD section -->
    <link rel="stylesheet" type="text/css" href="engine1/style.css" />
    <script type="text/javascript" src="engine1/jquery.js"></script>
    <!-- End WOWSlider.com HEAD section -->
</head>
<body>
<div id="main_container">
    <header id="main_header">
        <img src="images/bundled_fun_logo.png" height="100" id="logo"/>
        <nav id="main_nav">
            <ul>
                <li><a href="#" id="btn-create-group" class="nav-button">Create a Quiz</a></li>
                <li><a href="#" id="btn-login" class="nav-button">Login</a></li>
                <li><a href="http://nemoryoliver.com/how-to-use-bb10-quiz-maker/" class="nav-button">Tutorial</a></li>
                <li><a href="http://nemoryoliver.com/about-bb10-quiz-maker/" class="nav-button">About/Features</a></li>
                <li><a href="http://nemoryoliver.com/bb10-quiz-maker-roadmaps-and-bugs/" class="nav-button">Roadmaps & Bugs</a></li>
                <li><a href="https://www.facebook.com/nemoryoliver" class="nav-button">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section id="main_section">
        <section id="main_content" >

            <p style="color:gray">
                Create a Logo Quiz, Video Quiz, Image Quiz, Text Quiz or a combination then Run with the Simulator and Deploy to BlackBerry 10.<br />
                To try: user: default  pass: default, user: nature  pass: nature, user: technology  pass: technology, user: chemistry  pass: chemistry
            </p>

            <!-- Start WOWSlider.com BODY section -->
            <div id="wowslider-container1">
            <div class="ws_images" ><ul>
            <li><img src="data1/images/deploy.jpg" alt="deploy" title="deploy" id="wows1_0"/></li>
            <li><img src="data1/images/run.jpg" alt="run" title="run" id="wows1_1"/></li>
            <li><img src="data1/images/supported.jpg" alt="supported" title="supported" id="wows1_2"/></li>
            <li><img src="data1/images/actionbar.jpg" alt="actionbar" title="actionbar" id="wows1_3"/></li>
            <li><img src="data1/images/cellediting.jpg" alt="cellediting" title="cellediting" id="wows1_4"/></li>
            <li><img src="data1/images/selectall.jpg" alt="selectall" title="selectall" id="wows1_5"/></li>
            <li><img src="data1/images/windowediting.jpg" alt="windowediting" title="windowediting" id="wows1_6"/></li>
            </ul></div>
            <div class="ws_bullets"><div>
            <a href="#" title="deploy"><img src="data1/tooltips/deploy.jpg" alt="deploy"/>1</a>
            <a href="#" title="run"><img src="data1/tooltips/run.jpg" alt="run"/>2</a>
            <a href="#" title="supported"><img src="data1/tooltips/supported.jpg" alt="supported"/>3</a>
            <a href="#" title="actionbar"><img src="data1/tooltips/actionbar.jpg" alt="actionbar"/>4</a>
            <a href="#" title="cellediting"><img src="data1/tooltips/cellediting.jpg" alt="cellediting"/>5</a>
            <a href="#" title="selectall"><img src="data1/tooltips/selectall.jpg" alt="selectall"/>6</a>
            <a href="#" title="windowediting"><img src="data1/tooltips/windowediting.jpg" alt="windowediting"/>7</a>
            </div></div>
            <a class="wsl" href="http://wowslider.com">jQuery Multiple Image Upload by WOWSlider.com v2.8</a>
            <div class="ws_shadow"></div>
            </div>
            <script type="text/javascript" src="engine1/wowslider.js"></script>
            <script type="text/javascript" src="engine1/script.js"></script>
            <!-- End WOWSlider.com BODY section -->
        </section>
    </section>
    
    <footer id="main_footer" style="margin:0px;">
        <p><a href="https://twitter.com/NemOry" style="color:white;">By Oliver Martinez (NemOry)></a></p>
    </footer>
</div>

<div id="dialog-login-form" title="Login">
    <p class="validateTips">All form fields are required.</p>
    <form id="loginForm">
        <fieldset>
            <label for="username">Username</label>
            <input type="text" name="login_username" id="login_username" class="text ui-widget-content ui-corner-all" />
            <label for="password">Password</label>
            <input type="password" name="login_password" id="login_password" value="" class="text ui-widget-content ui-corner-all" />
        </fieldset>
    </form>
</div>

<div id="dialog-group-create-form" title="Create your Quiz">
    <p class="validateTips">All form fields are required.</p>

    <form id="groupCreateForm">
        <fieldset>
            <label for="name">Quiz Title</label>
            <input type="text" name="group_create_name" id="group_create_name"  placeholder="ex: Science Quiz" class="text ui-widget-content ui-corner-all" />
            <label for="username">Username</label>
            <input type="text" name="group_create_username" id="group_create_username" placeholder="sciencequiz" class="text ui-widget-content ui-corner-all" />
            <label for="password">Password</label>
            <input type="password" name="group_create_password" id="group_create_password" placeholder="*****" value="" class="text ui-widget-content ui-corner-all" />
            <!-- <label for="email">Email</label>
            <input type="email" name="group_create_email" id="group_create_email" placeholder="youremail@mailprovider.com" value="" class="text ui-widget-content ui-corner-all" /> -->
        </fieldset>
    </form>
</div>

<!-- <div id="dialog-register-to-group" title="Register to this Quiz">
    <p class="validateTips">All form fields are required.</p>

    <form id="registerToGroup">
        <fieldset>
            <label for="name">Name</label>
            <input type="text" name="name" id="name"  placeholder="Your School, Organization etc.." class="text ui-widget-content ui-corner-all" />
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all" />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="youremail@mailprovider.com" value="" class="text ui-widget-content ui-corner-all" />
        </fieldset>
    </form>
</div> -->

<script src="js/jquery-1.8.2.js"></script>
<script src="js/jquery-ui-1.9.0.custom.js"></script>
<script>
    $(function() {
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
        ////////////////////////////////////////////////////////////////////////

        function updateTips( t ) 
        {
            tips.text( t ).addClass( "ui-state-highlight" );
            setTimeout(function() 
            {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }

        function checkLength( o, n, min, max ) 
        {
            if ( o.val().length > max || o.val().length < min ) 
            {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                    min + " and " + max + "." );
                return false;
            } 
            else 
            {
                return true;
            }
        }

        function checkRegexp( o, regexp, n ) 
        {
            if ( !( regexp.test( o.val() ) ) ) 
            {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            }
            else 
            {
                return true;
            }
        }

        var login_username = $( "#login_username" ),
            login_password = $( "#login_password" ),
            allFields = $( [] ).add( login_username ).add( login_password ),
            tips = $( ".validateTips" );
        
        $( "#dialog-login-form" ).dialog({
            autoOpen: false,
            height: 350,
            width: 300,
            modal: true,
            buttons: {
                "Login": function() {
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );

                    bValid = bValid && checkLength( login_username, "login_username", 3, 16 );
                    bValid = bValid && checkLength( login_password, "login_password", 3, 16 );

                    bValid = bValid && checkRegexp( login_username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                    bValid = bValid && checkRegexp( login_password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

                    if ( bValid ) 
                    {
                        $.ajax({
                            type:"POST",
                            url:"login.php?",
                            data: $('#loginForm').serialize(),
                            success: function(result){
                                if(result == "success")
                                {
                                    window.location.href = "app.php";
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
                    }
                },
                Cancel: function() 
                {
                    $( this ).dialog( "close" );
                }
            },
            close: function() 
            {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        $( "#btn-login" ).click(function() 
        {
            $( "#dialog-login-form" ).dialog( "open" );
        });

        //////////////////////////////////////////////////////////////////////////////////

        var group_create_name       = $( "#group_create_name" ),
            group_create_username   = $( "#group_create_username" ),
            group_create_password   = $( "#group_create_password" ),
            group_create_email      = $( "#group_create_email" ),
            allFields               = $( [] ).add( group_create_name ).add( group_create_username ).add( group_create_password ).add( group_create_email ),
            tips                    = $( ".validateTips" );

        $( "#dialog-group-create-form" ).dialog({
            autoOpen: false,
            height: 500,
            width: 400,
            modal: true,
            buttons: {
                "Create": function() 
                {

                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );

                    bValid = bValid && checkLength( group_create_name, "group_create_name", 1, 30 );
                    bValid = bValid && checkLength( group_create_username, "group_create_username", 1, 16 );
                    bValid = bValid && checkLength( group_create_password, "group_create_password", 1, 16 );

                    bValid = bValid && checkRegexp( group_create_username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                    bValid = bValid && checkRegexp( group_create_password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

                    if ( bValid ) 
                    {
                        $.ajax({
                            type:"POST",
                            url:"group_create.php",
                            data: $('#groupCreateForm').serialize(),
                            success: function(result)
                            {
                                if(result == "success")
                                {
                                    window.location.href = "app.php";
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
                    }
                },
                Cancel: function() 
                {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        // $( "#dialog-register-to-group" ).dialog({
        //     autoOpen: false,
        //     height: 500,
        //     width: 400,
        //     modal: true,
        //     buttons: {
        //         "Create": function() 
        //         {
        //             var bValid = true;
        //             allFields.removeClass( "ui-state-error" );

        //             bValid = bValid && checkLength( name, "name", 3, 30 );
        //             bValid = bValid && checkLength( username, "username", 3, 16 );
        //             bValid = bValid && checkLength( password, "password", 5, 16 );

        //             bValid = bValid && checkRegexp( username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
        //             bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

        //             if ( bValid ) 
        //             {
        //                 $.ajax({
        //                     type:"GET",
        //                     url:"../includes/functions/registrator.php",
        //                     data: $('#registerToGroup').serialize(),
        //                     success: function(result)
        //                     {
        //                         if(result == "success")
        //                         {
        //                             window.location.href = "mobile_website/categories.php";
        //                         }
        //                         else
        //                         {
        //                             alert(result);
        //                         }
        //                     },
        //                     error: function(jqXHR, textStatus, errorThrown)
        //                     {
        //                         alert("error");
        //                     }
        //                 });

        //                 return false;
        //             }
        //         },
        //         Cancel: function() 
        //         {
        //             $( this ).dialog( "close" );
        //         }
        //     },
        //     close: function() 
        //     {
        //         allFields.val( "" ).removeClass( "ui-state-error" );
        //     }
        // });

        $( "#btn-create-group" ).click(function() {
            $( "#dialog-group-create-form" ).dialog( "open" );
        });

        // $( ".btn_register_to_group" ).click(function() {
        //     alert("reg");
        //     $( "#dialog-register-to-group" ).dialog( "open" );
        // });

    });
</script>

</body>
</html>