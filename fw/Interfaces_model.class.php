<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("filesystem.fun.php");
require_once("struct.fun.php");
require_once("Xml_interface_file_analyzer.class.php");

class Interfaces_model
{
 static function getAllPages(string $actApp):array
 {
 	return getAllPages($actApp);
 }
 
 //
 // Ritorna tutte le interfacce escluso i modelli Std per actPage=STRING_NULL
 // Ritorna un array ad indice alfanumerico
 //
 static function getAllInterfacesByPage(string $actApp,string $actPage,bool $actIncludePageNull=false):array
 {
 	$appDir = $actApp;
  $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
  $files = scandir($appXmlDir);
  $interfaces = array();
  foreach($files as $file)
  {
   $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
   if(! is_dir($file) && ((count($fileItems)==1)||((count($fileItems)==2)&&($fileItems[1]==XML_SUFFIX))))
   	if(Xml_interface_file_analyzer::is_interface_file($appXmlDir . DIR_SEP . $file))
    if (! Xml_interface_file_analyzer::is_standard($appXmlDir . DIR_SEP . $file))
   	{
   	  $items = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	  $pageName = $items[1];
   	  if(($pageName==$actPage)||(($actIncludePageNull)&&($pageName==STRING_NULL)))
   	  {
   	   $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);	
   		 $interfaces[$file] = $file;
   	  } 
    }
   }
  return $interfaces;
 }
 
 //
 // Ritorna tutte le interfacce di una certa pagina e tipo - escludo i modelli Std.
 // Ritorna un array ad indice alfanumerico.
 //
 static function getAllInterfacesByPageAndType (string $actApp, string $actPage,string $actType):array
 {
  $appDir = $actApp;
  $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
  $files = scandir($appXmlDir);
  $interfaces = array();
  foreach($files as $file)
  {
   $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
   if(! is_dir($file) && ((count($fileItems)==1)||((count($fileItems)==2)&&($fileItems[1]==XML_SUFFIX))))
   	if(Xml_interface_file_analyzer::is_interface_file($appXmlDir . DIR_SEP . $file))
    if (! Xml_interface_file_analyzer::is_standard($appXmlDir . DIR_SEP . $file))
   	{
   	  //$items = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	  $type = Xml_interface_file_analyzer::getScalarProperty($appXmlDir . DIR_SEP . $file,"type");
  	  $items = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	  $pageName = $items[1];
   	  if(($type==$actType)&&(($pageName==$actPage)||(($pageName==STRING_NULL))))
   	  {
   	   //$fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);	
   		 $interfaces[$file] = $file;
   	  } 
    }
   }
  return $interfaces;	 
 }
 
 //
 // Ritorna tutte le interfacce Std; 
 // Per actPage=STRING_NULL
 // ritorna un array ad indice numerico
 //
 static function getAllStdInterfaces(string $actApp):array
 {
 	$appDir = $actApp;
  $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
  $files = scandir($appXmlDir);
  $interfaces = array();
  foreach($files as $file)
  {
   $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
   if(! is_dir($file) && ((count($fileItems)==1)||((count($fileItems)==2)&&($fileItems[1]==XML_SUFFIX))))
   	if(Xml_interface_file_analyzer::is_interface_file($appXmlDir . DIR_SEP . $file))
    if (Xml_interface_file_analyzer::is_standard($appXmlDir . DIR_SEP . $file))
   	{
   	   $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);	
   		 $interfaces[$file] = $file;
    }
   }
  return $interfaces;
 }

 static function getAllInterfacesByNode(string $actApp,string $actNode):array
 {
 	$appDir = $actApp;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appXmlDir);
   $interfaces = array();
   foreach($files as $file)
   {
   	$fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
   if(! is_dir($file) && ((count($fileItems)==1)||((count($fileItems)==2)&&($fileItems[1]==XML_SUFFIX))))
   	 if(Xml_interface_file_analyzer::is_interface_file($appXmlDir . DIR_SEP . $file))
     if(! Xml_interface_file_analyzer::is_standard($appXmlDir . DIR_SEP . $file)) 
   	 {
   	 	$node = Xml_interface_file_analyzer::getScalarProperty($appXmlDir . DIR_SEP . $file,"obj");
   	 	if($node=="OBJ_NONE")
   	 	 $node=OBJ_NONE;
   	 	if($node===$actNode)
   	  {
   		 $interfaces[] = $file;
   	  }
    }
   } 
   return $interfaces;
 }
 
 static function replaceInAllInterfaces(string $actAppName,
 string $actOldStr,string $actNewStr):bool
 {
 	$appIntDir = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP . INTERFACES_DIR;
 	$files = scandir($appIntDir);
 	$nFiles = array();
 	$res=true;
 	foreach($files as $file)
 	{
 	 $fileItems = explode(STRING_POINT,$file);
 		if(! is_dir($file) && (count($fileItems)==1))
 		 $nFiles[] = $file;
 	}
  foreach($nFiles as $fileName)
  {
   $res = $res && replace_in_file_content($appIntDir . DIR_SEP . $fileName,
   $actOldStr,$actNewStr); 
  }
 	return $res;
 }
 
 static function replaceIntNameInAllInterfaces(object $actIntSerializer,
 string $actOldStr,string $actNewStr):bool
 {
  $appIntDir = PREVIOUS_DIR . DIR_SEP . $actIntSerializer->getAppName() . DIR_SEP . INTERFACES_DIR;
  $files = scandir($appIntDir);
  $nFiles = array();
  foreach($files as $file)
  {
   $fileItems = explode(STRING_POINT,$file);
   if(! is_dir($file) && (count($fileItems)==1))
 	$nFiles[] = $file;
  }
  foreach($nFiles as $fileName)
  {
	$swapInt=array();
	$swapInt[0]=$actOldStr;
	$swapInt[1]=$actNewStr;
	$actIntSerializer->setFileName($fileName);
	//die(count($swapInt));
	$actIntSerializer->setLoadSpecialChars(true);
	$actIntSerializer->loadData($swapInt);
    $items = $actIntSerializer->getItems ();
	/*if($fileName=='Prova_2_ns!!!accordion!!0')
	{
		echo "AAA";
		//print_r($);
		die(print_r($items["interfacesContainer"]->getInterfaces()));
	}*/
	$actIntSerializer->loadItems ( $items );
	$actIntSerializer->saveData ();
    $actIntSerializer->resetDOM ();
	$actIntSerializer->resetInterfacesContainer ();
  }
  return true;
 }

 static function isInterfaceBusy(string $actAppDir,string $actIntName):bool
 {
  $appXmlDir = PREVIOUS_DIR . DIR_SEP . $actAppDir . DIR_SEP . INTERFACES_DIR;	
 	$files = scandir($appXmlDir);
 	$nFiles = array();
 	$res=STRING_NULL;
 	foreach($files as $file)
 	{
 	 $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
 	 if(! is_dir($file) && (count($fileItems)==1)&&($file!==$actIntName))
 	 {
 		$fileContents = file($appXmlDir . DIR_SEP . $file);
 		foreach($fileContents as $content)
 		{
 		 if(strpos($content,$actIntName)!==false)
 		 	return true;
 		}
 	 }
 	 elseif(! is_dir($file) && (count($fileItems)==2) && ($fileItems[1]==XML_SUFFIX) &&
 	 (Xml_interface_file_analyzer::is_interface_file($appXmlDir . DIR_SEP . $file)) &&
 	 ($fileItems[0]!==$actIntName))
 	 {
 	 	$fileContents = file($appXmlDir . DIR_SEP . $file);
 	 	foreach($fileContents as $content)
 	 	{
 	 		if(strpos($content,$actIntName)!==false)
 	 		 return true;
 	 	}
 	 }
 	}
 	return false;
 }
}

?>