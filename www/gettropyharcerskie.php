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
		
		$metodyka= $_GET['metodyka'];
		if ($metodyka=="WSZYSTKIE") $metodyka="%";
		
		
		
		
		$stmt = $connection->prepare("SELECT `Nazwa`, `ID`, `Kategoria`, `Metodyka` FROM tropyharcerskie WHERE (`Nazwa` LIKE ?) AND `Kategoria` LIKE ? AND `Metodyka` LIKE ? ORDER BY `Nazwa`");
		
		$stmt->bind_param('sss',$nazwa,$kategoria,$metodyka);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while ($row = $result->fetch_assoc()) {
			echo "<a href='szczegoly-tropow-harcerskich.php?ID=". $row["ID"]."'>";
			echo "<div class= 'row trophwrapper' style='border-color:#382259; border-bottom-style:solid;'>";
			echo "<div class= 'col-2 p-3'>";
			echo "<img class='img-fluid w-100 w-md-75 d-block mx-auto' src='GrafikiTrpHarc/". $row["Kategoria"].".svg'>";
			echo "</div>";
			echo "<div class='col-8 p-3'>";
			echo "<h2>". $row["Nazwa"]. "</h2>";
			echo "</div>";
			echo "<div class= 'col-2 p-3'>";
			echo "<img class='img-fluid w-100 w-md-75 d-block mx-auto' src='GrafikiMetodyki/". $row["Metodyka"].".svg'>";
			echo "</div>";
			echo "</div>";
			echo "</a>";
		}
	$connection->close();
	
	 }
?>