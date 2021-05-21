<?php require_once("header.php");?>

<div class="container my-5">
  <h1 class="my-3 text-center">Добавить статью</h1>
  <div class="col-md-6 mx-auto">
    <form onsubmit="addPost(this); return false;">
      <div class="mb-3">
        <input name="title" type="text" class="form-control" placeholder="Заголовок">
      </div>
      <div class="mb-3">
        <textarea name="content" class="form-control" placeholder="Контент"></textarea>
      </div>
      <div class="mb-3">
        <input name="author" type="text" class="form-control" placeholder="Автор">
      </div>
      <div class="mb-3">
        <input type="submit" class="form-control btn btn-primary" value="Добавить пост">
      </div>
    </form>
  </div>
</div>

<script>
  function addPost(form){
    const formData = new FormData(form);
    fetch("/addPost",{
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