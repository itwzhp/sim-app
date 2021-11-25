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
<title>Tropy harcerskie</title>
</head>
<body onLoad="getSprawnosci()">
<?php include_once("navbar.php");?>
<div class='tropyheader'>
	<div class="col-12" style="">
	<h1>Tropy harcerskie</h1>
	</div>
	<div class="row d-flex align-self-stretch flex-wrap">
	<form name="Filtry">
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Nazwa">Nazwa</label>
		<input type="text" placeholder="Wyszukaj.." class="form-control" name="Nazwa" onkeyup="getSprawnosci()" >
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Kategoria">Kategoria</label>
		<select name="Kategoria" class="form-select" id="Kategoria" onchange="getSprawnosci()">
			<option value="WSZYSTKIE" selected>WSZYSTKIE</option>
		<?php
		$sql="SELECT DISTINCT Kategoria From tropyharcerskie";
		$result = $connection->query($sql);
		while($row = $result->fetch_assoc()) {
			echo "<option value=\"", $row["Kategoria"],"\">", $row["Kategoria"], "</option>" ;
		  }
		?>
		</select>
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Metodyka">Metodyka</label>
		<select name="Metodyka" class="form-select" id="Metodyka" onchange="getSprawnosci()">
			<option value="WSZYSTKIE" selected>WSZYSTKIE</option>
		<?php
		$sql="SELECT DISTINCT Metodyka From tropyharcerskie ORDER BY Metodyka";
		$result = $connection->query($sql);
		while($row = $result->fetch_assoc()) {
			echo "<option value=\"", $row["Metodyka"],"\">", $row["Metodyka"], "</option>" ;
		  }
		?>
		</select>
		</div>
	</form>
	</div>
</div>
<div class="container-fluid">
<div class="col-12" id="divTropy">
</div>
</div>




<script>
function getSprawnosci(){
	let nazwa = document.forms["Filtry"]["Nazwa"].value;
	let kategoria = document.forms["Filtry"]["Kategoria"].value;
	let metodyka = document.forms["Filtry"]["Metodyka"].value;
	
	
	const xhttp = new XMLHttpRequest();
	GETstr="gettropyharcerskie.php?kategoria="+kategoria+"&metodyka="+metodyka+"&nazwa="+nazwa;
	
	xhttp.onload = function() {
		document.getElementById("divTropy").innerHTML = this.responseText;
	}
	xhttp.open("GET", GETstr);
	xhttp.send(null);
}
</script>	
<?php
		$connection->close();?>
</body>
</html>