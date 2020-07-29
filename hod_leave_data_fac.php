<?php
	$value=$_POST['value'];
	$faculty_id=$_POST['roll'];
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

	$query="SELECT casual,earned,halfpay,compensatory, maternity FROM leave_faculty";
		$result = mysqli_query($link, $query);
		$query1="SELECT type FROM application_faculty WHERE faculty_id='$faculty_id' and strdate='$strdate'";
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
		$diff = date_diff(date_create($strdate), date_create($endate));
		$diff=$diff->format("%R%a");
		$leave_left=$sum-$diff;
	if($value == 2)
	{
		$query="UPDATE application_faculty SET result='Rejected' WHERE faculty_id='$faculty_id' and strdate='$strdate'";
		$result1 = mysqli_query($link, $query);
		$query="UPDATE application_faculty SET status='HOD' WHERE faculty_id='$faculty_id' and strdate='$strdate'";
		$result = mysqli_query($link, $query);
		if($result1 and $result)
			echo'<a class="ui red label">Rejected</a>';
	}

	if($value == 1)
	{
		$query="UPDATE application_faculty SET status='HOD' WHERE faculty_id='$faculty_id' and strdate='$strdate'";
		$result1 = mysqli_query($link, $query);
		$query="UPDATE application_faculty SET result='Accepted' WHERE faculty_id='$faculty_id' and strdate='$strdate'";
		$result = mysqli_query($link, $query);
		if($result1 and $result)
			echo'<a class="ui green label">Accepted</a>';
		if($info1['type']=='casual')
			$query="UPDATE leave_faculty SET casual='$leave_left' WHERE faculty_id='$faculty_id'";
		if($info1['type']=='earned')
			$query="UPDATE leave_faculty SET earned='$leave_left' WHERE faculty_id='$faculty_id'";
		if($info1['type']=='compensatory')
			$query="UPDATE leave_faculty SET compensatory='$leave_left' WHERE faculty_id='$faculty_id'";
		if($info1['type']=='halfpay')
			$query="UPDATE leave_faculty SET halfpay='$leave_left' WHERE faculty_id='$faculty_id'";
		if($info1['type']=='maternity')
			$query="UPDATE leave_faculty SET maternity='$leave_left' WHERE faculty_id='$faculty_id'";
		$result=mysqli_query($link, $query);
	}

	if($value == 3)
	{
		$query="SELECT casual,earned,halfpay,compensatory, maternity FROM leave_faculty";
		$result = mysqli_query($link, $query);
		$query1="SELECT type FROM application_faculty WHERE faculty_id='$faculty_id' and strdate='$strdate'";
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