<?php
  $file = $_FILES['userfile']; // Сохраняем в переменную всю информацию о файле
  $updir = 'userfile/'.time().$file['name']; // Путь куда будет сохранён файл. time() - Возвращает текущую метку системного времени Unix
  if($file['type'] == 'image/jpeg' or $file['type'] == 'image/png'){
    move_uploaded_file($file['tmp_name'],$updir); // Копируем файл из временной папки
    echo $updir;
  }else{
    echo 'file type error';
  }
  
  
?>