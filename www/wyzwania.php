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
<title>Wyzwania i zadania indywidualne</title>
</head>
<body>

<?php include_once("navbar.php");?>
<?php include_once("main header.htm");?>
	
	<div class="row col-12 p-4">
	<h1 style="text-align:center;">Wyzwania i zadania indywidualne</h1>
	</div>
	<div class= "row col-12 d-flex align-self-stretch flex-wrap">
	<div class="p-2 col-12 col-md-6  selzadania">
		<a href="zadania-zuchowe.php">
		<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src="GrafikiMetodyki/Zuchowa.svg">
		<h2 style="text-align:center;">zuchowe zadania indywidualne</h2>
		</a>
	</div>
	<div class="p-2 col-12 col-md-6 selwyzwania">
		<a href="wyzwania-harcerskie.php">
		<img style='width:60%; display: block; margin-left: auto; margin-right: auto;' src='GrafikiWyzwania/1.svg'>
		<h2 style="text-align:center;">wyzwania harcerskie</h2>
		</a>
	</div>
	</div>
</body>
</html>