<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("Db_nodes_container.class.php");

abstract class Int_domain
{
	const CLASS_PREFIX="Int_domain";
	
  const FIELD_DOMAIN_VALUE_NONE  = STRING_NULL;
  const FIELD_DOMAIN_KEY_NONE = STRING_NULL;
  const FIELD_DOMAIN_ATOMIC = "atomic";
  const FIELD_DOMAIN_ATOMIC_STATIC = "atomic_static";
  const FIELD_DOMAIN_TABLE="table";
  const FIELD_DOMAIN_TABLE_NO_LOOKUP = "table_no_lookup";
  const FIELD_DOMAIN_TABLE_UNIQUE_VAL = "table_unique_val";
  const FIELD_DOMAIN_SET="set";
  const FIELD_DOMAIN_OBJ="object";
// I successivi  campi servono solo per il controllo form. 
  const FIELD_DOMAIN_CHECK = "check";
  const FIELD_DOMAIN_RADIO="radio";
  const FIELD_DOMAIN_STATIC_TEXT="static_text";
  const FIELD_DOMAIN_MULTIPLE="multiple";
  const FIELD_DOMAIN_PASSWORD="password";
  const FIELD_DOMAIN_FILE="file";
  const FIELD_DOMAIN_HIDDEN="hidden";
  const FIELD_DOMAIN_FUNCTION="function";
  const FIELD_DOMAIN_STRING_PHP_CODE="string_php_code";
  const FIELD_DOMAIN_NONE='none';	
	
	//Nome del dominio
	protected $name=STRING_NULL;
	//Chiave del dominio
	protected $key=STRING_NULL;
	//Valore del dominio
	protected $value;

	// All'atto della creazione dell'oggetto dominio astratto 
	// posso anche non specificare un valore.
	// Questo sarà Int_domain::::  per
	// default.
	// In questo caso getAllValues ritornerà NO_VALUE.
	function __construct(string $actName)
	{
		$this->name = $actName;
		$this->key = self::FIELD_DOMAIN_KEY_NONE;
		$this->value = self::FIELD_DOMAIN_VALUE_NONE ;
	}
	
	function getName():string
	{
		return $this->name;
	}
	
	function setName(string $actName):void
	{
		$this->name = $actName;
	}
	
	function getValue():mixed
	{
		return $this->value;
	}
	
	function setValue(mixed $actValue):void
	{
		$this->value = $actValue;
	}
	
	function getKey():string
	{
		return $this->key;
	}
	
	function setKey(string $actKey):void
	{
		$this->key = $actKey;
	}
	
	// Metodo virtuale;
	abstract function getAllValues(array|string|int|float|null $actFieldVal):mixed;
	
}


class Int_domain_atomic extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_ATOMIC);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
		{
	   $fieldVal = $actFieldVal;
	  }
	  return $fieldVal;
	}
	
}

class Int_domain_hidden extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_HIDDEN);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}

class Int_domain_password extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_PASSWORD);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}

class Int_domain_set extends Int_domain
{
	const ERROR_1 = "Int_domain_set:errore valore scalare non consentito.";
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_SET);
	}

  function setValue(mixed $actValue):void
  {
  	if($actValue===self::FIELD_DOMAIN_VALUE_NONE )
		 $this->value = array();
		elseif(is_array($actValue))
		 $this->value = $actValue;
		else
		 die(self::ERROR_1);
  }
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}

class Int_domain_multiple extends Int_domain
{
	const ERROR_1 = "Int_domain_multiple:errore valore scalare non consentito.";	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_MULTIPLE);
	}
	
  function setValue(mixed $actValue):void
  {
  	if($actValue===self::FIELD_DOMAIN_VALUE_NONE )
		 $this->value = array();
		elseif(is_array($actValue))
		 $this->value = $actValue;
		else
		 die(self::ERROR_1);
  }
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}

class Int_domain_atomic_static extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_ATOMIC_STATIC);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
	  return $fieldVal;
	}
	
}

class Int_domain_static_text extends Int_domain
{
	
	function __construct()
	{
	 parent::__construct(self::FIELD_DOMAIN_STATIC_TEXT);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
	  return $fieldVal;
	}
	
}

class Int_domain_table extends Int_domain
{
	
	//Riferimento alla struttura del db.
	var $dbStruct;
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_TABLE);
	}
	
	function setDbStruct(?Db_nodes_container $actDbStruct):void
	{
		$this->dbStruct = $actDbStruct;
	}
	
  function getDbStruct():?Db_nodes_container
	{
		return $this->dbStruct;
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
	 $domainKey = $this->getKey();
   $dbStruct = $this->getDbStruct();
	 //
	 // Il nome della tabella è uguale a quello della "chiave del dominio"
	 // che nel caso dei campi con dominio tabelle è definita appunto come il nome
	 // della tabella.
	 //
	 $tableName = $domainKey;
	 //
	 // Il valore del dominio nel caso di domini tabelle è il nome del campo 
	 // della tabella da cui reperire i dati.
	 //
	 $dataField = $this->getValue();
	 $ordField = $dataField;
	 $obj = $dbStruct->getElementByAliasName($tableName);
	 $row1 = $obj->getAllOrdData($ordField,$dataField);
	 $pObjs = $dbStruct->getElementsByName($domainKey);
	 $pObj = $pObjs[0];
	 $pKeys = $pObj->getKeyFields();
   $pKey = $pKeys[0]; 
   //
	 //Per ipotesi la chiave primaria è atomica
	 //
	 $row2 = $obj->getAllOrdData($ordField,$pKey);
	 
	 if((count($row1)>0)&&(count($row2)>0))
	  $row = array_combine($row2,$row1);		 
	 else
	  $row=array();
	  
	 if(($pos = array_getPos($row2,$actFieldVal)))
	 {	 	
	  $row = array_deleteItem($row,$actFieldVal);
	  $row = array_addItemAtFirst($row,$row1[$pos],$actFieldVal);
	 }
	 return $row;
	}
	
}

