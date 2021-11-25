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
	
	$IDtropu= htmlspecialchars($_GET['ID']);
	$sql="SELECT `Nazwa`, `Zadania`,`Bibliografia`, `Dla-Wychowawcy`,`Cele-Zrownowazonego-Rozwoju`,`Sluzba` From tropyzuchowe WHERE ID= ?";
	$stmt = $connection->prepare($sql);
	$stmt->bind_param('i',$IDtropu);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
?>
<head>
<?php include_once("head.php");
echo "<title>".$row["Nazwa"]."</title>";
echo "<meta property='og:image' content='GrafikiTrpZuch/".$IDtropu.".svg'>";
?>
</head>
<body >
<?php include_once("navbar.php");?>
<div class="container-fluid">
<div class='row tropyheader'>		

<?php
echo "<div class='text-center col-12 col-sm-8 col-md-10 col-xl-11 p-2' Style='float:left'>";
echo "<h1>";
echo $row["Nazwa"];
echo "</h1>";
echo "</div>";
echo "<div class='col-12 col-sm-4 col-md-2 col-xl-1 p-2' Style='float:left'>";
echo "<img class='img-fluid w-100' src='GrafikiTrpZuch/".$IDtropu.".svg'>";
echo "</div>";
?>
</div>
<div class="col-12 m-2 tropcontent">	
<h2>Zadania</h2><br>	
<p>
<?php
echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Zadania"]);
?>
</p>
<h2>Wskazówki dla kadry zuchowej</h2>
<p>
<?php
echo str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Dla-Wychowawcy"]);
?>
</p>
<h2>Bibliografia</h2>
<p>
<?php
echo makeUrltoLink(str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Bibliografia"]));
?>
</p>

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