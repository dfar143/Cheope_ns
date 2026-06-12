<?
namespace Cheope_ns\fw;
require_once("Db_item.class.php");
require_once("Db_rel.class.php");

class Db_node extends Db_item
{
 const ERROR_0 = "Errore in getRelsByEntFather: Errato numero di entità.";
 const ERROR_1 = "Errore in getRelsByEntSon: Errato numero di entità.";
 // Chiavi.
 private $keyFields=array();
 // Chiavi candidate; in generale array di array.
 private $candKeyFields=array();
 // Chiavi esterne; in generale array associativo di array.
 private $extKeyFields=array();
 // Partecipazione alle relazioni;
 // Array con un oggetto relazione per ogni parente 
 // se la relazione è di tipo 1:N o M:N e un oggetto relazione
 // per ogni figlio se la relazione è di tipo M:N.
 private $rels=array();

 function __construct(string $actNodeName)
 {
  parent::__construct($actNodeName); 
 }

 function getRels():array
 {
  return $this->rels;
 }
 
 function setRels(array $actRels):void
 {
  $this->rels = $actRels;
 } 
 
 // Seleziona tutte le entita (nomi di oggetti) genealogicamente
 // al livello superiore.
 function getParents():array
 {
  $rels = $this->getRelsByEntSon($this->getName());
	$num = count($rels);
	$parents = array();
	for($i=0;$i<=$num-1;$i++)
	{
	 $rel = $rels[$i];
	 $entities = $rel->getEntities();
	 $parents[$i] = $entities[ENT_FATHER];
	}
	return $parents;
 }
 
 function getRelsByEntityName(string $actTab):array
 {
  $rels = $this->getRels();
	$pRels = array();
	$k=0;
	$num1 = count($rels);
	for($j=0;$j<=$num1-1;$j++)
	{
	 $val = $rels[$j]->getEntities();
	 $num2 = count($val);
	 for($i=0;$i<=$num2-1;$i++)
	 {
		$name = $val[$i];
	  if($actTab == $name)
		 $pRels[$k++] = $rels[$j];
	 }
	}
	return $pRels;
 }
 
 // seleziona le relazioni a cui partecipa l'oggetto
 // considera solo quelle in cui $actTab ha il ruolo di padre
  function getRelsByEntFather(string $actTab):array
 {
  $rels = $this->getRels();
	$pRels = array();
	$k=0;
	$num1 = count($rels);
	for($j=0;$j<=$num1-1;$j++)
	{
	 $entities = $rels[$j]->getEntities();
	 $num2 = count($entities);
	 if($num2==2)
	 {
		$name = $entities[ENT_FATHER];
	  if($actTab == $name)
		 $pRels[$k++] = $rels[$j];
	 }
	 else
	  die(self::ERROR_0);
	}
	return $pRels;
 }
 
 
 // seleziona le relazioni a cui partecipa l'oggetto
 // considera solo quelle in cui $actTab ha il ruolo di figlio 
 function getRelsByEntSon(string $actTab):array
 {
  $rels = $this->getRels();
	$pRels = array();
	$k=0;
	$num1 = count($rels);
	for($j=0;$j<=$num1-1;$j++)
	{
	 $entities = $rels[$j]->getEntities();
	 $num2 = count($entities);
	 if($num2==2)
	 {
		$name = $entities[ENT_SON];
	  if($actTab == $name)
		 $pRels[$k++] = $rels[$j];
	 }
	 else
	  die(self::ERROR_1);
	}
	return $pRels;
 }
 
