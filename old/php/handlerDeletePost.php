<?php
  require_once("db.php");
  $id = $_POST['id'];

  $mysqli->query("DELETE FROM `blog` WHERE id='$id'");
  echo json_encode(["result"=>"success"]);
?>