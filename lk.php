<?php session_start(); ?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Личный кабинет</title>
    <style>
      .edit-btn{
        color: blue;
        cursor: pointer;
      }
      .edit-btn:hover{
        color:DodgerBlue;
      }
      .edit-btn:active{
        color:DarkBlue;
      }
      .save-btn{
        color:green;
        cursor: pointer;
      }
      .save-btn:hover{
        color:LimeGreen;
      }
      .save-btn:active{
        color:DarkGreen;
      }
       .cancel-btn{
        color:Crimson;
        cursor: pointer;
      }
      .cancel-btn:hover{
        color:HotPink;
      }
      .cancel-btn:active{
        color:Maroon;
      }
    </style>

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
      <p>
        Фамилия:<span> <?php echo $_SESSION['lastname'] ?></span>
        <span class="edit-btn">[редактировать]</span>
        <span class="save-btn" hidden data-item="lastname">[сохранить]</span>
        <span class="cancel-btn" hidden data-item="lastname">[отменить]</span>
      </p>
      <p>
        Имя: <span><?php echo $_SESSION['firstname'] ?></span>
        <span class="edit-btn">[редактировать]</span>
        <span class="save-btn" hidden data-item="firstname">[сохранить]</span>
        <span class="cancel-btn" hidden data-item="firstname">[отменить]</span>
      </p>
      <p>Email: <?php echo $_SESSION['email'] ?></p>
    </div>
    <script>
      const editBtns = document.querySelectorAll('.edit-btn');
      const saveBtns = document.querySelectorAll('.save-btn');
      const cancelBtns = document.querySelectorAll('.cancel-btn');
      for(let i=0; i<editBtns.length; i++){
        const editBtn = editBtns[i];
        const saveBtn = saveBtns[i];
        const cancelBtn = cancelBtns[i];
        let value_cancel;  // = editBtn.previousElementSibling.innerText;
        console.log(value_cancel);
        editBtn.addEventListener("click", ()=>{
          let value = editBtn.previousElementSibling.innerText;
          editBtn.previousElementSibling.innerHTML = `<input type="text" value="${value}">`;
          editBtn.hidden = true; // Скрываем кнопку [редактировать]
          saveBtn.hidden = false; // Показываем кнопку [сохранить]
          cancelBtn.hidden = false; // Показываем кнопку [отменить]
        });
        saveBtn.addEventListener("click", ()=>{
          let value = editBtn.previousElementSibling.getElementsByTagName('input')[0].value;
          const item = saveBtn.dataset.item;
          const formData = new FormData();
          formData.append('item',item);
          formData.append('value',value);
          fetch("/updateUser.php",{
            method:"POST",
            body:formData
          }).then(response=>response.text())
            .then(result=>{
              value = editBtn.previousElementSibling.getElementsByTagName('input')[0].value;
              editBtn.previousElementSibling.innerHTML = value;
              value_cancel=value;
              saveBtn.hidden = true;
              cancelBtn.hidden = true;
              editBtn.hidden = false;
                           
            });
        });
        cancelBtn.addEventListener("click", ()=>{
          //value = editBtn.previousElementSibling.getElementsByTagName('input')[0].value;
          const item = cancelBtn.dataset.item;
          console.log(item);
           //editBtn.previousElementSibling.innerHTML = `<input type="text" value="<?php echo $_SESSION[$item] ?>">`;
          //editBtn.previousElementSibling.innerHTML = `<input type="text" value="${value_cancel}">`;
          editBtn.previousElementSibling.innerHTML = value_cancel;
          saveBtn.hidden = true;
          cancelBtn.hidden = true;
          editBtn.hidden = false;//скрыть
        })
  
    
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>