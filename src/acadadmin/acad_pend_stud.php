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


$qry = "SELECT roll_no,strdate,purpose,type from application_student where status='Acad' and result='pending'";   
$result = mysqli_query($link,$qry); 
	//Check whether the query was successful or not

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
	  						<h4>Academic</h4>
	  					</div>
					</div>
				</div>
				<div class="ui vertical steps" style="display:block;">
					<a href="/ApplicationTracker/src/acadadmin/acad_pend_stud.php"><div class="ui active step">
						Pending Leave Student
					</div></a>
					<a href="/ApplicationTracker/src/acadadmin/acad_pend_fac.php"><div class="ui step">
						Pending Leave Faculty
					</div></a>
					<a href="/ApplicationTracker/src/acadadmin/acad_approv.php"><div class="ui step">
						Approved/Rejected Leaves
					</div></a>
				</div>
			</div>
			<div class="ui padded segment eight wide column">
			<div class="column">
			<div class="ui dividing header">
				Pending Leave of Students
			</div>
			<br>
	<table class="ui unstackable table"><thead><th>Roll no.</th><th>Purpose</th><th>Type</th></thead><tbody>';
 if($result){
 	$init=0;
	 while($info=mysqli_fetch_array($result)){
	 	echo '<tr class="clickable-row" data-href="/ApplicationTracker/src/acadadmin/acad_application.php?roll_no='.$info['roll_no'].'&strdate='.$info['strdate'].'">
	 			  <td>'.$info['roll_no'].'</td>
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