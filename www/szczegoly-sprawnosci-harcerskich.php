<!DOCTYPE html>
<html lang="pl">
<?php
	$IDsprawnosci= htmlspecialchars($_GET['ID']);;
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	$sql="SELECT `Nazwa-M`, `Nazwa-Z`,`Idea`,`Wskazowki` From sprawnosciharcerskie WHERE ID= ?";
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
if ($row["Nazwa-M"]!=$row["Nazwa-Z"]) echo "/".$row["Nazwa-Z"];
?>
</title>
<?php
echo "<meta name='description'".str_replace(array("\r\n", "\n", "\r"), " ", $row["Idea"])."'>";
?>


</head>
<body>
<?php include_once("navbar.php");?>
<div class="container-fluid ">
<div class="row">
<div class="col-12 sprawnosciharcheader">	
		
	<?php
	
	
	echo "<div class=' text-center col-12 col-sm-8 col-md-10 col-xl-11 p-2' Style='float:left'>";
	echo "<h1>";
	echo $row["Nazwa-Z"];
	echo "<br>";
	 if($row["Nazwa-M"]!=$row["Nazwa-Z"]) echo $row["Nazwa-M"];
	echo "</h1>";
	echo "</div>";
	echo "<div class='col-12 col-sm-4 col-md-2 col-xl-1 p-2' Style='float:left'>";
	echo "<img class='img-fluid' src='GrafikiSprHarc/".$IDsprawnosci.".svg'>";
	echo "</div>";		
?>	
</div>
</div>
<div class= "col-12 m-2 sprawnosccontent">
<h2>Wskazówki dla drużynowego</h2>
	<p>
	<?php
	if($row["Wskazowki"]!=""){
	echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Wskazowki"]);
	}else{
		echo "Brak.";
	}
	?>
	</p>
<br>
<h2>Idea poziomu trudności</h2>
	<p>
	<?php
	echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Idea"]);
	?>
	</p>
<br>

<h2>Zadania</h2>
	<p>
	<?php
	$sql="SELECT `Tresc`,`Stopien` From zadaniasprawnosciharcerskich WHERE `Sprawnosc`= ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('i',$IDsprawnosci);
	$stmt->execute();
	$result = $stmt->get_result();

	$numerzadania=1;
	
	$stopnie= array(" ");
	While($row = $result->fetch_assoc()){
		if ($row["Stopien"]) 
		{
			if (!array_search($row["Stopien"],$stopnie)) if($stopnie[0]!=$row["Stopien"]) $stopnie[]=$row["Stopien"];
			echo "<b>";
		}
		echo $numerzadania.". ".$row["Tresc"];
		if ($row["Stopien"]) 
		{
			for($i=1;$i<array_search($row["Stopien"],$stopnie)+1;$i++) 
			{
				echo "*";
			}
			echo "</b>";
		}
		echo "<br>";
		$numerzadania++;
	}
	echo "<br><br>";
	for($i=1;$i<count($stopnie);$i++){
		for ($j=0; $j<$i; $j++) echo "*";
		echo "Powiązane ze stopniem ".$stopnie[$i]."<br>";
	}
	?>
	</p>
</div>
</div>


<?php
		$connection->close();?>
</body>
</html>