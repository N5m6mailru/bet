<?php
	//var_dump(scandir("../php/"));
	$filename = "../php/db.php";
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	echo $contents;
?>