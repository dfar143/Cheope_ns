<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("filesystem.const.php");
require_once("Json_serializer.class.php");
require_once("Creator.tra.php");

//
// Carica le informazioni sui messaggi da file json con
// formato {"ConstPrefix":{"YConstSuffix1":"YLabel1",....}}
//


class PhpMsgsGen
{
 const LOCALE_DEFAULT = STRING_NULL;
	
 private $dir=STRING_NULL;
 private $fileName=STRING_NULL;
 private $locale=self::LOCALE_DEFAULT;
 
 function __construct(string $actFileName)
 {
 	$this->fileName = $actFileName;
 }
 
 static function createJsonSerializer(string $actFileName)
 {
 	return Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),STRING_NULL,$actFileName);
 }
 
 function getLocale()
 {
 	return $this->locale;
 }
 
 function setLocale(string $actLocale)
 {
 	$this->locale = $actLocale;
 }
 
 function getDir()
 {
 	return $this->dir;
 }
 
 function setDir(string $actDir)
 {
 	$this->dir = $actDir;
 }
 
 function getFileName()
 {
 	return $this->fileName;
 }
 
 function setFileName(string $actFileName)
 {
 	$this->fileName = $actFileName;
 }
 
 function constsGenExec(string $actSuffix)
 {
 	$locale = $this->getLocale();
 	$dir = $this->getDir();
 	$fileName = $this->getFileName();
 	$fileName = $fileName . FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX;
 	$path = ($dir == STRING_NULL)?($fileName):($dir . DIR_SEP . $fileName);
 	$jsonSerializer = self::createJsonSerializer($path);
 	$jsonSerializer->loadData();
  $items = $jsonSerializer->getItems();
  $localizzazioni = $items;
  $objs=array();
  if(is_array($localizzazioni))
  {
   foreach($localizzazioni as $locale1)
   {
    if ($locale1["locale"] == $locale)
   	 $objs = $locale1["items"];
   } 	
 	 foreach($objs as $ind=>$obj)
 	 {
 		if($ind==$actSuffix)
 		{
 		 $strings = $obj;
 		 foreach($strings as $ind1=>$string)
 		 {
 		 	if(! defined(strToUpper($actSuffix . VAR_SEP . $ind1)))
 		 	define(strToUpper($actSuffix . VAR_SEP . $ind1), $string);
 		 }
 	  }
 	 }
 	}
 }
 
}
?>