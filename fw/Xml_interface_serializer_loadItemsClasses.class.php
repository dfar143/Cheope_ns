<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("class.const.php");
require_once("Classes_info.class.php");
require_once("Executable.int.php");
require_once("Factory_4.int.php");
require_once("Creator.tra.php");

abstract class LoadItems_base implements Executable
{
//	const ERROR_1="LoadItems_base:Documento nullo.";
//	const ERROR_2="LoadItems_base:Node padre nullo.";
	const ERROR_3="LoadItems_base:Item name nullo.";
	
	
	protected $items;
	protected $itemName=STRING_NULL;
	protected $doc=null;
	protected $fatherNode=null;
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode)
	{
		$this->setItems($actItems);
		$this->setDoc($actDoc);
		$this->setFatherNode($actFatherNode);
		$this->setItemName($actItemName);
	}
	
	function getItems():mixed
	{
		return $this->items;
	}
	
	function setItems(mixed $actItems):void
	{
		$this->items=$actItems;
	}
	
	function getDoc():\DOMDocument
	{
		return $this->doc;
	}
	
	function setDoc(\DOMDocument $actDoc):void
	{
		$this->doc=$actDoc;
	}	
	
	function getFatherNode():\DOMElement
	{
		return $this->fatherNode;
	}
	
	function setFatherNode(\DOMElement $actFatherNode):void
	{
		$this->fatherNode=$actFatherNode;
	}
	
	function getItemName():string
	{
		return $this->itemName;
	}
	
	function setItemName(string $actItemName):void
	{
		//if($actItemName===STRING_NULL)
		// die(self::ERROR_3);
		$this->itemName = $actItemName;
	}
	
	function getShortItemNameFromItemName():string
	{
	 $itemName = $this->getItemName();
   $firstChar = substr($itemName,0,1);
   if(($firstChar==STRING_AT)||($firstChar==STRING_PERCENT)||
   ($firstChar==STRING_DOLLAR)||($firstChar==STRING_STAR))
   {
    $shortItemName = substr($itemName,1,strlen($itemName)-1); 
   }
   else
    $shortItemName = $itemName;
   return $shortItemName;
	}
	
}

class LoadItems_array extends LoadItems_base
{
	const ERROR_1="LoadItems_array:Oggetto caller nullo.";
	private $callerObj=null;
	
	function getCallerObj():?object 
	{
		return $this->callerObj;
	}
	
	function setCallerObj(?object $actCallerObj)
	{
		$this->callerObj = $actCallerObj;
	}
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,$actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$callerObj = $this->getCallerObj();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();
		
    $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	  $el = $fatherNode->appendChild($el);
	  foreach($items as $itemName=>$itemVal)
	  {	  
	   	$callerObj->loadItemsRecurse($el,$itemName,$itemVal);
    }
	  $el->setAttribute("type","array");
	  $el->setAttribute("id",$aItemName); 
	}
}

class LoadItems_container extends LoadItems_base
{
	// const ERROR_1="LoadItems_container:Oggetto caller nullo.";
	private $callerObj=null;
	
	function getCallerObj():?object
	{
		return $this->callerObj;
	}
	
	function setCallerObj(?object $actCallerObj)
	{
		$this->callerObj = $actCallerObj;
	}
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,$actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$callerObj = $this->getCallerObj();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();
      $scope = $callerObj->getScope();	 
      $scope1 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;		
	  $iter = $items->create();
	  $iter->reset();
	  $i=0;
	  $el = $doc->createElement("ind" . VAR_SEP . $shortItemName);
	  $el = $fatherNode->appendChild($el);   	  
	  while($iter->hasMore())
	  {
	   $itemVal = $iter->current();
	   if(is_string($itemVal) || is_a($itemVal,$scope1))
	    $callerObj->loadItemsRecurse($el,$i++,$itemVal);
	   $iter->next(); 	  	 		
	  }
	  $el->setAttribute("type","container");
	  $el->setAttribute("id",$aItemName);  
	}
}

class LoadItems_generic_interface extends LoadItems_base
{
  const INTERFACE_NAME_SEP=STRING_EXCLAMATION_MARK;	
	
