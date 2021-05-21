<?php
  header('Content-type: text/html; charset=utf-8');
  session_start();
  //include_path ('../view/template1.php');
  $uri = explode('/',$_SERVER['REQUEST_URI']);
//var_dump($uri);
 //echo '(<hr>)';

  require_once('php/db.php');
  require_once('php/classes/User.php');
  require_once('php/classes/Blog.php');
  require_once('php/classes/File.php');
  require_once('php/classes/simple_html_dom.php');
  
  $request=[
    'regUser'=>function(){return User::regUser();},
    'authUser'=>function(){return User::authUser();},
    'updateUser'=>function(){return User::updateUser();},
    'giveContact'=>function(){return User::giveContact();},
    'getUserById'=>function(){return User::getUserById($_SESSION['id']);},
    'uploadUserAvatar'=>function(){return User::uploadUserAvatar($_FILES['avatar']);},
    'addPost'=>function(){return Blog::addPost($_POST['title'],$_POST['content'],$_POST['author']);},
    'deletePost'=>function(){return Blog::deletePost();},
    'updatePost'=>function(){return Blog::updatePost();},
    'getPosts'=>function(){return Blog::getPosts();},
    'addPost'=>function(){return Blog::addPost($_POST['title'],$_POST['content'],$_POST['author']);},
    'getPosts'=>function(){return Blog::getPosts();},
    'getPostById'=>function(){return Blog::getPostById($_POST['id']);}, 
    'updatePost'=>function(){return Blog::updatePost($_POST['id'],$_POST['title'],$_POST['content'],$_POST['author']);}
  ];
  foreach($request as $key=>$handler){
    if($uri[1]==$key){
      exit($handler());
    }
  }
  
  if($uri[1]==''){
    $title="Главная";
    $h1="Блог";
    $content=file_get_contents('view/index.html');
    require_once('view/template.php');
  }else if($uri[1]=='about'){
    $title="О нас";
    $h1="О нас";
    $content=file_get_contents('view/about.html');
    require_once('view/template.php');
  }else if($uri[1]=='reg'){
    $title="Регистрация на сайте";
    $h1="Регистрация на сайте";
    $content=file_get_contents('view/reg.html');
    require_once('view/template.php');
  }else if($uri[1]=='auth'){
    $title="Вход на сайт";
    $h1="Вход на сайт";
    $content=file_get_contents('view/auth.html');
    require_once('view/template.php');
  }else if($uri[1]=='post'){
    $title="Посмотреть пост";
    $h1="Посмотреть пост";
    $content=file_get_contents('view/post.html');
    require_once('view/template.php');
  }else if($uri[1]=='lk'){
    $content = file_get_contents('view/lk.php');
    require_once('view/template.php');
  }
  
  //Админка для нашего сайта Блог
  if($uri[1]=='admin'){
     if($uri[2]=='addPost'){
    $title="Добавить статью";
    $h1="Добавить статью";
    $content=file_get_contents('view/addPost.html');
    }else if($uri[2]=='postList'){
    $title="Список постов";
    $h1="Список постов";
    $content=file_get_contents('view/postList.html');
    }else if($uri[2]=='editPost'){
    $title="Peдактирование постов";
    $h1="Peдактирование постов";
    $content=file_get_contents('view/editPost.php');

    }
    require_once('view/templateAdmin.php');
  }
  
    
    if($uri[1]=='uploadFile'){
    echo File::uploadFile();
    }else if($uri[1]=='fileUpload'){
    require_once('view/fileUpload.php');
    }
?>
