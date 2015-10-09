<?php
/**
* 中文编码
*
* @param string 要编码的字符串
* @return string 编码过的字符串
*/
function hex_encode($s) {
    $s = iconv('UTF-8', 'GBK', $s);
    return preg_replace('/(.)/es', "str_pad(dechex(ord('\\1')),2,'0',STR_PAD_LEFT)", $s);
}

/**
* 中文解码
*
* @param string 要解码的字符串
* @return string 解码过的字符串
*/
function hex_decode($s) {
    return preg_replace('/(\w{2})/e', "chr(hexdec('\\1'))", $s);
}

function loseSpace($pcon){
 $pcon = preg_replace("/ /","",$pcon);
 $pcon = preg_replace("/&nbsp;/","",$pcon);
 $pcon = preg_replace("/　/","",$pcon);
 $pcon = preg_replace("/\r\n/","",$pcon);
 $pcon = str_replace(chr(13),"",$pcon);
 $pcon = str_replace(chr(10),"",$pcon);
 $pcon = str_replace(chr(9),"",$pcon);
 return $pcon;
}

/**
 * 调试打印
 *
 * @param mix $var	    需要打印的值
 * @param boolean $method   需要打印的方式
 * @param boolean $exit     是否停止程序继续执行
 *
 * @return void
 */
function debug($var, $method = true, $exit = false) {
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo ' <pre>';
	$method ? print_r($var) : var_dump($var);
	echo '</pre> ';
	if ($exit) {
		exit;
	}
}

//PHP stdClass Object转array  
function object_array($array) {  
    if(is_object($array)) {  
        $array = (array)$array;  
     } if(is_array($array)) {  
         foreach($array as $key=>$value) {  
             $array[$key] = object_array($value);  
             }  
     }  
     return $array;  
}  

//建立目录
/*
	正在使用
*/
function create_dir($dir){
	if(!is_dir($dir)){
		mkdir($dir, 0777, true);
		chmod($dir, 0777); 
	}
	return true;
}