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

$qry = "SELECT name FROM student WHERE roll_no = $user_id";
	//Execute query 
$result = mysqli_query($link,$qry);  
	//Check whether the query was successful or not
$count = mysqli_num_rows($result);

if($count==1){
	$info=mysqli_fetch_array($result);
	$name=$info["name"];
	$query = "Select strdate,endate,type,purpose,status,result From application_student Where roll_no='$user_id' ORDER BY strdate desc"; 
	$result = mysqli_query($link,$query); 
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
	<body onmouseover="change()">
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
					<a href="/ApplicationTracker/src/status/show_stat_stud.php"><div class="ui active step">
						Leave Status
					</div></a>
					<a href="/ApplicationTracker/src/leave/leave_stud.php"><div class="ui step">
						Create Leave
					</div></a>
				</div>
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