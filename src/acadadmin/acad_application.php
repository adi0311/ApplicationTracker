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
$roll_no=$_GET['roll_no'];
$strdate=$_GET['strdate'];

$qry1 = "SELECT roll_no,strdate,endate,purpose,type from application_student where roll_no='$roll_no' and strdate='$strdate'";   
$result1 = mysqli_query($link,$qry1);
$qry2 = "SELECT name from student where roll_no='$roll_no'";
$result2 = mysqli_query($link, $qry2); 
$change = -1;
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
			<div class="ui horizontal divider header">Status of Leave</div><br><table class="ui definition table">
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
			$.post('../leave/leave_data.php', {value:value, roll:r, date:date, edate:edate},
				function(data){
				$(".result").html(data);
			});
		}
	</script>

	<?php echo'</body>
</html>';
 
 

 }
 ?>