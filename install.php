<?php
	if(file_exists("install.lock")){
		header("Location: index.php");
		exit();
	}
	if(empty($_POST['dbhost'])){
		echo '<h1>Installation</h1>';
		echo '<form action="install.php" method="post">Host: <input type="text" name="dbhost" size="10" > : <input type="text" name="dbport" size="3" placeholder="3306"><br />User: <input type="text" name="dbuser" ><br />Pass: <input type="text" name="dbpass" ><br />Name: <input type="text" name="dbname" ><br /><br /><input type="submit" value="Next"></form>';
		exit();
	}
	$dbhost = $_POST['dbhost'].':';
	if(empty($_POST['dbport'])){
		$dbhost = $dbhost.'3306';
	}else{
		$dbhost = $dbhost.$_POST['dbport'];
	}
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	$dbname = $_POST['dbname'];
	$dbtable = "KAOQIN";
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(!$con){
		echo 'Connection Failed!';
		header("Refresh:1,url=install.php");
		exit();
	}
	$sql = "CREATE TABLE ".$db_name.".KAOQIN ( `name` TEXT NOT NULL , `1` INT NOT NULL , `2` INT NOT NULL , `3` INT NOT NULL , `4` INT NOT NULL , `5` INT NOT NULL) ENGINE = InnoDB;";
	mysqli_query($con,$sql);
	mysqli_close($con);
	$o = fopen("./admin/connect.php","w");
	fwrite($o,"<?php\n\$db_host = \"".$dbhost."\";\n\$db_user = \"".$dbuser."\";\n\$db_pass = \"".$dbpass."\";\n\$db_name = \"".$dbname."\";\n\$db_table = \"KAOQIN\";\n");
	fwrite($o,"\$con = mysqli_connect(\$db_host,\$db_user,\$db_pass,\$db_name);\n");
	fwrite($o,"if(!\$con){die(\"Connection Failed!\");}\n?>");
	fclose($o);
	$lock = fopen("install.lock","w");
	fclose($lock);
	echo 'Installation Done! <br />Administrator: user<br />Default Password: pass<br />';
	echo '<a href="index.php"><button>Return to index.php</button></a><a href="/admin/"><button>Control Panel</button></a>';
?>
