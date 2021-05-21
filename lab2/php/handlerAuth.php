<?
    header('Content-type: text/html; charset=utf-8');
    session_start();
    $mysqli=new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
    // $mysqli = new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
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
     
?>
