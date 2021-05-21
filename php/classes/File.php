<?php

class File{
  public static function uploadFile(){
 $file = $_FILES['userfile']; // Сохраняем в переменную всю информацию о файле
  $updir = 'userfile/'.time().$file['name']; // Путь куда будет сохранён файл. time() - Возвращает текущую метку системного времени Unix
  if($file['size'] <= 1048576){
    move_uploaded_file($file['tmp_name'],$updir); // Копируем файл из временной папки
    echo $updir;
  }else{
    echo 'file size error - file too large';
  }
  }
}
?>