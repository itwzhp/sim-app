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
<title>Wyzwania harcerskie</title>
</head>
<body onLoad="getWyzwawnia()">
<div class="container-fluid p-0">
<?php include_once("navbar.php");?>
<div class='row wyzwaniaheader'>
	<div class="row col-12" style="">
	<h1>Wyzwania harcerskie</h1>
	</div>
	<div class="row col-12 d-flex align-self-stretch flex-wrap">
	<form name="Filtry">
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Tresc">Treść</label>
		<input type="text" placeholder="Wyszukaj.." class="form-control"  name="Tresc" onkeyup="getWyzwawnia()" >
		</div>
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Metodyka">Metodyka</label>
		<select name="Metodyka" class="form-select" id="Metodyka" onchange="getWyzwawnia()">
			<option selected value='WSZYSTKIE'>WSZYSTKIE</option>	
				<?php
		$sql="SELECT DISTINCT `Metodyka` From `wyzwania` ORDER BY `Metodyka`";
		$result = $connection->query($sql);
		while($row = $result->fetch_assoc()) {
			echo "<option value='". $row["Metodyka"]."'>".$row["Metodyka"]. "</option>" ;
		  }
		?>
		</select>
		</div>
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Rozwoj">Rozwój</label>
		<select name="Rozwoj" class="form-select" onchange="getWyzwawnia()" >
			<option selected value='WSZYSTKIE'>WSZYSTKIE</option>
			<option value="Duchowy">Duchowy</option>
			<option value="Emocjonalny">Emocjonalny</option>
		</select>
		</div>
		<div class="col-12 col-md-6 p-1" style="float:left;">
		<label for="Prawo">Prawo Harcerskie</label>
		<select name="Prawo" class="form-select" id="Prawo"  onchange="getWyzwawnia()">
				<option selected value='WSZYSTKIE'>WSZYSTKIE</option>
				<?php
		$sql="SELECT `ID`, `Tresc` From `prawoharcerskie` ORDER BY `ID`";
		$result = $connection->query($sql);
		while($row = $result->fetch_assoc()) {
			echo "<option value='". $row["ID"]."'>".$row["ID"].". ".$row["Tresc"]. "</option>" ;
		  }
		?>
		</select>
		</div>
	</form>
	</div>
</div>
<div class="container-fluid">
<div class=" col-12" id="divWyzwania">
</div>
</div>
<?php $connection->close();?>
</div>
</body>


<script>
function getWyzwawnia(){
	let tresc = document.forms["Filtry"]["Tresc"].value;
	let rozwoj = document.forms["Filtry"]["Rozwoj"].value;
	let prawa =document.forms["Filtry"]["Prawo"].value;
	let metodyka =document.forms["Filtry"]["Metodyka"].value;
	
	tresc='%'+tresc+'%';
	let duchowy=0;
	let emocjonalny=0;
	if (rozwoj=="WSZYSTKIE") {duchowy=0; emocjonalny=0;}
	if (rozwoj=="Duchowy") {duchowy=1; emocjonalny=0;}
	if (rozwoj=="Emocjonalny") {duchowy=0; emocjonalny=1;}
	
	
	if (metodyka=="WSZYSTKIE") metodyka="";
	metodyka="%"+metodyka+"%";
	
	
	if (prawa=="WSZYSTKIE") prawa="%";
	
	
	const xhttp = new XMLHttpRequest();
	GETstr="getwyzwania.php?tresc="+tresc+"&duchowy="+duchowy+"&emocjonalny="+emocjonalny+"&prawo="+prawa+"&metodyka="+metodyka;
	
	xhttp.onload = function() {
		document.getElementById("divWyzwania").innerHTML = this.responseText;
	}
	xhttp.open("GET", GETstr);
	xhttp.send(null);
}
</script>	
</html>