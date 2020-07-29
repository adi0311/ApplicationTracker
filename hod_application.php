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

$roll_no=$_GET['roll_no'];
$strdate=$_GET['strdate'];

$qry1 = "SELECT roll_no,strdate,endate,purpose,type from application_student where roll_no='$roll_no' and strdate='$strdate'";   
$result1 = mysqli_query($link,$qry1);
$qry2 = "SELECT name from student where roll_no='$roll_no'";
$result2 = mysqli_query($link, $qry2); 
$change = -1;
	//Execute query 
$qry = "SELECT name FROM faculty WHERE faculty_id = '$user_id'";
$result = mysqli_query($link,$qry);  
	//Check whether the query was successful or not
$count = mysqli_num_rows($result);

if($count==1){
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
					<a href="/ApplicationTracker/leave_fac.php"><div class="ui step">
						Create Leave
					</div></a>';
$qry2 = "SELECT name FROM department WHERE hod_id = '$user_id'";
	//Execute query 
$result2 = mysqli_query($link,$qry2);  
	//Check whether the query was successful or not
$count2 = mysqli_num_rows($result2);
if($count2==1){
					echo'<a href="/ApplicationTracker/hod_pend_stud.php"><div class="ui active step">
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
			<div class="ui padded segment eight wide column">
			<div class="column">
			<div class="ui dividing header">
				Pending Leave of Student
			</div>
			<br>
			<table class="ui unstackable table">
			    <thead>
			        <th>
			            Field
			        </th>
			        <th>
			            Detail
			        </th>
			    </thead>
			<tbody>';
 if($result1 and $result2){
	 	$info=mysqli_fetch_array($result1);
	 	$info2 = mysqli_fetch_array($result2);
	 	$endate=$info['endate'];
	 	$start=date_create($info['strdate']);
	 	$end=date_create($info['endate']);
	 	$roll=$info['roll_no'];
	 	$type=$info['type'];
	 	echo '<tr><td>Name</td><td>'.$info2['name']."</td></tr>";
	 	echo '<tr><td>Roll No.</td><td>'.$info['roll_no']."</td></tr>";
	 	echo '<tr><td>Start Date</td><td>'.$info['strdate']."</td></tr>";
	 	echo '<tr><td>End Date</td><td>'.$info['endate']."</td></tr>";
	 	echo '<tr><td>Type of Leave</td><td>'.$type."</td></tr>";
	 	echo '<tr><td>Purpose</td><td>'.$info['purpose']."</td></tr>";
		}
	?>

	</table>
	<br>
	<div class="ui buttons">
  			<button class="ui positive button" onclick="execute(1)">Accept</button>
  			<div class="or"></div>
  			<button class="ui negative button" onclick="execute(2)">Reject</button>
  			<div class="or"></div>
  			<button class="ui button" onclick="execute(3)">Check eligibility</button>
	</div>
 		</div>
 		<br>
 		<br>
 		<div class="result">
 		</div>
			</div>
			<div class="two wide column">
			</div>
	</div>
	<script>
		function execute(value)
		{
			var r = <?php echo $roll; ?>;
			var date = <?php echo '"'.$strdate.'"'; ?>;
			var edate = <?php echo '"'.$endate.'"'; ?>;
			$.post('hod_leave_data.php', {value:value, roll:r, date:date, edate:edate}, 
				function(data){
				$(".result").html(data);
			});
		}
	</script>
<?php echo'</body>
</html>';
 
 }
 ?>