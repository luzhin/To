<!DOCTYPE html>
<html>
  <head>
    <title>Каталог ТО</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="jquery-1.11.1.min.js"></script>
  </head>
  <body>
    <div style="border: 1px solid darkgray; padding: 5px 20px 10px;">
<?php
  $id = empty($_GET['id']) ? null : $_GET['id'];
  $model_id = empty($_GET['model_id']) ? null : $_GET['model_id'];
  $title = empty($_GET['title']) ? null : $_GET['title'];
  $brand_name = empty($_GET['brand_name']) ? null : $_GET['brand_name'];
  
  echo '<h3>', $title, '</h3><br>', PHP_EOL;
  
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
  $to = Cat_To::getInstance();
  $groups = $to->getGroups($id, $model_id);
  foreach ($groups as &$group) {
    $group['brand_name'] = $brand_name;
  }
  prn($groups);
  //Helper::getInstance()->printPre($groups);
  
  function prn($a) {
    if (count($a) > 0) {
      echo '<table style="width: 800px; border-collapse: collapse; font-size:9pt;">', PHP_EOL;
      echo '<tr><th>Группа</th><th>Артикул</th><th>Комментарий</th></tr>', PHP_EOL;
      foreach ($a as $m) {
        echo '<tr><td><a href="'.strtr(Helper::EXT_LINK_PRICE, array('#part#' => preg_replace('/\W/','',$m['search']), '#brand#' => $m['brand_name'])).
             '" target="_blank">',$m['descr'],'</a></td><td>',$m['article'],'</td><td>',$m['comment'],'</td></tr>' . PHP_EOL;
      }
      echo '</table>', PHP_EOL;
    } else {
      echo 'Нет данных.', PHP_EOL;
    }
  }
?>
    </div>
  </body>
</html>