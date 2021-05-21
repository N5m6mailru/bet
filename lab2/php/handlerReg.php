<?
    $mysqli = new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
    header('Content-type: text/html; charset=utf-8');
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
?>
