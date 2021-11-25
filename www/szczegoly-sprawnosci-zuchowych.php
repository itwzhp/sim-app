<!DOCTYPE html>
<html lang="pl">
<?php
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	
	$IDsprawnosci= htmlspecialchars($_GET['ID']);
	$sql="SELECT `Nazwa-M`, `Nazwa-Z`,`Wymagania`, `Uwagi` From sprawnoscizuchowe WHERE ID= ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('i',$IDsprawnosci);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
?>
<head>
<?php include_once("head.php");?>
<title>
<?php
echo $row["Nazwa-M"];
if ($row["Nazwa-M"]!=$row["Nazwa-Z"]&&""!=$row["Nazwa-Z"]) echo "/".$row["Nazwa-Z"];
?>
</title>	
</head>
<body>
<?php include_once("navbar.php");?>
<div class="container-fluid ">
<div class="row">
<div class="col-12 sprawnoscizuchheader">		
<?php

echo "<div class='text-center col-12 col-sm-8 col-md-10 col-xl-11' Style='float:left'>";
echo "<h1>";
echo $row["Nazwa-Z"];
echo "<br>";
echo $row["Nazwa-M"];
echo "</div>";
?>
</h1>
<?php
echo "<div class='col-12 col-sm-4 col-md-2 col-xl-1' Style='float:left'>";
echo "<img class='img-fluid w-100' src='GrafikiSprZuch/".$IDsprawnosci.".svg'>";
echo "</div>";
?>	
</div>
</div>
<div class="col-12 m-2 sprawnosczuchcontent">
<h2>Wymagania:</h2>
<p>
<?php
echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Wymagania"]);
?>
</p>
<h2>Wskazówki dla kadry zuchowej:</h2>
<p>
<?php
echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Uwagi"]);
?>
</p>

<?php
$sql="SELECT `Zadanie` From zadaniasprawnoscizuchowych WHERE `Sprawnosc`= ? AND `Poziom`= ?";
for ($poziom=1; $poziom<=3;$poziom++){
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('ii',$IDsprawnosci,$poziom);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows>0){
		echo "<h2>Przykładowe zadania dla zucha zdobywającego ";
		for ($i=0; $i<$poziom;$i++) echo "★";
		echo " gwiazdkę:</h2><p>";
		$numerzadania=1;
		While($row = $result->fetch_assoc()){
			echo $numerzadania.". ".$row["Zadanie"]."<br>";
			$numerzadania++;
		}
		echo "</p>";
	}
}

?>
</div>
</div>


<?php
		$connection->close();?>
</body>
</html>