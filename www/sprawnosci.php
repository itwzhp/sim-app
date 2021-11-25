<!DOCTYPE html>
<html lang="pl">
<?php 
require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	?>



<head>
<?php include_once("head.php");?>
<title>Sprawności</title>
</head>
<body>
	<?php include_once("navbar.php");?>
	<?php include_once("main header.htm");?>
	<div class="container-fluid">
	<div class="row p-5">
	<h1 style="text-align:center;">Sprawności</h1>
	</div>
	
	<div class= "col-12 d-flex align-self-stretch flex-wrap">
	<div class="p-5 col-12 col-md-6 sprawnosczwrapperout" style="float: left;" >
	<a href="sprawnosci-zuchowe.php">
		<?php
		$sql="SELECT `ID` From sprawnoscizuchowe ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiSprZuch/".$row["ID"].".svg'>";
		?>
		<h2 style="text-align:center;">sprawności zuchowe</h2>
	</a>
	</div>
	<div class="p-5 col-12 col-md-6 sprhwrapperout" style="float: left;">
	<a href="sprawnosci-harcerskie.php">
		<?php
		$sql="SELECT  `ID` From sprawnosciharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiSprHarc/". $row["ID"].".svg'>";
		?>
		<h2 style="text-align:center;">sprawności harcerskie</h2>
	</a>
	</div>
	</div>
	</div>
</body>
</html>