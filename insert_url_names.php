<?php
  $opts = array('to_cars' => 0, 'to_models' => 1, 'to_types' => 0, 'to_groups' => 0);
  echo '* Script start...', PHP_EOL;

  //require_once(  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cat_to.php');
  require_once('cat_to.php');
  $to = Cat_To::getInstance();
  
  if ($opts['to_cars'] == 1) {
    echo PHP_EOL, '* to_cars', PHP_EOL;
    $rows = $to->getBrands();
    foreach ($rows as $row) {
      //echo $row['id'], '. ', $row['name'], PHP_EOL;
      $answer = $to->setUrlName('to_cars', $row['id'], strtolower($row['name']));
      //echo $answer, PHP_EOL;
    }
  }
  
  if ($opts['to_models'] == 1) {
    echo PHP_EOL, '* to_models', PHP_EOL;
    $rows = $to->getModels();
    foreach ($rows as $row) {
      //preg_match('/\w/', $row['name'], $matches);
      $matches = preg_replace('/[()]/','',$row['name']);
      $matches = preg_replace('/\s+/','_',$matches);
      $matches = str_replace(array('/', ',', '.', '\'', '"'),'_',$matches);
      $matches = preg_replace('/_+/','_',$matches);

      $matches = $to->RemoveCharset($matches);

      $url_name = strtolower($matches);
      //echo $row['id'], '. ', $row['name'], ' -> ', $url_name, PHP_EOL;
      $answer = $to->setUrlName('to_models', $row['id'], $url_name);
      //echo $answer, PHP_EOL;
    }
  }
  
  if ($opts['to_types'] == 1) {
    echo PHP_EOL, '* to_types', PHP_EOL;
    $rows = $to->getTypes();
    foreach ($rows as $row) {
      //echo $row['id'], '. ', $row['name'], PHP_EOL;
      $answer = $to->setUrlNameLikeID('to_types');
      //echo $answer, PHP_EOL;
    }
  }

  if ($opts['to_groups'] == 1) {
    echo PHP_EOL, '* to_groups', PHP_EOL;
    $rows = $to->getGroups();
    foreach ($rows as $row) {
      //echo $row['id'], '. ', $row['name'], PHP_EOL;
      $answer = $to->setUrlNameLikeID('to_groups');
      //echo $answer, PHP_EOL;
    }
  }

  echo '* Script end.', PHP_EOL;