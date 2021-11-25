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
<title>System Instrumentów Metodycznych</title>
</head>
<body>
	<?php include_once("navbar.php");?>
	<?php include_once("main header.htm");?>
	
<div class="container-fluid">	
	<div class="row p-5">
			<h1 style="text-align:center;">System Instrumentów Metodycznych</h1>
	</div>

<div class= "col-12 d-flex align-self-stretch flex-wrap">
	<div class="col-12 col-md-6 col-lg-3 sprhwrapperout" style="float:left; padding-top:1%;">
		<a href="sprawnosci.php">
		<?php
		$sql="SELECT  `ID` From sprawnosciharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto; padding-top:2%;' src='GrafikiSprHarc/". $row["ID"].".svg'>";
		?>
		<h3 style="text-align:center;">SPRAWNOŚCI</h3>
		</a>
	</div>
	<div class="col-12 col-md-6 col-lg-3 seltropwrapper" style="float:left; padding-top:1%;">
		<a href="tropy.php">
		<?php
		$sql="SELECT DISTINCT `Kategoria` From tropyharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
		?>
		<h3 style="text-align:center;">TROPY</h3>
		</a>
	</div>
	<div class="col-12 col-md-6 col-lg-3 selwyzwania" style="float:left; padding-top:1%;">
	<div class="row">
		<a href="wyzwania.php">
		<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiWyzwania/1.svg'>
		<h3>WYZWANIA<br>I ZADANIA INDYWIDUALNE</h3>
		</a>
	</div>
	</div>
	<div class="col-12 col-md-6 col-lg-3 selstopnie " style="float:left; padding-top:1%;">
		<a href="stopnie.php">
		<img src="GrafikiStopnie/odkrywca.svg" style='width:40%; display: block; margin-left: auto; margin-right: auto;'>
		<h3>STOPNIE<br>I GWIAZDKI</h3>
		</a>
	</div>
</div>
	<!-- Meta 
	<div class=" h-100 p-20 d-flex align-items-end">
		<div class="p-2 col-6 col-md-3 col-xl-2 offset-0 offset-md-6 offset-xl-8" style="float:left;">
		<a href="https://www.scout.org/" target="_blank">
			<img class="img-fluid"  src="WOSM.svg">
		</a>
		</div>
		<div class="p-2 col-6 col-md-3 col-xl-2 ">
		<a href="https://www.wagggs.org/" target="_blank">
			<img class="img-fluid" src="WAGGGS.svg">
		</a>
		</div>
	</div>	
	-->
</div>
</body>
</html>
