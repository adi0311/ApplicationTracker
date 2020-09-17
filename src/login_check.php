<?php 
    if ($_POST['submit'] == 'Login'){
        //Collect POST values
        $login = $_POST['login'];
        $password = $_POST['password'];
        if($login && $password){
            //Connect to mysql server
            $link = mysqli_connect('localhost', 'root', '');
            //Check link to the mysql server
            if(!$link) {
                die('Failed to connect to server: ' . mysqli_error($link));
            }
            //Select database
            $db = mysqli_select_db($link,'file tracking');
            if(!$db) {
                die("Unable to select database");
            }
            //Create query (if you have a Logins table the you can select login id and password from there)
            if($login=='ACAD001' && $password=='12345'){
                session_start();
                $_SESSION['IS_AUTHENTICATED'] = 1;
                $_SESSION['USER_ID'] = $login;
                header('location:./acadadmin/acad_pend_stud.php?');
                $count=1;
            }
            else{
                $qry1 = "SELECT * FROM student WHERE roll_no = '$login' AND password = '$password'";
                $qry2 = "SELECT * FROM faculty WHERE faculty_id = '$login' AND password = '$password'";
                //Execute query
                $result1 = mysqli_query($link,$qry1);
                $result2 = mysqli_query($link,$qry2);
                //Check whether the query was successful or not
                    $count1 = mysqli_num_rows($result1);
                    $count2= mysqli_num_rows($result2);
                    //$count = 1;
                if( $count1 == 1){
                //Login successful set session variables and redirect to main page.
                    session_start();
                    $_SESSION['IS_AUTHENTICATED'] = 1;
                    $_SESSION['USER_ID'] = $login;
                    header('location:./status/show_stat_stud.php?');
                }
                else if($count2==1){
                    session_start();
                    $_SESSION['IS_AUTHENTICATED'] = 1;
                    $_SESSION['USER_ID'] = $login;
                    header('location:./status/show_stat_fac.php?');
                }
                else{
                    //Login failed
                    include('login.php');
                    echo '<center>Incorrect Username or Password !!!<center>';
                    exit();
                }
            }
        }
        else{
            include('login.php');
            echo '<center>Username or Password missing!!</center>';
            exit();
        }
    }
    else
    {
        header("location: login.php");
        exit();
    }
?>
