<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

function writeToLog(string $actLogName,string $actLogMsg):bool
{
 if (file_exists ( $actLogName )) 
 {
  if (! ($handle = fopen ( $actLogName, "a" )))
	return false;
  $msg =  date("Y-m-d H:i:s") . STRING_SPACE . STRING_CANCELLETTO . 
  STRING_SPACE . $actLogMsg . STRING_EOL;
  if (! fwrite ( $handle, $msg ))
   return false;
  fclose ( $handle );
  return true;
 }
 return false;
}


function getClassNameForCreate(string $actClassItem):string
{
 return str_replace(__NAMESPACE__ . STRING_BACKSLASH,
 STRING_NULL,$actClassItem);
}

 function matrix_lookup_value(array $actMatrix,int|string $actKey):mixed
 {
 	foreach($actMatrix as $ind=>$value)
 	{
 	 foreach($value as $ind2=>$val2)
 	 {
 	  if($ind2==$actKey)
 	   return $val2;  	
 	 }	
 	}
 }
 
 function getMicroTime():float
 {
  list($usec, $sec) = explode(STRING_SPACE,microtime()); 
  return ((float)$usec + (float)$sec); 
 }
 
 function isClassDeclared(string $actClass):bool
 {
 	$declaredClasses = get_declared_classes ();
  if (in_array ( $actClass, $declaredClasses )) 
  {
  	return true;
  }  	
  return false;
 }

  function array_containDifferentValues(array $actArray):bool
  {
  	$i=0;
    foreach($actArray as $ind=>$val1)
    {
    	if($i==0)
    	{
    	 $val0=$val1;
    	 $i++;
    	}
    	else
    	 if($val1==$val0)
    	  $i++;
    }
    if($i!=count($actArray))
     return true; 
    else
     return false;
  }

function boolToString(bool $actBoolVal):string
{
	if($actBoolVal)
	 return "true";
	else
	 return "false";
}

function is_array_of_array(mixed $actArray):bool
{
	$retVal = false;
	if(is_array($actArray))
	{
		foreach($actArray as $ind=>$val)
		{
			if(is_array($val))
			{
			 $retVal = true;
		  }
		  else
		  {
		   $retVal = false;
		   break;
		  }
		}
	}
	return $retVal;
}

function is_an_html_id(string $actStr):bool
{
 $ch = subStr($actStr,0,1);
 if ($ch == STRING_CANCELLETTO)
  return true;
 else
  return false;
}

function is_id_char(string $actChar):bool
{
	  $asciiVal = ord($actChar);
		return ((($asciiVal>=97) && ($asciiVal<=122))||
		(($asciiVal>=65)&&($asciiVal<=90)) || 
		($asciiVal==95));
}

function is_alpha(string $actChar):bool
{
	  $asciiVal = ord($actChar);
		return ((($asciiVal>=97) && ($asciiVal<=122))||
		(($asciiVal>=65)&&($asciiVal<=90)) || 
		(($asciiVal>=48) && ($asciiVal<=57)) ||
		($actAsciiVal==95));
		//return preg_match('/[a-zA-Z_]/',$actCh);
}

function is_char_uppercased(string $actChar):bool
{
	$asciiVal = ord($actChar);
	return (($asciiVal>=65)&&($asciiVal<=90));
}

// Funzione usata dal lexer
function is_digit(int $actAsciiVal):bool
{
 return (($actAsciiVal>=48) && ($actAsciiVal<=57)); 
}

function convertPointToComma(string $actValue):string
{
	return str_replace(STRING_POINT,STRING_COMMA,$actValue);
}

function matrix_getColumnByName(array $actMatrix,string $actFieldName):array
{
 $retVal = array();
 $i=0;
 foreach($actMatrix as $row)
 {
 	$retVal[$i++] = $row[$actFieldName];
 }
 return $retVal;
}

function getGgMmAa():string
{
	$date = getDate();
  $day = $date['mday'];
  $month = $date['mon'];
  $year = $date['year'];
  $year = substr($year,strlen($year)-2,2);
  return $day . STRING_SLASH . $month . STRING_SLASH . $year;
}

