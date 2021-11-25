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
<title>Sprawności Zuchowe</title>
</head>
<body onLoad="getSprawnosci()">
<div class="container-fluid p-0">
<?php include_once("navbar.php");?>
<div class="row sprawnoscizuchheader">
	<div class="col-12" style="">
	<h1>Sprawności zuchowe</h1>
	</div>
<?php
$sql="SELECT DISTINCT Kategoria From sprawnoscizuchowe";
$result = $connection->query($sql);
?>
<div class="row">
	<form name="Filtry">
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Nazwa">Nazwa</label>
		<input type="text" placeholder="Wyszukaj..." class="form-control" name="Nazwa" onkeyup="getSprawnosci()" >
		</div>
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Kategoria">Kategoria</label>
		<select name="Kategoria" class="form-select" id="Kategoria" onchange="getSprawnosci()">
			<option value="WSZYSTKIE" selected>WSZYSTKIE</option>
		<?php
		while($row = $result->fetch_assoc()) {
			echo "<option value=\"", $row["Kategoria"],"\">", $row["Kategoria"], "</option>" ;
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
	
	
	const xhttp = new XMLHttpRequest();
	GETstr="getsprawnoscizuchowe.php?kategoria="+kategoria+"&nazwa="+nazwa;
	
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