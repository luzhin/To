<?php
Class Helper
{
  //CONST EXT_LINK_PRICE = 'http://massive.ua/goods/#partnumber#/#brand#/';
  static $model = null;
	
	/**
	 * @return Helper
	 */
  static public function getInstance() {
		if (is_null(self::$model)) {
			self::$model = new Helper();
		}
		return self::$model;
	}
  
  public function printPre($a = array(), $stop = false) {
    echo '<pre>';
    print_r($a);
    echo '</pre>';
    if ($stop) exit();
  }
  
  public function printTable($arr = array(), 
                             $fieldForShow, 
                             $full = false, 
                             $dateFields = array(), 
                             $excludeFields = array(),
                             $style = null,
                             $headers = array(),
                             $upperFields = array()) {
    if (count($arr) > 0) {
      $style = (is_null($style)) ? 'width: 100%; border-collapse: collapse; font-size:8pt;' : $style;
      echo '<table style="', $style, '">', PHP_EOL;
      if (count($headers) > 0) {
        echo '<tr>';
        foreach ($headers as $header) {
          echo '<th>', $header, '</th>';
        }
        echo '</tr>', PHP_EOL;
      }
      foreach ($arr as $m) {
        echo '<tr>';
        $row = '';
        
        foreach ($m as $key => $value) {
          if ($key == $fieldForShow) {
            if (in_array($key, $upperFields)) {
              $complect = mb_strtoupper($value, 'UTF-8');
            } else {
              $complect = $value;
            }
            $row .= '<td>' . $complect . '</td>';
          } else {
            if (!in_array($key, $excludeFields)) {
              if ($full) {
                if (in_array($key, $dateFields)) {
                  $value = (strlen($value) == 6) ? $this->getHumanDateShort($value) : $this->getHumanDateLong($value);
                }
                if (in_array($key, $upperFields)) {
                  $value = (strtoupper($value));
                }
                $row .= '<td>' . $value . '</td>';
              }
            }
          }
        }
        echo $row, PHP_EOL;
      }
      echo '</table>', PHP_EOL;
    } else {
      echo 'No data';
    }
  }
  
  public function printTableWLink($arr = array(), 
                                  $fieldForLink, 
                                  $linkFile = '', 
                                  $full = false, 
                                  $dateFields = array(), 
                                  $excludeFields = array(),
                                  $style = null,
                                  $headers = array(),
                                  $upperFields = array()) {
    if (count($arr) > 0) {
      $style = (is_null($style)) ? 'width: 100%; border-collapse: collapse; font-size:8pt;' : $style;
      echo '<table style="', $style, '">', PHP_EOL;
      if (count($headers) > 0) {
        echo '<tr>';
        foreach ($headers as $header) {
          echo '<th>', $header, '</th>';
        }
        echo '</tr>', PHP_EOL;
      }
      
      foreach ($arr as $m) {
        echo '<tr>';
        $row = '';
        $link = '<a href="' . $linkFile . '?';
        
        foreach ($m as $key => $value) {
          if ($key == $fieldForLink) {
            if (in_array($key, $upperFields)) {
              $complect = mb_strtoupper($value, 'UTF-8');
            } else {
              $complect = $value;
            }
          } else {
            if (!in_array($key, $excludeFields)) {
              if ($full) {
                if (in_array($key, $dateFields)) {
                  $dt = (strlen($value) == 6) ? $this->getHumanDateShort($value) : $this->getHumanDateLong($value);
                  $row .= '<td>' . $dt . '</td>';
                } else {
                  if (in_array($key, $upperFields)) {
                    $row .= '<td>' . mb_strtoupper($value, 'UTF-8') . '</td>';
                  } else {
                    $row .= '<td>' . $value . '</td>';
                  }
                }
              }
            }
          }
          $link .= $key . '=' . urlencode($value) . '&';
        }
        $link = substr($link, 0, strlen($link)-1);
        $link .= '">' . $complect . '</a>';
        $row = '<td>' . $link . '</td>' . $row . '</tr>';
        echo $row, PHP_EOL;
      }
      echo '</table>', PHP_EOL;
    } else {
      echo 'No data';
    }
  }
  
  public function printTableWLinkWImg($arr = array(), 
                                  $fieldForLink, 
                                  $linkFile = '', 
                                  $full = false, 
                                  $dateFields = array(), 
                                  $excludeFields = array(),
                                  $style = null,
                                  $headers = array(),
                                  $upperFields = array(),
                                  $imgField = null,
                                  $imgSize = array('100px','100px')) {
    if (count($arr) > 0) {
      $style = (is_null($style)) ? 'width: 100%; border-collapse: collapse; font-size:8pt;' : $style;
      echo '<table style="', $style, '">', PHP_EOL;
      if (count($headers) > 0) {
        echo '<tr>';
        foreach ($headers as $header) {
          echo '<th>', $header, '</th>';
        }
        echo '</tr>', PHP_EOL;
      }
      
      foreach ($arr as $m) {
        echo '<tr>';
        $row = '';
        $link = '<a href="' . $linkFile . '?';
        
        foreach ($m as $key => $value) {
          if ($key == $fieldForLink) {
            if (in_array($key, $upperFields)) {
              $complect = mb_strtoupper($value, 'UTF-8');
            } else {
              $complect = $value;
            }
          } elseif ($key == $imgField) {
            //echo dirname(__FILE__), DIRECTORY_SEPARATOR, $value, '<br>', PHP_EOL;
            if (file_exists($value)) {
              $td_img = '<td><img src="' . $value . '" alt="ТО" width="'.$imgSize[0].'" height="'.$imgSize[1].'"></td>';
            } else {
              $td_img = '<td><img src="/pict/titles/0.png" alt="ТО" width="'.$imgSize[0].'" height="'.$imgSize[1].'"></td>';
            }
          } else {
            if (!in_array($key, $excludeFields)) {
              if ($full) {
                if (in_array($key, $dateFields)) {
                  $dt = (strlen($value) == 6) ? $this->getHumanDateShort($value) : $this->getHumanDateLong($value);
                  $row .= '<td>' . $dt . '</td>';
                } else {
                  if (in_array($key, $upperFields)) {
                    $row .= '<td>' . mb_strtoupper($value, 'UTF-8') . '</td>';
                  } else {
                    $row .= '<td>' . $value . '</td>';
                  }
                }
              }
            }
          }
          $link .= $key . '=' . urlencode($value) . '&';
        }
        $link = substr($link, 0, strlen($link)-1);
        $link .= '">' . $complect . '</a>';
        $row = $td_img . '<td>' . $link . '</td>' . $row . '</tr>';
        echo $row, PHP_EOL;
      }
      echo '</table>', PHP_EOL;
    } else {
      echo 'No data';
    }
  }
  
  public function printDivWLink($arr = array(), 
                                $fieldForLink, 
                                $linkFile = '', 
                                $full = false, 
                                $dateFields = array(), 
                                $excludeFields = array(),
                                $style = null,
                                $headers = array(),
                                $upperFields = array(),
                                $boldIdField = false,
                                $jsFunctionName = 'fuCallServer',
                                $jsFields = array(),
                                $fieldId = null) {
    if (count($arr) > 0) {
      $fieldId = (is_null($fieldId)) ? $fieldForLink : $fieldId;
      $style = (is_null($style)) ? 'width: 100%; font-size:8pt;' : $style;
      echo '<div style="', $style, '">', PHP_EOL;
      
      foreach ($arr as $m) {
        $jsParsString = '';
        foreach ($jsFields as $jsField) {
          $jsParsString .= '\'' . $m[$jsField] . '\',';
        }
        $jsParsString = substr($jsParsString, 0, strlen($jsParsString)-1);
        echo '<div style="width:100%; cursor:pointer; margin-top:4px;" onClick="' . $jsFunctionName . '(' . $jsParsString . ')">', PHP_EOL;
        $row = '';
        $link = '<a href="' . $linkFile . '?';
        
        foreach ($m as $key => $value) {
          if ($key == $fieldForLink) {
            if (in_array($key, $upperFields)) {
              $complect = mb_strtoupper($value, 'UTF-8');
            } else {
              $complect = $value;
            }
            if ($boldIdField) {
              $complect = '<strong>' . $complect . '</strong>';
            }
          } else {
            if (!in_array($key, $excludeFields)) {
              if ($full) {
                if (in_array($key, $dateFields)) {
                  $value = (strlen($value) == 6) ? $this->getHumanDateShort($value) : $this->getHumanDateLong($value);
                }
                if (in_array($key, $upperFields)) {
                  $row .= ' ' . mb_strtoupper($value, 'UTF-8');
                } else {
                  $row .= ' ' . $value;
                }
              }
            }
          }
          $link .= $key . '=' . urlencode($value) . '&';
        }
        $link = substr($link, 0, strlen($link)-1);
        $link .= '">' . $complect . '</a>';
        if (count($jsFields) == 0) {
          $row = $link . ' '. $row;
        } else {
          $row = $complect . ' ' . $row;
        }
        echo '<span style="border-bottom:1px dashed #000000;">', $row, '</span>', PHP_EOL;
        echo '</div>', PHP_EOL;
        echo '<div id="' . $m[$fieldId] . '" style="width:100%; display: none;"><img src="Img/loader.gif"></div>', PHP_EOL;
      }
      echo '</div>', PHP_EOL;
    } else {
      echo 'No data';
    }
  }
  
  public function printDivWLinkWImg($arr = array(), 
                                $fieldForLink, 
                                $linkFile = '', 
                                $full = false, 
                                $dateFields = array(), 
                                $excludeFields = array(),
                                $style = null,
                                $headers = array(),
                                $upperFields = array(),
                                $boldIdField = false,
                                $jsFunctionName = 'fuCallServer',
                                $jsFields = array(),
                                $fieldId = null,
                                $imgField = null,
                                $imgSize = array('100px','100px')) {
    if (count($arr) > 0) {
      $fieldId = (is_null($fieldId)) ? $fieldForLink : $fieldId;
      $style = (is_null($style)) ? 'width: 100%; font-size:8pt;' : $style;
      echo '<div style="', $style, '">', PHP_EOL;
      
      foreach ($arr as $m) {
        $jsParsString = '';
        foreach ($jsFields as $jsField) {
          $jsParsString .= '\'' . $m[$jsField] . '\',';
        }
        $jsParsString = substr($jsParsString, 0, strlen($jsParsString)-1);
        echo '<div style="width:100%; cursor:pointer; margin-top:4px;" onClick="' . $jsFunctionName . '(' . $jsParsString . ')">', PHP_EOL;
        $row = '';
        $link = '<a href="' . $linkFile . '?';
        
        foreach ($m as $key => $value) {
          if ($key == $fieldForLink) {
            if (in_array($key, $upperFields)) {
              $complect = mb_strtoupper($value, 'UTF-8');
            } else {
              $complect = $value;
            }
            if ($boldIdField) {
              $complect = '<strong>' . $complect . '</strong>';
            }
          } elseif ($key == $imgField) {
            if (file_exists($value)) {
              $td_img = '<img src="' . $value . '" alt="ТО" width="'.$imgSize[0].'" height="'.$imgSize[1].'" style="float:left;">';
            } else {
              $td_img = '<img src="/pict/titles/0.png" alt="ТО" width="'.$imgSize[0].'" height="'.$imgSize[1].'" style="float:left;">';
            }
          } else {
            if (!in_array($key, $excludeFields)) {
              if ($full) {
                if (in_array($key, $dateFields)) {
                  $value = (strlen($value) == 6) ? $this->getHumanDateShort($value) : $this->getHumanDateLong($value);
                }
                if (in_array($key, $upperFields)) {
                  $row .= ' ' . mb_strtoupper($value, 'UTF-8');
                } else {
                  $row .= ' ' . $value;
                }
              }
            }
          }
          $link .= $key . '=' . urlencode($value) . '&';
        }
        $link = substr($link, 0, strlen($link)-1);
        $link .= '">' . $complect . '</a>';
        if (count($jsFields) == 0) {
          $row = $link . ' '. $row;
        } else {
          $row = $complect . ' ' . $row;
        }
        $margForText = ($imgSize[1] / 2) - 20;
        echo $td_img,'<div style="border-bottom:1px dashed #000000; float:left; margin-top:',$margForText,'px; margin-left:15px;">', $row, '</div>', PHP_EOL;
        echo '</div>', PHP_EOL;
        echo '<div style="float:none; clear:both;"></div>';
        echo '<div id="' . $m[$fieldId] . '" style="width:100%; display: none;"><img src="Img/loader.gif"></div><br>', PHP_EOL;
      }
      echo '</div>', PHP_EOL;
    } else {
      echo 'No data';
    }
  }
  
  public function printCarMainInfo($a, $set = 0) {
    if (count($a) > 0) {
      echo '<table style="border-collapse: collapse; font-size:9pt;">';
      foreach ($array as $key => $value) {
        echo '  <tr>';
        echo '    <td>', $a[$set][$key], '</td>';
        echo '    <td>';
        echo '      <strong>', $a[$set][$value], '</strong>';
        echo '    </td>';
        echo '  </tr>';
      }
      echo '</table>';
    } else {
      echo 'No data';
    }
  }
  
  public function getHumanDateShort($str = null) {
    if (is_null($str) || strlen($str) == 0) {
      return '...';
    }
    if ($str == '999999') {
      return '...';
    }
    return substr($str, -2) . '.' . substr($str, 0, 4);
  }
  
  public function getHumanDateLong($str = null) {
    if (is_null($str) || strlen($str) == 0) {
      return '...';
    }
    if ($str == '99999999') {
      return '...';
    }
    return substr($str, -2) . '.' . substr($str, 4, 2) . '.' . substr($str, 0, 4);
  }
}
?>