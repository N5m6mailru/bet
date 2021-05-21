<?php
  header('Content-type: text/html; charset=utf-8');
  require_once('classes/simple_html_dom.php');
  $html = file_get_html('https://xn----7sbab5aqcbiddtdj1e1g.xn--p1ai/musical_instruments');
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

    <title>Музыкалка парсер</title>

  </head>
  <body>
    <div class="container">
      <h1 class="text-center mt-3"><?= $title_h1 = $html->find('h1[id="pageH1"]',0)->plaintext; ?></h1>
      <div>
       <?foreach($html->find('h3') as $h3):?>  
        <h3 class="text-center mt-3"><?=$h3->plaintext; ?></h1>
        <div class="row text-center">
        <?foreach($h3->next_sibling()->children() as $div):?>
          <div class="col-md-2 p-2">
            <a href=<?=$div->find('a',0)->href; ?>>
              <div class="card">
                <div class="card-header"><?=$div->find('div(".card-header',0)->plaintext; ?></div>
                <img src=<?=$div->find('img',0)->src; ?> style="width: 99%" alt="">
              </div>
            </a>
          </div>
    
        <?endforeach;?>
       </div>
        <?endforeach;?>

     
      </div>
    </div>

        
    
    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
