<?
namespace Cheope_ns\fw;
require_once("Xml_interface_file_analyzer.class.php");
require_once("Xml_serializer.class.php");
require_once("Xml_node.class.php");
require_once("Json_serializer.class.php");
require_once("Json_node.class.php");
require_once("Interfaces_container.class.php");
require_once("Executable_1.int.php");
require_once("Factory_3.int.php");
require_once("Interface_as_string.class.php");
require_once("Creator.tra.php");

abstract class LoadData_base implements Executable_1
{
	//const ERROR_1="LoadData_base:Item nullo.";	
	protected $item=null;
	protected $swapInt=array();
	
	function __construct(\SimpleXMLElement $actItem)
	{
		$this->setItem($actItem);
	}
	
	function getSwapInt():array
	{
	 return $this->swapInt;
	}
	
	function setSwapInt(array $actSwapInt=array()):void
	{
	 $this->swapInt = $actSwapInt;
	}
	
	function setItem(\SimpleXMLElement $actItem):void
	{
	//	if(is_null($actItem))
	//	 die(self::ERROR_1);
		$this->item = $actItem;
	}
	
	function getItem():\SimpleXMLElement
	{
		return $this->item;
	}
	
}

class LoadData_array extends LoadData_base
{
//	const ERROR_1="LoadData_array:Oggetto caller nullo.";
	
 	private $callerObj=null;
	private $loadSpecialChars=false;
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
	function getLoadSpecialChars():bool
	{
	 return $this->loadSpecialChars;
	}
	
	function setLoadSpecialChars(bool $actLoadSpecialChars):void
	{
	 $this->loadSpecialChars = $actLoadSpecialChars;
	}
	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();
 		$values=array();
	 	foreach($item->children() as $ind=>$itemVal)
	 	{ 
		 $swapInt = $this->getSwapInt();
         $value = $callerObj->loadDataRecurse($itemVal,$ind,$swapInt);
	 	 $values[$ind] = $value;
	 	}
	  $itemStr = (string)$item['id'];
	  $firstStr = substr($itemStr,0,1);
	  $loadSpecialChars = $this->getLoadSpecialChars();
	  //if((($firstStr=="\$") || ($firstStr=="*") || ($firstStr=="@"))&&(! $loadSpecialChars))
	  if((($firstStr=="\$") || ($firstStr==STRING_STAR) || ($firstStr==STRING_AT) || ($firstStr==STRING_PERCENT))&&(! $loadSpecialChars))
		$actInd = substr($itemStr,1,strlen($itemStr)-1);
	  else
	   $actInd = (string)$item['id'];
	  if(is_numeric($actInd))
	 	 $actInd = (int)$actInd;
	    
		/*echo "AAAAAAAAA";
	     echo $actInd;
	 	print_r($values);
		echo "AAAAAAAAA";
		echo "<br/>";*/
	 	
		return $values;
 	}
}

class LoadData_scalar extends LoadData_base
{
	//const ERROR_1="LoadData_scalar:Oggetto caller nullo.";
	
 	private $callerObj=null;
	private $loadSpecialChars=false;
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
// 	 if(is_null($actCallerObj))
// 	  die(self::ERROR_1);
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
	
	function getLoadSpecialChars():bool
	{
	 return $this->loadSpecialChars;
	}
	
	function setLoadSpecialChars(bool $actLoadSpecialChars):void
	{
	 $this->loadSpecialChars = $actLoadSpecialChars;
	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();
	  $itemStr = (string)$item['id'];
	  $loadSpecialChars = $this->getLoadSpecialChars();
	  //var_dump($loadSpecialChars);
	  //die('kkk');
	  $firstStr = substr($itemStr,0,1);
	  if((($firstStr=="\$") || ($firstStr==STRING_STAR) || ($firstStr==STRING_AT) || ($firstStr==STRING_PERCENT))&&(! $loadSpecialChars))
		$actInd = substr($itemStr,1,strlen($itemStr)-1);
	  else
	   $actInd = (string)$item['id'];
	  if(is_numeric($actInd))
	 	 $actInd = (int)$actInd;
	 	$item = trim((string)$item);
	 	$interpConsts = $callerObj->getInterpolateConsts();
	 	if ($interpConsts)
	 	 $item = Xml_interface_serializer::substituteConstantInString($item);
	 	$interpPars = $callerObj->getInterpolatePars();
	 	if ($interpPars)
	 	 $item = Xml_interface_serializer::substituteParsInString($item);
	 	if(($item=="true")||($item=="false"))
	 	{
	 	}
	 	else
	 	{
	 	 if(is_numeric($item))
	 	 {
	 	 	$item = $item + 0;
	 	 }
	 	 else
	 	 {
	 	  //$item = utf8_encode((string)$item);
	 	  $item = (string)$item;
	 	 }
	 	}
	 	return $item; 
 	}
}

