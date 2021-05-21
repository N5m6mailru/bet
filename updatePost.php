<?php 
$id = $_GET['id'];
require_once('php/db.php');
$result = $mysqli->query("SELECT * FROM blog WHERE id='$id'");
$row = $result->fetch_assoc();

require_once("header.php");?>

<div class="container my-5">
  <h1 class="my-3 text-center">Добавить статью</h1>
  <div class="col-md-6 mx-auto">
    <form onsubmit="updatePost(this); return false;">
      <div class="mb-3">
        <input value="<?= $row['title']?>" name="title" type="text" class="form-control" placeholder="Заголовок">
      </div>
      <div class="mb-3">
        <textarea name="content" class="form-control" placeholder="Контент"><?= $row['content']?></textarea>
      </div>
      <div class="mb-3">
        <input value="<?= $row['author']?>" name="author" type="text" class="form-control" placeholder="Автор">
      </div>
      <div class="mb-3">
        <input type="submit" class="form-control btn btn-primary" value="Сохранить">
      </div>
    </form>
  </div>
</div>

<script>
  function updatePost(form){
    const formData = new FormData(form);
    formData.append('id',<?= $id ?>);
    fetch("/updatePost",{
      method: "POST",
      body: formData
    }).then(response=>response.text())
      .then(result=>{
        if(result==='success'){
          location.href='/';
        }
      });
  }
</script>


<?php require_once('footer.php'); ?>