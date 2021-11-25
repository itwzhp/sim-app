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
<title>Zuchowe zadania indywidualne</title>
</head>
<body onLoad="getZadania()">
<?php include_once("navbar.php");?>
<div class="container-fluid">
<div class="row">
<div class='col-12 zadaniaheader'>
	<div class="row" style="">
	<h1>Zuchowe zadania indywidualne</h1>
	</div>
	<div class="row d-flex align-self-stretch flex-wrap">
	<form name="Filtry">
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Tresc">Treść</label>
		<input type="text" placeholder="Wyszukaj.." class="form-control"  name="Tresc" onkeyup="getZadania()" >
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Rozwoj">Rozwój</label>
		<select name="Rozwoj" class="form-select" onchange="getZadania()">
			<option selected value="WSZYSTKIE">WSZYSTKIE</option>
			<option value="Duchowy">Duchowy</option>
			<option value="Emocjonalny">Emocjonalny</option>
		</select>
		</div>
		<div class="col-12 col-md-6 col-lg-4 p-1" style="float:left;">
		<label for="Prawo">Prawo Zucha</label>
		<select name="Prawo" class="form-select" id="Prawo" onchange="getZadania()">
			<option selected value="WSZYSTKIE">WSZYSTKIE</option>	
		<?php
		$sql="SELECT `ID`, `Tresc` From `prawozucha` ORDER BY `ID`";
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
</div>
</div>
<div class="container-fluid">
<div class="col-12" id="divZadania">
</div>
<?php $connection->close();?>
</div>
</body>


<script>
function getZadania(){
	let tresc = document.forms["Filtry"]["Tresc"].value;
	let rozwoj = document.forms["Filtry"]["Rozwoj"].value;
	let prawa =document.forms["Filtry"]["Prawo"].value;
	
	
	tresc='%'+tresc+'%';
	let duchowy=0;
	let emocjonalny=0;
	if (rozwoj=="WSZYSTKIE") {duchowy=0; emocjonalny=0;}
	if (rozwoj=="Duchowy") {duchowy=1; emocjonalny=0;}
	if (rozwoj=="Emocjonalny") {duchowy=0; emocjonalny=1;}
	
	if (prawa=="WSZYSTKIE") prawa="%";
	
	
	const xhttp = new XMLHttpRequest();
	GETstr="getzadaniazuchowe.php?tresc="+tresc+"&duchowy="+duchowy+"&emocjonalny="+emocjonalny+"&prawo="+prawa;
	xhttp.onload = function() {
		document.getElementById("divZadania").innerHTML = this.responseText;
	}
	xhttp.open("GET", GETstr);
	xhttp.send(null);
}
</script>	
</html>