<?php
	if(!file_exists("install.lock")){
		header("Location: install.php");
		exit();
	}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>KQSystem</title>
</head>
<body>
	<center><h1>KQSystem</h1></center>
    <form action="submit.php" method="post">
    	Name: <input type="text" name="name" />
    	<input type="submit" value="Submit" />
    </form>
	<br />
    <a href="/admin/"><button>Control Panel</button></a>
</body>
</html>