  function getMNParents():array
 {
  $rels = $this->getRels();
	$subMNObjs = array();
	$objName = $this->getName();
	$num1 = count($rels);
	$k=0;
	for($j=0;$j<=$num1-1;$j++)
	{
	 $rel = $rels[$j];
	 $type = $rel->getRelType($objName);
	 $entities = $rel->getEntities();
	 if($type==REL_M_N)
	  if($entities[ENT_FATHER]==$objName)
	  {
     $subMNObjs[$k] = $entities[ENT_SON];	 	
	   $k++;
	  }
  }
	return $subMNObjs;
 } 

 
 function get1NSons():array
 {
  $rels = $this->getRels();
	$sub1NObjs = array();
	$objName = $this->getName();
	$num1 = count($rels);
	$k=0;
	for($j=0;$j<=$num1-1;$j++)
	{
	 $rel = $rels[$j];
	 $type = $rel->getRelType($objName);
	 $entities = $rel->getEntities();
	 if(($type==REL_1_N)&&($entities[ENT_FATHER]==$objName))
	 {
     $sub1NObjs[$k] = $entities[ENT_SON];	 	
	   $k++;
	 }
  }
	return $sub1NObjs;
 } 
 
 function get1NFathers():array
 {
  $rels = $this->getRels();
	$sub1NObjs = array();
	$objName = $this->getName();
	$num1 = count($rels);
	$k=0;
	for($j=0;$j<=$num1-1;$j++)
	{
	 $rel = $rels[$j];
	 $entities = $rel->getEntities();
   $entFatherRelType = $rel->getRelType($entities[ENT_FATHER]);
	 if(($entities[ENT_SON]==$objName)&&
	  ($entFatherRelType==REL_1_N))
		{
     $sub1NObjs[$k] = $entities[ENT_FATHER];	 	
	   $k++;
		}
  }
	return $sub1NObjs;
 }
 
 function is1NSon(string $actTab):bool
 {
 	$sub1NObjs = $this->get1NSons();
 	if(in_array($actTab,$sub1NObjs))
 	 return true;
 	return false;
 }
 
 function is1NFather(string $actTab):bool 
 {
 	$sub1NObjs = $this->get1NFathers();
 	if(in_array($actTab,$sub1NObjs))
 	 return true;
 	return false;
 }

 function getSubEntities():array
 {
  $rels = $this->getRels();
	$subObjs = array();
	$objName = $this->getName();
	$num1 = count($rels);
	$k=0;
	for($j=0;$j<=$num1-1;$j++)
	{
	 $rel = $rels[$j];
	 $type = $rel->getRelType($objName);
	 $entities = $rel->getEntities();
	 if($type==REL_1_1)
	 {
	  if($entities[ENT_FATHER]==$objName)
		{
     $subObjs[$k] = $entities[ENT_SON];	 	
	   $k++;
		}
	 }
  }
	return $subObjs;
 } 
 
 //*********************************
 	
	
 function getKeyFields():array
 {
  return $this->keyFields;
 }
  
 function setKeyFields(array $actKeyFields):void
 {
  $this->keyFields = $actKeyFields;
 }
 
 //*********************************
 
 function getCandKeyFields():array
 {
  return $this->candKeyFields;
 }
 
 function setCandKeyFields(array $actCandKeyFields):void
 {
  $this->candKeyFields = $actCandKeyFields;
 }
 
 function getCandKeyFieldsByFieldName(string $actFieldName):?array
 {
  $candKeyFields = $this->getCandKeyFields();
	$num = count($candKeyFields);
	for($i=0;$i<=$num-1;$i++)
	{
	 $candKeys = $candKeyFields[$i];
	 $num1 = count($candKeys);
	 for($j=0;$j<=$num1-1;$j++)
	 {
	  $candKey = $candKeys[$j];
	  if ($candKey == $actFieldName)
	   return $candKeys;
	 }
	}
	return NULL;
 }
 
 function isFieldInCandKeyFields(string $actFieldName):bool
 {
  $candKeyFields = $this->getCandKeyFields();
	$num = count($candKeyFields);
	for($i=0;$i<=$num-1;$i++)
	{
	 $candKeys = $candKeyFields[$i];
	 $num1 = count($candKeys);
	 for($j=0;$j<=$num1-1;$j++)
	 {
	  $candKey = $candKeys[$j];
	  if ($candKey == $actFieldName)
	   return true;
	 }
	}
	return false;
 }
 
