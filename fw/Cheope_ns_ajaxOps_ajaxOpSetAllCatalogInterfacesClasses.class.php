<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("Xml_serializer.class.php");
require_once("Json_serializer.class.php");
require_once("Executable_4.int.php");
require_once("Factory_9.int.php");
require_once("Creator.tra.php");

abstract class SetAllCatalogInterfacesBase implements Executable_4
{
 Use Creator;	
	
 protected $setAllNodesTo=STRING_NULL;
	
 function __construct(string $actSetAllNodesTo)
 {
 	$this->setAllNodesTo($actSetAllNodesTo);
 }	
	
 function setAllNodesTo(string $actSetAllNodesTo)
 {
 	$this->setAllNodesTo = $actSetAllNodesTo;
 }
 
 function getAllNodesTo()
 {
 	return $this->setAllNodesTo;
 }	
 
}

class SetAllCatalogInterfaces_xmlDataSource extends SetAllCatalogInterfacesBase
{
	private $appXmlDir=STRING_NULL;
	private $scope=STRING_NULL;
	private $xmlSerializer=null;
	
	function __construct(string $actSetAllNodesTo)
	{
		parent::__construct($actSetAllNodesTo);
	}
	
  function setAppXmlDir(string $actAppXmlDir)
  {
   $this->appXmlDir = $actAppXmlDir; 	
  }
 
  function getAppXmlDir()
  {
 	 return $this->appXmlDir;
  }
  
  function setScope(string $actScope)
  {
  	$this->scope = $actScope;
  }
  
  function getScope()
  {
  	return $this->scope;
  }
  
  function getXmlSerializer()
  {
  	return $this->xmlSerializer;
  }
  
  function setXmlSerializer($actXmlSerializer)
  {
  	$this->xmlSerializer = $actXmlSerializer;
  }
  
	function exec():object|null
	{
	 $setAllNodesTo = $this->getAllNodesTo();
	 $appXmlDir = $this->getAppXmlDir();
	 $scope = $this->getScope();
	 $xmlSerializer = $this->getXmlSerializer();	 
	 $xmlSerializer->setFileName($setAllNodesTo);
	 $xmlSerializer->setDir($appXmlDir);
	 $dataSourceItem = Creator::create(XML_NODE_CLASS,$scope,$xmlSerializer);
	 return $dataSourceItem;
	}
}


class SetAllCatalogInterfaces_jsonDataSource extends SetAllCatalogInterfacesBase
{
	private $appJsonDir=STRING_NULL;
	private $scope=STRING_NULL;
	private $jsonSerializer=null;
	
	function __construct(string $actSetAllNodesTo)
	{
		parent::__construct($actSetAllNodesTo);
	}

  function setAppJsonDir(string $actAppJsonDir)
  {
   $this->appJsonDir = $actAppJsonDir; 	
  }
 
  function getAppJsonDir()
  {
 	 return $this->appJsonDir;
  }
  
  function setScope(string $actScope)
  {
  	$this->scope = $actScope;
  }
  
  function getScope()
  {
  	return $this->scope;
  }
  
  function getJsonSerializer()
  {
  	return $this->jsonSerializer;
  }
  
  function setJsonSerializer($actJsonSerializer)
  {
  	$this->jsonSerializer = $actJsonSerializer;
  }
	
	function exec():object|null
	{
	 $setAllNodesTo = $this->getAllNodesTo();
	 $appJsonDir = $this->getAppJsonDir();
	 $scope = $this->getScope();
	 $jsonSerializer = $this->getJsonSerializer();
	 
	 $jsonSerializer->setFileName($setAllNodesTo);
	 $jsonSerializer->setDir($appJsonDir);
	 $dataSourceItem = Creator::create(JSON_NODE_CLASS,$scope,$jsonSerializer);
	 return $dataSourceItem;
	}
}

class SetAllCatalogInterfaces_dbNodeDataSource extends SetAllCatalogInterfacesBase
{
	private $scope=STRING_NULL;
	
	function __construct(string $actSetAllNodesTo)
	{
		parent::__construct($actSetAllNodesTo);
	}
	
  function setScope(string $actScope)
  {
  	$this->scope = $actScope;
  }
  
  function getScope()
  {
  	return $this->scope;
  }	
	
	function exec():object|null
	{
	 $setAllNodesTo = $this->getAllNodesTo();
	 $scope = $this->getScope();
   $dataSourceItem = Creator::create(DB_NODE_CLASS,$scope,$setAllNodesTo);	
   return $dataSourceItem; 		
	}
	
}

class SetAllCatalogInterfaces_dbQueryDataSource extends SetAllCatalogInterfacesBase
{
 	private $scope=STRING_NULL;

	function __construct(string $actSetAllNodesTo)
	{
		parent::__construct($actSetAllNodesTo);
	}
	
