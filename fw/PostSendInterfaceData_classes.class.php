<?
namespace Cheope_ns\fw;
require_once("class.const.php");
require_once("Factory_7.int.php");
require_once("Executable_2.int.php");
require_once("Creator.tra.php");

abstract class PostSendInterfaceData_base implements Executable_2 
{
	private $ind=STRING_NULL;
	private $val=STRING_NULL;
	private $doc=null;
	private $root=null;
	
	function __construct(string $actInd,string $actVal,
	\DOMDocument $actDoc=null,\DOMElement $actRoot=null)
	{
		$this->setInd($actInd);
		$this->setVal($actVal);
		$this->setDoc($actDoc);
		$this->setRoot($actRoot);
	}
	
 function setInd(string $actInd)
 {
 	$this->ind = $actInd;
 }
	
 function getInd()
 {
 	return $this->ind;
 }
 
 function setVal(string &$actVal)
 {
 	$this->val = $actVal;
 }
 
 function getVal()
 {
 	return $this->val;
 }
 
 function setDoc(\DOMDocument $actDoc)
 {
 	$this->doc = $actDoc;
 }
 
 function getDoc()
 {
 	return $this->doc;
 }
 
 function setRoot(\DOMElement $actRoot)
 {
 	$this->root = $actRoot;
 }
 
 function getRoot()
 {
 	return $this->root;
 }
 

} 

class PostSendInterfaceData_cancelletto extends PostSendInterfaceData_base
{
	const ERROR_0= "PostSendInterfaceData_cancelletto:" . MSG_59;
	const ERROR_1=  "PostSendInterfaceData_cancelletto:" . MSG_65;
	
	private $parentObj=null;
//	private $items=array();
	private $appName=STRING_NULL;
	private $pageName=STRING_NULL;
	private $dir=STRING_NULL;
	
	function __construct(string $actInd,string $actVal,
	\DOMDocument $actDoc=null,\DOMElement $actRoot=null)
	{
		parent::__construct($actInd,$actVal,$actDoc,$actRoot);
	}
	
	function setDir(string $actDir):void
  {
  	$this->dir = $actDir;
  }
  
  function getDir():string
  {
  	return $this->dir;
  }
	
	function setAppName(string $actAppName):void
	{
		$this->appName = $actAppName;
	}
	
	function getAppName():string
	{
		return $this->appName;
	}
	
	function setPageName(string $actPageName):void
	{
		$this->pageName=$actPageName;
	}
	
	function getPageName():string
	{
		return $this->pageName;
	}
	
	function setParentObj(AjaxOp $actObj):void
	{
		$this->parentObj = $actObj;
	}
	
	function getParentObj():AjaxOp
	{
		return $this->parentObj;
	}
	
	function is_interface(string $actItem):bool {
		$appName = $this->getAppName ();
		$pageName = $this->getPageName ();
		$dir = $this->getDir ();
		$items = Generic_interface::decodeInterfaceId ( $actItem, Xml_interface_serializer::INTERFACE_NAME_SEP );
		$num = count ( $items );
		if (($actItem !== STRING_NULL) && file_exists ( $dir . DIR_SEP . $actItem ) && Xml_interface_file_analyzer::is_free_interface_file ( $dir . DIR_SEP . $actItem )) {
			$intFileName = $actItem;
			$intFreeAppName = Xml_interface_file_analyzer::getScalarProperty ( $dir . DIR_SEP . $intFileName, "appName" );
			if ($intFreeAppName == $appName)
				return true;
		} elseif (($items [0] == $appName) && (($num == 5) || ($num == 6)))
			return true;
		else
			return false;
	}
	
