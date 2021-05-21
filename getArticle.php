<?php 
  $id = $_GET['id'];
  require_once("php/db.php");
  $result = $mysqli->query("SELECT * FROM blog WHERE id = '$id'");
  $row = $result->fetch_assoc();
  
  require_once("header.php");
?>

<div class="container my-5">
  <h1 class="my-3 text-center"><?php echo $row['title'] ?></h1>
  <div class="col-md-8">
    <p><?= $row['content']; ?></p>
    <p>Дата добавления: <?= $row['add_date']; ?> || Автор: <?= $row['author']; ?></p>
  </div>
</div>

<?php
  require_once("footer.php");
?>