function getGgMmAaaa():string
{
	$date = getDate();
  $day = $date['mday'];
  $month = $date['mon'];
  $year = $date['year'];
  return $day . STRING_SLASH . $month . STRING_SLASH . $year;
}


function array_getDistinctValues(array $actRow):array
{
	$newRow = array();
	$i=0;
	foreach($actRow as $ind=>$val)
	{
		if(! in_array($actRow[$ind],$newRow))
		{
		 $newRow[$i] = $actRow[$ind];
	   $i++;
	  }
	}
	return $newRow;
}

// Aggiunge tanti caratteri alla stringa data tanto da arrivare al 
// valore dato dall'argomento $actLenght.
function strComplete(string $actStr,string $actChar,int $actLength):string
{
 $strLength = strlen($actStr);
 if(($actLength - $strLength)>0)
  for($i=0;$i<=($actLength - $strLength);$i++)
  {
   $actStr = $actStr . $actChar;	
  }
 return $actStr;
}

// Cerca l'elemento $actItem nella matrice $actMat
// Se lo trova torna true altrimenti torna false.
//
function in_matrix(mixed $actItem,array $actMat):bool
{
	foreach($actMat as $ind => $val)
	{
		if(is_array($val))
		{
		 if(in_matrix($actItem,$val))
		  return true;
	  }
	  else
	  {
	  	if($val==$actItem)
	  	 return true;
	  }
	}
 return false;
}

function isWholeAlpha(string $actStr):bool
{
 if (! preg_match("/^[a-zA-Z]*$/",$actStr))
	return false;
 return true;
}

function timeDiff(string $actInitTime,string $actEndTime):int
{	
	$initTimeItems = explode(STRING_COLON,$actInitTime);
	$endTimeItems = explode(STRING_COLON,$actEndTime);
	
	$initSec = $initTimeItems[2];
	$endSec = $endTimeItems[2];

	$initMin = $initTimeItems[1];
	$endMin = $endTimeItems[1];

	$initHour = $initTimeItems[0]; 
	$endHour = $endTimeItems[0]; 

	$totInitSec = $initSec + $initMin * 60 + $initHour * 3600;
	$totEndSec = $endSec + $endMin * 60 + $endHour * 3600;
	$totDiffSec = $totEndSec - $totInitSec;
	
	return $totDiffSec; 
}

function str_right(string $actStr,int $actNum):string|false
{
	//echo "Actum:" . $actNum;
	if($actNum > 0)
	 return substr($actStr,strlen($actStr)-$actNum,$actNum);
  else
   return false;
}

function str_left(string $actStr,int $actNum):string|false
{
 if($actNum > 0)
  return substr($actStr,0,$actNum);
 else
  return false;
}

function is_uppercased(string $actStr):bool
{
	$newUCStr = ucfirst($actStr);
	return ! strcmp($newUCStr,$actStr);
}

function isAnIpNumber(string $actVal):bool
{
 $actVal = trim($actVal);

 //if (! preg_match("/^(([1|2])?([0-9])?[0-9])\.((([1|2])?([0-9])?[0-9])\.(([1|2])?([0-9])?[0-9])\.(([1|2])?([0-9])?[0-9]))?$/",$actVal))
 if (! preg_match("/^((([1|2])?([0-9])?[0-9])\.){1,3}(([1|2])?([0-9])?[0-9])?$/",$actVal))
	return false;

 $items = explode(".",$actVal);	
 $classa = $items[0] + 0;
 if(isset($items[1]))
  $classb = $items[1] + 0;
 else
  $classb=0;
 if (isset($items[2]))
  $classc = $items[2] + 0;
 else
  $classc=0;
 if (isset($items[3]))
  $classd = $items[3] + 0;
 else
  $classd=0;
	
 if (($classa>=0)&&($classa<=255))
  if(($classb>=0)&&($classb<=255))
	 if(($classc>=0)&&($classc<=255))
	  if(($classd>=0)&&($classd<=255))
		 return true;

 return false;
}

