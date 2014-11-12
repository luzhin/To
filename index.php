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
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helper.php');
  $to = Cat_To::getInstance();
  
  $brands = $to->getBrands();
  Helper::getInstance()->printPre($brands);
?>
    </div>
  </body>
</html>