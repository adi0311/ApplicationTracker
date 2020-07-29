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

$qry = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
	//Execute query 
$result = mysqli_query($link,$qry); 

if($result){
	$info=mysqli_fetch_array($result);
	$name=$info["name"];
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
	<body>
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
					<a href="/ApplicationTracker/show_stat_fac.php"><div class="ui step">
						Leave Status
					</div></a>
					<a href="/ApplicationTracker/leave_fac.php"><div class="ui active step">
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
			echo '</div>
			</div>
			<div class="eight wide column ui padded segment">
			<div class="column">
	<form class="ui form" action="/ApplicationTracker/create_app.php" method="post">
	  <h4 class="ui dividing header">Leave Application</h4>
	  <br>
	  <div class="field">
	    <div class="two fields">
	      <div class="field">
	    	<label>From</label>
	    	<div class="ui icon input">
	    		<i class="calendar alternate icon"></i>
	        	<input type="date" name="strdate" placeholder="Click to enter date">
	        </div>
	        <div class="ui pointing label">
      				Enter your leaving date
    		</div>
	      </div>
	      <div class="field">
	      	<label>To</label>
	      	<div class="ui icon input">
	      		<i class="calendar alternate icon"></i>
	        	<input type="date" name="endate" placeholder="Click to enter date">
	        </div>
	        <div class="ui pointing label">
      				Enter your arriving date
    		</div>
	      </div>
	    </div>
	  </div>
	  <br>
	  <div class="field">
	    <label>Leave type</label>
	      <select class="ui fluid dropdown" name="type">
	      	<option value="casual">Casual</option>
	      		<option value="earned">Earned</option>
	      		<option value="compensatory">Compensatory</option>
	      		<option value="halfpay">Halfpay</option>
	      		<option value="maternity">Maternity</option>
	    </select>
	  </div>
	  <br>
	  <div class="field">
	  	<label>Purpose</label>
	  	<input type="text" name="purpose" placeholder="Purpose of your leave">
	  </div>
	  <br>
	  <div class="field">
	  	<input class="ui primary button" type="submit" value="Submit" name="submit">
	  </div>
	</form>
</div>
			</div>
			<div class="two wide column">
			</div>
		</div>
	</body>
</html>';
}
?>