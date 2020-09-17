<?php
    session_start();
    if(isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1){
    $link = mysqli_connect('localhost', 'root', '');
    if(!$link){
        die('Failed to connect to server: ' . mysqli_error($link));
    }
    $db = mysqli_select_db($link,'file tracking');
    if(!$db){
        die("Unable to select database");
    }
    $user_id = $_SESSION['USER_ID'];

    $qry1 = "SELECT faculty_id,strdate,purpose,type from application_faculty where status='HOD' and result='Pending' and faculty_id in (SELECT faculty_id from faculty where dept_id=(SELECT dept_id FROM department WHERE hod_id='$user_id'))";
    $result1 = mysqli_query($link,$qry1);

    $qry = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
        //Execute query
    $result = mysqli_query($link,$qry);
        //Check whether the query was successful or not
    $count = mysqli_num_rows($result);

    if($count==1){
        $info=mysqli_fetch_array($result);
        $name=$info["name"];
    }
    echo'<html>
        <head>
            <link rel="stylesheet" type="text/css" href="/ApplicationTracker/css/semantic.min.css">
            <link rel="stylesheet" type="text/css" href="/ApplicationTracker/css/semantic.css">
            <link rel="stylesheet" type="text/css" href="/ApplicationTracker/js/semantic.min.js">
            <link rel="stylesheet" type="text/css" href="/ApplicationTracker/js/semantic.js">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <meta charset="utf-8">
        </head>
        <body>
            <div class="ui secondary inverted segment">
                <div class="ui inverted secondary menu">
                    <a class="active item">
                        Home
                    </a>
                    <a class=" right aligned item" href="/ApplicationTracker/src/logout.php">
                        Logout
                    </a>
                </div>
            </div>
            <div class="ui stackable four column grid">
                <div class="two wide column">
                </div>
                <div class="column">
                    <div class="ui segment">
                        <div class="ui small image" style="display:block;">
                            <svg width="150" height="200">
                                <image xlink:href="../../img/user.jpg" x="0" y="0" width="100%" height="100%"></image>
                            </svg>
                            <br>
                            <div>
                                <h4>'.$name.'</h4>
                            </div>
                        </div>
                    </div>
                    <div class="ui vertical steps" style="display:block;">
                        <a href="/ApplicationTracker/src/status/show_stat_fac.php"><div class="ui step">
                            Leave Status
                        </div></a>
                        <a href="/ApplicationTracker/src/leave/leave_fac.php"><div class="ui step">
                            Create Leave
                        </div></a>';
    $qry2 = "SELECT name FROM department WHERE hod_id = '$user_id'";
        //Execute query
    $result2 = mysqli_query($link,$qry2);
        //Check whether the query was successful or not
    $count2 = mysqli_num_rows($result2);
    if($count2==1){
        echo'<a href="/ApplicationTracker/src/hod/hod_pend_stud.php"><div class="ui step">
            Pending Leave Student
        </div></a>
        <a href="/ApplicationTracker/src/hod/hod_pend_fac.php"><div class="ui active step">
            Pending Leave Faculty
        </div></a>
        <a href="/ApplicationTracker/src/hod/hod_approv.php"><div class="ui step">
            Approved/Rejected Leaves
        </div></a>';
    }
    echo'</div>
            </div>
            <div class="ui padded segment eight wide column">
            <div class="column">
            <div class="ui dividing header">
                Pending Leave of Faculty
            </div>
            <br>
            <table class="ui unstackable table"><thead><th>Faculty Id</th><th>Start Date</th><th>Purpose</th><th>Type</th></thead><tbody>';
    if($result1){
        $init=0;
         while($info=mysqli_fetch_array($result1)){
            echo '<tr class="clickable-row" data-href="/ApplicationTracker/src/hod/hod_app_fac.php?faculty_id='.$info['faculty_id'].'&strdate='.$info['strdate'].'">
                      <td>'.$info['faculty_id'].'</td>
                      <td>'.$info['strdate'].'</td>
                      <td>'.$info['purpose'].'</td>
                      <td>'.$info['type'].'</td></tr></a>';
                      $init += 1;
         }
        }
    echo '</tbody></table>
            </div>
                </div>
                <div class="two wide column">
                </div>
            </div>
            <script>
                function change()
                {
                    var k;
                    for(var i = 0; i < 100; i++)
                    {
                        var k = document.getElementById(i.toString(10)).innerHTML;
                        if(k == "pending")
                        {
                            $("#"+i.toString(10)).addClass("ui yellow message");
                        }
                        else if(k == "casual")
                        {
                            $("#"+i.toString(10)).addClass("positive");
                        }
                    }
                }
            </script>
            <script>
                $(document).ready(function($)
                {
                    $(".clickable-row").click(function()
                    {
                        window.location = $(this).data("href");
                    });
                });
            </script>
        </body>
    </html>';
    }
?>