function isTypeDataValueNormalized(string $actVal):bool
{
 $actVal = trim($actVal);
 if (preg_match("/^([0|1|2|3]?[0-9])\/([0|1]?[0-9])\/([1|2][0|9][0-9][0-9])$/",$actVal))
  return true;
 else
  return false;
}

function item_in_array_keys(string|int $actKey,array $actArray):bool
{
 foreach($actArray as $key=>$val)
 {
  if ($actKey === $key)
	{
	 return true;
  }
 }
 return false;
}

function array_stretch(array $actArray):array
{
 $newArray = array();
 $num = count($actArray);
 $j=0;
 for($i=0;$i<=$num-1;$i++)
 {
  if(is_array($actArray[$i]))
	{
	 $innerArray = $actArray[$i];
	 $num1 = count($innerArray);	 
	 for($k=0;$k<=$num1-1;$k++)
	  $newArray[$j++] = $innerArray[$k];
	}
	else
	  $newArray[$j++] = $actArray[$i];
 }
 return $newArray;
}

function array_join_string_to_all(array $actArray,string $actString):array
{
 $num = count($actArray);
 for($i=0;$i<=$num-1;$i++)
 {
  $actArray[$i] = $actArray[$i] . $actString;
 }
 return $actArray;
 
}

function array_deleteItemByKey(array $actRow,int|string $actKey):array
{
 $newRow = array();
 if(array_is_part_assoc($actRow))
 {
  foreach($actRow as $key => $value)
  {
   if($key !== $actKey)
	  $newRow[$key] = $value;
  }
 }
 else
 {
  $i=0;
  $num = count($actRow);
  for($j=0;$j<=$num-1;$j++)
  {
  	$val = $actRow[$j];
  	if($j!=$actKey)
  	 $newRow[$i++] = $val;
  }
 }
 return $newRow;
}

function array_getKey(array $actRow,mixed $actVal):string|int
{
 foreach($actRow as $key => $value)
 {
  if($value === $actVal)
	{
    return $key;
  }
 }
 return NO_VALUE;
}

function array_is_assoc (array $actArr):bool
{
 return (is_array($actArr) && (count(array_filter(array_keys($actArr),'is_string')) == count($actArr)) && 
 (count($actArr)>0));}

function array_is_part_assoc(array $actArr):bool
{
	return (is_array($actArr) && (count(array_filter(array_keys($actArr),'is_string')) > 0) && 
	(count($actArr)>0));
}

function array_is_numeric(array $actArr):bool
{
 return (is_array($actArr) && (count(array_filter(array_keys($actArr),'is_numeric')) == count($actArr)) &&
 (count($actArr)>0));}

function array_deleteItem(array $actRow,mixed $actVal):array
{
 $newRow = array();
 if(array_is_part_assoc($actRow))
 {
  foreach($actRow as $key => $value)
  {
   if($value !== $actVal)
	  $newRow[$key] = $value;
  }
 }
 else
 {
  $i=0;
  $num = count($actRow);
  for($j=0;$j<=$num-1;$j++)
  {
  	if($actRow[$j]!==$actVal)
  	 $newRow[$i++] = $actRow[$j];
  }
 }
 return $newRow;
}

function array_addItemAtFirst(array $actRow,string|int $actKey,mixed $actVal):array
{
 $newRow = array();
 $newRow[$actKey] = $actVal;
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 return $newRow;
}

function array_addItemAtLast(array $actRow,string|int $actKey,mixed $actVal):array
{
 $newRow = array();
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
  $newRow[$actKey] = $actVal;
 return $newRow;
}

function array_addBlankItemAtFirst(array $actRow):array
{
 $newRow = array();
 $newRow[STRING_NULL] = STRING_NULL;
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 return $newRow;
}

function array_addBlankItemAtLast(array $actRow):array
{
 $newRow = array();
 foreach($actRow as $key => $value)
  $newRow[$key] = $value;
 $newRow[STRING_NULL] = STRING_NULL; 
 return $newRow;
}