	function loadRecurse(\DOMElement $actFatherNode, string $actItemName,string|array $actItems):void {
		$doc = $this->getDoc ();
		$appName = $this->getAppName ();
		$pageName = $this->getPageName ();
		$parentObj = $this->getParentObj();
		
		$fatherId = $actFatherNode->getAttribute ( "id" );
		if (is_array ( $actItems )) {
			$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName );
			$el = $actFatherNode->appendChild ( $el );
			$el->setAttribute ( "id", $actItemName );
			foreach ( $actItems as $itemName => $itemVal ) {
				$this->loadRecurse ( $el, $itemName, $itemVal );
			}
			$el->setAttribute ( "type", "array" );
		} elseif ($this->is_interface ( $actItems ) && ($fatherId == "dataFieldsDomainsValues")) {
			$dataFieldsDomains = $parentObj->getDataFieldsDomains ();
			if ($dataFieldsDomains [( int ) $actItemName] == "object") {
				$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName );
				$el = $actFatherNode->appendChild ( $el );
			  $el2 = $doc->createCDATASection ( ( string ) $actItems );
			  $el2 = $el->appendChild ( $el2 );
				$el->setAttribute ( "type", "interface" );
				$el->setAttribute ( "id", $actItemName );
			} else {
				$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName );
				$el = $actFatherNode->appendChild ( $el );
				$el2 = $doc->createCDATASection ( ( string ) $actItems );
				$el2 = $el->appendChild ( $el2 );
				$el->setAttribute ( "type", "scalar" );
				$el->setAttribute ( "id", $actItemName );
			}
		} elseif ($this->is_interface ( $actItems ) && (($fatherId == "interfacesContainer")||
		($fatherId == "interfacesContainerTop")||($fatherId == "interfacesContainerCenter")||
		($fatherId == "interfacesContainerBottom"))) {
			$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName);
			$el = $actFatherNode->appendChild ( $el );
			$el2 = $doc->createCDATASection ( ( string ) $actItems );
			$el2 = $el->appendChild ( $el2 );
			$el->setAttribute ( "type", "interface" );
			$el->setAttribute ( "id", $actItemName );
		} elseif ($fatherId == "dataFieldsDomainsValues") {
			$dataFieldsDomains = $parentObj->getDataFieldsDomains ();
			if ($dataFieldsDomains [( int ) $actItemName] == "object") {
				die ( self::ERROR_1 );
			}
			$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName );
			$el = $actFatherNode->appendChild ( $el );
			$el2 = $doc->createCDATASection ( ( string ) $actItems );
			$el2 = $el->appendChild ( $el2 );
			$el->setAttribute ( "type", "scalar" );
			$el->setAttribute ( "id", $actItemName );
		} else {
			$el = $doc->createElement ( "ind" . VAR_SEP . ( string ) $actItemName );
			$el = $actFatherNode->appendChild ( $el );
			$el2 = $doc->createCDATASection ((string)$actItems);
			$el2 = $el->appendChild ( $el2 );
			$el->setAttribute ( "type", "scalar" );
			$el->setAttribute ( "id", $actItemName );
		}
	}

	
	function exec(array &$actItems)
	{	
	  $ind = $this->getInd();
	  $val = $this->getVal();	
	  $doc = $this->getDoc(); 
    $root = $this->getRoot();   
		$parentObj = $this->getParentObj();	
		
		$strCode = "\$nextItem = $val;";
		eval ( $strCode );
	  if (is_array ( $nextItem )) {
		 $itemKey = substr ( $ind, 1, strlen ( $ind ) - 1 );
		 $suffix = substr ( $itemKey, 0, 1 );
		 $itemKeyId = $itemKey;
		 if ($suffix == '$')
			$itemKey = substr ( $itemKey, 1, strlen ( $itemKey ) - 1 );
			$el2 = $doc->createElement ( "ind" . VAR_SEP . $itemKey );
			$el2 = $root->appendChild ( $el2 );
			$el2->setAttribute ( "type", "array" );
			$el2->setAttribute ( "id", $itemKeyId );
			if ($itemKey == "dataFieldsDomains")
				$parentObj->setDataFieldsDomains ( $nextItem );
			foreach ( $nextItem as $itemName => $itemVal ) {
				$this->loadRecurse ( $el2, $itemName, $itemVal );
			}
		} else
		die ( self::ERROR_0 );
		
		return null;   	  
	}
	
}

class PostSendInterfaceData_barra extends PostSendInterfaceData_base
{

	function __construct(string $actInd,string $actVal,\DOMDocument $actDoc,\DOMElement $actRoot)
	{
		parent::__construct($actInd,$actVal,$actDoc,$actRoot);
	}
	
	function exec(array &$actItems)
	{	
	 $ind = $this->getInd();
	 $val = $this->getVal();	
	 $doc = $this->getDoc();  
   $root = $this->getRoot();  
	 $ind = substr ( $ind, 1, strlen ( $ind ) - 1 );
	 $el2 = $doc->createElement ( "ind" . VAR_SEP . $ind );
	 $el2->setAttribute ( "type", 'container' );
	 $el2->setAttribute ( "id", $ind );
	 $el2 = $root->appendChild ( $el2 );
	 if ($val != STRING_NULL) {
		$valItems = explode ( STRING_SEMICOLON, $val );
		$num = count ( $valItems );
		for($i = 0; $i <= $num - 1; $i ++) {
		 $valItemEl = $valItems [$i];							
		 $el3 = $doc->createElement ( "ind" . VAR_SEP . $i);
		 $el4 = $doc->createCDATASection ($valItemEl );
		 $el4 = $el3->appendChild ( $el4 );
		 $el3->setAttribute ( "type", 'interface' );
		 $el3->setAttribute ( "id", $i );
		 $el3 = $el2->appendChild ( $el3 );
		} 
	 } 
	 return null;   
	}
}

