<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Загрузка файлов</title>
  </head>
  <body>
    <form onsubmit="sendFile(this);return false;"enctype="multipart/form-data" action="/handlerFileUpload.php" method="POST">
      <input name="userfile" type="file">
      <input type="submit" value="загрузить">
    </form>
    <script>
      function sendFile(form){
        const formData = new FormData(form);
        fetch("/uploadFile",{
          method: "POST",
          body: formData
        })
          .then(response=>response.text())
          .then(result=>console.log(result));
      }
    </script>
  </body>
</html>