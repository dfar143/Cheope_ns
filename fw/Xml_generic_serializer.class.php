<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Serializer.class.php");
require_once("Creator.tra.php");

//
// Serializzatore-Deserializzatore file xml generico 
// Se l'array contiene un solo elemento usa l'indice come
// root.
// Gestisce anche i file xml con root uguale a "Items" 
// Non gestisce i file xml con tag numerico e viceversa
// non serializza gli array php a base numerica.
//

class Xml_generic_serializer extends Serializer
{
	Use Creator;
	
  const ROOT_TAG="Items";
  
	private $doc=null;
	private $root=null;
	
	function __construct(string $actFileName=STRING_NULL)
	{
		parent::__construct($actFileName);
		$doc = Creator::create("DOMDocument","\\","1.0");
		$this->setDoc($doc);
	  $root = $doc->createElement(self::ROOT_TAG);
	  $doc->appendChild($root);
    $this->setRoot($root);
	}
	
	function resetRoot():void
	{
	 $root = $this->getRoot();
	 $doc=$this->getDoc();
	 $newRoot = $doc->createElement(self::ROOT_TAG);
	 $this->setRoot($newRoot);
	 $doc->removeChild($root);
	 $doc->appendChild($newRoot);				
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
	
	
	function loadItemsRecurse(\DOMElement $actFatherNode,string $actItemName,$actItems):void
	{
	 $doc = $this->getDoc();

   if(is_array($actItems))
   {
   	$el = $doc->createElement((string)$actItemName);
	  foreach($actItems as $itemName=>$itemVal)
	  {	 
	   $this->loadItemsRecurse($el,$itemName,$itemVal);
    }
    $el = $actFatherNode->appendChild($el);
   }
   else
   {
	 	$item = $actItems;
	 	if(is_bool($item))
	   if($item)
	   	 $item = "true";
	   else
	   	 $item = "false";
	 	$el = $doc->createElement((string)$actItemName,(string)$item);
	 	$el = $actFatherNode->appendChild($el); 
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
	   
	  if(is_array($items) && (count($items)>1))
	  {
	   foreach($items as $ind=>$val)
	   {
	    $this->loadItemsRecurse($root,$ind,$val);
	   }
	  }
	  elseif(is_array($items) && (count($items)==1))
	  {
	   $rootName = key($items);
	   $newRoot = $doc->createElement($rootName);
	   $this->setRoot($newRoot);
	   $doc->replaceChild($newRoot,$root);
	   $items = current($items);
	   foreach($items as $ind=>$val)
	   {
	    $this->loadItemsRecurse($newRoot,$ind,$val);
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
		$doc->formatOutput = true;
		$doc->save($fileName);
	}
	
	function loadDataRecurse(\SimpleXMLElement $actItem,string &$ind):array|string
	{
	 $values = array();
	 $loadedValues = array();
	 
	 if($actItem->count()>0)
	 {
	 	foreach($actItem->children() as $itemVal)
	 	{
     $value = $this->loadDataRecurse($itemVal,$ind);
	 	 $values[$ind] = $value;
	 	}
	 	$ind = $actItem->getName();
	 	if(is_numeric($ind))
	 		$ind = (int)$ind;
	 	$loadedValues = $values;
	 }
	 else
	 {
	 	$ind=$actItem->getName();
	 	if(is_numeric($ind))
	 		$ind = (int)$ind;
	 	$loadedValues = (string)$actItem;
	 }
	 return $loadedValues;
	}
	
	function loadData():void
	{
	 $loadedValues = array();
	 $values = array();
	 $fileName = $this->getFileName();
   $ind = STRING_NULL;
   
	 $xml = simplexml_load_file($fileName);
	 if($xml->getName() == self::ROOT_TAG)
	 {
	  $xmlItems = $xml->children();
	  foreach($xmlItems as $item)
	  {
	 	 $values = $this->loadDataRecurse($item,$ind);
	 	 $loadedValues[$ind] = $values;
	  }
	 }
	 else
	 {
	  $xmlItem = $xml;
	  $values = $this->loadDataRecurse($xmlItem,$ind);
	  $loadedValues[$ind] = $values;
   }
	 $this->setItems($loadedValues);
	}
	
}	
	
?>