class PostSendInterfaceData_decorated_obj extends PostSendInterfaceData_base
{

	function __construct(string $actInd,string $actVal,\DOMDocument $actDoc,\DOMElement $actRoot)
	{
		parent::__construct($actInd,$actVal, $actDoc, $actRoot);
	}
	
	function exec(array &$actItems)
	{
	 $ind = $this->getInd();
	 $val = $this->getVal();	
	 $doc = $this->getDoc();
	 $root = $this->getRoot();  
	 $el2 = $doc->createElement ( "ind" . VAR_SEP . $ind);
	 $el3 = $doc->createCDATASection ($val);
	 $el3 = $el2->appendChild ( $el3 );
	 $el2->setAttribute ( "type", 'interface' );
	 $el2->setAttribute ( "id", $ind );
	 $el2 = $root->appendChild ( $el2 );	
	 return null; 			
	}
}

class PostSendInterfaceData_not_nomePagina extends PostSendInterfaceData_base
{
 private $nodeName=STRING_NULL;
 private $appName=STRING_NULL;
 private $pageName=STRING_NULL;
  
	function __construct(string $actInd,string $actVal,\DOMDocument $actDoc,\DOMElement $actRoot)
	{
		parent::__construct($actInd,$actVal,$actDoc,$actRoot);
	}

	function setAppName(string $actAppName):void
	{
		$this->appName = $actAppName;
	}
	
	function getAppName():string
	{
		return $this->appName;
	}
	
	function setPageName(string $actPageName):void
	{
		$this->pageName=$actPageName;
	}
	
	function getPageName():string
	{
		return $this->pageName;
	}
	
	function setNodeName(string $actNodeName):void
	{
		$this->nodeName = $actNodeName;
	}
	
	function getNodeName():string
	{
		return $this->nodeName;
	}

	function exec(array &$actItems)
	{
	 $ind = $this->getInd();
	 $val = $this->getVal();	
	 $doc = $this->getDoc();
	 $root = $this->getRoot();
	 $appName = $this->getAppName ();
	 $pageName = $this->getPageName ();
		
	 $itemKey = $ind;
	 if ($itemKey == "obj") {
		$nodeName = $val;
		//$fileItems = explode ( STRING_POINT, $nodeName );
	  //$num = count ( $fileItems );
						if (isAXmlDataSource($nodeName)) {
							$el2 = $doc->createElement ( "ind" . VAR_SEP . "obj");
							$nodeName1 = $nodeName;
							$nodeName = OBJ_DATA_SOURCE;
							$el2->setAttribute ( "type", 'xml_node' );
							$el2->setAttribute ( "id", "obj" );
							$el3 = $root->appendChild ( $el2 );
						  $el4 = $doc->createCDATASection ((string)$nodeName1);
			        $el4 = $el3->appendChild ( $el4 );
							//$el3 = $root->appendChild ( $el4 );
						} elseif (isAJsonDataSource($nodeName)) {
							$el2 = $doc->createElement ( "ind" . VAR_SEP . "obj");
							$nodeName1 = $nodeName;
							$nodeName = OBJ_DATA_SOURCE;
							$el2->setAttribute ( "type", 'json_node' );
							$el2->setAttribute ( "id", "obj" );
							$el3 = $root->appendChild ( $el2 );
						  $el4 = $doc->createCDATASection ((string)$nodeName1);
			        $el4 = $el3->appendChild ( $el4 );
						} elseif ($nodeName == "OBJ_NONE") {
							$el2 = $doc->createElement ( "ind" . VAR_SEP . "obj" );
							$nodeName1="OBJ_NONE";
							$el2->setAttribute ( "type", 'db_item' );
							$el2->setAttribute ( "id", "obj" );
							$el3 = $root->appendChild ( $el2 );
							$el4 = $doc->createCDATASection ((string)$nodeName1);
							$el4 = $el3->appendChild ( $el4 );
						} else {
							$el2 = $doc->createElement ( "ind" . VAR_SEP . "obj" );
							$nodeName1 = $nodeName;
							$el2->setAttribute ( "type", 'db_item' );
							$el2->setAttribute ( "id", "obj" );
							$el3 = $root->appendChild ( $el2 );
							$el4 = $doc->createCDATASection ((string)$nodeName1);
							$el4 = $el3->appendChild ( $el4 );
						}
						$this->setNodeName($nodeName);
						//die('AAAA' . $nodeName);
					} elseif (($itemKey == "checkBox_IFreeName") && ($val == "true")) {
						$el2 = $doc->createElement ( "ind" . VAR_SEP . "pageName" );
						$el2->setAttribute ( "type", 'scalar' );
						$el2->setAttribute ( "id", "pageName" );
						$el3 = $root->appendChild ( $el2 );
						$el4 = $doc->createCDATASection ( $pageName );
						$el5 = $el3->appendChild ( $el4 );
						$el2 = $doc->createElement ( "ind" . VAR_SEP . "appName" );
						$el2->setAttribute ( "type", 'scalar' );
						$el2->setAttribute ( "id", "appName" );
						$el3 = $root->appendChild ( $el2 );
						$el4 = $doc->createCDATASection ( $appName );
						$el5 = $el3->appendChild ( $el4 );
					} elseif ($itemKey != "checkBox_IFreeName") {
						$startChar = substr ( $ind, 0, 1 );
						if (($startChar == STRING_PERCENT) || ($startChar ==STRING_AT) 
						|| ($startChar ==STRING_STAR) || ($startChar == "\$"))
							$newInd = substr ( $ind, 1, strlen ( $ind ) - 1 );
						else
							$newInd = $ind;
						$el2 = $doc->createElement ( "ind" . VAR_SEP . $newInd );
						$el2->setAttribute ( "type", 'scalar' );
						$el2->setAttribute ( "id", $ind );
						$el3 = $root->appendChild ( $el2 );
						$el4 = $doc->createCDATASection ( $val );
						$el5 = $el3->appendChild ( $el4 );
						$actItems [$ind] = $val;
					}
	 return null;

	}
}


