<?
namespace Cheope_ns\fw;
require_once("Db_nodes_container.class.php");
require_once("Queries_container.class.php");
require_once("Interfaces_info.class.php");
require_once("Executable_6.int.php");
require_once("Factory_5.int.php");
require_once("Creator.tra.php");

abstract class CreateInterfaceFromStringBase implements Executable_6
{
	const FRAMEWORK_DIR = "fw";
	
	protected $scope=STRING_NULL;
  protected $appName=STRING_NULL;
  protected $interfaceIds=array();
  protected $interfacesCodeDir=STRING_NULL;

	function __construct(string $actAppName)
	{
		$this->setAppName($actAppName);
	}
	
	function setScope(string $actScope):void
	{
		$this->scope = $actScope;
	}
	
	function getScope():string
	{
	 return $this->scope;
	}
	
	function setInterfacesCodeDir(string $actInterfacesCodeDir):void
	{
		if($actInterfacesCodeDir==STRING_NULL)
		 $this->interfacesCodeDir = THIS_DIR . DIR_SEP . self::FRAMEWORK_DIR;
		else
		 $this->interfacesCodeDir = $actInterfacesCodeDir;
	  //return $this->interfacesCodeDir;
	}
	
	function getInterfacesCodeDir():string
	{
		return $this->interfacesCodeDir;
	}	
	
  function setAppName(string $actAppName):void
  {
  	$this->appName = $actAppName;
  }
  
  function getAppName():string
  {
  	return $this->appName;
  }
  
  abstract function setInterfaceIds(array $actInterfaceIds):void;
  
  function getInterfaceIds():array
  {
  	return $this->interfaceIds;
  }
  	
}

class CreateInterfaceFromString_dataObjFull extends CreateInterfaceFromStringBase
{
  const ERROR_1="CreateInterfaceFromString_dataObjFull: Formato nome interfaccia errato.";
  const ERROR_2="CreateInterfaceFromString_dataObjFull: Il nome dell'applicazione dell'interfaccia e' errato.";
  const ERROR_3="CreateInterfaceFromString_dataObjFull: L'oggetto dati non esiste.";
  //const ERROR_3="CreateInterfaceFromString_dataObjFull: Grafo database nullo.";
  //const ERROR_4="CreateInterfaceFromString_dataObjFull: Contenitore queries nullo.";
  private $dbStruct=null;
  private $dbQueries=null;
  
	function __construct(string $actAppName,array $actInterfaceIds,
	Db_nodes_container $actDbStruct,Queries_container $actDbQueries) 
	{
	 parent::__construct($actAppName);
	 $this->setInterfaceIds($actInterfaceIds);
	 $this->setDbStruct($actDbStruct);
	 $this->setDbQueries($actDbQueries);
	}
	
	function setDbStruct(?Db_nodes_container $actDbStruct):void
	{
		$this->dbStruct = $actDbStruct;
	}
	
	function getDbStruct():?Db_nodes_container
	{
		return $this->dbStruct;
	}
	
	function setDbQueries(?Queries_container $actDbQueries)
	{
		$this->dbQueries = $actDbQueries;
	}
	
	function getDbQueries():?Queries_container
	{
		return $this->dbQueries;
	}
  
  function setInterfaceIds(array $actInterfaceIds):void
  {
   $num =count($actInterfaceIds);
 	 if(($num!=6)&&($num!=1))
 	 {
	  die(self::ERROR_1);
	 }
	 else
	  $this->interfaceIds=$actInterfaceIds;
  }
	
	function exec():Generic_interface
	{
		$appName = $this->getAppName();
		$interfaceIds = $this->getInterfaceIds();
		$dbStruct = $this->getDbStruct();
		$dbQueries = $this->getDbQueries();
    
	  $interfaceAppName = $interfaceIds[0];
	  //
	  // Possono essere ritornate solo istanze di interfacce della stessa applicazione della stringa 
	  // che identifica l'istanza xml dell'interfaccia stessa.  
	  //
	  if($interfaceAppName !== $appName)
	  	 die(self::ERROR_2);
	  	
	  $interfaceDataObjName = $interfaceIds[2];
	  if(($interfaceDataObjName != STRING_NULL)&&($interfaceDataObjName != OBJ_DATA_SOURCE))
	  {
	   $interfaceDataObj = $dbStruct->getElementByAliasName($interfaceDataObjName);
	   $interfaceQuery = $dbQueries->getQuery($interfaceDataObjName);
	   if (isset($interfaceDataObj))
	  	$interfaceDataObj = $interfaceDataObj;
	   elseif(! is_null($interfaceQuery))
	  	$interfaceDataObj = $interfaceQuery;
	   else
	  	die( self::ERROR_3 . STRING_SPACE . $interfaceDataObjName);
	//$interfaceDataObj = OBJ_NONE;
	  }
	  elseif($interfaceDataObjName == OBJ_DATA_SOURCE)
	  {
//
// Gli oggetti dati nel caso di nodi xml o json vengono caricati dopo.
// tramite il metodo 'unserialize' di Generic_interface.
//
      $interfaceDataObj = OBJ_DATA_SOURCE;  		
	  }
	  else
	   $interfaceDataObj = OBJ_NONE;
	  $interfaceType = $interfaceIds[3];
	  $interfaceOp = $interfaceIds[4];
	  $interfaceNum = $interfaceIds[5];
	  	
	  $interfaceTypeComps = explode(VAR_SEP,$interfaceType);
	  $interfacesCodeDir = $this->getInterfacesCodeDir();
	  
      $scope = $this->getScope();
      $scope1 = $scope . STRING_BACKSLASH . INTERFACES_INFO_CLASS;	
      $className = $scope1;
	
	 	 if (! IsClassDeclared($className))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");	  
	   
	  if(!(($interfaceTypeComps[0] == "html")||($interfaceTypeComps[0] == "php")||($interfaceTypeComps[0] == "xml")||
	  ($interfaceTypeComps[0] == "javascript")))
    {
      $interfaceName = $appName . VAR_SEP 
      	. $interfaceType;
      	
      $newInterface = $className::createInterface($interfacesCodeDir,$interfaceName,$interfaceDataObj,$interfaceOp,$interfaceNum);
      $newInterface->setDbStruct($dbStruct);
      $newInterface->setDbQueries($dbQueries);
     }
	   else
     {
      $interfaceName = $interfaceType;
      $newInterface = $className::createInterface($interfacesCodeDir,$interfaceName,$interfaceDataObj,$interfaceOp,$interfaceNum);
      $newInterface->setDbStruct($dbStruct);
      $newInterface->setDbQueries($dbQueries);
     }
    return $newInterface;		
	}
}

