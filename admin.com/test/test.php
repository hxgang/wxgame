<?php
header('Content-Type: text/html;charset=utf-8');

//session_start();
//$_SESSION['name']='dy';
//

echo "<pre/>";
$str="http://www.sina.com.cn/abc/de/fg.php?id=1";
$arr=parse_url($str);
/*
 * array(4) {
      ["scheme"]=>
      string(4) "http"
      ["host"]=>
      string(15) "www.sina.com.cn"
      ["path"]=>
      string(14) "/abc/de/fg.php"
      ["query"]=>
      string(4) "id=1"
    }
 */
$file=basename($arr['path']);
/*
 * string(6) "fg.php"
 */

$ext=explode('.',$file);
/*
 * array(2) {
      [0]=>
      string(2) "fg"
      [1]=>
      string(3) "php"
   }
 */
echo $ext[count($ext)-1];
echo "<br/>";


$str2=basename($str);  //fg.php?id=1
echo $str2;
var_dump($arr);
