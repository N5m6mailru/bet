<?php
	$mysqli = new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
	$result = $mysqli->query("SHOW TABLES");
	while($row=$result->fetch_assoc()){
		var_dump($row);
	}
?>