	private $pageName=STRING_NULL;
	private $appName=STRING_NULL;
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,$actFatherNode);
	}
	
	function setPageName(string $actPageName)
	{
		$this->pageName=$actPageName;
	}
	
	function getPageName():string
	{
		return $this->pageName;
	}
	
	function setAppName(string $actAppName):void
	{
		$this->appName=$actAppName;
	}
	
	function getAppName():string
	{
		return $this->appName;
	}
	
	function exec():void
	{
		$pageName = $this->getPageName();
		$appName = $this->getAppName();
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();		
		
	  $itemCode = $items->getCompleteInterfaceId(self::INTERFACE_NAME_SEP);
	  $itemPageName = $items->getPageName();
	  if($itemPageName!=STRING_NULL)
	   $pageName = $itemPageName;
	  $itemAppName = $items->getAppName();
	  if($itemAppName!=STRING_NULL)
	   $appName = $itemAppName;
	  $shortName = $items->getShortName();
	  	  
	  if((Html_formatted_interface::$useShortNameAsInterfaceId)&&($shortName!==STRING_NULL))
		{
			$itemCode = $shortName;
		}
		else
     $itemCode = $appName . self::INTERFACE_NAME_SEP . 
	   $pageName . self::INTERFACE_NAME_SEP . $itemCode;	
	    	  
	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);	  
	 	$el1 = $fatherNode->appendChild($el);
	 	$el->setAttribute("type","interface");
	 	$el->setAttribute("id",$aItemName);
    $el2 = $doc->createCDATASection((string)$itemCode);
    $el3 = $el1->appendChild($el2);
	}
}

class LoadItems_generic_interface_as_string extends LoadItems_base
{
  const INTERFACE_NAME_SEP = STRING_EXCLAMATION_MARK;	
	
	private $pageName=STRING_NULL;
	private $appName=STRING_NULL;
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,$actFatherNode);
	}
	
	function setPageName(string $actPageName):void
	{
		$this->pageName=$actPageName;
	}
	
	function getPageName():string
	{
		return $this->pageName;
	}
	
	function setAppName(string $actAppName):void
	{
		$this->appName=$actAppName;
	}
	
	function getAppName():string
	{
		return $this->appName;
	}
	
	function exec():void
	{
	//	$pageName = $this->getPageName();
	//	$appName = $this->getAppName();
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();		
		
	  $itemCode = $items->getItemName();
	//  $itemCodes = explode(STRING_EXCLAMATION_MARK,$itemCode);  
	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	 	$el1 = $fatherNode->appendChild($el);
	 	$el->setAttribute("type","interface");
	 	$el->setAttribute("id",$aItemName);
    $el2 = $doc->createCDATASection((string)$itemCode);
    $el3 = $el1->appendChild($el2);
	}
}

class LoadItems_db_item extends LoadItems_base
{
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,
		$actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();	
	 	$itemCode = $items->getAliasName();
	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	 	$el1 = $fatherNode->appendChild($el);
	 	$el->setAttribute("type","db_item");
	 	$el->setAttribute("id",$aItemName);
    $el2 = $doc->createCDATASection((string)$itemCode);
    $el3 = $el1->appendChild($el2);	 	 
	}
}

class LoadItems_xml_node extends LoadItems_base
{
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,
		$actDoc,
		$actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();	
	 	$itemCode = $items->getNodeName();
	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	 	$el1 = $fatherNode->appendChild($el);
	 	$el->setAttribute("type","xml_node");
	 	$el->setAttribute("id",$aItemName);
    $el2 = $doc->createCDATASection((string)$itemCode);
    $el3 = $el1->appendChild($el2);	 	 
	}
}

class LoadItems_json_node extends LoadItems_base
{
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,$actDoc,
		 $actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();	
	 	$itemCode = $items->getNodeName();
	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	 	$el1 = $fatherNode->appendChild($el);
	 	$el->setAttribute("type","json_node");
	 	$el->setAttribute("id",$aItemName);
    $el2 = $doc->createCDATASection((string)$itemCode);
    $el3 = $el1->appendChild($el2);			
	}
}

class LoadItems_otherwise extends LoadItems_base
{
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,\DOMElement $actFatherNode)
	{
		parent::__construct($actItems,$actItemName,
		$actDoc,
		$actFatherNode);
	}
	
	function exec():void
	{
		$doc = $this->getDoc();
		$items = $this->getItems();
		$fatherNode = $this->getFatherNode();
		$aItemName = $this->getItemName();
		$shortItemName = $this->getShortItemNameFromItemName();	

	 	if(! is_object($items))
	 	{
	 	 if(is_bool($items))
	   	if($items)
	   	  $items = "true";
	   	else
	   	  $items = "false";
	   	//$items = utf8_encode($items);
	 	  $el = $doc->createElement("ind" . VAR_SEP . $shortItemName);
	 	  $el->setAttribute("type","scalar"); 
	 	  $el->setAttribute("id",$aItemName);
	 	  $el1 = $fatherNode->appendChild($el);
      $el2 = $doc->createCDATASection((string)$items);
      $el3 = $el1->appendChild($el2);
	   }
	   else
	   {
	  	$itemCode = serialize($items);
	 	  $el = $doc->createElement("ind" . VAR_SEP . (string)$shortItemName);
	 	  $el->setAttribute("type","object");
	 	  $el->setAttribute("id",$aItemName);
	 	  $el1 = $fatherNode->appendChild($el);
      $el2 = $doc->createCDATASection((string)$itemCode);
      $el3 = $el1->appendChild($el2);
	   }   	
	}
}


