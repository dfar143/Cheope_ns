<?
namespace Cheope_ns\fw;
require_once("Classes_info.class.php");
require_once("struct.fun.php");
require_once("Db_node.class.php");
require_once("Db_query.class.php");
require_once("Executable.int.php");
require_once("Creator.tra.php");

class Db_item_processor implements Executable
{
// const DB_ITEM_PROCESSOR_ERROR_1 = "Db_item_processor:Errore nell'inserimento del Db_item.";
// const DB_ITEM_PROCESSOR_ERROR_2 = "Db_item_processor:Errore nell'inserimento del Generic_db_op.";
 const DB_ITEM_PROCESSOR_ERROR_3 = "Db_item_processor:L'oggetto deve essere un Db_node.";
 const DB_ITEM_PROCESSOR_ERROR_4 = "Db_item_processor:L'oggetto deve essere un Generic_db_op.";
 const DB_ITEM_PROCESSOR_ERROR_5 = "Db_item_processor:Violazione chiave candidata";
 const DB_ITEM_PROCESSOR_ERROR_6 = "Db_item_processor:Record non presente.";
 const DB_ITEM_PROCESSOR_ERROR_7 = "Db_item_processor:Chiave non esistente.";
 const DB_ITEM_PROCESSOR_ERROR_8 = "Db_item_processor:L'oggetto deve essere un Db_item.";

 private $dbItem=null;
 private $testCandKeyFieldError=self::DB_ITEM_PROCESSOR_ERROR_5;
 private $testPresenceError=self::DB_ITEM_PROCESSOR_ERROR_6;
 private $keyNotExistingError=self::DB_ITEM_PROCESSOR_ERROR_7;
 private $defaultDbOps=true;
 private $dbOpClass=null;

 function __construct(Db_item $actDbItem)
 {
 	parent::__construct($actDbItem);
 }
 
 function setDbItem(Db_item $actDbItem):void
 {
// 	if(! is_a($actDbItem,Classes_info::DB_ITEM_CLASS))
// 	 die(self::DB_ITEM_PROCESSOR_ERROR_1);

 	$dbOpClass = $actDbItem->getDbOp();
 	if(! is_null($dbOpClass))
 	 $this->setDbOp($dbOpClass);

  $this->dbItem = $actDbItem;
 }
 
 function getDbItem():Db_item
 {
 	return $this->dbItem;
 }
 
 function setDefaultDbOps(bool $actDefaultDbOps):void
 {
 	$this->defaultDbOps = $actDefaultDbOps;
 }
 
 function getDefaultDbOps():bool
 {
 	return $this->defaultDbOps;
 } 

 function setTestCandKeyFieldError(string $actTestCandKeyFieldError):void
 {
 	$this->testCandKeyFieldError = $actTestCandKeyFieldError;
 }
 
 function getTestCandKeyFieldError():string
 {
 	return $this->testCandKeyFieldError;
 }
 
 function setInsertDbRowError(string $actInsertDbRowError):void
 {
 	$this->insertDbRowErrorError = $actInsertDbRowError;
 }
 
 function getInsertDbRowError():string
 {
 	return $this->insertDbRowError;
 }
 
 
 function setTestPresenceError(string $actTestPresenceError):void
 {
 	$this->testPresenceError = $actTestPresenceError;
 }
 
 function getTestPresenceError():string
 {
 	return $this->testPresenceError;
 }
 
 function setUpdateDbRowError(string $actUpdateDbRowError):void
 {
 	$this->updateDbRowError = $actUpdateDbRowError;
 }
 
 function getUpdateDbRowError():string
 {
 	return $this->updateDbRowError;
 }
 
 function setDeleteDbRowError(string $actDeleteDbRowError):void
 {
 	$this->deleteDbRowError = $actDeleteDbRowError;
 }
 
 function getDeleteDbRowError():string
 {
 	return $this->deleteDbRowError;
 }
 
 function setKeyNotExistingError(string $actKeyNotExistingError):void
 {
 	$this->keyNotExistingError = $actKeyNotExistingError;
 }
 
 function getKeyNotExistingError():string
 {
 	return $this->keyNotExistingError;
 }
 
 function getDbOp():Generic_db_op
 {
 	return $this->dbOpClass;
 }
 