class CreateInterfaceFromString_dataObjEmpty extends CreateInterfaceFromStringBase
{
  const ERROR_1="CreateInterfaceFromString_dataObjEmpty: Formato nome interfaccia errato.";
  const ERROR_2="CreateInterfaceFromString_dataObjEmpty: Il nome dell'applicazione dell'interfaccia è errato.";
  
	function __construct(string $actAppName,array $actInterfaceIds)
	{
	 parent::__construct($actAppName);
	 $this->setInterfaceIds($actInterfaceIds);
	}
  
  function setInterfaceIds(array $actInterfaceIds):void
  {
   $num =count($actInterfaceIds);
 	 if($num!=5)
	  die(self::ERROR_1);
	 else
	  $this->interfaceIds=$actInterfaceIds;
  }
	
	function exec():Generic_interface
	{
		$appName = $this->getAppName();	
	  $interfaceIds = $this->getInterfaceIds();
	  $interfaceAppName = $interfaceIds[0];
	  if($interfaceAppName !== $appName)
	  	 die(self::ERROR_2);
	  $interfaceType = $interfaceIds[2];
	  $interfaceOp = $interfaceIds[3];
	  $interfaceNum = $interfaceIds[4];
	  	
	  $interfaceTypeComps = explode(VAR_SEP,$interfaceType);
	  $interfacesCodeDir = $this->getInterfacesCodeDir();
	  //$interfacesCodeDir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FRAMEWORK_DIR;

     $scope = $this->getScope();
     $scope1 = $scope . STRING_BACKSLASH . INTERFACES_INFO_CLASS;	
     $className = $scope1;

	 	 if (! IsClassDeclared($className))
	 	 require_once(PREVIOUS_DIR . DIR_SEP .  
	 	 $className . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php");
	 // $interfaceTypeComps[0] = strToLower($interfaceTypeComps[0]);
	  
	  if(!(($interfaceTypeComps[0] == "html")||($interfaceTypeComps[0] == "php")||
	  	($interfaceTypeComps[0] == "javascript")))
    {
     $interfaceName = $appName . VAR_SEP . $interfaceType;
     $newInterface = $className::createInterface($interfacesCodeDir,$interfaceName,null,$interfaceOp,$interfaceNum);
    }
	  else
    {
     $interfaceName = $interfaceType;
     $newInterface = $className::createInterface($interfacesCodeDir,$interfaceName,null,$interfaceOp,$interfaceNum);
     $newInterface->setNum($interfaceNum);        
    }	  		 
    //var_dump($interface);
    //die('AAA');
     	
    return $newInterface;
  }
}


class CreateInterfaceFromString_factory implements Factory_5
{
	use Creator;
	
  const ERROR_1="CreateInterfaceFromString_factory: Formato nome interfaccia errato.";

	private $interfaceIds=array();
	private $appName=STRING_NULL;
	private $scope=STRING_NULL;
	
  function __construct(array $actInterfaceIds,string $actAppName)
  {
  	$this->setAppName($actAppName);
  	$this->setInterfaceIds($actInterfaceIds);
  }
  
  function setScope(string $actScope)
  {
  	$this->scope = $actScope;
  }
  
  function getScope():string
  {
  	return $this->scope;
  }
  
  function setAppName(string $actAppName):void
  {
  	$this->appName = $actAppName;
  }
  
  function getAppName():string
  {
  	return $this->appName;
  }
  
  function setInterfaceIds(array $actInterfaceIds):void
  {
  	$this->interfaceIds = $actInterfaceIds;
  }
  
  function getInterfaceIds():array
  {
  	return $this->interfaceIds;
  }
  
  function create(?Db_nodes_container $actDbStruct=null,
  ?Queries_container $actDbQuery=null):object
  {
  	$interfaceIds = $this->getInterfaceIds();
  	$scope = $this->getScope();
  	$appName = $this->getAppName();  	
    $num = count($interfaceIds);
  	if($num==6)
  	{
  		$obj = Creator::create(getClassNameForCreate(Classes_info::CREATEINTERFACEFROMSTRING_DATAOBJFULL_CLASS),STRING_NULL,$appName,$interfaceIds,
  		$actDbStruct,$actDbQuery);
  		$obj->setScope($scope);
  	}
  	elseif($num==5)
  	{
  		$obj = Creator::create(getClassNameForCreate(Classes_info::CREATEINTERFACEFROMSTRING_DATAOBJEMPTY_CLASS),STRING_NULL,$appName,$interfaceIds);
  		$obj->setScope($scope);
  	}
  	else
  	 die(self::ERROR_1);
   return $obj;
  }
}


?>