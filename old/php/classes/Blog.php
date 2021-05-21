<?php

class Blog{
  public static function addPost(){
    global $mysqli;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    
    $mysqli->query("INSERT INTO blog (`author`,`title`,`content`) VALUES ('$author','$title','$content')");
    echo 'success';
  }
  public static function deletePost(){
    global $mysqli;
    $id = $_POST['id'];
  
    $mysqli->query("DELETE FROM `blog` WHERE id='$id'");
    echo json_encode(["result"=>"success"]);
  }
   public static function updatePost(){
    global $mysqli;
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author= $_POST['author'];
    $content=$_POST['content'];
      
    $mysqli->query("UPDATE `blog` SET `author`='$author',`title`='$title',`content`='$content' WHERE id='$id'");
    echo "success";
  }
  public static function getPosts(){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM `blog`");
  
    $posts = [];
    while($row = $result->fetch_assoc()){
    $posts[] = $row;
    }
  
    echo json_encode($posts);
  }
}
?>