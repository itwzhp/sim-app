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
		
		
		
		
		$stmt = $connection->prepare("SELECT `Nazwa`, `ID` FROM tropyzuchowe WHERE (`Nazwa` LIKE ?) AND `Kategoria` LIKE ? ORDER BY `Nazwa`");
		
		$stmt->bind_param('ss',$nazwa,$kategoria);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while ($row = $result->fetch_assoc()) {
			echo "<div class= 'col-6 col-md-4 col-lg-3 col-xl-2 tropzwrapperout' style='float:left'>";
			echo "<a href='szczegoly-tropow-zuchowych.php?ID=". $row["ID"]."'>";
			echo "<div class='tropzwrapperin'>";
			echo "<img class='img-fluid w-100' src='GrafikiTrpZuch/".$row["ID"].".svg'>";
			echo "<figcaption>". $row["Nazwa"];
			
			echo "</figcaption></div>";
			echo "</a>";
			echo "</div>";
		}
	$connection->close();
	
	 }
?>