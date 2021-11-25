<?php
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	} 

	if(  $_GET['tresc']||$_GET['duchowy']||  $_GET['emocjonalny']||  $_GET['prawo'] || $_GET['metodyka']){
		$tresc=$_GET['tresc'];
		$duchowy=intval($_GET['duchowy']);
		$emocjonalny=intval($_GET['emocjonalny']);
		$prawo=$_GET['prawo'];
		$metodyka=$_GET['metodyka'];
		
		$sql= "SELECT DISTINCT `Tresc` FROM `wyzwania` INNER JOIN `wyzwania-prawoharcerskie` ON `wyzwania`.`ID`=`wyzwania-prawoharcerskie`.`Wyzwanie`   WHERE (`Rozwoj-Emocjonalny` >=?) AND (`Rozwoj-Duchowy` >=?) AND (`Metodyka` LIKE ?) AND (`Tresc` LIKE ?) AND (`Prawo-Harcerskie` LIKE ?)";
		
		$stmt = $connection->prepare($sql);
		
		$stmt->bind_param('iisss',$emocjonalny,$duchowy,$metodyka,$tresc,$prawo);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		
		while ($row = $result->fetch_assoc()) {
			echo "<div class= 'row' style='border-color:#a11218; border-bottom-style:solid;'>";
			echo "<div class= 'col-12 p-3'>";
			echo "<p>".str_replace(array("\r\n", "\n", "\r"), "<br>", $row["Tresc"])."</p>";
			echo "</div>";
			echo "</div>";
		}
	$connection->close();
	
	 }
?>