<?php session_start(); ?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Контакты</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary bg-gradient">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Группа 400</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/"> Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contact-us">Контакты</a>
            </li>
           
            
          </ul>
          <a href="/reg.php" class="btn btn-outline-success me-3">Регистрация</a>
          <a href="/auth.php" class="btn btn-outline-success">Вход</a>
          
        </div>
      </div>
    </nav>

    <div class="container my-5">
      <div class="col-sm-4 mx-auto" id="formContainer">
        <h1 class="text-center my-3">Контакты</h1>
        <form action="php/handlerForm.php" onsubmit="sendForm(this);return false;" method="POST">
          <div class="mb-3">
            <input name ="firstname" type="text" class="formt-control" placeholder="Введите имя">
          </div>
          <div class="mb-3">
            <input name ="email" type="email" class="formt-control" placeholder="Введите email">
          </div>
          <div class="mb-3">
            <input name ="phone" type="text" class="formt-control" placeholder="Введите телефон">
          </div>
          <div class="mb-3">
            <textarea name="msg" class="form-control" placeholder="Сообщение"></textarea>
          </div>
          <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary">
          </div>
        </form>
       </div>
      </div>
    <script>
      const formContainer=document.getElementById('formContainer');
      function sendForm(form){
        const formData=new FormData(form);
        fetch("/php/handlerForm.php",{
          method: "POST",
          body: formData
        }).then(response=>response.text())
          .then(result=>{
            if(result==="success"){
              formContainer.innerHTML = `<p class="h2 text-center">Успешная передача данных</p>`;
            }
          });
        
        console.log("Отправка формы");
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
  </body>
</html>
