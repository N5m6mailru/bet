<?
    header('Content-type: text/html; charset=utf-8');
    session_start();
    $mysqli=new mysqli('localhost','begetira_ira','Beget_123','begetira_ira');
    $firstname=$_POST['firstname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $msg=$_POST['msg'];
    echo "success";
?>