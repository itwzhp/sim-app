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
<title>Sprawności Harcerskie</title>
</head>
<body onLoad="getSprawnosci()">
<div class="container-fluid p-0">
<?php include_once("navbar.php");?>
<div class="sprawnosciharcheader">
	<div class="col-12" style="">
	<h1>Sprawności harcerskie</h1>
	</div>
	<div class="row d-flex align-self-stretch flex-wrap">
	<form name="Filtry">
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Nazwa">Nazwa</label>
		<input type="text" placeholder="Wyszukaj..." class="form-control" name="Nazwa" onkeyup="getSprawnosci()" >
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Kategoria">Kategoria</label>
		<select name="Kategoria" id="Kategoria" class="form-select" onchange="getSprawnosci()">
			<option value="WSZYSTKIE" selected>WSZYSTKIE</option>
			<?php
			$sql="SELECT DISTINCT Kategoria From sprawnosciharcerskie";
			$result = $connection->query($sql);
			while($row = $result->fetch_assoc()) {
				echo "<option value=\"", $row["Kategoria"],"\">", $row["Kategoria"], "</option>" ;
			  }
			?>
		</select>
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Poziom">Poziom</label>
		<select name="Poziom" id="Poziom" class="form-select" onchange="getSprawnosci()">
			<option value="WSZYSTKIE" selected>WSZYSTKIE</option>
			<?php
			$sql="SELECT DISTINCT `Poziom` FROM `sprawnosciharcerskie` ORDER BY Poziom";
			$result = $connection->query($sql);
			while($row = $result->fetch_assoc()) {
				echo "<option value=\"", $row["Poziom"],"\">";
				for($i=0;$i<$row["Poziom"];$i++) echo "★";
				echo"</option>" ;
			  }
			?>
		</select>
		</div>
	</form>
	</div>
</div>
<div class="col-12 d-flex align-self-stretch flex-wrap" id="divSprawnosci">

</div>




<script>
function getSprawnosci(){
	let nazwa = document.forms["Filtry"]["Nazwa"].value;
	let kategoria = document.forms["Filtry"]["Kategoria"].value;
	let poziom = document.forms["Filtry"]["Poziom"].value;
	
	
	const xhttp = new XMLHttpRequest();
	GETstr="getsprawnosciharcerskie.php?kategoria="+kategoria+"&nazwa="+nazwa+"&poziom="+poziom;
	
	xhttp.onload = function() {
		document.getElementById("divSprawnosci").innerHTML = this.responseText;
	}
	xhttp.open("GET", GETstr);
	xhttp.send(null);
}
</script>	
<?php
		$connection->close();?>
</div>
</body>
</html>