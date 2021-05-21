<?php
  header('Content-type: text/html; charset=utf-8');
  require_once("db.php");
  $title = $_POST['title'];
  $content = $_POST['content'];
  $author = $_POST['author'];
  
  $mysqli->query("INSERT INTO blog (`author`,`title`,`content`) VALUES ('$author','$title','$content')");
  echo 'success';
?>