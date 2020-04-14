<?php
	if(!file_exists("install.lock")){
		header("Location: install.php");
		exit();
	}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>考勤系统</title>
</head>
<body>
	<center><h1>考勤系统</h1></center>
    <form action="submit.php" method="post">
    	学生姓名：<input type="text" name="name" />
    	<input type="submit" value="提交" />
    </form>
	<br />
    <a href="/admin/"><button>后台管理</button></a>
</body>
</html>