<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Узнай свой ИНН</title>
  </head>
  <body>
    <div class="container my-5">
      <div id="innAlert" hidden class="alert alert-secondary my-3" role="alert">
        
      </div>
      <h1 class="text-center">Заполните форму чтобы узнать свой ИНН</h1>
      <form onsubmit="sendForm(this); return false;">
        <div class="mb-3">
          <input type="text" name="name" class="form-control" placeholder="Имя">
        </div>
        <div class="mb-3">
          <input type="text" name="lastname" class="form-control" placeholder="Фамилия">
        </div>
        <div class="mb-3">
          <input type="text" name="secondname" class="form-control" placeholder="Отчество">
        </div>
        <div class="mb-3">
          <input type="date" name="bdate" class="form-control" placeholder="Дата рождения">
        </div>
        <div class="mb-3">
          <input type="text" name="docno" class="form-control" placeholder="Серия и номер паспорта в формате ** ** ******">
        </div>
        <div class="mb-3">
          <input type="submit" class="form-control btn btn-primary">
        </div>
      </form>
    </div>
    <script>
      function sendForm(form){
        const formData = new FormData(form);
        fetch('inn.php',{
          method: "POST",
          body: formData
        }).then(response=>response.json())
          .then(result=>{
            result = (JSON.parse(result));
            console.log(result);
            if(result.inn == undefined){
              innAlert.hidden = false;
            innAlert.innerText = `ИНН не найден`;
            }else{
              innAlert.hidden = false;
              innAlert.innerText = `Ваш ИНН: `+result.inn;
            }
          })
        
      }
    </script>

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>