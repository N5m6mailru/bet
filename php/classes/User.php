<?php

class User{
  public static function authUser(){
    global $mysqli;
    $email=mb_strtolower($_POST['email']);
    $password=$_POST['password'];
    
    $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
   
    $row=$result->fetch_assoc();
    if(password_verify($password,$row['password'])){
      $_SESSION['firstname']=$row['firstname'];
      $_SESSION['lastname']=$row['lastname'];
      $_SESSION['email']=$row['email'];
      $_SESSION['id']=$row['id'];
      echo "success";
    }else{
      echo "error";
    }
    
  }
  public static function regUser(){
    global $mysqli;
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=mb_strtolower($_POST['email']);
    $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    //$message="Данные о пользователе $firstname $lastname $surname email:$email\n логин:$login\n пароль: $password\n успешно переданы на сервер.";
   // echo "$message";
   $result = $mysqli->query("SELECT `id` FROM `users` WHERE `email`='$email'");
   if($result->num_rows){
     echo "exist";
   }else{
     $mysqli->query("INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`) VALUES ('$firstname','$lastname','$email','$password')");
     echo "success";
   }
   
  }
  public static function updateUser(){
    global $mysqli;
    $item = $_POST['item']; // тут либо name либо lastname
    $value= $_POST['value'];
    $id = $_SESSION['id'];
    $mysqli->query("UPDATE `users` SET `$item`='$value' WHERE `id`='$id'");
    $_SESSION[$item] = $value;
    echo "success";
    
  }
  public static function giveContact(){
    echo "success";
    
  }
    public static function getUserById($id){
    global $mysqli;
    $result = $mysqli->query("SELECT id, firstname, lastname, email, avatar FROM users WHERE id=$id");
    $row = $result->fetch_assoc();
    return json_encode($row);
  }
  public static function uploadUserAvatar($avatar){
    global $mysqli;
    $updir = 'userfile/'.time().$avatar['name'];
    $id = $_SESSION['id'];
    if($avatar['type'] == 'image/jpeg' or $avatar['type'] == 'image/png'){
      move_uploaded_file($avatar['tmp_name'],$updir);
      $mysqli->query("UPDATE `users` SET `avatar`='/$updir' WHERE id=$id");
      return json_encode(['imagePath'=>"/$updir"]);
    }else{
      return json_encode(['imagePath'=>'error']);
    }
  }

}
?>
