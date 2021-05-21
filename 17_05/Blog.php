<?php
class Blog{
  public static function addPost($title,$content,$author){
    global $mysqli;
    function base64_to_jpeg($base64_string) {
      // split the string on commas
      // $data[ 0 ] == "data:image/png;base64"
      // $data[ 1 ] == <actual base64 string>
      $data = explode( ',', $base64_string );
      // we could add validation here with ensuring count( $data ) > 1
      $image_info = getimagesize($base64_string); // Массив содержащий информацию о файе
      $extension = explode('/',$image_info["mime"])[1]; // расширение файла, в $image_info["mime"] хранится "image/jpeg" 
      $output_file = 'userfile/'.time().'.'.$extension; // формируем название файла
      $ifp = fopen( $output_file, 'wb' ); // open the output file for writing
      fwrite( $ifp, base64_decode( $data[ 1 ] ) );
      // clean up the file resource
      fclose( $ifp );
      return $output_file;
    }
    $html = new simple_html_dom(); // Создаём объект парсера
    $html->load($content); // Предоставляем HTML код
    
    // $images = $html->find('img') - вернёт массив изображений
    /*
      foreach($html->find('img') as $img){
        
      }
    */
    
    $img = $html->find('img',0); // Находим первую картинку в разметке $content
    $img->src = '/'.base64_to_jpeg($img->src); // Переписываем значение атрибута src у изображения
    $html->save(); // Сохраняем изменения в разметке
    $content = $html;
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