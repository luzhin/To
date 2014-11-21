<?php

require_once( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php');

class Cat_To
{
  
  static $model = null;
	
	/**
	 * @return To
	 */
  static public function getInstance() {
		if (is_null(self::$model)) {
			self::$model = new Cat_To();
		}
		return self::$model;
	}
  
  /**
   * Метод для получения списка брендов для главной страницы.
	 * @return array
	 */
  public function getBrands() {
    $query = 'SELECT *
FROM to_cars AS c';
    return $this->_getQuery($query);
  }
  
  /**
   * Метод для установки url_name.
	 * @return array
	 */
  public function setUrlName($table_name, $id, $url_name) {
    $query = 'UPDATE '.$table_name.' SET url_name = \''.$url_name.'\' WHERE id = '.$id;
    $this->_setQuery($query);
    return 'Ok!';
  }
  
  /**
   * Метод для установки url_name как id.
	 * @return array
	 */
  public function setUrlNameLikeID($table_name) {
    $query = 'UPDATE '.$table_name.' SET url_name =  id';
    $this->_setQuery($query);
    return 'Ok!';
  }
  
  /**
   * Метод для получения списка моделей определенного бренда.
	 * @return array
	 */
  public function getModels($car_id = null) {
    $and = (is_null($car_id)) ? '' : 'WHERE m.car_id = ' . $car_id;
    $query = 'SELECT id, car_id, name, sort, is_active, content, title, kwords, descr, img, seo_text
FROM to_models AS m ' . PHP_EOL . $and;
    return $this->_getQuery($query);
  }
  
  /**
   * Метод для получения списка комплектаций.
	 * @return array
	 */
  public function getTypes($model_id = null) {
    $and = (is_null($model_id)) ? '' : 'WHERE t.model_id = ' . $model_id;
    $query = 'SELECT id, model_id, name, sort, is_active, content, title, kwords, descr, img, `mod`, `engine`, engine_model, 
      engine_obj, engine_horse, type_year, seo_text, tecdoc_url, tecdoc_id
FROM to_types AS t ' . PHP_EOL . $and;
    return $this->_getQuery($query);
  }
  
  /**
   * Метод для получения списка групп.
	 * @return array
	 */
  public function getGroups($id = null, $model_id = null) {
    $and = (is_null($id)) ? '' : 'WHERE too.type_id = ' . $id . PHP_EOL;
    $query = 'SELECT *
FROM to_groups AS too ' . PHP_EOL . 
$and . 
' ORDER BY type_id, descr';
    return $this->_getQuery($query);
  }
  
  public function prepareCharset($str) {
    $str = $this->CyrillicToLatinica2($str);    //перегоняем кирилицу в латиницу
    return preg_replace("/\W/",'',$str);        //[a-zA-Z0-9]
  }
  
  public function CyrillicToLatinica2($str_in) {
    $r = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м', 'н','о','п','р','с','т','у','ф','х','ц','ч', 'ш', 'щ', 'ъ','ы','ь','э', 'ю', 'я', 
               'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М', 'Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч', 'Ш', 'Щ', 'Ъ','Ы','Ь','Э', 'Ю', 'Я');
    $l = array('a','b','v','g','d','e','e','g','z','i','y','k','l','m','n', 'o','p','r','s','t','u','f','h','c','ch','sh','sh','', 'y','y', 'e','yu','ya',
               'A','B','V','G','D','E','E','G','Z','I','Y','K','L','M','N', 'O','P','R','S','T','U','F','H','C','CH','SH','SH','', 'Y','Y', 'E','YU','YA');
    $str_out = str_replace($r, $l, $str_in);
    //$s = preg_replace("/[^\w\-]/","$1",$s);
    //$s = preg_replace("/\-{2,}/",'-',$s);
    return $str_out;
  }
  
  public function CyrillicToLatinica($str) {
    $count = strlen($str);
    $temp = '';
    
    $dictionary = array(
      '224' => 'a',
      '225' => 'b',
      '226' => 'v',
      '246' => 'c',
      '247' => 'ch',
      '228' => 'd',
      '229' => 'e',
      '184' => 'e',
      '244' => 'f',
      '227' => 'g',
      '232' => 'i',
      '233' => 'y',
      '231' => 'z',
      '230' => 'j',
      '234' => 'k',
      '235' => 'l',
      '236' => 'm',
      '237' => 'n',
      '238' => 'o',
      '239' => 'p',
      '240' => 'r',
      '241' => 's',
      '248' => 'sh',
      '249' => 'sch',
      '242' => 't',
      '243' => 'u',
      '226' => 'v',
      '245' => 'h',
      '255' => 'ya',
      '254' => 'yu',
      '231' => 'z',
      '252' => '',
      '250' => '',
      '251' => 'q',
      '192' => 'a',
      '193' => 'b',
      '194' => 'v',
      '214' => 'c',
      '215' => 'ch',
      '196' => 'd',
      '197' => 'e',
      '168' => 'e',
      '212' => 'f',
      '195' => 'g',
      '200' => 'i',
      '201' => 'y',
      '221' => 'z',
      '198' => 'j',
      '202' => 'k',
      '203' => 'l',
      '204' => 'm',
      '205' => 'n',
      '206' => 'o',
      '207' => 'p',
      '208' => 'r',
      '209' => 's',
      '216' => 'sh',
      '217' => 'sch',
      '210' => 't',
      '211' => 'u',
      '194' => 'v',
      '213' => 'h',
      '223' => 'ya',
      '222' => 'yu',
      '199' => 'z',
      '220' => '',
      '218' => '',
      '219' => 'q'
    );

    for ($i = 0; $i < $count; $i++) {
      if (isset($dictionary[ord($str[$i])])) {
        $temp .= $dictionary[ord($str[$i])];
      } else {
        $temp .= $str[$i];
      }
    }
    return $temp;
  }
  
  /**
   * Метод-заготовка.
	 * @return array
	 */
  /*
  public function getArray($par) {
    $query = '';
    return $this->_getQuery($query);
  }
  */
  
  
  private function _getQuery($query, $databaseName = null) {
    if (Init::_DEBUG) {
      echo '<div onClick=\'$(".sqlquery").toggle()\'><span class="dashed-underline">Query</span>', 
           '</div><div class="sqlquery" style="width:800px!important; font-family: Courier, monospace, \'Courier New\'; font-size: 7pt; display: none;"><pre>', $query, '</pre></div>';
      //exit();
    }
    $db = @mysql_connect(Init::_HOST, Init::_USER, Init::_PASSWORD);
    if (is_null($databaseName)) {
      @mysql_select_db(Init::_DATABASE, $db);
    } else {
      @mysql_select_db($databaseName, $db);
    }
    
    $resultArray = array();
    
    mysql_query ("set_client='utf8'");
    mysql_query ("set character_set_results='utf8'");
    mysql_query ("set collation_connection='utf8_general_ci'");
    mysql_query ("SET NAMES utf8");
    
    $result = @mysql_query($query, $db);
    if (mysql_num_rows($result) > 0) {
      mysql_data_seek($result, 0);

      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $resultArray[] = $row;
      }
      mysql_free_result($result);
      mysql_close($db);
    } else {
      mysql_close($db);
      return array();
    }
    
    return $resultArray;
  }
  
  private function _setQuery($query, $databaseName = null) {
    if (Init::_DEBUG) {
      echo '<div onClick=\'$(".sqlquery").toggle()\'><span class="dashed-underline">Query</span>', 
           '</div><div class="sqlquery" style="width:800px!important; font-family: Courier, monospace, \'Courier New\'; font-size: 7pt; display: none;"><pre>', $query, '</pre></div>';
      //exit();
    }
    $db = @mysql_connect(Init::_HOST, Init::_USER, Init::_PASSWORD);
    if (is_null($databaseName)) {
      @mysql_select_db(Init::_DATABASE, $db);
    } else {
      @mysql_select_db($databaseName, $db);
    }
    
    mysql_query ("set_client='utf8'");
    mysql_query ("set character_set_results='utf8'");
    mysql_query ("set collation_connection='utf8_general_ci'");
    mysql_query ("SET NAMES utf8");
    
    @mysql_query($query, $db);
    mysql_close($db);
  }
}
