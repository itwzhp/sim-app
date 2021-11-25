<?php
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	




	if(  $_GET['kategoria']||$_GET['nazwa']  ){
		$kategoria= $_GET['kategoria'];
		if ($kategoria=="WSZYSTKIE") $kategoria="%";
		$poziom= $_GET['poziom'];
		if ($poziom=="WSZYSTKIE") $poziom="%";
		
		
		$nazwa= $_GET['nazwa'];
		if($nazwa=="") {
			$nazwa="%";
		}else $nazwa= "%{$nazwa}%";
		
		
		
		$stmt = $connection->prepare("SELECT `Nazwa-M`,`Nazwa-Z`, `ID` FROM sprawnosciharcerskie WHERE (`Nazwa-M` LIKE ? OR `Nazwa-Z` LIKE ?) AND `Kategoria` LIKE ? AND `Poziom` LIKE ? ORDER BY `Nazwa-M`");
		
		$stmt->bind_param('ssss',$nazwa,$nazwa,$kategoria,$poziom);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		$rowcounter=0;
		while ($row = $result->fetch_assoc()) {
			echo "<div class= 'col-6 col-md-4 col-lg-3 col-xl-2 sprhwrapperout' Style='float:left' >";
			echo "<a href='szczegoly-sprawnosci-harcerskich.php?ID=". $row["ID"]."'>";
			echo "<div class='sprhwrapperin'>";
			echo "<img class='img-fluid w-100' src='GrafikiSprHarc/".$row["ID"].".svg' alt='".$row["Nazwa-Z"]."/".$row["Nazwa-M"]."'>";
			echo "<figcaption>". $row["Nazwa-M"];
			if($row["Nazwa-M"]!=$row["Nazwa-Z"]) echo "<br>".$row["Nazwa-Z"];
			echo "</figcaption>";
			echo "</div></a></div>";
		}
	$connection->close();
	
	 }
?>