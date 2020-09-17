<?php
    session_start();
    session_unset();
    session_destroy();
?> 
<html>
<head>
	<title>Login page</title>
    <link rel="stylesheet" type="text/css" href="/ApplicationTracker/css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="/ApplicationTracker/css/semantic.css">
    <link rel="stylesheet" type="text/css" href="/ApplicationTracker/js/semantic.min.js">
    <link rel="stylesheet" type="text/css" href="/ApplicationTracker/js/semantic.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--link rel="stylesheet" href="style.css"-->
    <style type="text/css">
        body {
            background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }
    </style>
</head>
<body>
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui teal image header">
                <!--img src="14.jpg" class="image"-->
                <div class="content">
                    Log-in to your account
                </div>
            </h2>
            <form class="ui large form" name="LoginForm" method="post" action="/ApplicationTracker/src/login_check.php">
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="login" placeholder="User Id">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="Password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Login" class="ui fluid large teal button">
                </div>
            </form>
            <!-- <div class="ui message">
                New to us? <a href="/ApplicationTracker/src/signup.php">Sign Up</a>
            </div> -->
        </div>
    </div>
</body>
</html>