<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Вход на сайт</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary bg-gradient">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Группа 400</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/"> Главная</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/contact-us.php">Контакты</a>
            </li>
           
            
          </ul>
          <a href="/reg.php" class="btn btn-outline-success me-3">Регистрация</a>
          <a href="/auth.php" class="btn btn-outline-success">Вход</a>
          
        </div>
      </div>
    </nav>
    <div class="container" py-5>
      <h1 class="text-center my-3">Вход на сайт</h1>
      <div class="col-md-5 mx-auto">
        <form action="/php/handlerAuth.php"  onsubmit="sendForm(this);return false;" method="POST">
          <div class="mb-3">
            <input name="email" type="email" class="form-control" placeholder="Email">
          </div>
          <div class="mb-3">
            <input name="password" type="passwordt" class="form-control" placeholder="Пароль">
            <p id="info" style="color:red;"></p>
          </div>
          <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="Войти">
          </div>
        </form>
      </div>
    </div>
    <script>
      const info = document.getElementById('info');
      function sendForm(form){
        info.innerText = '';
        const formData = new FormData(form);
        fetch("/authUser",{
          method: "POST",
          body: formData
        }).then(response=>response.text())
          .then(result=>{
            if(result === 'success') location.href = "/lk.php";
            else if (result === 'error') info.innerText = `Неправильный логин или пароль`;
          });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>