class LoadData_big_scalar extends LoadData_base
{
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
	  $actInd = STRING_AT . (string)$item['id'];
	 	return (string)$item; 
 	}
}

class LoadData_container extends LoadData_base
{
	Use Creator;
	
//	const ERROR_1="LoadData_container:Oggetto caller nullo.";
	
 	private $callerObj=null;
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();
	  $scope = $callerObj->getScope();
	  $codeDir = $callerObj->getCodeDir();
	  
    $className = getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS);
    
    //$className = $scope1; 	
	  $actInd = (string)$item['id'];
	  if(is_numeric($actInd))
	 	 $actInd = (int)$actInd; 

    //$app = preg_split("/" . STRING_BACKSLASH . STRING_BACKSLASH . "/",$scope)[0];

      //echo "WWWWWW";
      //echo $codeDir;
	  //echo "WWWWWW";
     //echo  $scope . STRING_BACKSLASH . $className;
	 //echo $codeDir;
	 //echo APPLICATION_NAME;
	 //echo $scope;
	 
	  /*$scopeItems = explode(STRING_BACKSLASH,$scope);
	  $scopeItem = $scopeItems[0];
	  if($scopeItem !== APPLICATION_NAME)
		$codeDir = PREVIOUS_DIR . DIR_SEP . $scopeItem . DIR_SEP . FW_DIR;*/
	
	  //echo $codeDir;
	  
      $className1 = $scope . STRING_BACKSLASH . $className;	
      //$className1 = $scope1;
	
	 	 if (! IsClassDeclared($className1))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className1 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");		  
	  

	 /* if (! IsClassDeclared($scope . STRING_BACKSLASH . $className))
      {	 
	   require_once($codeDir . DIR_SEP . $className . ".class.php");
	  }	  */
	 	$newInterfacesContainer = Creator::create($className,$scope,$actInd);
	 	$i=0;
	 	$values = array();
	 	foreach($item->children() as $itemVal)
	 	{
		 $swapInt = $this->getSwapInt();
         $value = $callerObj->loadDataRecurse($itemVal,$i,$swapInt);
	 	 $values[$i++] = $value;
	 	}
	 	$newInterfacesContainer->setInterfaces($values);
	 	return $newInterfacesContainer;
 	}
}

class LoadData_interface extends LoadData_base
{
  const INTERFACE_NAME_SEP=STRING_EXCLAMATION_MARK;
 
//	const ERROR_1="LoadData_interface:Oggetto caller nullo.";
//	const ERROR_2="LoadData_interface:Oggetto grafo nodi nullo.";
//	const ERROR_3="LoadData_interface:Oggetto contenitore queries nullo.";
//	const ERROR_4="LoadData_interface:Oggetto contenitore interfacce nullo.";
			
 	private $callerObj=null;
 	private $interfacesContainer=null;
 	private $dbStruct=null;
 	private $dbQueries=null;
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
 	function setDbStruct(?object $actDbStruct):void
 	{
 		$this->dbStruct = $actDbStruct;
 	}
 	
 	function getDbStruct():?object
 	{
 		return $this->dbStruct;
 	}
 	
 	function setDbQueries(?object $actDbQueries):void
 	{
 		$this->dbQueries = $actDbQueries;
 	}
 	
 	function getDbQueries():?object
 	{
 		return $this->dbQueries;
 	}
 	
