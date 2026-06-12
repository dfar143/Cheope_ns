<?
namespace Std\fw;
require_once("filesystem.fun.php");
require_once("std_filesystem.const.php");


function copy_file(array $actFiles,string $actDir,bool $overwrite):bool
{
 $fileName =  $actDir . DIR_SEP .
  $actFiles[FIELD_FILE]['name'];
 if (! $overwrite)
 {
  if(is_file($fileName))
	{
	 putGenericHtmlString("Il file " . $actFiles[FIELD_FILE]['name'] . " esiste già.",0);
	 putGenericHtmlString(SEP_OPEN_TAG,0);
	 return false;
  }
	else
	{
	 return copy($actFiles[FIELD_FILE]['tmp_name'],$fileName);
	}
 }
 else
 return copy($actFiles[FIELD_FILE]['tmp_name'],$fileName); 
}


?>