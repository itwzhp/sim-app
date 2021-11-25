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
<title>Tropy</title>
</head>
<body>
<?php include_once("navbar.php");?>
<?php include_once("main header.htm");?>
	<div class="container-fluid">
	<div class="row p-5">
	<h1 style="text-align:center;">Tropy</h1>
	</div>
	<div class= "row d-flex align-self-stretch flex-wrap">
	<div class="p-5 col-12 col-md-6  seltropwrapper">
		<a href="tropy-zuchowe.php">
		<?php
		$sql="SELECT `ID` From tropyzuchowe ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiTrpZuch/". $row["ID"].".svg'>";
		?>
		<h2 style="text-align:center;">tropy zuchowe</h2>
		</a>
	</div>
	<div class="p-5 col-12 col-md-6 seltropwrapper">
		<a href="tropy-harcerskie.php">
		<?php
		$sql="SELECT DISTINCT `Kategoria` From tropyharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
		?>
		<h2 style="text-align:center;">tropy harcerskie</h2>
		</a>
	</div>
	</div>
	</div>
</body>
</html>