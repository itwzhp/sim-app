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
	<div class="row">
			<h1 style="text-align:center; font-size: min(3rem,10vw)">System Instrumentów Metodycznych</h1>
	</div>
<div class="container-fluid d-flex flex-wrap align-items-center">
<div class= "col-12  d-flex flex-wrap align-items-center p-lg-5" style="float:left;">
<div class="col-12 p-2"><h2>INSTRUMENTY OBOWIĄZKOWE:</h2></div>
	<div class="col-12 col-sm-6 col-md-4 col-lg-3 selstopnie mt-3 p-2 align-self-stretch " style="float:left; padding-top:1%; ">
		<a href="stopnie.php">
		<img src="GrafikiStopnie/odkrywca.svg" style='width:40%; display: block; margin-left: auto; margin-right: auto;'>
		<h3 class="pt-2 "  style="text-align:center; " >STOPNIE I GWIAZDKI</h3>
		</a>
	</div>

	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch sprawnosczwrapperout " style="float:left; padding-top:1%; ">
		<a href="sprawnosci-zuchowe.php">
		<?php
		$sql="SELECT `ID` From sprawnoscizuchowe ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:69.282%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiSprZuch/".$row["ID"].".svg'>";
		?>
		<h3 class="pt-2" style="text-align:center; ">SPRAWNOŚCI ZUCHOWE</h3>
		</a>
	</div>
	
	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch sprhwrapperout " style="float:left; padding-top:1%; ">
		<a href="sprawnosci-harcerskie.php">
		<?php
		$sql="SELECT  `ID` From sprawnosciharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto; padding-top:2%;' src='GrafikiSprHarc/". $row["ID"].".svg'>";
		?>
		<h3 class="pt-2" style="text-align:center;">SPRAWNOŚCI HARCERSKIE</h3>
		</a>
	</div>

	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch seltropwrapper " style="float:left; padding-top:1%; ">
		<a href="tropy-zuchowe.php">
		<?php
		$sql="SELECT `ID` From tropyzuchowe ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:69.282%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiTrpZuch/". $row["ID"].".svg'>";
		?>
		<h3 class="pt-2 " style="text-align:center;">TROPY ZUCHOWE</h3>
		</a>
	</div>
	
</div>


<div class="col-12 d-flex align-self-stretch flex-wrap p-lg-5">
<div class="col-12 p-2"><h2>INSTRUMENTY NIEOBOWIĄZKOWE:</h2></div>
	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch  seltropwrapper " style="float:left; padding-top:1%; ">
		<a href="tropy-harcerskie.php">
		<?php
		$sql="SELECT DISTINCT `Kategoria` From tropyharcerskie ORDER BY RAND()LIMIT 1 ";
		$result = $connection->query($sql);
		$row = $result->fetch_assoc();
		echo "<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
		?>
		<h3 class="pt-2 " style="text-align:center;">PROPOZYCJE TROPÓW HARCERSKICH</h3>
		</a>
	</div>
	
	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch  selzadania " style="float:left; padding-top:1%; ">
		<a href="zadania-zuchowe.php">
		<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src="GrafikiMetodyki/Zuchowa.svg">
		<h3 class="pt-2 " style="text-align:center;">PROPOZYCJE ZADAŃ INDYWIDUALNYCH (ZUCHY)</h3>
		</a>
	</div>
	
	<div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-3 p-2 align-self-stretch  selwyzwania " style="float:left; padding-top:1%; ">
		<a href="wyzwania-harcerskie.php">
		<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiWyzwania/1.svg'>
		<h3 class="pt-2 " style="text-align:center;">PROPOZYCJE WYZWAŃ</h3>
		</a>
	</div>
	
</div>
</div>
	
</div>
</body>
</html>
