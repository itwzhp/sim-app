<?php
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	




	if(  $_GET['kategoria']||$_GET['nazwa']  ){
		$kategoria= $_GET['kategoria'];
		if ($kategoria=="WSZYSTKIE") $kategoria="%";
		
		
		$nazwa= $_GET['nazwa'];
		if($nazwa=="") {
			$nazwa="%";
		}else $nazwa= "%{$nazwa}%";
		
		
		
		
		$stmt = $connection->prepare("SELECT `Nazwa-M`,`Nazwa-Z`, `ID` FROM sprawnoscizuchowe WHERE (`Nazwa-M` LIKE ? OR `Nazwa-Z` LIKE ?) AND `Kategoria` LIKE ?");
		
		$stmt->bind_param('sss',$nazwa,$nazwa,$kategoria);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while ($row = $result->fetch_assoc()) {
			echo "<a href='szczegoly-sprawnosci-zuchowych.php?ID=". $row["ID"]."'";
			echo "<div class= 'col-6 col-md-4 col-lg-3 col-xl-2 sprawnosczwrapperout' style='float:left'>";
			echo "<div class='sprawnosczwrapperin'>";
			echo "<img class='img-fluid w-100' style='width:100%' src='GrafikiSprZuch/".$row["ID"].".svg'>";
			echo "<figcaption>". $row["Nazwa-M"]. "<br>";
			if($row["Nazwa-M"]!=$row["Nazwa-Z"]) echo$row["Nazwa-Z"];
			
			
			echo "</figcaption></div></div>";
			echo "</a>";
		}
	$connection->close();
	
	 }
?>