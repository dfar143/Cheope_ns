<?
namespace Cheope_ns\fw;
require_once("GNode.class.php");
require_once("Xml_serializer.class.php");
require_once("Json_serializer.class.php");

class Serializable_node extends GNode
{
	const ERROR_1 = "Serializable_node:File non esiste.";
	const ERROR_2 = "Serializable_node:Errore nel caricamento.";
	const DEFAULT_LOG_ENABLED = false;
	
	private $serializer=null;
	private $fields=array();
	private $logEnabled=self::DEFAULT_LOG_ENABLED;
	
	function __construct(Serializer $actSerializer,string $actFileName=STRING_NULL)
	{
		if($actFileName != STRING_NULL)
		{
		 $fileName = $actFileName;
		 $actSerializer->setFileName($fileName);
		}
		else
		 $fileName = $actSerializer->getFileName();
		if($fileName != STRING_NULL)
		 $this->setFields($actSerializer->getRootFields());
		parent::__construct($fileName);
		$this->setSerializer($actSerializer);		
	}
	
 function setLogEnabled(bool $actLogEnabled):void
 {
  $this->logEnabled = $actLogEnabled;
 }
 
 function getLogEnabled():bool
 {
  return $this->logEnabled;
 }
	
 function getName():string
 {
 	return parent::getNodeName();
 }
 
 function getFields():array
 {
 	return $this->fields;
 }
 
 function setFields(array $actFields):void
 {
 	$this->fields = $actFields;
 }
	
  function setSerializer(Serializer $actSerializer):void
  {
  	$this->serializer = $actSerializer;
  }	
  
  function getSerializer():Serializer
  {
  	return $this->serializer;
  }

// Carica i dati da disco  
  function loadData():void
  {
  	$serializer = $this->getSerializer();
	try
	{
  	 $serializer->loadData();
  	}
	catch(\Exception $e)
	{
	 $logEnabled = $this->getLogEnabled();
	 $fileName = $serializer->getFileName();
	 $msg = self::ERROR_2 . $fileName;
	 if($logEnabled)
     { 
	  $logFileName = PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME .
	  DIR_SEP . strTolower(APPLICATION_NAME) . VAR_SEP . "log" . 
	  FILE_NAME_ELEMENTS_SEP . TXT_SUFFIX;
	  writeToLog($logFileName,$msg);
	 }	 
	}
	$items = $serializer->getItems();
  	$this->setValues($items);
  }

// Salva i dati su disco  
  function saveData():void
  {
  	$serializer = $this->getSerializer();
    $values = $this->getValues();
    $serializer->loadItems($values);
    $serializer->saveData(); 
  }
  
 function ready():bool
 {
  $serializer = $this->getSerializer();
  $fileName = $serializer->getFileName();
  $dir = $serializer->getDir();
  $msg = self::ERROR_1 . $fileName;
  $fe = file_exists($dir . $fileName);
  $logEnabled = $this->getLogEnabled();  
  if(! $fe)
  {
	if($logEnabled)
    { 
	 $logFileName = PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME .
	 DIR_SEP . strTolower(APPLICATION_NAME) . VAR_SEP . "log" . 
	 FILE_NAME_ELEMENTS_SEP . TXT_SUFFIX;
	 writeToLog($logFileName,$msg);
	}
  }
  return $fe;
 }
	
}


?>
