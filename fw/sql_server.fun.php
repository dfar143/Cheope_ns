<?
namespace Cheope_ns\fw;
require_once("sql_server.const.php");
require_once("generic.fun.php");

function adjustSqlServerTypeDataValues(string $actFieldValue):string
{
 $fieldValue = $actFieldValue;
 if (! isTypeDataValueNormalized($actFieldValue))
  $fieldValue = convertFromSqlServerToNormalDataType($actFieldValue);
 return $fieldValue;
}

function adjustSqlServerTypeFloatValues(float $actFieldValue):float
{
 $fieldValue = round($actFieldValue,SQL_SERVER_NUM_DEC_ROUND_DIGITS);
 return $fieldValue;
}

// $day1 deve essere nel formato campo data di Sql server.
//
function areTheSameDay(string $day1,string $day2):bool
{
 $day1 = convertFromSqlServerToNormalDataType($day1);
 if($day1 != $day2)
 {
	 return false;
 }

 return true;
}

//
// La data passata deve essere nel formato gg-mm-aaaa
function convertFromSqlServerToNormalDataType(string $actFieldValue):string
{
 $items = explode(SQL_SERVER_DATA_ITEMS_SEP,$actFieldValue);
 $num = count($items);
 if($num==3)
 {
  $day = $items[0];
	if(strlen($day)==1)
	 $day = "0" . $day;
  $month = $items[1];
  $year = $items[2];
  switch ($month)
  {
   case "gen":
	  $month = "01";
	  break;
   case "feb":
	  $month = "02";
	  break;
   case "mar":
	  $month = "03";
	  break;
	 case "apr":
	  $month = "04";
	  break;
	 case "mag":
	  $month = "05";
	  break;
	 case "giu":
	  $month = "06";
	  break;
	 case "lug":
	  $month = "07";
	  break;
	 case "ago":
	  $month = "08";
	  break;
	 case "set":
	  $month = "09";
	  break;
	 case "ott":
	  $month = 10;
	  break;
	 case "nov":
	  $month = 11;
	  break;
	 case "dic":
	  $month = 12;
	  break;
  }
  $items = explode(STRING_SPACE,$year);
  $year = $items[0];
  $newValue = $day . STRING_SLASH . $month . STRING_SLASH . $year;
 }
 else
  $newValue = STRING_NULL;
 return $newValue;
}

//
// La data passata deve essere nel formato gg/mm/aaaa
function convertToSqlServerDataType(string $actFieldValue):string
{
 $items = explode(STRING_SLASH,$actFieldValue);
 if(count($items)==3)
 {
  $day = $items[0];
  $month = $items[1];
  $year = $items[2];
  $newValue = $month . SQL_SERVER_DATA_ITEMS_SEP . $day . SQL_SERVER_DATA_ITEMS_SEP . $year;
 }
 else
  $newValue=STRING_NULL;
 return $newValue;
}


?>