 function setDbOp(object $actDbOpClass):void
 {
 	if(is_a($actDbOpClass,Classes_info::GENERIC_DB_OP_CLASS))
 	 $this->dbOpClass = $actDbOpClass;
  else
 	 die(self::DB_ITEM_PROCESSOR_ERROR_2);   
 }
 
 function insertData(array $actData):bool
 {
 	$dbItem = $this->getDbItem();
 	if(! is_a($dbItem,Classes_info::DB_NODE_CLASS))
 	 die(self::DB_ITEM_PROCESSOR_ERROR_3);
 	  
  $row = array();
  $j=0;

  foreach($actData as $fieldName => $fieldValue)
  {
   if($dbItem->isFieldInFields($fieldName))
	 {
	 	if(is_null($fieldValue))
	 	 	$row[$fieldName] = $fieldValue;
	 	else
	 	{
	   $type = $dbItem->getFieldTypeByName($fieldName);
 
	   if(ACTIVE_DB == SQLSRV)
	    if ($type == FIELD_TYPE_DATE)
	     $fieldValue = convertToSqlServerDataType($fieldValue);
	 
     $row[$fieldName] = fixSecurityOnSqlArg($fieldValue);
	  }
	 }
  } 
  if(! $dbItem->testCandKeyFields($row,$error))
  {
   $error = $this->getTestCandKeyFieldError() . STRING_COLON . $error;
   $e = Creator::create("Exception",STRING_BACKSLASH,$error);
   throw $e;
  } 

  $res = $dbItem->insertDbRow($row);
  return $res;
 }
   
 function modifyData(array $actData):bool
 {
 	$dbItem = $this->getDbItem();
 	if(! is_a($dbItem,Classes_info::DB_NODE_CLASS))
 	 die(self::DB_ITEM_PROCESSOR_ERROR_3);
  
  $row=array();

  $j=0;
  foreach($actData as $fieldName => $fieldValue)
  {
   if($dbItem->isFieldInFields($fieldName))
	 {
	 	if(is_null($fieldValue))
	 	 	$row[$fieldName] = $fieldValue;
	 	else
	 	{
	   $type = $dbItem->getFieldTypeByName($fieldName);
	 
	   if(ACTIVE_DB == SQLSRV)
	    if ($type == FIELD_TYPE_DATE)
	     $fieldValue = convertToSqlServerDataType($fieldValue);
	 
	   $row[$fieldName] = fixSecurityOnSqlArg($fieldValue);
	  }
	 }
  }
 
  if(! $dbItem->testCandKeyFields($row,$error))
  {
   $error = $this->getTestCandKeyFieldError() . STRING_COLON . $error;
   $e = Creator::create("Exception",STRING_BACKSLASH,$error);
   throw $e;
  }
  
  $keys = $dbItem->getKeyFields(); 
  $key = $keys[0]; 
  
  if(! isset($row[$key]))
  {
   $error = $this->getKeyNotExistingError();
   $e = Creator::create("Exception",STRING_BACKSLASH,$error);
   throw $e;  	
  }
  
  if(! $dbItem->testPresence($row[$key]))
	{
	 $error = $this->getTestPresenceError();
   $e = Creator::create("Exception",STRING_BACKSLASH,$error);
   throw $e;
	}
	
 // Estraggo la riga dal Db non ancora modificata relativa
 // all'oggetto corrente ed all'Id passato nell'array dei 
 // dati (normalmente $_POST).
 // Per ipotesi la chiave è atomica.

  $res = $dbItem->updateDbRow($row);
  return $res;
	
 }  
  
  // Si suppone che venga passato il valore del campo chiave che deve essere numerico.
 function execDelete(string $actKeyVal):bool
 {
 	$dbItem = $this->getDbItem();
 	if(! is_a($dbItem,Classes_info::DB_NODE_CLASS))
 	 die(self::DB_ITEM_PROCESSOR_ERROR_3);

  $res = $dbItem->deleteDbRow($actKeyVal);
  return $res;
 }
 
 function exec():bool|int|string|array
 {
 	$dbItem = $this->getDbItem();
 	if(! is_a($dbItem,Classes_info::DB_ITEM_CLASS))
 	 die(self::DB_ITEM_PROCESSOR_ERROR_8);
  
  $res = $dbItem->getAllDataByQuery();
 	
 	return $res;
 }

}


?>