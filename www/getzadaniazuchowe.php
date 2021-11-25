<?php
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 
	




	if(  $_GET['tresc']||$_GET['duchowy']||  $_GET['emocjonalny']||  $_GET['prawo'] ){
		$tresc=$_GET['tresc'];
		$duchowy=intval($_GET['duchowy']);
		$emocjonalny=intval($_GET['emocjonalny']);
		$prawo=$_GET['prawo']."";
		
		$sql= "SELECT DISTINCT `Tresc` FROM `zuchowezadaniaindywidualne` INNER JOIN `zuchowezadaniaindywidualne-prawozucha` ON `zuchowezadaniaindywidualne`.`ID`=`zuchowezadaniaindywidualne-prawozucha`.`Zadanie`   WHERE (`Rozwoj-Emocjonalny` >=?) AND (`Rozwoj-Duchowy` >=?) AND (`Tresc` LIKE ?) AND (`Prawo-Zucha` Like ?)";
		
		
		
		$stmt = $connection->prepare($sql);
		
		$stmt->bind_param('iiss',$emocjonalny,$duchowy,$tresc,$prawo);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		
		while ($row = $result->fetch_assoc()) {
			echo "<div class= 'row' style='border-color:#f7961d; border-bottom-style:solid;'>";
			echo "<div class= 'col-12 p-3'>";
			echo "<p>".$row["Tresc"]."</p>";
			echo "</div>";
			echo "</div>";
		}
	$connection->close();
	
	 }
?>