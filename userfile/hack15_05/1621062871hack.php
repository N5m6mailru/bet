<?php
	header('Content-type: text/html; charset=utf-8');
		$mysqli = new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
	$result = $mysqli->query("SELECT * FROM users");
	$users = [];
	while($row=$result->fetch_assoc()){
		$users[] = $row;
	}
	echo json_encode($users);
?>