 	function setInterfacesContainer(Interfaces_container $actInterfacesContainer)
 	{
 		$this->interfacesContainer = $actInterfacesContainer;
 	}
 	
 	function getInterfacesContainer():Interfaces_container
 	{
 		return $this->interfacesContainer;
 	} 	
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();
 		$dbStruct = $this->getDbStruct();
 		$dbQueries = $this->getDbQueries();
 		$interfacesContainer = $this->getInterfacesContainer();
 		$scope = $callerObj->getScope();
 		
	  $actInd = (string)$item['id'];
	  if(is_numeric($actInd))
	 	 $actInd = (int)$actInd;
	 	$fileName = (string)$item; 

	$swapInt = $this->getSwapInt();
	if(count($swapInt)==2)
	{
	 if($swapInt[0]==$fileName)
	  $fileName = $swapInt[1];
	}
    $loadInterfaceAsString = $callerObj->getLoadInterfaceAsString();
    if(($loadInterfaceAsString)||/*(is_null($item))||*/($item==STRING_NULL)) 
    {
       $className1 = $scope . STRING_BACKSLASH . INTERFACE_AS_STRING_CLASS;	
      //$className1 = $scope1;
	
	   if (! IsClassDeclared($className1))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className1 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");
	      
	   $loadedValues = Creator::create(getClassNameForCreate(Classes_info::INTERFACE_AS_STRING_CLASS),$scope,$fileName);
	//   echo "W-" . $fileName . "-W";
	//   if($fileName=='')
	//   {  
    //    print_r($loadedValues);
	//    die('BBBBCheope');
	   //die('BBBBCheope');
	  }
	  else
	  {
     $interfacesDir = $callerObj->getInterfacesDir();
     $xmlDir = $callerObj->getXmlDir();
     $jsonDir = $callerObj->getJsonDir();
     $codeDir = $callerObj->getCodeDir();
     //$interfacesDir = $callerObj->getInterfacesDir();
	   $interfaceIds = Xml_interface_file_analyzer::getInterfaceItems($interfacesDir . 
	   DIR_SEP . $fileName,false);
     $newInterface = $callerObj->createInterfaceFromString($fileName);
     $pageName = $interfaceIds[1];
     $appName = $interfaceIds[0];
	 $objName = $interfaceIds[2];
	 
	/*  $objNode = $dbStruct->getElementByAliasName($objName);
	  if(is_null($objNode))
		$objNode = $dbQueries->getElementByAliasName($objNode);
	  if(is_null($objNode))
		 $objNode = OBJ_NONE;*/
	 
	 
	 	 $xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();
     $interpConsts = $callerObj->getInterpolateConsts();
     $xmlIntSerializer->setInterpolateConsts($interpConsts);
	 	 //$xmlIntSerializer->setDir($dir);
	 	 $xmlIntSerializer->setInterfacesDir($interfacesDir);
	 	 $xmlIntSerializer->setXmlDir($xmlDir);
	 	 $xmlIntSerializer->setJsonDir($jsonDir);
	 	 $xmlIntSerializer->setCodeDir($codeDir);
     $xmlIntSerializer->setPageName($pageName);
     $newInterface->setPageName($pageName);
     $xmlIntSerializer->setAppName($appName);
     $newInterface->setAppName($appName);
     $xmlIntSerializer->setDbStruct($dbStruct);
     $xmlIntSerializer->setDbQueries($dbQueries);
     $xmlIntSerializer->setInterfacesContainer($interfacesContainer);
  
     $scope2 = $scope . STRING_BACKSLASH . HTML_DATA_INTERFACE_CLASS; 
  
     if(is_a($newInterface,$scope2))
     {
      $newInterface->setDbStruct($dbStruct);
	  $newInterface->setDbQueries($dbQueries);
	   } 
     $newInterface->setSerializer($xmlIntSerializer);
  
    // if(Xml_interface_file_analyzer::is_free_interface_file($interfacesDir . DIR_SEP . $fileName))
      $newInterface->setShortName($fileName);
     //echo "KKKKKKK";
     $newInterface->serializer_loadData($appName);
     $newInterface->unserialize();
	   $interfacesContainer = $xmlIntSerializer->getInterfacesContainer();
	   $interfacesContainer->add($newInterface);
	   $loadedValues = $newInterface;
	  }
 		return $loadedValues;
 	}
}

