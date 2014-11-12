<!DOCTYPE html>
<html>
  <head>
    <title>Каталог ТО</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="jquery-1.11.1.min.js"></script>
  </head>
  <body>
    <h2 style="padding: 5px 20px 10px;">Запчасти для планового ТО</h2>
    <div style="border: 1px solid darkgray; padding: 5px 20px 10px;">
<?php 
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
  $to = Cat_To::getInstance();
  $brands = $to->getBrands();
  foreach ($brands as &$brand) {
    $brand['image_path'] = '/logos/' . $brand['img'];
    $brand['link_name'] = 'Каталог запчастей для ТО ' . $brand['title'];
  }
  
  Helper::getInstance()->printTableWLinkWImg($brands, 'name', 'catalog_to.php', true, array(), 
      array('id', 'sort', 'is_active', 'content', 'title', 'kwords', 'descr', 'img', 'truck', 'seo_text', 'image_path'), 
      'width: 600px; border-collapse: collapse; font-size:8pt;', 
      array(), array(), 'image_path', array('100px','100px'));
  
  //Helper::getInstance()->printPre($brands);
?>
    </div>
  </body>
</html>