 function isFieldAKeyField(string $actField):bool
 {
  $fields = $this->getKeyFields();
  $num = count($fields);
	for($i=0;$i<=$num-1;$i++)
	{
	 if($actField==$fields[$i])
	  return true;
	}
	return false; 
 }
 
 
 //*********************************
 function getExtKeyFields():array
 {
  return $this->extKeyFields;
 } 
 
 function setExtKeyFields(array $actExtKeyFields):void
 {
  $this->extKeyFields = $actExtKeyFields;
 } 
 
 //Trova la versione generalizzata dell'entità 
 //corrente,
 //nel caso in cui l'entità è sottoentità di una sola
 //entità generale. 
 function getGeneralized():bool|string
 {
  $rels = $this->getRels();
	$objName = $this->getName();
	$num1 = count($rels);
	for($j=0;$j<=$num1-1;$j++)
	{
	 $rel = $rels[$j];
	 $type = $rel->getRelType($objName);
	 $entities = $rel->getEntities();
	 if($type==REL_GEN)
	 {
	  if($entities[ENT_SON]==$objName)
		{
     $genObjName = $entities[ENT_FATHER];	 	
	   return $genObjName;
		}
	 }
  }
	return false; 	
 }
 
 function getName():string
 {
  return parent::getNodeName();
 }
 
 function getLogDataField():string
 {
  return $this->logDataField;
 }
 
 function setLogDataField(string $actLogDataField):void
 {
  $this->logDataField = $actLogDataField;
 }
 
 function getQueryStr():string
 {
 	$name = $this->getName();
 	return "select * from " . $name;
 }
 
 //
// Controlla se l'array $actRow soddisfi il vincolo di 
// chiave candidata per l'oggetto $actObj
//
function testCandKeyFields(array $actRow,string &$actError):bool
{
 $dbOp = $this->getDbOp();
 $defaultDbOps = true;

 if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
  $defaultDbOps=false;
   
 $actError = STRING_NULL;
 $candKeyFields = $this->getCandKeyFields();
 // $candKeyFields è un array di array;
 //
 $candKeyValues = array();
 $num = count($candKeyFields);
 for($i=0;$i<=$num-1;$i++)
 {
  $candKeys = $candKeyFields[$i];
	$num1 = count($candKeys);
	$candKeyValue = array();
	for($j=0;$j<=$num1-1;$j++)
	{
	 if(isset($actRow[$candKeys[$j]]))
	  $candKeyValue[$j] = $actRow[$candKeys[$j]];
	}
	$candKeyValues[$i] = $candKeyValue;
 }

 $keys = $this->getKeyFields();
 // Ipotesi chiave primaria atomica.
 //
 $key = $keys[0]; 			
 for($i=0;$i<=$num-1;$i++)
 {	
  if(count($candKeyValues[$i])>0)
	{
   ($defaultDbOps==true)?($row1 = getFilteredData($this->getName(),$candKeyFields[$i],$candKeyValues[$i],$key)):
   ($row1 = $this->getFilteredData($candKeyFields[$i],$candKeyValues[$i],$key));
	 // L'istruzione successiva permette la validità 
	 // del test anche se il record dati passato è per
	 // la modifica.
	 //
	 if (isset($actRow[$key]))
	  $row1 = array_deleteItem($row1,$actRow[$key]);
	 if(count($row1)>=1)
	 {
	  $candKey = $candKeyFields[$i];
	  $num1 = count($candKeys);
	  $actError = $candKey[0];
	  for($j=1;$j<=$num1-1;$j++)
	  {
	   $actError = $actError . STRING_COMMA . $candKey[$j] ;
    }
	  return false;
	 }
  }
 }
 return true;
}

