<?php
	if(file_exists("install.lock")){
		header("Location: index.php");
		exit();
	}
	if(empty($_POST['dbhost'])){
		echo '<h1>安装向导</h1>';
		echo '<form action="install.php" method="post">数据库主机：<input type="text" name="dbhost" size="10" > : <input type="text" name="dbport" size="3" placeholder="3306"><br />数据库用户：<input type="text" name="dbuser" ><br />数据库密码：<input type="text" name="dbpass" ><br />数据库名称：<input type="text" name="dbname" ><br /><br /><input type="submit" value="下一步"></form>';
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
		echo '连接失败！';
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
	echo '安装成功！<br />管理员初始账户：user<br />管理员初始密码：pass<br />';
	echo '<a href="index.php"><button>返回主页</button></a><a href="/admin/"><button>管理面板</button></a>';
?>