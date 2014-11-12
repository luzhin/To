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
  $title = empty($_GET['title']) ? null : $_GET['title'];
  $content = empty($_GET['content']) ? null : $_GET['content'];
  $image_path = empty($_GET['image_path']) ? null : $_GET['image_path'];
  
  echo '<h2>', $title, '</h2><br>', PHP_EOL;
  echo '<img src="', $image_path,'" alt="', $title, '"><br>', PHP_EOL;
  echo $content, '<br>', PHP_EOL;
  
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
  $to = Cat_To::getInstance();
  $types = $to->getTypes($id);
  Helper::getInstance()->printTableWLink($types, 'title', 'groups.php', true, array(), 
      array('id', 'model_id', 'name', 'sort', 'is_active', 'content', 'kwords', 'descr', 'img', 'mod', 'seo_text', 'tecdoc_url', 'tecdoc_id', 'title'), 
      'width: 900px; border-collapse: collapse; font-size:8pt;', array(), 
      array('Марка','Двигатель','Модель двигателя','Объём двигателя','Мощность, л.с.','Год'));
  //Helper::getInstance()->printPre($types);
?>
    </div>
  </body>
</html>