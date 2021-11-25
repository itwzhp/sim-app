<!DOCTYPE html>
<html lang="pl">
<?php
function makeUrltoLink($string) {
 // The Regular Expression filter
 $reg_pattern = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
return preg_replace($reg_pattern, '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $string);
}

	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	$IDtropu= $_GET['ID'];
	$sql="SELECT `Nazwa`, `Wprowadzenie`,`Plan`, `Zadania`, `Podsumowanie`,`Cele-Zrownowazonego-Rozwoju`,`Sluzba`,`Kategoria`,`Metodyka` From tropyharcerskie WHERE ID= ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('i',$IDtropu);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
?>

<head>
<?php include_once("head.php");
echo "<title>".$row["Nazwa"]."</title>";
echo "<meta property='og:image' content='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
echo "<meta name='description'".str_replace(array("\r\n", "\n", "\r"), " ", $row["Wprowadzenie"])."'>";
?>


</head>
<body >
<?php include_once("navbar.php");?>
<div class="container-fluid">
<div class='row tropyheader'>	
	<div class='text-center col-12 col-sm-8 col-md-10 col-xl-11 p-2' Style='float:left'>
	<h1>	
	<?php
	echo $row["Nazwa"];
	?>
	</h1>
	</div>
	<div class='col-12 col-sm-4 col-md-2 col-xl-1 p-2' Style='float:left'>
	<?php
	echo "<img class='img-fluid w-75 mx-auto' src='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
	?>
	</div>
</div>
	
<div class="col-12 m-2 tropcontent">	
<h2>Wprowadzenie:</h2>
<p>	
<?php
echo makeUrltoLink(str_replace(array("\r\n", "\n", "\r"), "\n<br>", $row["Wprowadzenie"]));
?>
</p>
<h2>Zaplanujcie!</h2>	
<p>
<?php
echo makeUrltoLink(str_replace(array("\r\n", "\n", "\r"), "\n<br>", $row["Plan"]));
?>
</p>
<h2>Zróbcie!</h2>
<p>
<?php
echo makeUrltoLink(str_replace(array("\r\n", "\n", "\r"), "\n<br>", $row["Zadania"]));
?>
</p>
<h2>Podsumujcie!</h2>	
<p>
<?php
echo makeUrltoLink(str_replace(array("\r\n", "\n", "\r"), "\n<br>", $row["Podsumowanie"]));
?>
</p>
<br>
<?php
$cele=explode(";",$row["Cele-Zrownowazonego-Rozwoju"]);
if($row["Cele-Zrownowazonego-Rozwoju"]!=""){
	
	echo "<img src='CeleZrownowazonegoRozwoju.svg' class='col-md-6 col-lg-4 img-fluid'>";
	echo "<br>";

for ($i=0; $i<count($cele);$i++)
{
	echo "<div class=' p-2 col-6 col-md-4 col-lg-3' style='float:left'>";
	echo "<a href='https://www.un.org.pl/cel".$cele[$i]."' target='_blank'>";
	echo "<img class='img-fluid w-75 mx-auto d-block' src='CZR/".$cele[$i].".svg'>";
	echo "</a>";
	echo "</div>";
}
}

$connection->close();
?>
</div>
</div>
</body>
</html>