function array_copy(array $actBuf,array $actArray):array
{
 $num = count($actArray);
 foreach($actArray as $key => $val)
  $actBuf[$key] = $val;
 
 return $actBuf;
}

// Concatena due array considerandoli come
// array associativi
function array_assoc_concat(array $actArray1,array $actArray2):array
{
 foreach($actArray2 as $key => $value)
 {
  $actArray1[$key] = $value;
 }
 return $actArray1;
}

// Concatena due array considerandoli come
// array normali
function array_concat(array $actArray1,array $actArray2):array
{
 $num2 = count($actArray2);
 for($i=0;$i<=$num2-1;$i++)
 {
 	if(isset($actArray2[$i]))
  $actArray1[] = $actArray2[$i];
 }
 
 return $actArray1;
}

// Ritorna la posizione di $actitem in $actArray
function array_getPos(array $actArray,mixed $actItem):int|string|false
{
	$noFound = false;
	foreach($actArray as $ind=>$val)
	{
		if($val === $actItem)
		 return $ind;
	}
	return false; 
}

// Ritorna un array ottenuto usando gli elementi dell'array 
// primo argomento come chiavi e gli elementi dell'array
// secondo argomento come valori.
function array_assoc(array $actArray1,array $actArray2):array
{
 $num = count($actArray1);
 $retArray = array();
 for($i=0;$i<=$num -1;$i++)
 {
  $retArray[$actArray1[$i]] = $actArray2[$i];
 }
 return $retArray;
}

function array_change_key_and_value(array $actArray):array
{
	$newArray = array();
	foreach($actArray as $ind=>$val)
	{
		$newArray[$val] = $ind;
	}
	return $newArray;
}

function getMaxElementsLength(array $actArray):int
{
 $num = count($actArray);
 $max=0;
 for($i=0;$i<=$num-1;$i++)
 {
  if (is_string($actArray[$i]))
  {
	 $actLength = strlen($actArray[$i]);
   if ($actLength > $max)
	  $max = $actLength;
	}
 }
 return $max;
}

function strUppercaseSplit(string $actStr):array
{
	$strlen = strlen($actStr);
	$charBuf = array(STRING_NULL);
	$j=0;
	for($i=0;$i<=$strlen-1;$i++)
	{
	 $char = substr($actStr,$i,1);
	 if(is_char_uppercased($char) && ($i==0))
	 {
	  $charBuf[$j] = $char;
	 }
	 elseif(is_char_uppercased($char))
	 {
	 	$j++;
	 	$charBuf[$j] = $char;
	 }
	 else
	  $charBuf[$j] = $charBuf[$j] . $char;
	}
	return $charBuf;
}

function separateStringItems(string $actStr):string
{
 $buf = strUppercaseSplit($actStr);
 $itemName = STRING_NULL;
 $j=0;
 foreach($buf as $item)
 {
  if($j=0)
   $itemName = $item;
  else
   $itemName = $itemName . VAR_SEP . $item;
  $j++; 
 }
 return $itemName;
}

function getOriginalItemName(string $actItemName):string
{
 $itemNameItems = explode(VAR_SEP,$actItemName);
 $num1 = count($itemNameItems);
 $itemFieldName = $itemNameItems[1];
 for($m=2;$m<=$num1-1;$m++)
 {
  $itemFieldName = $itemFieldName . VAR_SEP . $itemNameItems[$m];
 }
 $itemFieldName = ucFirst(strToLower($itemFieldName));
 return $itemFieldName;
}

function getFieldTypeItemName(string $actItemName):string
{
 $itemNameItems = explode(VAR_SEP,$actItemName);
 $num1 = count($itemNameItems);
 $itemFieldName = $itemNameItems[2];
 for($m=3;$m<=$num1-1;$m++)
 {
  $itemFieldName = $itemFieldName . VAR_SEP . $itemNameItems[$m];
 }
 return $itemFieldName;
}

