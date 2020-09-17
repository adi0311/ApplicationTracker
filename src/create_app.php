
<?php
session_start(); 
if(isset($_SESSION['IS_AUTHENTICATED']) && $_SESSION['IS_AUTHENTICATED'] == 1){ 

if($_POST['submit']=='Submit')
{
	$user_id = $_SESSION['USER_ID'];
	$strdate = $_POST['strdate']; 
	$endate = $_POST['endate'];
	$type = $_POST['type'];
	$purpose = $_POST['purpose'];
$link = mysqli_connect('localhost', 'root', ''); 
if(!$link){ 
die('Failed to connect to server: ' . mysqli_error($link)); 
}
$db = mysqli_select_db($link,'file tracking'); 
if(!$db){ 
die("Unable to select database"); 
}
$user_id = $_SESSION['USER_ID']; 

$qry1 = "SELECT name FROM student WHERE roll_no = '$user_id'";
$qry2 = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
	//Execute query 
$result1 = mysqli_query($link,$qry1); 
$result2 = mysqli_query($link,$qry2); 
	//Check whether the query was successful or not
$count1 = mysqli_num_rows($result1);
$count2 = mysqli_num_rows($result2);

if($count1==1){
	$query = "INSERT INTO application_student (roll_no, strdate, endate,type,purpose,status,result) VALUES ('$user_id','$strdate','$endate','$type','$purpose','Acad','pending')"; 
	$results = mysqli_query($link,$query); 
	$qry = "SELECT name FROM student WHERE roll_no = '$user_id'";
	$result = mysqli_query($link,$qry);
	$info=mysqli_fetch_array($result);
	$name=$info["name"];
}

else if($count2==1){
	$query = "INSERT INTO application_faculty (faculty_id, strdate, endate,type,purpose,status,result) VALUES ('$user_id','$strdate','$endate','$type','$purpose','Acad','pending')"; 
	$results = mysqli_query($link,$query);
	$qry = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
	$result = mysqli_query($link,$qry);
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
	    					<image xlink:href="../img/user.jpg" x="0" y="0" width="100%" height="100%"></image>
	  					</svg>
	  					<br>
	  					<div>
	  						<h4>'.$name.'</h4>
	  					</div>
					</div>
				</div>';
		if($count2 == 1)
				echo'<div class="ui vertical steps" style="display:block;">
					<a href="/ApplicationTracker/src/status/show_stat_fac.php"><div class="ui step">
						Leave Status
					</div></a>
					<a href="/ApplicationTracker/src/leave/leave_fac.php"><div class="ui active step">
						Create Leave
					</div></a>
				    </div>
                </div>
                <div class="eight wide column ui padded segment">
                <div class="column">';
		else if($count1 == 1)
		    echo'<div class="ui vertical steps" style="display:block;">
					<a href="/ApplicationTracker/src/status/show_stat_stud.php"><div class="ui step">
						Leave Status
					</div></a>
					<a href="/ApplicationTracker/src/leave/leave_stud.php"><div class="ui active step">
						Create Leave
					</div></a>
				</div>
			</div>
			<div class="eight wide column ui padded segment">
			<div class="column">';
			if($results == FALSE) 
			echo mysqli_error($link) . '<br>'; 
			else 
			echo 'Application sent successfully ! '; 
			
echo '</div>
			</div>
			<div class="two wide column">
			</div>
		</div>
	</body>
</html>';
}
}
?>