class LoadItems_factory implements Factory_4
{
	Use Creator;
	
	const INTERFACES_DIR = "interfaces";
	
	private $items;
	private $doc=null;
	private $fatherNode=null;
	private $itemName=STRING_NULL;
	private $scope=Classes_info::CLASSES_INFO_CLASS;
	
	function __construct(mixed $actItems,string $actItemName,
	\DOMDocument $actDoc,
	\DOMElement $actFatherNode,
	string $actScope)
	{
		$this->setItems($actItems);
		$this->setDoc($actDoc);
		$this->setFatherNode($actFatherNode);
		$this->setItemName($actItemName);
		$this->setScope($actScope);
	}
	
	function setStatus(string $actStatus):void
	{
	 $this->status = $actStatus;
	}
	
	function getStatus():string
	{
	 return $this->status;
	}
	
	function setScope(string $actScope):void
	{
		$this->scope = $actScope;
	}
	
	function getScope():string
	{
		return $this->scope;
	}	
	
	function setItems(mixed $actItems):void
	{
		$this->items = $actItems;
	}
	
	function getItems():mixed
	{
		return $this->items;
	}
	
	function setDoc(\DOMDocument $actDoc):void
	{
		$this->doc = $actDoc;
	}
	
	function getDoc():\DOMDocument
	{
		return $this->doc;
	}
	
	function setFatherNode(\DOMElement $actFatherNode):void
	{
		$this->fatherNode = $actFatherNode;
	}
	
	function getFatherNode():\DOMElement
	{
		return $this->fatherNode;
	}
	
	function getItemName():string
	{
		return $this->itemName;
	}
	
	function setItemName(string $actItemName):void
	{
		$this->itemName = $actItemName;
	}
	
	function create($actCallerObj=null,
	string $actAppName=STRING_NULL,
	string $actPageName=STRING_NULL):object
	{
	 $items = $this->getItems();
	 $doc = $this->getDoc();
	 $fatherNode = $this->getFatherNode();
	 $itemName = $this->getItemName();
	 $scope = $this->getScope();
	 
   $scope1 = $scope . STRING_BACKSLASH . GENERIC_CONTAINER_CLASS;
   //echo $scope1;
   $scope2 = $scope . STRING_BACKSLASH . CONTAINER_ASSOCIATIVE_CLASS;
   $scope3 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
   $scope4 = $scope . STRING_BACKSLASH . XML_NODE_CLASS;
   $scope5 = $scope . STRING_BACKSLASH . JSON_NODE_CLASS;
   $scope6 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;
   $scope7 = $scope . STRING_BACKSLASH . GENERIC_INTERFACE_CLASS;
   
	 /*if(is_string($items))
	 	 $fileName = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP . 
	 	 self::INTERFACES_DIR . DIR_SEP . $items;*/

   if(is_array($items))
   {
   	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_ARRAY_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);
   	$obj->setCallerObj($actCallerObj);
   }
	 elseif(is_a($items,$scope1)||
	 is_a($items,$scope2))
	 { 
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_CONTAINER_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);
	 	$obj->setCallerObj($actCallerObj);
	 }
	 elseif(is_a($items,$scope3))
	 { 
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_DB_ITEM_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);		 	
	 }
	 elseif(is_a($items,$scope4))
	 {
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_XML_NODE_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode); 		 	
	 }
	 elseif(is_a($items,$scope5))
	 { 	
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_JSON_NODE_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);	 	
	 }
	 elseif(is_a($items,$scope6)  && ($actCallerObj->getLoadInterfaceAsString()))
	 {
		// $fatherId = $fatherNode->getAttribute("id");
		// die($fatherId);
	 	 $obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_GENERIC_INTERFACE_AS_STRING_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);
	 } 
	 elseif(is_a($items,$scope7))
	 {
	 	//$obj = Creator::create("LoadItems_generic_interface_as_string",$scope,$items,$itemName,$doc,$fatherNode);	 	
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_GENERIC_INTERFACE_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);
	 	$obj->setAppName($actAppName);
	 	$obj->setPageName($actPageName);
	 }
   else
   {
   	/*if(is_object($items))
   	{
   	 echo $scope3;
   	 die(get_class($items));
    }*/
	  //  var_dump($items);
	//	die('kkkkkkk');
	 	$obj = Creator::create(getClassNameForCreate(Classes_info::LOADITEMS_OTHERWISE_CLASS),STRING_NULL,$items,$itemName,$doc,$fatherNode);
   	//$obj = new LoadItems_otherwise($items,$itemName,$doc,$fatherNode);
   }
   return $obj;		
	}
}

?>