class LoadData_db_item extends LoadData_base
{
	Use Creator;
	
//	const ERROR_1="LoadData_db_item:Oggetto grafo nodi nullo.";
//	const ERROR_2="LoadData_db_item:Oggetto contenitore queries nullo.";
			
 	private $dbStruct=null;
 	private $dbQueries=null;
 	private $callerObj=null;
 	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
 	function setDbStruct(?object $actDbStruct):void
 	{
 		$this->dbStruct = $actDbStruct;
 	}
 	
 	function getDbStruct():?object
 	{
 		return $this->dbStruct;
 	}
 	
 	function setDbQueries(?object $actDbQueries):void
 	{
 		$this->dbQueries = $actDbQueries;
 	}
 	
 	function getDbQueries():?object
 	{
 		return $this->dbQueries;
 	}
	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$dbStruct = $this->getDbStruct();
 		$dbQueries = $this->getDbQueries();
 		$callerObj = $this->getCallerObj();
 		$scope = $callerObj->getScope();
        $codeDir = $callerObj->getCodeDir();
 		 		
    //$scope1 = $scope . STRING_BACKSLASH . DB_ITEM_CLASS;
    $className =  DB_ITEM_CLASS; 
  
    //echo $scope1;
    //die('XXXXX');
    
    //$className = $scope1;

      $className1 = $scope . STRING_BACKSLASH . $className;	
     // $className1 = $scope1;
	
	 	 if (! IsClassDeclared($className1))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className1 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");
	
	/*if (! IsClassDeclared($scope . STRING_BACKSLASH . $className))	 	 
	   require_once($codeDir . DIR_SEP . DB_ITEM_CLASS . 
     ".class.php");*/ 	
	
	 	$actInd = (string)$item['id'];
	 	$nodeName = (string)$item;
	 	if(($nodeName != STRING_NULL)&&($nodeName != "OBJ_NONE"))
	 	{
	 	 $obj = $dbStruct->getElementByAliasName($nodeName);
	 	 $dbQuery = $dbQueries->getQuery($nodeName);
	 	 if(! is_null($obj))
	 	 {
	 	  $loadedValues = $obj;
	 	 }
	 	 elseif(! is_null($dbQuery))
	 	 {
	 	 	$loadedValues = $dbQuery;
	 	 }
	 	 else
	 	  $loadedValues = Creator::create($className,$scope,$nodeName); 
	 	}
	 	elseif($nodeName=="OBJ_NONE")
	 	{
	 		$loadedValues = Creator::create($className,$scope,$nodeName);
	  }
	 	else
	 	 $loadedValues = Creator::create($className,$scope,OBJ_NONE);
	 	 
   return $loadedValues;
 	}
}

class LoadData_xml_node extends LoadData_base
{
	Use Creator;
	
  const ERROR_0="LoadData_xml_node:xml file non esiste.";
  
  private $callerObj=null;
   	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();	
 		
 		$scope = $callerObj->getScope();
 		$codeDir = $callerObj->getCodeDir();
 		
