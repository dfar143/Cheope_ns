<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("Serializer.class.php");

class Json_serializer extends Serializer
{
	const JSON_DIR = STRING_POINT . STRING_SLASH . JSON_ACRONYM;	
	
	private $dir = Json_serializer::JSON_DIR;
	private $jsonStr = STRING_NULL;
	private $root = STRING_NULL;
	private $overWrite = false;
	const ERROR_1 = "Errore in scrittura Json_serializer.saveData.";
	
	function __construct(string $actFileName=STRING_NULL)
	{
		parent::__construct($actFileName);
	}
	
	function setOverwrite(bool $actOverwrite):void
	{
		$this->overwrite = $actOverwrite;
	}
	
	function getOverwrite():bool
	{
		return $this->overwrite;
	}
	
	function setDir(string $actDir):void
	{
		$this->dir =$actDir;
	}
	
	function getDir():string
	{
		return $this->dir;
	}
	
	function setJsonStr(string $actJsonStr):void
	{
		$this->jsonStr = $actJsonStr;
	}
	
	function getJsonStr():string
	{
		return $this->jsonStr;
	}
	
	function loadItems(array|string $actItems=STRING_NULL):void
	{
		$jsonStr = $this->getJsonStr();
		if($actItems == STRING_NULL)
		{
		 $items = $this->getItems();
	  }
	  else
	   $items = $actItems;
	  $jsonStr = json_encode($items);
	  $this->setJsonStr($jsonStr);
	}
	
	function saveData():void
	{
		$jsonStr = $this->getJsonStr();
		$fileName = $this->getFileName();
    $overwrite = $this->getOverwrite();
    if($overwrite)
     $mode = "w";
    else
     $mode = "a";
    $handle = fopen($fileName,$mode);
    if (! fwrite($handle,$jsonStr))
     die(self::ERROR_1);  
    fclose($handle);
	}
	
	function getRootFields():array
	{
		$this->loadData();
		$items = $this->getItems();
		$rootFields = array();
		$i=0;
		foreach($items as $ind=>$val)
		{
			$rootFields[$i++]=$ind;
		}
		return $rootFields;
	}
	
   function prepareJSON(string $actInput):string {
    
    //This will convert ASCII/ISO-8859-1 to UTF-8.
    //Be careful with the third parameter (encoding detect list), because
    //if set wrong, some input encodings will get garbled (including UTF-8!)
    $input = mb_convert_encoding($actInput, 'ISO-8859-1', 'UTF-8');
    
    //Remove UTF-8 BOM if present, json_decode() does not like it.
    if(substr($input, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) $input = substr($input, 3);
    
    return $input;
  }


	
	function loadData():void
	{
	 $fileName = $this->getFileName();
	 $dir = $this->getDir();
	 $path=((($dir != STRING_NULL)&&(strpos($fileName,DIR_SEP)==false))
	 ?($dir . DIR_SEP . $fileName):($fileName));
   $handle = fopen($fileName,"r");
   $jsonStr = fread($handle,filesize($fileName));
   fclose($handle);
   $values = json_decode($jsonStr,true);
   //echo json_last_error();
	 //print_r($values);
	 $this->setItems($values);
	}
	
}	
	
?>