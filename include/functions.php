<?php 

function urlroute($url){
	global $htaccess;
	if(!$htaccess){
		$url = 'index.php?view='.$url;
	}
	return $url;
}


function escape($input){
	if (get_magic_quotes_gpc()) {
		@$input = stripslashes($input);
	}
	return mysql_real_escape_string($input);
}

function dateConvert($date){
	$req_date = explode("/",$date);
	return $dt = "$req_date[2]-$req_date[1]-$req_date[0]";
}


function tbl_data($col,$tbl){
	$sql = "SELECT $col FROM $tbl";
	$qry = mysql_query($sql) or die ("Error in $col selection at header".mysql_error());
	$rs = mysql_fetch_array($qry);
	return $rs[$col];
}


function name($email){
	$sql = "SELECT username FROM user_admin WHERE email = '$email'";
	$qry = mysql_query($sql) or die ("Error in name selection at header".mysql_error());
	$rs = mysql_fetch_array($qry);
	return $rs['username'];
}


function generate_table($tbl_option){
	$explode = explode(',',$tbl_option);
	
	$sql_user_admin = "SELECT * FROM user_admin";
    $qry_user_admin = mysql_query($sql_user_admin);
    while($rowc = mysql_fetch_array($qry_user_admin)){
		
	}
	
}

function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str, $i+1, $l);
	return $ext;
}



function random_num($n){
	$uniqid = uniqid(rand(), true);
	return substr(number_format(time() * rand(),0,'',''),0,$n);
	//return substr(base_convert(md5($uniqid), 16, 10) , $n);
}


//converts $12312,12312.00 to mysql format
function NumberConvertFromBDT($value){
	$value = preg_replace('/[\৳,]/', '', $value); 
	$value = floatval($value);
	return $value;
}

//converts $12312,12312.00 to mysql format
function NumberConvertFromUSD($value){
	$value = preg_replace('/[\$,]/', '', $value); 
	$value = floatval($value);
	return $value;
}

function countword($text,$n){
$text=strip_tags($text); // not neccssary for none HTML
// $text=strip_shortcodes($text); // uncomment only inside wordpress system
$text = trim(preg_replace("/\s+/"," ",$text));
$word_array = explode(" ", $text);
if (count($word_array) <= $n)
return implode(" ",$word_array);
else{
$text='';
foreach ($word_array as $length=>$word){
$text.=$word ;
if($length==$n) break;
else $text.=" ";
}
}
echo $text."....";
}

function string_limit_words($string, $word_limit) { 
	$words = explode(' ', $string); 
	return implode(' ', array_slice($words, 0, $word_limit)); 
} 


function activeselect($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo "active";
}
define("MAX_LENGTH", 6);
function generateHashWithSalt($password) {
    $intermediateSalt = md5(uniqid(rand(), true));
    $salt = substr($intermediateSalt, 0, MAX_LENGTH);
    return hash("sha256", $password . $salt);
}

function currency_type()
{
    $q = "SELECT currency_id FROM `company` ORDER BY currency_id DESC LIMIT 0,1";

    $result = mysql_query($q) or die("Error in  selection".mysql_error());
    
    $rs = mysql_fetch_array($result);
	return $rs['currency_id'];
    
}

function currency_format($format)
{
    $q = "SELECT format FROM `currency_format` WHERE currency_name='".$format."'";

    $result = mysql_query($q) or die("Error in  selection".mysql_error());
    
    $rs = mysql_fetch_array($result);
	return $rs['format'];
    
}


?>