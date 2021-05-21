<?php
  header('Content-type: text/html; charset=utf-8');
  require_once("db.php");
  
  $result = $mysqli->query("SELECT * FROM `blog`");
  
  $posts = [];
  while($row = $result->fetch_assoc()){
    $posts[] = $row;
  }
  
  echo json_encode($posts);
?>