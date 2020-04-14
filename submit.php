<?php
	require_once("./admin/connect.php");
	$date = date("w");
	if($date == 6||$date == 0){
		header("refresh:3;url=/");
		die("Today is weekend!");
	}
	$stuname = $_POST['name'];
	$sql = "SELECT * FROM ".$db_table." WHERE name='".$stuname."';";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) == 0){
		header("refresh:3;url=/");
		die("No record in database!<br />Please contact the administrator!");
	}
	$sql = "SELECT * FROM ".$db_table." WHERE name='".$stuname."';";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	if(empty($row[$date])){
		$sql = "UPDATE ".$db_table." SET ".$db_table.".".$date."=1 WHERE name='".$stuname."';";
		mysqli_query($con,$sql);
		header("refresh:3;url=/");
		exit('Submit Successful!');
	}else{
		header("refresh:3;url=/");
		exit('Submitted!');
	}
?>
