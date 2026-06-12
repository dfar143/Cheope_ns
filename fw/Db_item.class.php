<?
namespace Cheope_ns\fw;
require_once("GNode.class.php");
require_once("db_item.const.php");
require_once("db_op.fun.php");
require_once("Sqlsrv_db_op.class.php");
require_once("Odbc_db_op.class.php");
require_once("generic.fun.php");

class Db_item extends GNode
{ 
 const ERROR_1 = "Db_item:L'oggetto deve essere un Generic_db_op.";
 const ERROR_2 = "Db_item:Connessione non pronta.";
 const DEFAULT_LOG_ENABLED = false;

 // Query di accesso ai dati.
 private $queryStr=STRING_NULL;
 // Campi;
 private $fields = array();
// Tipo dei campi;
 private $fieldsTypes = array();
 private $aliasName=STRING_NULL;
 private $logEnabled=self::DEFAULT_LOG_ENABLED;
 protected $dbOp=null;
 
 function __construct(string $actName=STRING_NULL)
 {
 	parent::__construct($actName);
 	$this->setAliasName($actName);
 }
 
 function setLogEnabled(bool $actLogEnabled):void
 {
  $this->logEnabled = $actLogEnabled;
 }
 
 function getLogEnabled():bool
 {
  return $this->logEnabled;
 }
 
 function setAliasName(string $actAliasName):void
 {
 	$this->aliasName = $actAliasName;
 }
 
 function getAliasName():string
 {
 	return $this->aliasName;
 } 
 
 function getDbOp():?Generic_db_op
 {
 	return $this->dbOp;
 } 
 
 function setDbOp(?object $actDbOp):void
 {
 	if (is_a($actDbOp,Classes_info::GENERIC_DB_OP_CLASS))
  	$this->dbOp = $actDbOp;
  else die(self::ERROR_1);
 }
 
 function getName():string
 {
 	return parent::getNodeName();
 }
 
 function getQueryStr():string
 {
 	return $this->queryStr;
 }
 
 function setQueryStr(string $actQueryStr):void
 {
 	$this->queryStr = $actQueryStr;
 }
 
 
 function getFields():array
 {
 	return $this->fields;
 }
 
 function setFields(array $actFields):void
 {
 	$this->fields = $actFields;
 }

 function getFieldsTypes():array
 {
  return $this->fieldsTypes; 	
 }
 
 function setFieldsTypes(array $actFieldsTypes):void
 {
 	$this->fieldsTypes = $actFieldsTypes;
 }
 
 function getAllDataByQuery():bool|int|string|array
 {
 	return STRING_NULL;
 }

 function getFieldTypeByName(string $actFieldName):string
 {
  $fields = $this->getFields();
	$fieldsTypes = $this->getFieldsTypes();
	$num = count($fields);
	for($i=0;$i<=$num -1;$i++)
	{
	 if ($fields[$i] == $actFieldName)
	  return $fieldsTypes[$i];
	}
	return FIELD_TYPE_NONE;
 }

 function setFieldTypeByName(string $actFieldName,string $actVal):bool
 {
 	$fields = $this->getFields();
  $fieldsTypes = $this->getFieldsTypes();
	$num = count($fields);
	for($i=0;$i<=$num -1;$i++)
	{
	 if ($fields[$i] == $actFieldName)
	  $fieldsTypes[$i]=$actVal;
	}
	$this->setFieldsTypes($fieldsTypes);
	return true;
 }

 function getFieldTypeByPos(int $actPos):string
 {
  $fieldsTypes = $this->getFieldsTypes();
	if ($actPos <= count($fieldsTypes)-1)
	 return $fieldsTypes[$actPos];
	else
	 return FIELD_TYPE_NONE;
 }

 function setFieldTypeByPos(int $actPos,string $actVal):void
 {
   $fieldsTypes = $this->getFieldsTypes();
	 $fieldsTypes[$actPos] = $actVal;
	 $this->setFieldsTypes($fieldsTypes);
 }
 
 function isFieldInFields(string $actField):bool
 {
  $fields = $this->getFields();
  $num = count($fields);
	for($i=0;$i<=$num-1;$i++)
	{
	 if($actField==$fields[$i])
	  return true;
	}
	return false;
 }
 
 function getGeneralized():bool|string
 {
 }
 
 function ready():bool
 {
   try
   {
   $dbOp=$this->getDbOp();
   if (is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   {
    $dbOp->testConnection();
	return true;
   }
   else
	testConnection();
	return true;
   }
   catch(\Exception $e)
   {
	$logEnabled = $this->getLogEnabled();
	if($logEnabled)
    {
	 $logFileName = PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME .
	 DIR_SEP . strTolower(APPLICATION_NAME) . VAR_SEP . "log" . 
	 FILE_NAME_ELEMENTS_SEP . TXT_SUFFIX;
	 writeToLog($logFileName,$e->getMessage());
	}
	echo self::ERROR_2 . "<br>";
	return false;
   }
 }
 
}

?>