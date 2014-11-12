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
  $brand_name = empty($_GET['name']) ? null : $_GET['name'];
  echo '<h2>', $title, '</h2><br>', PHP_EOL;
  
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
  $to = Cat_To::getInstance();
  $models = $to->getModels($id);
  foreach ($models as &$model) {
    $model['image_path'] = '/TO/' . $model['img'];
    $model['brand_name'] = $brand_name;
  }
  Helper::getInstance()->printTableWLinkWImg($models, 'name', 'complectations.php', true, array(), 
      array('id', 'car_id', 'sort', 'is_active', 'title', 'kwords', 'descr', 'img', 'seo_text', 'image_path', 'brand_name'), 
      'width: 700px; border-collapse: collapse; font-size:8pt;', array(), array(), 'image_path', array('100px','100px'));
  //Helper::getInstance()->printPre($models);
?>
    </div>
  </body>
</html>