    $className1 =  getClassNameForCreate(Classes_info::XML_NODE_CLASS);
    $className2 =  getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS);
    
    //$className1 = $scope1; 
    //$className2 = $scope2;				
 	  //$dir = $callerObj->getDir();
 	  $xmlDir = $callerObj->getXmlDir();
	 	$actInd = (string)$item['id'];
	 	$nodeName = (string)$item;
	 	$fileName = $nodeName;

    	  
	/* $scopeItems = explode(STRING_BACKSLASH,$scope);
	  $scopeItem = $scopeItems[0];
	  if($scopeItem !== APPLICATION_NAME)
		$codeDir = PREVIOUS_DIR . DIR_SEP . $scopeItem . DIR_SEP . FW_DIR;*/

       $className3 = $scope . STRING_BACKSLASH . $className1;	
    //  $className3 = $scope3;
	
	 	 if (! IsClassDeclared($className3))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className3 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");
	 
    //$app = preg_split("/" . STRING_BACKSLASH . STRING_BACKSLASH . "/",$scope)[0];

      $className4 = $scope . STRING_BACKSLASH . $className2;	
      //$className4 = $scope4;
	
	 	 if (! IsClassDeclared($className4))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className4 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");


	  //if (! IsClassDeclared($scope . STRING_BACKSLASH . $className2))
      //{		  
	  // require_once($codeDir . DIR_SEP . XML_SERIALIZER_CLASS . ".class.php");
      // die('HHHHHHHHHHHHHH' . $codeDir);
      //}	   
	  
	  $serializer = Creator::create($className2,$scope,$xmlDir . DIR_SEP . $fileName);
	  $serializer->setDir($xmlDir);

      //$scope1 = $scope . STRING_BACKSLASH . $className;	
      //$className1 = $scope1;
	
	 /*	 if (! IsClassDeclared($className1))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className1 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");*/
	  
	/*  if (! IsClassDeclared($scope . STRING_BACKSLASH . $className1))	 	 
	   require_once($codeDir . DIR_SEP . XML_NODE_CLASS . 
     ".class.php"); */ 	  
	  
	  //echo $className1;
	  //die($fileName);
	  if(file_exists($xmlDir . DIR_SEP . $fileName))
	   $xmlNode = Creator::create($className1,$scope,$serializer,$fileName);
      else
	   die(self::ERROR_0 . STRING_SPACE . $xmlDir . DIR_SEP . $fileName);

	  $xmlNode->setNodeName($nodeName);
    return $xmlNode;
 	}
}

class LoadData_json_node extends LoadData_base
{
  const ERROR_0="LoadData_json_node:Json file non esiste.";
  
  private $callerObj=null;
   	
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function setCallerObj(Xml_interface_serializer $actCallerObj):void
 	{
 		$this->callerObj = $actCallerObj;
 	}
 	
 	function getCallerObj():Xml_interface_serializer
 	{
 		return $this->callerObj;
 	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
 		$callerObj = $this->getCallerObj();
 		$scope = $callerObj->getScope();
 		
    $className1 = getClassNameForCreate(Classes_info::JSON_NODE_CLASS);
    $className2 = getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS);
    
    //$className1 = $scope1;
    //$className2 = $scope2; 	 		
 	  $jsonDir = $callerObj->getJsonDir();
 	  $codeDir = $callerObj->getCodeDir();
 	  
	 	$actInd = (string)$item['id'];
	 	$nodeName = (string)$item;
	 	$fileName = $nodeName;

    //$app = preg_split("/" . STRING_BACKSLASH . STRING_BACKSLASH . "/",$scope)[0];

    /*  $scopeItems = explode(STRING_BACKSLASH,$scope);
	  $scopeItem = $scopeItems[0];
	  if($scopeItem !== APPLICATION_NAME)
		$codeDir = PREVIOUS_DIR . DIR_SEP . $scopeItem . DIR_SEP . FW_DIR;*/

       $className3 = $scope . STRING_BACKSLASH . $className2;	
    //  $className3 = $scope3;
	
	 	 if (! IsClassDeclared($className3))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className3 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");
	 	
	  //if (! IsClassDeclared($scope . STRING_BACKSLASH . $className2))	 	 
	  // require_once($codeDir . DIR_SEP . JSON_SERIALIZER_CLASS . ".class.php"); 	 	
	 	
	 	$serializer = Creator::create($className2,$scope,$jsonDir . DIR_SEP . $fileName);
	  
	  //if (! IsClassDeclared($scope . STRING_BACKSLASH . $className1))	 	 
	  // require_once($codeDir . DIR_SEP . JSON_NODE_CLASS . ".class.php"); 	  
	  
       $className4 = $scope . STRING_BACKSLASH . $className1;	
    //  $className3 = $scope3;
	
	 	 if (! IsClassDeclared($className4))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className4 . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");	  
	  
	  if(file_exists($jsonDir . DIR_SEP . $fileName))
	   $jsonNode = Creator::create($className1,$scope, $serializer,$fileName);
      else
	   die(self::ERROR_0 . STRING_SPACE . $jsonDir . DIR_SEP . $fileName);
	  $jsonNode->setNodeName($nodeName);
    return $jsonNode;
 	}
}