class PostSendInterfaceData_factory implements Factory_7
{
	use Creator;
	
	private $doc=null;
	private $ind=STRING_NULL;
	private $val=STRING_NULL;
	private $root=null;

 function __construct(string &$actInd,string $actVal,\DOMDocument $actDoc,\DOMElement $actRoot)
 { 	
 	$this->setDoc($actDoc);
 	$this->setInd($actInd);
 	$this->setVal($actVal);
 	$this->setRoot($actRoot);
 }

 function setDoc(\DOMDocument $actDoc):void
 {
 	$this->doc = $actDoc;
 }	
	
 function getDoc():\DOMDocument
 {
 	return $this->doc;
 }
	
 function setInd(string $actInd):void
 {
 	$this->ind = $actInd;
 }
	
 function getInd():string
 {
 	return $this->ind;
 }
 
 function setVal(string $actVal):void
 {
 	$this->val = $actVal;
 }
 
 function getVal():string
 {
 	return $this->val;
 }
 
 function setRoot(\DOMElement $actRoot):void
 {
 	$this->root = $actRoot;
 }
 
 function getRoot():\DOMElement
 {
 	return $this->root;
 }
	
 function create(AjaxOp $actParentObj,string $actAppName,string $actPageName,string $actDir):?object
 { 	
 	$ind = $this->getInd();
 	$doc = $this->getDoc();
 	$val = $this->getVal();
 	$root = $this->getRoot();
 	
 	//echo $ind;
 	//die('AAA');
 	
 	if(substr ( $ind, 0, 1 ) == STRING_CANCELLETTO)
 	{
 		$obj = Creator::create(getClassNameForCreate(Classes_info::POSTSENDINTERFACEDATA_CANCELLETTO_CLASS),STRING_NULL,$ind,$val,$doc,$root);
 		$obj->setParentObj($actParentObj);
 		$obj->setAppName($actAppName);
 		$obj->setPageName($actPageName);
 		$obj->setDir($actDir);
 	 	return $obj;
 	}
 	elseif(substr ( $ind, 0, 1 ) == '|')
 	{
 	 $obj = Creator::create(getClassNameForCreate(Classes_info::POSTSENDINTERFACEDATA_BARRA_CLASS),STRING_NULL,$ind,$val,$doc,$root);
   return $obj;
 	}
  elseif(($ind == "decoratedObj")||($ind=="innerInterface")||($ind=="bodyStructTemplate")) 	
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::POSTSENDINTERFACEDATA_DECORATED_OBJ_CLASS),STRING_NULL,$ind,$val,$doc,$root);
  	return $obj;
  }
  elseif($ind != 'Nome_pagina') 
  {
  	$obj = Creator::create(getClassNameForCreate(Classes_info::POSTSENDINTERFACEDATA_NOT_NOMEPAGINA_CLASS),STRING_NULL,$ind,$val,$doc,$root);
 		$obj->setAppName($actAppName);
 		$obj->setPageName($actPageName);
  	return $obj;
  }	
 	return null;
 }
	
}


?>