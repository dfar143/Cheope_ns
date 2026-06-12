<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("Serializer.class.php");
require_once("Creator.tra.php");

//
// Permette serializzazione e deserializzazione generico array
// Php (non object).
// Il nome dei tags è formata da due parti 1)"ind_" 2)<index>
// questo perchè il gestore DOMDocument xml non permette 
// la gestione dei tag numerici
//   

class Xml_serializer extends Serializer
{
	Use Creator;
	
	const ROOT_TAG = "Items";
	const TAGS_SUFFIX = "ind" . VAR_SEP;
	const XML_DIR = THIS_DIR . DIR_SEP . XML_ACRONYM;
	
	private $dir = STRING_NULL;
	private $tagsSuffix = Xml_serializer::TAGS_SUFFIX;
	private $doc=null;
	private $root=null;
	
	function __construct(string $actFileName=STRING_NULL)
	{
		parent::__construct($actFileName);
		$doc = Creator::create("DOMDocument",STRING_BACKSLASH,"1.0");
		$this->setDoc($doc);
	  $root = $doc->createElement(self::ROOT_TAG);
	  $doc->appendChild($root);
    $this->setRoot($root);
	}
	
	function setTagsSuffix(string $actTagsSuffix):void
	{
		$this->tagsSuffix = $actTagsSuffix;
	}
	
	function getTagsSuffix():string
	{
		if($this->tagsSuffix == STRING_NULL)
		 return self::TAGS_SUFFIX;
		else
		 return $this->tagsSuffix;
	}	
	
	function setDir(string $actDir):void
	{
		$this->dir =$actDir;
	}
	
	function getDir():string
	{
		return $this->dir;
	}
	
	function setDoc(\DOMDocument $actDoc):void
	{
		$this->doc = $actDoc;
	}
	
	function getDoc():\DOMDocument
	{
		return $this->doc;
	}
	
	function setRoot(\DOMElement $actRoot):void
	{
		$this->root = $actRoot;
	}
	
	function getRoot():\DOMElement
	{
		return $this->root;
	}
	
	
	function loadItemsRecurse(\DOMElement $actFatherNode,
	string $actItemName,array|string $actItems):void
	{
	 $doc = $this->getDoc();
   $tagsSuffix = $this->getTagsSuffix();
   
   if(is_array($actItems))
   {
 	  $el = $doc->createElement($tagsSuffix . (string)$actItemName);
	  $el = $actFatherNode->appendChild($el);   
	  foreach($actItems as $itemName=>$itemVal)
	  {	  
	   	$this->loadItemsRecurse($el,$itemName,$itemVal);
	  }
	  $el->setAttribute("type","array");
	  $el->setAttribute("id",$actItemName); 	  
   }
   else
   {
	 	$item = $actItems;
	 	if(is_bool($item))
	   if($item)
	   	 $item = "true";
	   else
	   	 $item = "false";
	 	$el = $doc->createElement($tagsSuffix . (string)$actItemName,(string)$item);
	 	$el = $actFatherNode->appendChild($el);
	 	$el->setAttribute("type","scalar"); 
	  $el->setAttribute("id",$actItemName);
   }
	}
	
	
	function loadItems(array|string $actItems=STRING_NULL):void
	{
		$doc = $this->getDoc();
		$root = $this->getRoot();
		if($actItems == STRING_NULL)
		{
		 $items = $this->getItems();
	  }
	  else
	   $items = $actItems;
	   
	  if(is_array($items))
	  {
	   foreach($items as $ind=>$val)
	   {
	    $this->loadItemsRecurse($root,$ind,$val);
	   }
	  }
	  else
	  {
	 	 $root->nodeValue = $items; 
	  } 
	}
	
	function saveData():void
	{
		$doc = $this->getDoc();
		$fileName = $this->getFileName();
		$dir = $this->getDir();
		$doc->formatOutput = true;
		$doc->save((($dir != STRING_NULL)?($dir . DIR_SEP . $fileName):($fileName)));
	}
	
	function loadDataRecurse(\SimpleXMLElement $actItem,string &$actInd):string|array
	{
	 $values = array();
	 $loadedValues = array();
	 
	 if($actItem['type']=="array")
	 {
	 	foreach($actItem->children() as $itemVal)
	 	{
     $value = $this->loadDataRecurse($itemVal,$actInd);
	 	 $values[$actInd] = $value;
	 	}
	 	$actInd = (string)$actItem['id'];
	 	$loadedValues = $values;
	 }
	 elseif($actItem['type']=="scalar")
	 {
	 	$actInd=(string)$actItem['id'];
	 	if(is_numeric($actInd))
	 		$actInd = (int)$actInd;
	 	$loadedValues = (string)$actItem;
	 }
	 else
	 {
    $loadedValues = (string)$actItem;
	 }
	 return $loadedValues;
	}
	
	function getRootFields():array
	{
		$this->loadData();
		$items = $this->getItems();
		$rootFields = array();
		$i=0;
		foreach($items as $ind=>$val)
		{
			if($i==0)
			{
			 if(is_array($val))	
			 {
			 	$j=0;
			 	foreach($val as $ind2=>$val2)
			 	 $rootFields[$j++]=$ind2;
		   }
		  }
		}
		return $rootFields;
	}
	
	function loadData():void
	{
	 $loadedValues = array();
	 $values = array();
	 $fileName = $this->getFileName();
	 $dir = $this->getDir();
	 $path=((($dir != STRING_NULL)&&(strpos($fileName,DIR_SEP)===false))
	 ?($dir . DIR_SEP . $fileName):($fileName));
   $ind = STRING_NULL;
   
	 $xml = simplexml_load_file($path);
	 foreach($xml->children() as $item)
	 {
	 	$values = $this->loadDataRecurse($item,$ind);
	  $loadedValues[$ind] = $values;
	 }
	 $this->setItems($loadedValues);
	}
	
}	
	
?>