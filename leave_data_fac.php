<?php
	$value=$_POST['value'];
	$roll_no=$_POST['roll'];
	$strdate=$_POST['date'];
	$endate=$_POST['edate'];
	$link = mysqli_connect('localhost', 'root', '');  
	if(!$link)
	{ 
		die('Failed to connect to server: ' . mysqli_error($link)); 
	}
	$db = mysqli_select_db($link,'file tracking'); 
	if(!$db)
	{ 
		die("Unable to select database"); 
	}
	if($value == 2)
	{
		$query="UPDATE application_faculty SET result='Rejected' WHERE faculty_id='$roll_no' and strdate='$strdate'";
		$result1 = mysqli_query($link, $query);
		$query="UPDATE application_faculty SET status='Acad' WHERE faculty_id='$roll_no' and strdate='$strdate'";
		$result = mysqli_query($link, $query);
		if($result1 and $result)
			echo'<a class="ui red label">Rejected</a>';
	}

	if($value == 1)
	{
		$query="UPDATE application_faculty SET status='HOD' WHERE faculty_id='$roll_no' and strdate='$strdate'";
		$result1 = mysqli_query($link, $query);
		$query="UPDATE application_faculty SET result='Pending' WHERE faculty_id='$roll_no' and strdate='$strdate'";
		$result = mysqli_query($link, $query);
		if($result1 and $result)
			echo'<a class="ui green label">Accepted</a>';

	}

	if($value == 3)
	{
		$query="SELECT casual,earned,halfpay,compensatory, maternity FROM leave_faculty";
		$result = mysqli_query($link, $query);
		$query1="SELECT type FROM application_faculty WHERE faculty_id='$roll_no' and strdate='$strdate'";
		$result1 = mysqli_query($link, $query1);
		$info=mysqli_fetch_array($result);
		$info1=mysqli_fetch_array($result1);
		if($result){
			if($info1['type'] == 'casual')
				$sum=$info['casual'];
			if($info1['type'] == 'earned')
				$sum=$info['earned'];
			if($info1['type'] == 'compensatory')
				$sum=$info['compensatory'];
			if($info1['type'] == 'halfpay')
				$sum=$info['halfpay'];
			if($info1['type'] == 'maternity')
				$sum=$info['maternity'];
		}
		else
			$sum=0;
		$diff = date_diff(date_create($strdate), date_create($endate));
		if($sum >= $diff->format("%R%a") and $diff->format("%R%a") > 0)
			echo'<a class="ui green label">Eligible</a>';
		else
			echo'<a class="ui red label">Not Eligible</a>';
	}
?>