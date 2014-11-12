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
FROM w_to_cars AS c';
    return $this->_getQuery($query);
  }
  
  /**
   * Метод для получения списка моделей определенного бренда.
	 * @return array
	 */
  public function getModels($car_id = null) {
    $and = (is_null($car_id)) ? '' : 'WHERE m.car_id = ' . $car_id;
    $query = 'SELECT id, car_id, name, sort, is_active, content, title, kwords, descr, img, seo_text
FROM w_to_models AS m ' . PHP_EOL . $and;
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
FROM w_to_types AS t ' . PHP_EOL . $and;
    return $this->_getQuery($query);
  }
  
  /**
   * Метод для получения списка групп.
	 * @return array
	 */
  public function getGroups($id = null, $model_id = null) {
    $and = (is_null($id)) ? '' : 'WHERE too.type_id = ' . $id . PHP_EOL;
    $query = 'SELECT *
FROM w_to AS too ' . PHP_EOL . 
$and . 
' ORDER BY type_id, descr';
    return $this->_getQuery($query);
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
}
