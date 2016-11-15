<?php session_start();?>

<?php

@$dbhost = 'localhost';
@$dbuser = 'root';
@$dbpass = '';
@$db = 'authenu0_parineeta';

@$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die (mysql_error());
@$db_found =mysql_select_db($db,$conn);
if(!$db_found)
{
	echo "Database NOT Found";
}

mysql_select_db($db) or die(mysql_error());


date_default_timezone_set('Asia/Dhaka');
$cur_date = date('Y-m-d');
$time = date('H:i:s');

/*You might not need this */
ini_set('SMTP', "mail.myt.mu"); // Overide The Default Php.ini settings for sending mail


//This is the address that will appear coming from ( Sender )
define('EMAIL', 'admin@njneera.com');

/*Define the root url where the script will be found such as http://website.com or http://website.com/Folder/ */
DEFINE('WEBSITE_URL', 'http://njneera.com/web/');
?>