<?php
  require_once("db.php");
  
  $id = $_POST['id'];
  $title = $_POST['title'];
  $author= $_POST['author'];
  $content=$_POST['content'];
  
  $mysqli->query("UPDATE `blog` SET `author`='$author',`title`='$title',`content`='$content' WHERE id='$id'");
  echo "success";
?>