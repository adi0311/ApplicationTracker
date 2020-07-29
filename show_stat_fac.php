<?php
    session_start();
    if(isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1)
    {

        $link = mysqli_connect('localhost', 'root', '');
        if(!$link){
            die('Failed to connect to server: ' . mysqli_error($link));
        }
        $db = mysqli_select_db($link,'file tracking');
        if(!$db){
            die("Unable to select database");
        }

        $user_id = $_SESSION['USER_ID'];

        $qry = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
            //Execute query
        $result = mysqli_query($link,$qry);
            //Check whether the query was successful or not
        $count = mysqli_num_rows($result);

        if($count==1){
            $info=mysqli_fetch_array($result);
            $name=$info["name"];
            $query = "Select strdate,endate,type,purpose,status,result From application_faculty Where faculty_id='$user_id'";
            $result = mysqli_query($link,$query);
        }

        echo'<html>
            <head>
                <link rel="stylesheet" type="text/css" href="semantic.min.css">
                <link rel="stylesheet" type="text/css" href="semantic.css">
                <link rel="stylesheet" type="text/css" href="semantic.min.js">
                <link rel="stylesheet" type="text/css" href="semantic.js">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <meta charset="utf-8">
            </head>
            <body onmouseover="change()">
                <div class="ui secondary inverted segment">
                    <div class="ui inverted secondary menu">
                        <a class="active item">
                            Home
                        </a>
                        <a class=" right aligned item" href="/ApplicationTracker/logout.php">
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
                                    <image xlink:href="14.jpg" x="0" y="0" width="100%" height="100%"></image>
                                </svg>
                                <br>
                                <div>
                                    <h4>'.$name.'</h4>
                                </div>
                            </div>
                        </div>
                        <div class="ui vertical steps" style="display:block;">
                            <a href="/ApplicationTracker/show_stat_fac.php"><div class="ui active step">
                                Leave Status
                            </div></a>
                            <a href="/ApplicationTracker/leave_fac.php"><div class="ui step">
                                Create Leave
                            </div></a>';
        $qry1 = "SELECT name FROM department WHERE hod_id = '$user_id'";
            //Execute query
        $result1 = mysqli_query($link,$qry1);
            //Check whether the query was successful or not
        $count1 = mysqli_num_rows($result1);
        if($count1==1){
                            echo'<a href="/ApplicationTracker/hod_pend_stud.php"><div class="ui step">
                                Pending Leave Student
                            </div></a>
                            <a href="/ApplicationTracker/hod_pend_fac.php"><div class="ui step">
                                Pending Leave Faculty
                            </div></a>
                            <a href="/ApplicationTracker/hod_approv.php"><div class="ui step">
                                Approved/Rejected Leaves
                            </div></a>';
        }
        echo	'</div>
                    </div>
                    <div class="ui padded segment eight wide column">
                    <div class="column">
                    <div class="ui dividing header">
                        Status of the leave
                    </div>
                    <br>
            <table class="ui unstackable table"><thead><tr><th>Start Date</th><th>End Date</th><th>Purpose</th><th>Status</th><th>Result</th></thead><tbody>';
        if($result){
            $init=0;
             while($info=mysqli_fetch_array($result)){
                echo '<tr><td>'.$info['strdate'].'</td>
                          <td>'.$info['endate'].'</td>
                          <td>'.$info['purpose'].'</td>
                          <td>'.$info['status'].'</td>
                          <td id= "'.$init.'">'.$info['result'].'</td></tr>';
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
                        }
                    }
                </script>
            </body>
        </html>';



     }
 ?>