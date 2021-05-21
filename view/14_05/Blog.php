<?php
class Blog{
  public static function addPost($title,$content,$author){
    global $mysqli;
    $mysqli->query("INSERT INTO blog (`author`,`title`,`content`) VALUES ('$author','$title','$content')");
    return json_encode(['result'=>'success']);
  }
  public static function getPosts(){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM blog");
    $posts = [];
    while($row = $result->fetch_assoc()){
      $posts[] = $row;
    }
    return json_encode($posts);
  }
  public static function getPostById($id){
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM blog WHERE id='$id'");
    return json_encode($result->fetch_assoc());
  }
  public static function updatePost($id,$title,$content,$author){
    global $mysqli;
    $mysqli->query("UPDATE `blog` SET `author`='$author',`title`='$title',`content`='$content' WHERE id='$id'");
    return json_encode(['result'=>'success']);
  }
}
?>