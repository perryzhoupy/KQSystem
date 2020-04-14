<?php
	require_once("./admin/connect.php");
	$date = date("w");
	if($date == 6||$date == 0){
		header("refresh:3;url=/");
		die("今天不需要上课诶！");
	}
	$stuname = $_POST['name'];
	$sql = "SELECT * FROM ".$db_table." WHERE name='".$stuname."';";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result) == 0){
		header("refresh:3;url=/");
		die("您没有被录入！<br />请联系您的老师！");
	}
	$sql = "SELECT * FROM ".$db_table." WHERE name='".$stuname."';";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	if(empty($row[$date])){
		$sql = "UPDATE ".$db_table." SET ".$db_table.".".$date."=1 WHERE name='".$stuname."';";
		mysqli_query($con,$sql);
		header("refresh:3;url=/");
		exit('考勤成功！');
	}else{
		header("refresh:3;url=/");
		exit('您今天已经考勤过了！');
	}
?>