function convertToDojoDefaultDate(string $actValue,string $actFormat):array|false
{
	if(in_array($actFormat,
	array("gg/mm/yy","gg/mm/yyyy",
	"mm/gg/yy","mm/gg/yyyy",
	"yy/gg/mm","yyyy/gg/mm",
	"yy/mm/gg","yyyy/mm/gg",
	"gg-mm-yy","gg-mm-yyyy",
	"mm-gg-yy","mm-gg-yyyy",
	"yy-gg-mm","yyyy-gg-mm",
	"yy-mm-gg","yyyy-mm-gg")))
	{
	 switch($actFormat)
	 {
		case "gg/mm/yy":
		if(preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0))
		{
		 $g = $matches[1];
		 $m = $matches[2];
		 $y = $matches[3];
		 $y = "20" . $y;		 
		}
		else
		return false;
		break;
		case "gg/mm/yyyy":if(preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9][0-9][0-9])/',$actValue,$matches,0,0))
		{
		 $g = $matches[1];
		 $m = $matches[2];
		 $y = $matches[3];
		}
		else
		 return false;		
		break;	
		case "mm/gg/yy":if(preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0))
		{
		 $m = $matches[1];
		 $g = $matches[2];
		 $y = $matches[3];
		 $y = "20" . $y;
		}
		else
		 return false;	
		break;	
		case "mm/gg/yyyy":if(preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9][0-9][0-9])/',$actValue,$matches,0,0))
		{
		 $m = $matches[1];
		 $g = $matches[2];
		 $y = $matches[3];
		}
		else
		 return false;	
		break;
		case "yy/gg/mm":if(preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0))
		{
		 $y = $matches[1];
		 $g = $matches[2];
		 $m = $matches[3];
		 $y = "20" . $y;
		}
		else
		 return false;	
		break;
		case "yyyy/gg/mm":preg_match('/([0-9][0-9][0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$g = $matches[2];
		$m = $matches[3];	
		break;
		case "yy/mm/gg":preg_match('/([0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$m = $matches[2];
		$g = $matches[3];
		$y = "20" . $y;	
		break;
		case "yyyy/mm/gg":preg_match('/([0-9][0-9][0-9][0-9])\/([0-9][0-9])\/([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$m = $matches[2];
		$g = $matches[3];	
		break;
		case "gg-mm-yy":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$g = $matches[1];
		$m = $matches[2];
		$y = $matches[3];
		$y = "20" . $y;	
		break;
		case "gg-mm-yyyy":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9][0-9][0-9])/',$actValue,$matches,0,0);
		$g = $matches[1];
		$m = $matches[2];
		$y = $matches[3];	
		break;
		case "mm-gg-yy":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$m = $matches[1];
		$g = $matches[2];
		$y = $matches[3];
		$y = "20" . $y;	
		break;
		case "mm-gg-yyyy":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9][0-9][0-9])/',$actValue,$matches,0,0);
		$m = $matches[1];
		$g = $matches[2];
		$y = $matches[3];	
		break;
		case "yy-gg-mm":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$g = $matches[2];
		$m = $matches[3];
		$y = "20" . $y;	
		break;
		case "yyyy-gg-mm":preg_match('/([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$g = $matches[2];
		$m = $matches[3];	
		break;
		case "yy-mm-gg":preg_match('/([0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$m = $matches[2];
		$g = $matches[3];
		$y = "20" . $y;	
		break;
		case "yyyy-mm-gg":preg_match('/([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])/',$actValue,$matches,0,0);
		$y = $matches[1];
		$m = $matches[2];
		$g = $matches[3];	
		break;		 
	 }
	 return array($g,$m,$y);
	}
	else
	 return false;
}

function array_max(array $actArray):int|string
{
	$dim = count($actArray);
	$max = $actArray[0];
	for($i=1;$i<=$dim-1;$i++)
	{
		$val = $actArray[$i];
		if ($val > $max)
		 $max = $val;		
	}
	return $max;
}


?>
