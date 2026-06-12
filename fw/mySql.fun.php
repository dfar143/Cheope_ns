<?
namespace Cheope_ns\fw;
require_once("mySql.const.php");

function getMySqlYear(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[1];
}

function getMySqlMonth(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[2];
}

function getMySqlDay(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[3];
}

function getMySqlHour(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[4];
}

function getMySqlMin(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[5];
}

function getMySqlSec(string $actDate):string
{
	preg_match("/([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP .
	"([0-9]+)" . MYSQL_SERVER_DATA_ITEMS_SEP . 
	"([0-9]+)" . STRING_SPACE . 
  "([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP . 
	"([0-9]+)" . MYSQL_SERVER_TIME_ITEMS_SEP .
	"([0-9]+)" .	
	"/i",$actDate,$items);
	return $items[6];
}


//
// La data passata deve essere nel formato gg/mm/aaaa
function convertToMySqlDataType(string $actFieldValue):string
{
 if($actFieldValue != STRING_NULL)
 {
  $items = explode(STRING_SLASH,$actFieldValue);
  $day = $items[0];
  $month = $items[1];
  $year = $items[2];
  $newValue = $year . MYSQL_SERVER_DATA_ITEMS_SEP . 
  $month . MYSQL_SERVER_DATA_ITEMS_SEP . $day;
 }
 else
  $newValue = $actFieldValue;
 return $newValue;
}

// La data passata deve essere nel formato aaaa-mm-gg
function convertFromMySqlToNormalDataType(string $actFieldValue):string
{
 $items1 = explode(STRING_SPACE,$actFieldValue);
 $items2 = explode(MYSQL_SERVER_DATA_ITEMS_SEP,$items1[0]);
 $day = (isset($items2[2])?($items2[2]):STRING_NULL);
 $month = (isset($items2[1])?($items2[1]):STRING_NULL);
 $year = (isset($items2[0])?($items2[0]):STRING_NULL);
 $newValue = $day . STRING_SLASH . $month . STRING_SLASH . $year;
 return $newValue;
}


?>