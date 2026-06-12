<?
namespace Std\fw;
//
// Modulo delle funzioni accessorie che non dipendono dalla struttura
// per l'applicazione Std
//
require_once("std.const.php");
require_once("generic.fun.php");
require_once("filesystem.fun.php");
require_once("html.fun.php");

function getDocumentRoot():string
{
 $items = explode(STRING_SLASH,dirname($_SERVER["SCRIPT_NAME"]));
 $documentRoot = $items[1];
 for($j=2;$j<=count($items)-2;$j++)
  $documentRoot = $documentRoot . STRING_SLASH . $items[$j]; 
 return $documentRoot;
}


function isAXmlDataSource(string $actFileName):bool
{
 $fileItems = explode(STRING_POINT,$actFileName);
 if((count($fileItems==2)) && ($fileItems[count($fileItems)-1]==XML_SUFFIX))
 {
 	$fileItems2 = explode(VAR_SEP ,$fileItems[0]);
 	$tag = $fileItems2[count($fileItems2)-2] . VAR_SEP . $fileItems2[count($fileItems2)-1];
  if($tag=="data_source")
   return true;
 }
 return false;
}

 function getApplicazioni(string $actAppDir):array
 {
 	$appls = array();
 	$files = scandir($actAppDir);
 	$i=0;
 	$appls[STRING_NULL] = $i;
 	$i++;
 	foreach($files as $ind=>$file)
 	{
 		if(is_dir($actAppDir . DIR_SEP . $file) && ($file != THIS_DIR) && ($file != PREVIOUS_DIR))
 		{
 		 $item = $actAppDir . DIR_SEP . $file . DIR_SEP . "root.const.php";	
 		 if(file_exists($item))
 		  $appls[$file] = $i++;
 		}
  }
  return $appls;
 }


function fixSecurityOnUrlPar(string $actArg):string
{
 if ((! is_null($actArg)) && (! is_numeric($actArg)))
 {
  $arg1 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$actArg);
  $arg2 = str_replace(STRING_BACKSLASH,STRING_NULL,$arg1);
  $arg3 = str_replace("|",STRING_NULL,$arg2);
  $arg4 = str_replace(STRING_AMPERSEND,STRING_NULL,$arg3);
  $arg5 = str_replace(STRING_SEMICOLON,STRING_NULL,$arg4);
  $arg6 = str_replace(STRING_DOLLAR,STRING_NULL,$arg5);
  $arg7 = str_replace(STRING_PERCENT,STRING_NULL,$arg6);
  $arg8 = str_replace(STRING_AT,STRING_NULL,$arg7);
  $arg9 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$arg8);
  $arg10 = str_replace(STRING_DOUBLE_QUOTE,STRING_NULL,$arg9);
  $arg11 = str_replace(STRING_BACKSLASH,STRING_NULL,$arg10);
  $arg12 = str_replace(STRING_OPEN_ANGLE_BRACKET,STRING_NULL,$arg11);
  $arg13 = str_replace(STRING_CLOSE_ANGLE_BRACKET,STRING_NULL,$arg12);
  $arg14 = str_replace(STRING_OPEN_PAR,STRING_NULL,$arg13);
  $arg15 = str_replace(STRING_CLOSE_PAR,STRING_NULL,$arg14);
  $arg16 = str_replace(STRING_PLUS,STRING_NULL,$arg15);
  $arg17 = str_replace(STRING_RETURN,STRING_NULL,$arg16);
  $arg18 = str_replace(STRING_LINE_FEED,STRING_NULL,$arg17);
  $arg19 = str_replace(STRING_COMMA,STRING_NULL,$arg18);
  $arg20 = str_replace(STRING_POINT,STRING_NULL,$arg19);
  $arg21 = str_replace(STRING_COLON,STRING_NULL,$arg20);
  return str_replace(STRING_DOUBLE_QUOTE,STRING_NULL,$arg21);
 }
 else
  return $actArg;	
}

function gen_escape_string(mixed $data):int|string {
	if ( ! isset($data) or empty($data) ) return STRING_NULL;
	if ( is_numeric($data) ) return $data;

	$non_displayables = array(
		'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
		'/%1[0-9a-f]/',             // url encoded 16-31
		'/[\x00-\x08]/',            // 00-08
		'/\x0b/',                   // 11
		'/\x0c/',                   // 12
		'/[\x0e-\x1f]/'             // 14-31
	);
	foreach ( $non_displayables as $regex )
		$data = preg_replace( $regex, STRING_NULL, $data );
//	$data = str_replace("'", "", $data );
	$data = str_replace(STRING_DOUBLE_QUOTE,"&quot;",$data);
	return $data;
}

function ms_escape_string(mixed $data):int|string  {
	if ( ! isset($data) or empty($data) ) return STRING_NULL;
	if ( is_numeric($data) ) return $data;

	$non_displayables = array(
		'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
		'/%1[0-9a-f]/',             // url encoded 16-31
		'/[\x00-\x08]/',            // 00-08
		'/\x0b/',                   // 11
		'/\x0c/',                   // 12
		'/[\x0e-\x1f]/'             // 14-31
	);
	foreach ( $non_displayables as $regex )
		$data = preg_replace( $regex, STRING_NULL, $data );
	$data = str_replace(STRING_SINGLE_QUOTE, "''", $data );
	$data = str_replace(STRING_DOUBLE_QUOTE,"&quot;",$data);
	return $data;
}

function fixSecurityOnSqlArg3(string $actArg,string $type='STRING'):string{
	
	if($type == 'STRING'){
		return gen_escape_string($actArg);
	}

	if($type == 'INTEGER'){
		return sprintf('%d',$actArg);
	}
	
	
	if($type == 'FLOAT'){
		return sprintf('%f',$actArg);
	}
	
	if($type == 'DATE'){
		if(is_date($actArg)){
			return $actArg;
		}
	}
	
	return STRING_NULL;
}


function fixSecurityOnSqlArg2(string $actArg,string $type='STRING'):string{
	
	
	if($type == 'STRING'){
		return ms_escape_string($actArg);
	}

	if($type == 'INTEGER'){
		return sprintf('%d',$actArg);
	}
	
	
	if($type == 'FLOAT'){
		return sprintf('%f',$actArg);
	}
	
	if($type == 'DATE'){
		if(is_date($actArg)){
			return $actArg;
		}
	}
	
	return STRING_NULL;
}

function fixSecurityOnSqlArg(string $actArg):string
{
 if ((! is_null($actArg)) && (! is_numeric($actArg)))
 {
  $arg1 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$actArg);
  $arg2 = str_replace(STRING_BACKSLASH,STRING_NULL,$arg1);
  return str_replace(STRING_DOUBLE_QUOTE,STRING_NULL,$arg2);
 }
 else
  return $actArg;
}

function getTopNumRowsForSqlQuery():string
{
  if (MAX_SQL_NUM_ROWS >0)
	{
	 $instr = " TOP " . MAX_SQL_NUM_ROWS ;
	}
	else
	 $instr = " * " ;
	 
	return $instr; 
}

function normalizeString(string $actStr):string
{
	return $actStr;
}

?>