class Int_domain_table_no_lookup extends Int_domain
{
	var $dbStruct;
		
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_TABLE_NO_LOOKUP);
	}

	function setDbStruct(?Db_nodes_container $actDbStruct):void
	{
		$this->dbStruct = $actDbStruct;
	}
	
  function getDbStruct():?Db_nodes_container
	{
		return $this->dbStruct;
	}	
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
	 $domainKey = $this->getKey();
	 //
	 // Il nome della tabella è uguale a quello della "chiave del dominio"
	 // che nel caso dei campi con dominio tabelle è definita appunto come il nome
	 // della tabella.
	 //
	 $tableName = $domainKey;
	 //
	 // Il valore del dominio nel caso di domini tabelle è il nome del campo 
	 // della tabella da cui reperire i dati.
	 //
	 $dataField = $this->getValue();
	 $ordField = $dataField;
	 $dbStruct = $this->getDbStruct();
	 $obj = $dbStruct->getElementByAliasName($tableName);
	 $row1 = $obj->getAllOrdData($ordField,$dataField);
	 
	 if(count($row1)>0)
	  $row = array_combine($row1,$row1);
	 else
	  $row = array();
	  
	 if(is_int($actFieldVal) || is_string($actFieldVal))
	 if(array_key_exists($actFieldVal,$row))
	 {
	   $row = array_deleteItem($row,$actFieldVal);
	   $row = array_addItemAtFirst($row,$actFieldVal,$actFieldVal);
	 }
	 return $row;
	}
	
}

class Int_domain_table_unique_val extends Int_domain
{
	var $dbStruct;
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_TABLE_UNIQUE_VAL);
	}
	
	function setDbStruct(?Db_nodes_container $actDbStruct):void
	{
		$this->dbStruct = $actDbStruct;
	}
	
  function getDbStruct():?Db_nodes_container
	{
		return $this->dbStruct;
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
	 $domainKey = $this->getKey();
	 //
	 // Il nome della tabella è uguale a quello della "chiave del dominio"
	 // che nel caso dei campi con dominio tabelle è definita appunto come il nome
	 // della tabella.
	 //
	 $tableName = $domainKey;
	 //
	 // Il valore del dominio nel caso di domini tabelle è il nome del campo 
	 // della tabella da cui reperire i dati.
	 //
	 $dataField = $this->getValue();
   $dbStruct = $this->getDbStruct();
	 $obj = $dbStruct->getElementByAliasName($tableName);
   if($actFieldVal != STRING_NULL)
   {
	  $row = $obj->getExtendedUniqueRow($actFieldVal);  
   }
   if(isset($row[$dataField]))
    $val = $row[$dataField];
   else
    $val = STRING_NULL;
	 return $val;
	}
	
}

class Int_domain_object extends Int_domain
{
	const ERROR_0 = "Int_domain_object:Errore oggetto Int_domain_object value.";
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_OBJ);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal=STRING_NULL):mixed
	{
		$domVal = $this->getValue();
		if (is_a($domVal,Classes_info::GENERIC_INTERFACE_CLASS))
//
// E' necessario clonare per poi 
// poter modificare le proprietà senza
// impattare sull'oggetto nel contenitore
// globale
//
		 $val = clone $domVal;
		else
		 die(self::ERROR_0);
		return $val;
	}
}

class Int_domain_radio extends Int_domain
{
	const ERROR_1 = "Int_domain_radio:errore valore scalare non consentito.";	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_RADIO);
	}
	
  function setValue(mixed $actValue):void
  {
  	if($actValue===self::FIELD_DOMAIN_VALUE_NONE )
		 $this->value = array();
		elseif(is_array($actValue))
		 $this->value = $actValue;
		else
		 die(self::ERROR_1);
  }
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}

class Int_domain_none extends Int_domain
{
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_NONE);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
	  return STRING_NULL;
	}
}

class Int_domain_check extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_CHECK);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}


class Int_domain_file extends Int_domain
{
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_FILE);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal):mixed
	{
		$fieldVal = $this->getValue();
		if($fieldVal===self::FIELD_DOMAIN_VALUE_NONE )
	   $fieldVal = $actFieldVal;
	  return $fieldVal;
	}
	
}


class Int_domain_function extends Int_domain
{
	const ERROR_0 = "Int_domain_function:Errore oggetto Int_domain_function value.";	
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_FUNCTION);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal=STRING_NULL):mixed
	{
		$fieldVal = $this->getValue();
		if(! is_callable($fieldVal))
		 die(self::ERROR_0);
	  return $fieldVal;
	}	
}

class Int_domain_string_php_code extends Int_domain
{
	const ERROR_0 = "Int_domain_string_php_code:Errore oggetto Int_domain_string_php_code value.";	
	
	function __construct()
	{
		parent::__construct(self::FIELD_DOMAIN_STRING_PHP_CODE);
	}
	
	function getAllValues(array|string|int|float|null $actFieldVal=STRING_NULL):mixed
	{
		$fieldVal = $this->getValue();
	  return eval($fieldVal);
	}	
}


?>