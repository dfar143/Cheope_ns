<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

define(__NAMESPACE__ .  '\MYSQL_SERVER_DATA_ITEMS_SEP',STRING_MINUS);
define(__NAMESPACE__ .  '\MYSQL_SERVER_TIME_ITEMS_SEP',STRING_COLON);
define(__NAMESPACE__ .  '\MYSQL_SERVER_DATA_FORMAT',
"Y" . namespace\MYSQL_SERVER_DATA_ITEMS_SEP . 
"m" . namespace\MYSQL_SERVER_DATA_ITEMS_SEP . 
"d");
define(__NAMESPACE__ .  '\MYSQL_SERVER_TIME_FORMAT',
"H" . namespace\MYSQL_SERVER_TIME_ITEMS_SEP .
"i" . namespace\MYSQL_SERVER_TIME_ITEMS_SEP .
"s");

?>