  function setScope(string $actScope)
  {
  	$this->scope = $actScope;
  }
  
  function getScope()
  {
  	return $this->scope;
  }
	
	function exec():object|null
	{
	 $setAllNodesTo = $this->getAllNodesTo();
	 $scope = $this->getScope();
	 $dbStructTree = null;
   $dataSourceItem = Creator::create(DB_QUERY_CLASS,$scope,$setAllNodesTo,$dbStructTree);
   return $dataSourceItem; 		
	}
	
}

class SetAllCatalogInterfaces_factory implements Factory_9
{
	Use Creator;
	
	private $setAllNodesTo=STRING_NULL;
	private $appXmlDir=STRING_NULL;
	private $appJsonDir=STRING_NULL;
	private $scope=STRING_NULL;
	private $xmlSerializer=null;
	private $jsonSerializer=null;

	const ERROR_1 = "AjaxOpSetAllCatalogInterfaces:" . MSG_57;
		
	function __construct(string $actSetAllNodesTo,string $actAppXmlDir,
	string $actAppJsonDir,string $actScope,object $actXmlSerializer,
	object $actJsonSerializer)
	{
		$this->setSetAllNodesTo($actSetAllNodesTo);
		$this->setAppXmlDir($actAppXmlDir);
		$this->setAppJsonDir($actAppJsonDir);
		$this->setScope($actScope);
		$this->setXmlSerializer($actXmlSerializer);
		$this->setJsonSerializer($actJsonSerializer);
	}
	
	function setSetAllNodesTo(string $actSetAllNodesTo):void
	{
		$this->setAllNodesTo = $actSetAllNodesTo;
	}
	
	function getSetAllNodesTo():string
	{
		return $this->setAllNodesTo;
  }
	
	function setAppXmlDir(string $actAppXmlDir):void
	{
		$this->appXmlDir = $actAppXmlDir;
	}
	
	function getAppXmlDir():string
	{
		return $this->appXmlDir;
	}
	
		function setAppJsonDir(string $actAppJsonDir):void
	{
		$this->appJsonDir = $actAppJsonDir;
	}
	
	function getAppJsonDir():string
	{
		return $this->appJsonDir;
	}
	
	function setScope(string $actScope):void
	{
		$this->scope = $actScope;
	}
	
	function getScope():string
	{
		return $this->scope;
	}
	
	function setXmlSerializer(object $actXmlSerializer):void
	{
		$this->xmlSerializer = $actXmlSerializer;
	}
	
	function getXmlSerializer():object
	{
		return $this->xmlSerializer;
	}
	
	function setJsonSerializer(object $actJsonSerializer):void
	{
		$this->jsonSerializer = $actJsonSerializer;
	}
	
	function getJsonSerializer():object
	{
		return $this->jsonSerializer;
	}
		
	function create(object $actDbStructTree,
	object $actDbQueriesContainer):object
	{
		$setAllNodesTo = $this->getSetAllNodesTo();
		$appXmlDir = $this->getAppXmlDir();
		$appJsonDir = $this->getAppJsonDir();
		$scope = $this->getScope();
		$xmlSerializer = $this->getXmlSerializer();
		$jsonSerializer = $this->getJsonSerializer();
		
		if(isAXmlDataSource($setAllNodesTo))
		{
		 $obj = Creator::create("SetAllCatalogInterfaces_xmlDataSource",STRING_NULL,$setAllNodesTo);
		 $obj->setScope($scope);
		 $obj->setXmlSerializer($xmlSerializer);
		 $obj->setAppXmlDir($appXmlDir);
		}
		elseif(isAJsonDataSource($setAllNodesTo))
		{
		 $obj = Creator::create("SetAllCatalogInterfaces_jsonDataSource",STRING_NULL,$setAllNodesTo);
		 $obj->setScope($scope);
		 $obj->setJsonSerializer($jsonSerializer);
		 $obj->setAppJsonDir($appXmlDir);
		}
		elseif((! is_null($actDbStructTree->getElementByAliasName($setAllNodesTo))) || ($setAllNodesTo==STRING_NULL))
		{
		 $obj = Creator::create("SetAllCatalogInterfaces_dbNodeDataSource",STRING_NULL,$setAllNodesTo);	
		 $obj->setScope($scope);
		}
		elseif((! is_null($actDbQueriesContainer->getQuery($setAllNodesTo))) || ($setAllNodesTo==STRING_NULL)) 
		{
		 $obj = Creator::create("SetAllCatalogInterfaces_dbQueryDataSource",STRING_NULL,$setAllNodesTo);
         $obj->setScope($scope);		 
		}
    else
     die(self::ERROR_1 . "-" . $setAllNodesTo . "-");
     
    return $obj; 
	}
	
}
?>