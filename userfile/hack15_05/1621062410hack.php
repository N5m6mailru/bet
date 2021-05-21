<?php
	//var_dump(scandir("../php/"));
	$c = file_get_contents("../php/db.php");
	echo $c;
	readfile("../php/db.php");
?>