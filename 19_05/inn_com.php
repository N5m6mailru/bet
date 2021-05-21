<?php 
  header('Content-type: text/html; charset=utf-8');//подключаем кодировку utf-8
  $name = $_POST['name'];//принимаем данные по ключу (из input) 
  //переданные методом POST (cм.fetch в файле getInn.php)
  $lastname = $_POST['lastname'];
  $secondname = $_POST['secondname'];
  $bdate = $_POST['bdate'];
  $bdateArr = explode('-',$bdate);//
  $bdate = $bdateArr[2].".".$bdateArr[1].".".$bdateArr[0];
  $docno = $_POST['docno'];
  
  
          //идем сразу не на страницы формы с данными в fns, а ту куда идет с нее редирект-Согласие
          //на обработку данных.Т.к. это первый запрос, он возвратит cookies
  $ch = curl_init("https://service.nalog.ru/static/personal-data.html?svc=inn&from=%2Finn.do");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //true для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер.
        //CURLOPT_HEADER-TRUE для включения заголовков в вывод.т.к. cookies находятся в header
  curl_setopt($ch, CURLOPT_HEADER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  
  preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches); // С помощью регулярного выражения ищем cookie, сохраняем все найденные в массив $matches[1]
  $cookies = array();
  foreach($matches[1] as $item) {
      parse_str($item, $cookie); // parse_str — Разбирает строку в переменные
      $cookies = array_merge($cookies, $cookie);
  }
          //2 раз переходим на страницу с которой считываем еще один параметр cookies , необходимые в дальнейшем 
          //для обработки формы upd
          /* Инициализирует новый сеанс cURL и возвращает дескриптор, который используется 
           с функциями curl_setopt(), cur l_exec() и curl_close(). Список параметров url */
  $ch = curl_init("https://service.nalog.ru/static/personal-data-proc.json");

           //curl_setopt — Устанавливает параметр для сеанса CURL
           /*CURLOPT_FOLLOWLOCATION-TRUE для следования любому заголовку "Location: ", отправленному
           сервером в своем ответе (учтите, что это 
           происходит рекурсивно, PHP будет следовать за всеми посылаемыми заголовками "Location: "
           -так как мы заметили , что страница с формой данных делает редиректы на другие страницы-Согласие обработки 
           данных  и еще на слеующую с передачей upd-cookies*/
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
           /* CURLOPT_COOKIE-Содержимое заголовка "Cookie: ", используемого в HTTP-запросе. Обратите внимание, что несколько cookies
            разделяются точкой с запятой с последующим пробелом (например, "fruit=apple; colour=red")*/
  curl_setopt($ch, CURLOPT_COOKIE, "JSESSIONID=".$cookies['JSESSIONID']);
           /* CURLOPT_POST-TRUE для использования обычного HTTP POST. Данный метод POST использует обычный application/x-www-form-urlencoded, 
            обычно используемый в HTML-формах.-так как мы будем отправлять форму данных к серверу-файл getInn.php*/
  curl_setopt($ch, CURLOPT_POST, true);
           // CURLOPT_POSTFIELDS, который означает, что значения, переданные с @ (&)могут безопасно передаваться в виде полей. 
  curl_setopt($ch, CURLOPT_POSTFIELDS, "from=/inn.do&svc=inn&personalData=1");
          /*  CURLOPT_RETURNTRANSFER-TRUE для возврата результата передачи в качестве строки из curl_exec() вместо 
            прямого вывода в браузер-нам необходимо считывать ответы со страницы редиректа 1раз "JSESSIONID"и 2 раз-"upd_inn",
            чтобы добавить их к запросу, отправленному с данными из формы, и 3 раз-потом-сам ИНН*/
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          /*curl_exec — Выполняет запрос cURLюВозвращает TRUE в случае успешного завершения или FALSE в случае
          возникновения ошибки. Однако, если установлена опция CURLOPT_RETURNTRANSFER,
          при успешном завершении будет возвращен результат, а при неудаче - FALSE.
          и считываем результат выполнения в $result-запрос от сервера возвращает ответ или error(это надо парсить)*/
  $result = curl_exec($ch);
 
          //curl_close-Завершает сеанс cURL и освобождает все ресурсы. Дескриптор ch также уничтожается.
  curl_close($ch);
            //убираем в считанных данных со страницы редиректа ненужные пары кавычек в начале и в конце
  $cookies['upd_inn'] = trim($result, '"');



            //3 раз идем на сайт уже со всеми данными (данные из формы и cookies, чтобы получить ответ
          //сохраняем дeскриптор в переменную
  $ch = curl_init("https://service.nalog.ru/inn-proc.do");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "c=innMy&captcha=&captchaToken=&fam=$lastname&nam=$name&otch=$secondname&bdate=$bdate&bplace=&doctype=21&docno=$docno&docdt=");
  curl_setopt($ch, CURLOPT_COOKIE, "JSESSIONID=".$cookies['JSESSIONID'].";upd_inn=".$cookies['upd_inn']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  echo json_encode($result);
?>