class LoadData_object extends LoadData_base
{
 	function __construct(\SimpleXMLElement $actItem)
 	{
 		parent::__construct($actItem);
 	}
 	
 	function exec_1(array|string|int &$actInd):mixed
 	{
 		$item = $this->getItem();
	  $actInd = (string)$item['id'];
	  if(is_numeric($actInd))
	 	 $actInd = (int)$actInd;
        echo get_class($item); 
	 	$obj = unserialize($item);
    return $obj;
 	}
}


class LoadData_factory implements Factory_3
{	
	Use Creator;
	
	private $item;
	private $loadSpecialChars=false;
	
	function __construct(\SimpleXMLElement $actItem)
	{
		$this->setItem($actItem);
	}
	
	function getLoadSpecialChars():bool
	{
	 return $this->loadSpecialChars;
	}
	
	function setLoadSpecialChars(bool $actLoadSpecialChars):void
	{
	 $this->loadSpecialChars = $actLoadSpecialChars;
	}
	
	function getItem():\SimpleXMLElement
	{
		return $this->item;
	}
	
	function setItem(\SimpleXMLElement $actItem)
	{
		$this->item = $actItem;
	}
	
	function create(Xml_interface_serializer $actCallerObj,
	Interfaces_container $actInterfacesContainer,
	 ?object $actDbStruct,
	 ?object $actDbQueries):object|string|null
	{
		$item = $this->getItem();
		$type = strToLower(trim($item['type']));
		//echo $type;
	  
	  if($type=="array")
	  {	
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_ARRAY_CLASS),STRING_NULL,$item);
	   $obj->setCallerObj($actCallerObj);
	   $specialChars = $this->getLoadSpecialChars();
	   //var_dump($specialChars);
	   //die('kkkw');
	   $obj->setLoadSpecialChars($specialChars);
	  }	
	  elseif($type=="scalar")
	  {	 
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_SCALAR_CLASS),STRING_NULL,$item);
	   $obj->setCallerObj($actCallerObj);	
	   $specialChars = $this->getLoadSpecialChars();
	   //var_dump($specialChars);
	   //die('kkksw');
	   $obj->setLoadSpecialChars($specialChars);	   
	  }
	  elseif($type=="big_scalar")
	  {
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_BIG_SCALAR_CLASS),STRING_NULL,$item);
	  }
	  elseif($type=="container")
	  { 
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_CONTAINER_CLASS),STRING_NULL,$item);
	   $obj->setCallerObj($actCallerObj);	
	  }	  
	  elseif($type=="interface")
	  {
		//echo "XXX" . var_dump($item) . "XXX";
	   //if((string)$item !== STRING_NULL)
	   //{
		//echo "E";
	    $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_INTERFACE_CLASS),STRING_NULL,$item);
	    $obj->setCallerObj($actCallerObj);
	    $obj->setInterfacesContainer($actInterfacesContainer);
	    $obj->setDbStruct($actDbStruct);
	    $obj->setDbQueries($actDbQueries);
       //} 
       //else
       // $obj = null;		   
	  }	  
	  elseif($type=="db_item")
	  {
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_DB_ITEM_CLASS),STRING_NULL,$item);
	   $obj->setDbStruct($actDbStruct);
	   $obj->setDbQueries($actDbQueries); 
	   $obj->setCallerObj($actCallerObj);	   
	  } 
	  elseif($type=="xml_node")
	  {
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_XML_NODE_CLASS),STRING_NULL,$item);
	   $obj->setCallerObj($actCallerObj);
	  } 
	  elseif($type=="json_node")
	  {	
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_JSON_NODE_CLASS),STRING_NULL,$item);
	   $obj->setCallerObj($actCallerObj);
	  }  
	  elseif($type=="object")
	  {
	   $obj = Creator::create(getClassNameForCreate(Classes_info::LOADDATA_OBJECT_CLASS),STRING_NULL,$item);
	  }
	  else
	   $obj = (string)$item;

	 return $obj;
	}
}

?>