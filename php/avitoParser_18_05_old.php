<?php
  header('Content-type: text/html; charset=utf-8');
  require_once('classes/simple_html_dom.php');
  $html = file_get_html('https://www.avito.ru/moskva/bytovaya_elektronika');
  //echo $html;
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Авито парсер</title>
    <style>
      .col-md-3{
        height: 450px;
      }
      .avitoImage{
        height:350px;
        background-size:cover;
        background-position: center;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <?foreach($html->find('div[data-marker=item]') as $div):?>
        <div class="col-md-3 border my-3" >
          <h3 style="height:100px;"><?= $title = $div->find('h3[itemprop="name"]',0)->plaintext; ?></h3>
          <div class="avitoImage" style="background-image: url('<?=$img = $div->find('img',0)->src; ?>');"></div>
        </div>
        <? endforeach; ?>
      </div>
    </div>
    
    
    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>