 function getAllDataByQuery():bool|int|string|array
 {
  $dbOp = $this->getDbOp();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
    
  $queryStr = $this->getQueryStr();
  try
  {
  ($defaultDbOps==true)?($res = getAllDataByQuery($queryStr)):
  ($res=$dbOp->getAllDataByQuery($queryStr));
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
  return $res; 
 }

 function testPresence(string|int $actKeyVal):bool
 {
 	$dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = testPresence($tabName,$key,$actKeyVal)):
  ($res=$dbOp->testPresence($tabName,$key,$actKeyVal));
  return $res; 
 }
 
 function getMaxId():int
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getMaxId($tabName,$key)):
  ($res=$dbOp->getMaxId($tabName,$key));
  return $res; 
 }
 
 function deleteDbRow(string $actId):void
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?(deleteDbRow($tabName,$key)):
  ($dbOp->deleteDbRow($tabName,$key));
  //return $res;
 }
 
 function deleteDbRows(string $actField,string|int $actVal):int|false
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = deleteDbRows($tabName,$actField,$actVal)):
  ($res=$dbOp->deleteDbRows($tabName,$actField,$actVal));
  return $res;
 }

//
// Effettua update sul primo campo della chiave.
// 
 function updateDbRow(array $actRow):void
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  
  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?(updateDbRow($tabName,$key,$actRow)):
  ($dbOp->updateDbRow($tabName,$key,$actRow));
  //return $res;
 } 
 
 function insertDbRow(array $actRow):void
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?(insertDbRow($tabName,$actRow)):
  ($dbOp->insertDbRow($actRow));
  //return $res;
 } 
 
 function getAllOrdData(string $actOrdField,string $actField):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getAllOrdData($tabName,$actOrdField,$actField)):
  ($res=$dbOp->getAllOrdData($tabName,$actOrdField,$actField));
  return $res;
 } 
 
 function getFilteredOrdData(string $actFilterField,
 int|string $actFilterValue,string $actOrdField,string $actField):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;

  ($defaultDbOps==true)?($res = getFilteredOrdData($tabName,$actFilterField,$actFilterValue,$actOrdField,$actField)):
  ($res=$dbOp->getFilteredOrdData($tabName,$actFilterField,$actFilterValue,$actOrdField,$actField));
  return $res;
 }  
 
 function getFilteredData(string|array $actFilterField,string|int|array $actFilterValue,string $actField):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getFilteredData($tabName,$actFilterField,$actFilterValue,$actField)):
  ($res=$dbOp->getFilteredData($tabName,$actFilterField,$actFilterValue,$actField));
  return $res;
 }  
 
  function getFilteredAllData(string|array $actFilterField,string|int|array $actFilterValue):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getFilteredAllData($tabName,$actFilterField,$actFilterValue)):
  ($res=$dbOp->getFilteredData($tabName,$actFilterField,$actFilterValue));
  return $res;
 } 
 
 function getAllData(string $actField):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getAllData($tabName,$actField)):
  ($res=$dbOp->getAllData($tabName,$actField));
  return $res;
 }   
 
 function getDistinctAllData(string $actField):array
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getDistinctData($tabName,$actField)):
  ($res=$dbOp->getDistinctData($tabName,$actField));
  return $res;
 }  
 
 function getUniqueData(int $actKeyValue,string $actField):string|int|bool
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  
  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getUniqueData($tabName,$key,$actKeyValue,$actField)):
  ($res=$dbOp->getUniqueData($tabName,$key,$actKeyValue,$actField));
  return $res;
 }
 
 function getExtendedUniqueRow(string|int|array $actKeyValue):array|false
 {
  $dbOp = $this->getDbOp();
	$tabName = $this->getName();
  $defaultDbOps = true;
  $keys = $this->getKeyFields(); 
  $key = $keys[0];
  
  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  ($defaultDbOps==true)?($res = getExtendedUniqueRow($tabName,$key,$actKeyValue)):
  ($res=$dbOp->getExtendedUniqueRow($tabName,$key,$actKeyValue));
  return $res;
 }
    
} 


?>