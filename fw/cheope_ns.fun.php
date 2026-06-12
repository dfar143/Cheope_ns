<?
namespace Cheope_ns\fw;
//
// Modulo delle funzioni accessorie che non dipendono dalla struttura
// per l'applicazione cheope_ns.
//

require_once("cheope_ns.const.php");
require_once("cheope_ns_stdModules.def.php");
require_once("html.fun.php");
require_once("generic.fun.php");
require_once("filesystem.fun.php");

function getDbOpParsExpr(string $actPar):string
{
 $items1 = explode(THIS_DIR , $actPar);
 $par1 = $items1[1];
 $par1 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$par1); 
 $par1 = str_replace(STRING_BACKSLASH,STRING_NULL,$par1);
 return $par1;
}

function getDocumentRoot():string
{
 $items = explode(STRING_SLASH,dirname($_SERVER["SCRIPT_NAME"]));
 $documentRoot = $items[1];
 for($j=2;$j<=count($items)-2;$j++)
  $documentRoot = $documentRoot . STRING_SLASH . $items[$j]; 
 return $documentRoot;
}

function createZipArchive(string $actDir, object $actZipFile,string $actSubFolder = STRING_NULL):bool
{
    if ($actZipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
	$items1 = str_split($actDir);
    $actDir .= ((end($items1) == DIR_SEP) ? STRING_NULL : DIR_SEP);
	$items2 = str_split($actSubFolder);
    $actSubFolder .= ((end($items2) == DIR_SEP) ? STRING_NULL : DIR_SEP);
    // we start by going through all files in $folder
    $handle = opendir($actDir);
    while ($f = readdir($handle)) {
        if ($f != THIS_DIR && $f != PREVIOUS_DIR) {
            if (is_file($actDir . $f)) {
                // if we find a file, store it
                // if we have a subfolder, store it there
                if ($actSubFolder != null)
                    $actZipFile->addFile($actDir . $f, $actSubFolder . $f);
                else
                    $actZipFile->addFile($actDir . $f);
            } elseif (is_dir($actDir . $f)) {
                // if we find a folder, create a folder in the zip
                $actZipFile->addEmptyDir($f);
                // and call the function again
                createZipArchive($actDir . $f, $actZipFile, $f);
            }
        }
    }
}


function isAXmlDataSource(string $actFileName):bool
{
 $fileItems = explode(STRING_POINT,$actFileName);
 if((count($fileItems)==2) && ($fileItems[count($fileItems)-1]==XML_SUFFIX))
 {
 	$fileItems2 = explode(VAR_SEP ,$fileItems[0]);
 	$tag = $fileItems2[count($fileItems2)-2] . VAR_SEP . $fileItems2[count($fileItems2)-1];
  if($tag=="data_source")
   return true;
 }
 return false;
}

function isAJsonDataSource(string $actFileName):bool
{
 $fileItems = explode(STRING_POINT,$actFileName);
 if((count($fileItems)==2) && ($fileItems[count($fileItems)-1]==JSON_SUFFIX))
 {
 	$fileItems2 = explode(VAR_SEP ,$fileItems[0]);
 	$tag = $fileItems2[count($fileItems2)-2] . VAR_SEP . $fileItems2[count($fileItems2)-1];
  if($tag=="data_source")
   return true;
 }
 return false;
}

 function putActiveApp(Html_writer $actHtmlWriter):void
 {
 	$htmlWriter = $actHtmlWriter;
  $htmlWriter->putSpanOpenTag("active_application_label_id","static_text");
  $htmlWriter->putGenericHtmlString(LABEL_APPLICAZIONE_ATTIVA . STRING_COLON . ENTITY_SPACE);
	$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
	$appDir=STRING_NULL;
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	{
 	 $appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $htmlWriter->putHrefOpenTag("active_application_id",STRING_NULL,"active_app");
 	 $htmlWriter->putGenericHtmlString($appDir);
 	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
  }
  if($appDir != STRING_NULL)
  {
   $appls = getApplicazioni_ns(PREVIOUS_DIR . DIR_SEP);
   unset($appls[0]);
   $menuItems = STRING_NULL;
   foreach($appls as $ind=>$file)
   {
   	if((($file != STRING_NULL)&&($file != $appDir)))
   	 $menuItems = $menuItems . "<div dojoType=\"dijit.MenuItem\">" . 
   	 $file . "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
   	 "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE . "','setSessionActiveApp','" . 
   	 $file . "','text',/[1]/);window.location='" . THIS_DIR . DIR_SEP . 
   	 THIS_PAGE . "';</script></div>";
   }
   $htmlWriter->put("<div dojoType=\"dijit.Menu\" targetNodeIds=\"active_application_id\" style=\"display:none\" >" .
      $menuItems . "</div>"); 
  }
 }
 
 function putActiveAppNoModify(Html_writer $actHtmlWriter):void
 {
 	$htmlWriter = $actHtmlWriter;
  $htmlWriter->putSpanOpenTag("active_application_label_id","static_text");
  $htmlWriter->putGenericHtmlString(LABEL_APPLICAZIONE_ATTIVA . STRING_COLON . ENTITY_SPACE);
	$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
	$appDir=STRING_NULL;
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	{
 	 $appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $htmlWriter->putHrefOpenTag("active_application_id","active_app",STRING_CANCELLETTO);
 	 $htmlWriter->putGenericHtmlString($appDir);
 	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
  }
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
 
  function getApplicazioni_ns(string $actAppDir):array
 {
 	$appls = array();
 	$files = scandir($actAppDir);
 	$i=0;
 	//$appls[STRING_NULL] = $i;
	$appls[STRING_NULL] = STRING_NULL;
 	//$i++;
 	foreach($files as $ind=>$file)
 	{
 		if(is_dir($actAppDir . DIR_SEP . $file) && ($file != THIS_DIR) && ($file != PREVIOUS_DIR))
 		{
 		 $item = $actAppDir . DIR_SEP . $file . DIR_SEP . "ns.php";	
 		 if(file_exists($item))
		 //$appls[$file] = $i++;
	     // $appls[$i++]=$file;
		  $appls[$file]=$file;
 		}
  }
  return $appls;
 }

function groupFilesByCategories(array $actFilesNames,string $actAppDir):array
{
 $funLibsNames = array();
 $constLibsNames = array();
 $defModsNames = array();
 $classModsNames = array();
 $appModsNames = array();
 $otherModsNames = array();
 
 $retFilesNames = array();
 
 $i=0;
 $j=0;
 $k=0;
 $l=0;
 $m=0;
 $n=0;
 
 $funPostfixStr = FUNCTION_LIB_MOD_POSTFIX . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $constPostfixStr = CONST_LIB_MOD_POSTFIX . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $defPostfixStr = DEFINITION_MOD_POSTFIX . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $classPostFixStr = CLASS_MOD_POSTFIX . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 
 foreach($actFilesNames as $fileName)
 {
 	if(! is_dir($actAppDir . DIR_SEP . $fileName))
 	if(str_right($fileName,3) == APP_LANGUAGE)
 	{	
 	 $funPostfix = str_right($fileName,strlen($funPostfixStr));
 	 $constPostfix = str_right($fileName,strlen($constPostfixStr));
 	 $defPostfix = str_right($fileName,strlen($defPostfixStr));
 	 $classPostFix = str_right($fileName,strlen($classPostFixStr));
 	 $classInitChar = str_left($fileName,1);
 	  
   if($funPostfix == $funPostfixStr)
   {
  	$funLibsNames[$i++] = $fileName;
  	continue;
   }
   if($constPostfix == $constPostfixStr)
   {
  	$constLibsNames[$j++] = $fileName;
  	continue;
   }
   if($defPostfix == $defPostfixStr)
   {
  	$defModsNames[$k++] = $fileName;
  	continue;
   }
   if(is_uppercased($classInitChar) || ($classInitChar == $classPostFix))
   {
  	$classModsNames[$l++] = $fileName;
  	continue;
   }
  
   $appModsNames[$m++] = $fileName;  
  }
  else
  {
   $otherModsNames[$n++] = $fileName;
  }
 }
 
 $retFilesNames[LABEL_FUNCTIONS_LIBS]=$funLibsNames;
 $retFilesNames[LABEL_CONSTS_LIBS]=$constLibsNames;
 $retFilesNames[LABEL_DEFINITIONS_MODULES]=$defModsNames;
 $retFilesNames[LABEL_CLASSES_MODULES]=$classModsNames;
 $retFilesNames[LABEL_APPLICATIONS_MODULES]=$appModsNames;
 $retFilesNames[LABEL_OTHER_MODULES]=$otherModsNames;
 
 return $retFilesNames;
 
}

function getStdFiles(array $actFiles):array
{
 $stdFiles = array();
 $i=0;
 foreach($actFiles as $file)
 {
 	if((strpos($file,STANDARD_MOD_PREFIX)===0) || 
 	(strpos($file,strtolower(STANDARD_MOD_PREFIX))===0))
 	{
 	 $stdFiles[$i] = $file;
   $i++;
  }
 }
 return $stdFiles;
}

function createApplicationSkeleton(string $actAppDir,string $actApp):bool
{
 global $stdModules;
 global $stdDirs;	
	
 $res=true;
 	
 $currentDir = PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME;
 $appDir = $actAppDir;
 
 if(is_dir($currentDir) && is_dir($appDir))
 {
  $oldAppDir = $appDir;	
  
 	$res = $res && copy_all_files_to_dir($currentDir,$appDir,array(ROOT_CONST_MOD,LOADER_MOD));
    $res = $res && copy_all_files_to_dir($currentDir,$oldAppDir,array(ROOT_FUN_MOD,ROOT_DEF_MOD));
 	if(file_exists($currentDir . DIR_SEP . STD_DB_OP_FUN_MOD))
 	 copy_all_files_to_dir($currentDir,$appDir,array(STD_DB_OP_FUN_MOD));
 	if(file_exists($currentDir . DIR_SEP . STD_SQLSRV_DB_OP_FUN_MOD))
 	 copy_all_files_to_dir($currentDir,$appDir,array(STD_SQLSRV_DB_OP_FUN_MOD));
 	if(file_exists($currentDir . DIR_SEP . STD_ODBC_DB_OP_FUN_MOD))
 	 copy_all_files_to_dir($currentDir,$appDir,array(STD_ODBC_DB_OP_FUN_MOD));
 	 
  $appDir = $appDir . DIR_SEP . FW_DIR;
  make_dir($appDir);
  
  $appDir1 =  $oldAppDir . DIR_SEP . PDF_DIR;
  make_dir($appDir1);
  
  $res = $res && copy_all_files_to_dir($currentDir,$oldAppDir,array("ns" . FILE_NAME_ELEMENTS_SEP . PHP_ACRONYM));
  make_dir($oldAppDir . DIR_SEP . $actApp);
  $fwDir = $currentDir . DIR_SEP . FW_DIR;
  $files = scandir($fwDir);
  $stdFiles = getStdFiles($files);
  $allStdFiles = array_concat($stdFiles,$stdModules);
  $res = $res && copy_all_files_to_dir($fwDir,$appDir,$allStdFiles);
  $res = $res && copy_all_files_to_dir($fwDir,$appDir,array("Model" . VAR_SEP .
  "jpgraphs" . FILE_NAME_ELEMENTS_SEP . "class" . FILE_NAME_ELEMENTS_SEP . PHP_ACRONYM));
//  $res = $res && copy_all_files_to_dir($currentDir,$actAppDir,array("model" . 
//  VAR_SEP . AJAX_HANDLER_PAGE));
  $res = $res && copy_all_files_to_dir($currentDir,$oldAppDir,array(strtolower(APPLICATION_NAME) . VAR_SEP . "prova.mdb"));
 }
 else
  return false;
    
 foreach($stdDirs as $dir)
 {
 	$currentCompleteSubDir = $currentDir . DIR_SEP . "model" . VAR_SEP . $dir;
 	$files = scandir($currentCompleteSubDir,1);
 	// Elimina . e ..
 	//
 	array_pop($files);
 	array_pop($files);
 	$destSubDir = $oldAppDir . DIR_SEP . $dir;
 	make_dir($destSubDir);
 	$res = $res && copy_all_files_to_dir($currentCompleteSubDir,$destSubDir,$files);
 } 
 return $res;
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


function getExactTableName(string $actTable):string
{
 $tableNameItems = explode(VAR_SEP,$actTable);
 $tableNameItemsNum = count($tableNameItems);
 $tableName = $tableNameItems[1];
 for($i=2;$i<=$tableNameItemsNum-1;$i++)
 {
 	$tableName = $tableName . VAR_SEP . $tableNameItems[$i];
 }
 return $tableName;
}

function normalizeString(string $actStr):string
{
	return $actStr;
}

?>