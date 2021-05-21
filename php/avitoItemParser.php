<?php
  header('Content-type: text/html; charset=utf-8');
  require_once('classes/simple_html_dom.php');
  $url = $_GET['url'];
  $html = file_get_html('https://www.avito.ru'.$url);
  $title = $html->find('h1.title-info-title',0)->plaintext;
  $price = $html->find('span[itemprop=price]',0)->plaintext;
  $address = $html->find('div[itemprop=address]',0)->plaintext;
  $description = $html->find('div[itemprop=description]',0);
  $img = $html->find('.gallery-img-frame.js-gallery-img-frame',0)->getAttribute('data-url');
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title><?= $title ?></title>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center"><?= $title ?></h1>
      <p class="text-center"><img src="<?= $img ?>" alt=""></p>
      <?= $description ?>
      <p>Цена: <?= $price ?></p>
      <p>Адрес: <?= $address ?></p>
    </div>

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>