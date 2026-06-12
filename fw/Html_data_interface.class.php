<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("generic.fun.php");
require_once("Int_fields_container.class.php");
require_once("Xml_node.class.php");
require_once("Json_node.class.php");
require_once("Xml_serializer.class.php");
require_once("Json_serializer.class.php");
require_once("Db_nodes_container.class.php");
require_once("Queries_container.class.php");
require_once("Creator.tra.php");
require_once("Init_1.int.php");
require_once("Init_2.int.php");
require_once("Init_3.int.php");

abstract class Html_data_interface extends Html_formatted_interface implements Init_1,Init_2,Init_3
{
 Use Creator;
//const ERROR_1="Html_data_interface:Errore nell'inserimento del grafo del database.";
 const ERROR_1 = "Html_data_interface:Errore nel tipo del campo dati.";
 const ERROR_2="Html_data_interface:Errore nell'inserimento del nodo dati.";
 const ERROR_3="Html_data_interface:Errore nel tipo del domain.";
 const ERROR_4="Html_data_interface:Errore nell'inserimento dei domains values:Oggetto dominio campo dati non esistente.";
 const ERROR_5="Html_data_interface:Errore in setDataFieldDomainValueByPos: Oggetto dominio campo dati non esistente.";
 const ERROR_6="Html_data_interface:Errore Grafo del database vuoto.";
 const ERROR_7="Html_data_interface:Errore Contenitore delle queries vuoto.";
// const ERROR_8="Html_data_interface:Errore nell'inserimento del contenitore queries.";
 const ERROR_9="Html_data_interface:Errore Dominio non valido.";
 const ERROR_10="Html_data_interface:Errore Oggetto non valido.";
 const ERROR_11="Html_data_interface:Errore Dominio non settato per il campo.";
 const ERROR_12="Html_data_interface:L'oggetto dati non pronto.";
// const ERROR_12="Html_data_interface:l'Argomento deve essere un array.";
  
 // Contenitore dei campi Int_field;
 private $intFieldsContainer=null; 
 // Sorgente dati dell'interfaccia.
 private $dataSource=array();

 private $inheritData = false;
 private $inheritDataFieldName = false;
  
 // Ogni istanza della classe è individuata da 
 // un oggetto data source (oggetto Db_item o Serializable), 
 // da un'operazione, da un numero progressivo e
 // da una denominazione di tipo di interfaccia.
 //
 private $obj=null;
 private $dbStruct=null;
 private $dbQueries=null;
 private $fieldsFromDataSource=false;
 static private $htmlDataInterfacesTotNum = 0;
 
 function __construct($actObj,string $actOp,string $actType,$actNum=STRING_NULL)
 {
  $this->setObj($actObj);
  parent::__construct($actOp,$actType,$actNum);
  $this->intFieldsContainer = self::createIntFieldsContainer();
  self::$htmlDataInterfacesTotNum++;
 }
 
 static function isValidDomain(string $actDomain):bool
 {
 	$validDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,
 	Int_domain::FIELD_DOMAIN_TABLE,Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP,Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL,
 	Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_CHECK,Int_domain::FIELD_DOMAIN_RADIO,
 	Int_domain::FIELD_DOMAIN_STATIC_TEXT,Int_domain::FIELD_DOMAIN_MULTIPLE,Int_domain::FIELD_DOMAIN_PASSWORD,
 	Int_domain::FIELD_DOMAIN_FILE,Int_domain::FIELD_DOMAIN_HIDDEN,Int_domain::FIELD_DOMAIN_FUNCTION,
 	Int_domain::FIELD_DOMAIN_STRING_PHP_CODE,Int_domain::FIELD_DOMAIN_NONE);
  if(in_array($actDomain,$validDomains))
   return true;
  return false;
 }
 
 static function createIntFieldsContainer():Int_fields_container
 {
  $intFieldsContainer = Creator::create(getClassNameForCreate(Classes_info::INT_FIELDS_CONTAINER_CLASS));
  return $intFieldsContainer; 
 }
 
 static function createIntField(string $actDataField):Int_field
 {
  $intField = Creator::create(getClassNameForCreate(Classes_info::INT_FIELD_CLASS),STRING_NULL,$actDataField);
  return $intField; 
 }
 
 static function createXmlSerializer(?Generic_interface $actObj=null,string $par1=STRING_NULL):Xml_serializer
 {
  $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,CLIENT_XML_PATH . DIR_SEP . self::getXmlDataSourceCanonicalName($actObj,$par1));
  return $serializer; 
 }
 
 static function createXmlNode(?Generic_interface $actObj=null,string $par1=STRING_NULL):Xml_node
 {
  $serializer = self::createXmlSerializer($actObj,$par1);
  $xmlNode = Creator::create(getClassNameForCreate(Classes_info::XML_NODE_CLASS),STRING_NULL,$serializer);
  return $xmlNode;
 }
 
 static function getXmlDataSourceCanonicalName(?Generic_interface $actObj=null,string $par1=STRING_NULL):string
 {
  if(! is_null($actObj) && is_a($actObj,Classes_info::GENERIC_INTERFACE_CLASS))
   $intId = $actObj->getInterfaceId(); 
  else
   $intId = STRING_NULL;
  return APPLICATION_NAME . VAR_SEP . 
  DEFAULT_PAGE_NAME . VAR_SEP . $intId . VAR_SEP . $par1 .
  VAR_SEP . Xml_node::XML_DATA_SOURCE_SUFFIX . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 }
  
 static function createJsonSerializer(?Generic_interface $actObj=null,string $par1=STRING_NULL):Json_serializer
 {
  $serializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),STRING_NULL,CLIENT_JSON_PATH . DIR_SEP . self::getJsonDataSourceCanonicalName($actObj,$par1));
  return $serializer; 
 }
 
 static function createJsonNode(?Generic_interface $actObj=null,string $par1=STRING_NULL):Json_node
 {
  $serializer = self::createJsonSerializer($actObj,$par1);
  $jsonNode = Creator::create(getClassNameForCreate(Classes_info::JSON_NODE_CLASS),$serializer);
  return $jsonNode;
 }

 static function getJsonDataSourceCanonicalName(?Generic_interface $actObj=null,string $par1=STRING_NULL):string
 {
  if(! is_null($actObj) && is_a($actObj,Classes_info::GENERIC_INTERFACE_CLASS))
   $intId = $actObj->getInterfaceId(); 
  else
   $intId = STRING_NULL;
   
  return APPLICATION_NAME . VAR_SEP . 
  DEFAULT_PAGE_NAME . VAR_SEP . $intId . VAR_SEP . $par1 .
  VAR_SEP . Json_node::JSON_DATA_SOURCE_SUFFIX . FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX;
 }
 
 static function getInterfacesTotNum():string|int
 {
  return self::$htmlDataInterfacesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
  self::$htmlDataInterfacesTotNum=$actIntNum;
 }
 
 function serializer_setFileName(string $actSuffix=STRING_NULL):void
 {
  $serializer = $this->getSerializer();
  $obj = $this->getObj();
  $op = $this->getOp();
  $type = $this->getType();
  $num = $this->getNum();
  $shortName = $this->getShortName();

  //print_r("Q" . $obj . "Q");
  //echo get_class((object)$obj);
  //echo "<br/>";
  //die('mmm');
   if(is_a($obj,Classes_info::GNODE_CLASS))
   {
    $objName = $obj->getAliasName();
    $fileName = $objName . Xml_interface_serializer::INTERFACE_NAME_SEP . 
    $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . 
    Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
   }
   elseif($obj == OBJ_DATA_SOURCE)
   {
    $fileName = "Data_source" . Xml_interface_serializer::INTERFACE_NAME_SEP . 
    $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . 
    Xml_interface_serializer::INTERFACE_NAME_SEP . $num;   
   }
   else
   {
    $fileName = STRING_NULL . Xml_interface_serializer::INTERFACE_NAME_SEP . 
    $type . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . 
    Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
   }
   if($actSuffix != STRING_NULL)
   {
    $serializer->setAppName($actSuffix);
    if($shortName === STRING_NULL)
    {
     $pageName = $serializer->getPageName();
     $serializer->setFileName($actSuffix . Xml_interface_serializer::INTERFACE_NAME_SEP .
     $pageName . Xml_interface_serializer::INTERFACE_NAME_SEP .
     $fileName);
    }
    else
     $serializer->setFileName($shortName);
   }
   else
   {
    $appName = $serializer->getAppName();
    $pageName = $serializer->getPageName();
    if($shortName === STRING_NULL)
    {
     if($appName !== STRING_NULL)
     {
      $serializer->setFileName($appName . 
      Xml_interface_serializer::INTERFACE_NAME_SEP .
      $pageName .
      Xml_interface_serializer::INTERFACE_NAME_SEP .
      $fileName);
     }
     else
      $serializer->setFileName($fileName);
    }
    else
     $serializer->setFileName($shortName);    
   } 
 }
 
 function serializer_loadData(string $actSuffix=STRING_NULL):void
 {
  $serializer = $this->getSerializer();
  $serializerDbStruct = $serializer->getDbStruct();
  $interfaceDbStruct = $this->getDbStruct();
  if(is_null($serializerDbStruct) && (! is_null($interfaceDbStruct)))
   $serializer->setDbStruct($interfaceDbStruct);
  elseif((! is_null($serializerDbStruct)) && is_null($interfaceDbStruct))
   $this->setDbStruct($serializerDbStruct);
  elseif((is_null($serializerDbStruct))&&(is_null($interfaceDbStruct)))
  {
   die(self::ERROR_6);
  }
   
  $serializerDbQueries = $serializer->getDbQueries();
  $interfaceDbQueries = $this->getDbQueries();
  if(is_null($serializerDbQueries) && ! is_null($interfaceDbQueries))
   $serializer->setDbQueries($interfaceDbQueries);
  elseif(! is_null($serializerDbQueries) && is_null($interfaceDbQueries))
   $this->setDbQueries($serializerDbQueries);
  elseif((is_null($serializerDbQueries))&&(is_null($interfaceDbQueries)))
   die(self::ERROR_7);
 // 	 echo "WWWWWWWWW";
  parent::serializer_loadData($actSuffix);
 }
 
 function serialize():void
 {
	//parent::serialize();
 	//$serializer = $this->getSerializer();
	//$booleanPropsArray = array("inheritData","inheritDataFieldName","fieldsFromDataSource");
	//$textPropsArray = array("style");
	//$this->serialize_props_exec($booleanPropsArray);
  
  parent::serialize();
  $serializer = $this->getSerializer();
  $dataFields = $this->getDataFields();
  $dataFieldsDomains = $this->getDataFieldsDomains();
  $dataFieldsDomainsValues = $this->getDataFieldsDomainsValues();
  $dataSource = $this->getDataSource();
  $fieldsFromDataSource = $this->getFieldsFromDataSource();
  $obj = $this->getObj();
  $item1 = array("obj"=>$obj);
  $serializer->loadItems($item1);
  $inheritData = $this->getInheritData();
  $item2 = array("*inheritData"=>$inheritData);
  $serializer->loadItems($item2); 
  $inheritDataFieldName = $this->getInheritDataFieldName();
  $item3 = array("*inheritDataFieldName"=>$inheritDataFieldName);
  $serializer->loadItems($item3); 
  $item4 = array("\$dataFields"=>$dataFields);
  $serializer->loadItems($item4);
  $item5 = array("\$dataFieldsDomains"=>$dataFieldsDomains);
  $serializer->loadItems($item5);
  $item6 = array("\$dataFieldsDomainsValues"=>$dataFieldsDomainsValues);
  $serializer->loadItems($item6);
  $item7 = array("\$dataSource"=>$dataSource);
  $serializer->loadItems($item7);
  $item8 = array("*fieldsFromDataSource"=>$fieldsFromDataSource);
  $serializer->loadItems($item8);
 }
 
 function convertToAssociative(array $actArray):array
 {
 	$newArray = array();
 	$dataFields = $this->getDataFields();
 	foreach($actArray as $ind=>$val)
 	{
 		if(is_numeric($ind))
 		{
 		 if(isset($dataFields[$ind]))
 		 {
 		  $key = $dataFields[$ind];
 		  $newArray[$key] = $val;
 	   }
 	  }
 	  else
 	   $newArray[$ind]=$val;
 	}
 	return $newArray;
 }

 //
 // <S>tatic Convert to associative
 // 
 static function sConvertToAssociative(array $actArray,array $actFields):array
 {
 	$newArray = array();
 	foreach($actArray as $ind=>$val)
 	{
 		if(is_numeric($ind))
 		{
 		 if(isset($actFields[$ind]))
 		 {
 		  $key = $actFields[$ind];
 		  $newArray[$key] = $val;
 	   }
 	  }
 	  else
 	   $newArray[$ind]=$val;
 	}
 	return $newArray;
 }
 
 static function isAPropFieldBool(array $actArray,array $actFields):bool
 {
 	$retVal=false;
 	foreach($actArray as $val)
 	{
 		if(in_array($val,$actFields,true))
 		{ 
 		 $retVal=true;
 		 break;
 		}
 	}
 	return $retVal;
 }

 //
 // <S>tatic Is a field a suitable array
 //  
 function isAFieldSuitableArray(array $actArray):bool
 {
 	$i=0;
 	$newArray = $this->convertToAssociative($actArray);
 	$newArray2=array();
 	$dataFields = $this->getDataFields();
 	foreach($newArray as $ind=>$val)
 	{
 		if(in_array($ind,$dataFields))
 		 $newArray2[$ind] = $val;
 	}
 	if(count($actArray)==count($newArray2))
 	 return true;
 	return false;
 }
 
 static function sIsAFieldSuitableArray(array $actArray,array $actFields):bool
 {
 	$i=0;
 	$newArray = self::sConvertToAssociative($actArray,$actFields);
 	$newArray2=array();
 	foreach($newArray as $ind=>$val)
 	{
 		if(in_array($ind,$actFields))
 		 $newArray2[$ind] = $val;
 	}
 	if(count($actArray)==count($newArray2))
 	 return true;
 	return false;
 }
 
 function convertToKeysNumeric(array $actArray,mixed $actDefaultValue=STRING_NULL):array
 {
 	$newArray = array();
 	$isPartAssoc = array_is_part_assoc($actArray);
 	$isNumeric = array_is_numeric($actArray);
 	$dataFields = $this->getDataFields();
 	if(count($dataFields)>0)
 	{
 	 foreach($dataFields as $ind=>$val)
 	 {
 		if(item_in_array_keys($val,$actArray))
 	   $newArray[$ind] = $actArray[$val];
 	  elseif(isset($actArray[$ind]))
 	   $newArray[$ind] = $actArray[$ind];
 	  elseif(($isPartAssoc)||($isNumeric))
 	   $newArray[$ind] = $actDefaultValue;
 	 }
 	 return $newArray;
  }
  return $actArray;
 }

 //
 // <S>tatic convert to keys numeric
 //  
 static function sConvertToKeysNumeric(array $actArray,
 array $actFields,mixed $actDefaultValue=STRING_NULL):array
 {
 	$newArray = array();
 	$isPartAssoc = array_is_part_assoc($actArray);
 	$isNumeric = array_is_numeric($actArray);
 	foreach($actFields as $ind=>$val)
 	{
 		if(item_in_array_keys($val,$actArray))
 	   $newArray[$ind] = $actArray[$val];
 	  elseif(isset($actArray[$ind]))
 	   $newArray[$ind] = $actArray[$ind];
 	  elseif(($isPartAssoc)||($isNumeric))
 	   $newArray[$ind] = $actDefaultValue;
 	}
 	return $newArray;
 }

 function setInheritData(bool $actInheritData):void
 {
 	$this->inheritData = $actInheritData;
 }
 
 function getInheritData():bool
 {
 	return $this->inheritData;
 }
 
 function setInheritDataFieldName(bool $actInheritDataFieldName):void
 {
 	$this->inheritDataFieldName = $actInheritDataFieldName;
 }
 
 function getInheritDataFieldName():bool
 {
 	return $this->inheritDataFieldName;
 } 
 
 function setDbStruct(?Db_nodes_container $actDbStruct)
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
 
 function getFieldsFromDataSource():bool
 {
  return $this->fieldsFromDataSource;
 }
 
 function setFieldsFromDataSource(bool $actFieldsFromDataSource):void
 {
  $this->fieldsFromDataSource=$actFieldsFromDataSource;
 }
 
 function fieldsFromDataSource():void
 {
  if($this->getFieldsFromDataSource())
  {
   $dataSource = $this->getDataSource();
   if(is_array($dataSource)&& (count($dataSource)>0))
   {
    $dataSourceRow = ((isset($dataSource[0]))?$dataSource[0]:current($dataSource));
    if(is_array($dataSourceRow) && (count($dataSourceRow)>0))
    {
     $dataSourceFields = $dataSourceRow;  
    }
    elseif(! is_array($dataSourceRow))
    {
     $dataSourceFields = $dataSource;
    }     
    $fields = array();
    $i=0;
    foreach($dataSourceFields as $field=>$val)
    {
     $fields[$i++] = $field;
    }
    $this->setAndPreserveDataFields($fields);
   }
  }
 }
 
 function getObj():object|string|null
 {
	// echo "$$$$$";
  return $this->obj;
 }
 
 function setObj(object|string|null $actObj):void
 {
  if(is_a($actObj,Classes_info::DB_ITEM_CLASS))
  {
   $nodeName = $actObj->getAliasName();
   if(($nodeName==OBJ_NONE)||($nodeName=="OBJ_NONE"))
    $this->obj = OBJ_NONE;
   else
    $this->obj = $actObj;
  }
  elseif(is_a($actObj,Classes_info::SERIALIZABLE_NODE_CLASS))
  {
  $nodeName = $actObj->getName();
   if(($nodeName==OBJ_NONE)||($nodeName=="OBJ_NONE"))
    $this->obj = OBJ_NONE;
   else
    $this->obj = $actObj;
  }
  elseif($actObj==OBJ_NONE)
   $this->obj = OBJ_NONE;
  elseif($actObj==OBJ_DATA_SOURCE)
   $this->obj = OBJ_DATA_SOURCE;
  else
   die(self::ERROR_2);
 }
 
 function getCompleteInterfaceId(string $actSepChar=Generic_interface::INTERFACE_ID_CHAR_SEP):string
 {
  $obj = $this->getObj();
  if($obj==OBJ_NONE)
  {
    $interfaceId = $actSepChar . $this->getInterfaceId($actSepChar);
  }
  else
  {
    $interfaceId = $obj->getName() . $actSepChar . $this->getInterfaceId($actSepChar);
  }
  return $interfaceId;
 }
 
 function getInstanceName(string $actSepChar=Generic_interface::INTERFACE_INSTANCE_CHAR_SEP):string
 {
  $obj = $this->getObj();
  if($obj==OBJ_NONE)
  {
    $instanceName = $this->getAppName() . $actSepChar .
    $this->getPageName() . $actSepChar . $actSepChar . 
    $this->getInterfaceId($actSepChar);
  }
  else
  {
    $instanceName = $this->getAppName() . $actSepChar .
   $this->getPageName() . $actSepChar . $obj->getName() . 
   $actSepChar . 
   $this->getInterfaceId($actSepChar);
  }
  return $instanceName;
 }
 
 function getIntFieldsContainer():?Int_fields_container
 {
  return $this->intFieldsContainer;
 }
 
 function setIntFieldsContainer(?Int_fields_container $actIntFieldsContainer):void
 {
   $this->intFieldsContainer = $actIntFieldsContainer;
 }
 
 function deleteField(string $actFieldName):bool
 {
  $dataFields = $this->getDataFields();
  if(in_array($actFieldName,$dataFields))
  {
   $newIntArray = array();
   $intFieldsContainer = $this->getIntFieldsContainer();
   $intFields = $intFieldsContainer->getContents();
   $intIter = $intFieldsContainer->create();
   $i=0;
   $intIter->reset();
   while($intIter->hasMore())
   {
   	$currField = $intIter->current();
   	if($currField->getName()!==$actFieldName)
     $newIntArray[$i++] = $currField;
    $intIter->next();
   }
   $intIter->reset();
   $intFieldsContainer->setContents($newIntArray);
   return true;
  }
  return false;
 }
 
 function addField(string $actFieldName,
 mixed $actFieldDomainValue=Int_domain::FIELD_DOMAIN_VALUE_NONE,
 string $actFieldDomain=Int_domain::FIELD_DOMAIN_NONE):Html_data_interface
 {
  $dataFields = $this->getDataFields();
  $num = count($dataFields);
  $domainKey = $num;
  $domainValue = $actFieldDomainValue;
  $intFieldsContainer = $this->getIntFieldsContainer();
//
// provo a indovinare il dominio
// dal valore
// 
  if($actFieldDomain==Int_domain::FIELD_DOMAIN_NONE)
  {
   if(is_callable($actFieldDomainValue))
   {
    $fieldDomain=Int_domain::FIELD_DOMAIN_FUNCTION;
   }
   elseif(is_object($actFieldDomainValue))
   {
    $fieldDomain=Int_domain::FIELD_DOMAIN_OBJ;
   }
   elseif(is_array($actFieldDomainValue))
   {
    $fieldDomain=Int_domain::FIELD_DOMAIN_SET;
   }
   else
   {
    $fieldDomain=Int_domain::FIELD_DOMAIN_ATOMIC;
   } 
  }
  else
  {
    $fieldDomain = $actFieldDomain;
  }
  $fieldDomainValue = $actFieldDomainValue;
   
  if(! in_array($actFieldName,$dataFields))
  {   
   $newIntField = self::createIntField($actFieldName);
   $newIntField->setDomain($fieldDomain); 
   $domObj = $this->createDomainObj($fieldDomain);
   $newIntField->setDomainObj($domObj);
 	 $newIntField->setDomainValue($fieldDomainValue);
   if(($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE)||
   ($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP)||
   ($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL))
   {
    $keys = array_keys($fieldDomainValue);
    $domainKey = $keys[0];
    $domainValues = array_values($fieldDomainValue);
    $domainValue = $domainValues[0];
   }
   $newIntField->setDomainValue($domainValue);
   $newIntField->setDomainKey($domainKey);
   $domObj = $newIntField->getDomainObj();
   $domObj->setKey($domainKey);
   $domObj->setValue($domainValue);
   $intFieldsContainer->add($newIntField);
  }
  else
  {
   $intField = $intFieldsContainer->getField($actFieldName);
   $intField->setDomain($fieldDomain);
   $intField->setDomainValue($fieldDomainValue);
   $dataFields = $this->getDataFields();
   $num = array_getKey($dataFields,$actFieldName);
   $domainKey = $num;
   if(($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE)||
   ($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP)||
   ($fieldDomain==Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL))
   {
    $keys = array_keys($fieldDomainValue);
    $domainKey = $keys[0];
    $domainValues = array_values($fieldDomainValue);
    $domainValue = $domainValues[0];
   }
   $intField->setDomainValue($domainValue);
   $intField->setDomainKey($domainKey);
   $domObj = $intField->getDomainObj();
   $domObj->setKey($domainKey);
   $domObj->setValue($domainValue);        
  } 
  return $this;
 }

 function getDataFields():array
 {
  $dataFields = array();
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    $dataFields[$i] = $intField->getName(); 
    $i++;
    $intFieldsIterator->next();
  }
  return $dataFields;
 }
 
 function setAndPreserveDataFields(array $actDataFields):void
 {
 	$intFieldsContainer = $this->getIntFieldsContainer();
 	$num2 = count($actDataFields);
 	$oldDataFields = $this->getDataFields();
 	for($i=0;$i<=$num2-1;$i++)
 	{
 	 $newDataField = $actDataFields[$i];
 	 if(! in_array($newDataField,$oldDataFields))
 	 {
 	  $newIntField = self::createIntField($newDataField);
 	  $newIntField->setName($newDataField); 
 	  $newIntField->setDomain(Int_domain::FIELD_DOMAIN_ATOMIC);
 	  $domObj = $this->createDomainObj(Int_domain::FIELD_DOMAIN_ATOMIC);
 	  $newIntField->setDomainObj($domObj);
 	  $newIntField->setDomainValue(Int_domain::FIELD_DOMAIN_VALUE_NONE);
 	  $newIntField->setDomainKey($i);
 		$intFieldsContainer->add($newIntField);
 	 }
 	}	
 	$this->setIntFieldsContainer($intFieldsContainer);
 }

 function setDataFields(array $actDataFields):void
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $num2 = count($actDataFields);
  for($i=0;$i<=$num2-1;$i++)
  {
   $newIntField = self::createIntField($actDataFields[$i]);
   $newIntField->setName($actDataFields[$i]); 
   $newIntField->setDomain(Int_domain::FIELD_DOMAIN_ATOMIC);
   $domObj = $this->createDomainObj(Int_domain::FIELD_DOMAIN_ATOMIC);
   $newIntField->setDomainObj($domObj);
   $newIntField->setDomainValue(Int_domain::FIELD_DOMAIN_VALUE_NONE);
   $newIntField->setDomainKey($i);
   if (! $intFieldsContainer->setElement($newIntField,$i))
   {
     $intFieldsContainer->add($newIntField);
   }
  } 
 }
 
 function setFields():Html_data_interface
 {
  $dataFields=array();
  foreach(func_get_args() as $arg)
  if(gettype($arg)=="string")
  {
   $dataFields[]=$arg;
  }
  else
   die(self::ERROR_1);
  $this->setDataFields($dataFields);
  return $this;
 }
 
 // Gestione dei domini dei campi;
 //
 function getDataFieldsDomains():array
 {
  $dataFieldsDomains = array();
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    $dataFieldsDomains[$i] = $intField->getDomain(); 
    $i++;
    $intFieldsIterator->next();
  }
  return $dataFieldsDomains;
 }
 
 function setDomains():Html_data_interface
 {
  $dataFieldsDomains=array();
  foreach(func_get_args() as $arg)
  if(gettype($arg)=="string")
  {
   $dataFieldsDomains[]=$arg;
  }
  else
   die(self::ERROR_3);
  $i=0;
  $dim = count($dataFieldsDomains);
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  while(($i<=$dim-1)&&($intFieldsIterator->hasMore()))
  { 
   $intField = $intFieldsIterator->current();
   $intField->setDomain($dataFieldsDomains[$i]); 
   $domObj = $this->createDomainObj($dataFieldsDomains[$i]);
   $intField->setDomainObj($domObj);
   $i++;
   $intFieldsIterator->next();	
  }
  return $this;
 }
 
 function setDataFieldsDomains(array $actDataFieldsDomains):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    if(isset($actDataFieldsDomains[$i]))
    {
     $intField->setDomain($actDataFieldsDomains[$i]); 
     $domObj = $this->createDomainObj($actDataFieldsDomains[$i]);
     $intField->setDomainObj($domObj);
     $i++;
     $intFieldsIterator->next();
    }
    else
     return false;
  } 
  return true;
 }
 
 function getDataFieldDomainByPos(int $actPos):string|bool
 {
  $fieldsDomains = $this->getDataFieldsDomains();
  if (isset($fieldsDomains[$actPos]))
   return $fieldsDomains[$actPos];
  else
   return false;
 }
 
 function setDataFieldDomainByPos(int $actPos,string $actVal):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
   $intField = $intFieldsIterator->current();
   if($actPos==$i)
   {
    $intField->setDomain($actVal); 
    $domObj = $this->createDomainObj($actVal);
    $intField->setDomainObj($domObj);
    return true;
   }
   $intFieldsIterator->next();
   $i++;
  }
  return false;
 }
 
 function getDataFieldDomainByName(string $actFieldName):string
 {
  $fields = $this->getDataFields();
  $dataFieldsDomains = $this->getDataFieldsDomains();
  $num = count($fields);
  for($i=0;$i<=$num-1;$i++)
  {
   if (($fields[$i] == $actFieldName)&&(isset($dataFieldsDomains[$i])))
   {
    return $dataFieldsDomains[$i];
   }
  }
  return Int_domain::FIELD_DOMAIN_NONE;
 }
 
 function setDataFieldDomainByName(string $actFieldName,string $actVal):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
   $intField = $intFieldsIterator->current();
   $field = $intField->getName();
   if ($field == $actFieldName)
   {
    $intField->setDomain($actVal); 
    $domObj = $this->createDomainObj($actVal);
    $intField->setDomainObj($domObj);
    return true;
   }
   $intFieldsIterator->next();
  }
  return false;
 } 
 
 
 // Gestione dei valori dei domini dei campi;
 //
 function getDataFieldsDomainsValues():array
 {
  $dataFieldsDomainsValues = array();
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $i=0;
  $intFieldsIterator->reset();
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    $domainKey = $intField->getDomainKey();
    $dataFieldsDomainsValues[$domainKey] = $intField->getDomainValue(); 
    $i++;
    $intFieldsIterator->next();
  }
  return $dataFieldsDomainsValues;
 }
 
 function setValues():Html_data_interface
 {
  $dataFieldsDomainsValues=array();
  foreach(func_get_args() as $arg)
   $dataFieldsDomainsValues[]=$arg;
  $i=0;
  $dim = count($dataFieldsDomainsValues);
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  while(($i<=$dim-1)&&($intFieldsIterator->hasMore()))
  { 
   $intField = $intFieldsIterator->current();
   $intField->setDomainValue($dataFieldsDomainsValues[$i]);
   $intField->setDomainKey($i);
   $domObj = $intField->getDomainObj();
   $intField->setDomainObj($domObj);
   if(isset($domObj) && (! is_null($domObj)))
   {
    $domObj->setKey($i);
    $domObj->setValue($dataFieldsDomainsValues[$i]);
   }
   else
    die(self::ERROR_4);
   $i++;
   $intFieldsIterator->next();	
  }
  return $this;
 }
 
 function setDataFieldsDomainsValues(array $actDataFieldsDomainsValues):bool
 {
//  $buf = array();
//  if(is_array($actDataFieldsDomainsValues))
//  {  
  $dataFieldsDomainsValues2 = array_values($actDataFieldsDomainsValues);  
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $dataFieldsDomainsKeys = array_keys($actDataFieldsDomainsValues);
  $i=0;
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    $fieldName = $intField->getName();
    if(isset($dataFieldsDomainsValues2[$i]))
    {
     $intField->setDomainValue($dataFieldsDomainsValues2[$i]);
     $intField->setDomainKey($dataFieldsDomainsKeys[$i]);
     $domObj = $intField->getDomainObj();
     if(isset($domObj) && (! is_null($domObj)))
     {
      $domObj->setKey($dataFieldsDomainsKeys[$i]);
      $domObj->setValue($dataFieldsDomainsValues2[$i]);
     }
     else
      die(self::ERROR_4);
     $i++;
     $intFieldsIterator->next();
    }
    else
     return false;
  }
  return true;
//  }
//  else
//   die(self::ERROR_12);    
 }
 
 function getDataFieldDomainValueByPos(int $actPos):mixed
 {
  $dataFieldsDomainsValues = $this->getDataFieldsDomainsValues();
  if (isset($dataFieldsDomainsValues[$actPos]))
   return $dataFieldsDomainsValues[$actPos];
  else
  {
    $retVal = Int_domain::FIELD_DOMAIN_VALUE_NONE ; 
    return $retVal;
  }
 }
 
 function setDataFieldDomainValueByPos(int $actPos,mixed $actVal):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
   $intField = $intFieldsIterator->current();
   if($i==$actPos)
   {
     $intField->setDomainValue($actVal);
     $domObj = $intField->getDomainObj();
     if (! is_null($domObj))
     {
      $domObj->setValue($actVal);
      return true;
     }
     else
      die(self::ERROR_5);
   }
   $intFieldsIterator->next();
   $i++;
  }
  return false;
 }
 
 function getDataFieldDomainValueByName(string $actFieldName):mixed
 {
  $fields = $this->getDataFields();
  $dataFieldsDomainsValues1 = $this->getDataFieldsDomainsValues();
  // La funzione array_values cancella le chiavi dell'array 
  // passato come argomento e reindicizza per numero; 
  // per questo è necessario lavorare su di una
  // copia.
  $dataFieldsDomainsValues3 = array_values($dataFieldsDomainsValues1);
  $num = count($fields);
  for($i=0;$i<=$num-1;$i++)
  {
   if (($fields[$i] == $actFieldName)&&(isset($dataFieldsDomainsValues3[$i])))
    return $dataFieldsDomainsValues3[$i];
  }
  $retVal = Int_domain::FIELD_DOMAIN_VALUE_NONE ; 
  return $retVal;
 }
 
 // Viene usato per i campi con dominio di tipo tabella.
 // In pratica ritorna il nome della tabella associata.
 //
 function getDataFieldDomainKeyByName(string $actFieldName):string
 {
  $fields = $this->getDataFields();
  $dataFieldsDomainsValues = $this->getDataFieldsDomainsValues();
  $dataFieldsDomainsKeys = array_keys($dataFieldsDomainsValues);
  $num = count($fields);
  for($i=0;$i<=$num-1;$i++)
  {
   if ($fields[$i] == $actFieldName)
    return $dataFieldsDomainsKeys[$i];
  }
  $retVal = Int_domain::FIELD_DOMAIN_KEY_NONE;
  return $retVal;
 }
 
 function setDataFieldDomainValueByName(string $actFieldName,mixed $actVal):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  while($intFieldsIterator->hasMore())
  {
   $intField = $intFieldsIterator->current();
   $field = $intField->getName();
   if ($field == $actFieldName)
   {
    $intField->setDomainValue($actVal); 
    $domObj = $intField->getDomainObj();
    $domObj->setValue($actVal);
    return true;
   }
   $intFieldsIterator->next();
  }
  return false;
 }  
 
 // Factory method...non implementato in modo canonico, ma 
 // sfruttando la tecnica delle variabili funzione;
 function createDomainObj(string $actDomName):Int_domain
 {
   if(self::isValidDomain($actDomName))
   {
    $objConstructorName = Int_domain::CLASS_PREFIX . VAR_SEP . $actDomName;
    $domObj = Creator::create($objConstructorName);
    if(($actDomName==Int_domain::FIELD_DOMAIN_TABLE)||
    ($actDomName==Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL)||
    ($actDomName==Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP))
    {
     $dbStruct = $this->getDbStruct();
     $domObj->setDbStruct($dbStruct);
    }
    return $domObj;
   }
   else
    die(self::ERROR_9);
 }
 
 function getDataFieldsDomainsObjs():array
 {
  $dataFieldsDomainsObjs = array();
  $intFieldsContainer = $this->getIntFieldsContainer();
  $intFieldsIterator = $intFieldsContainer->create();
  $i=0;
  $intFieldsIterator->reset();
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    $dataFieldsDomainsObjs[$i] = $intField->getDomainObj(); 
    $i++;
    $intFieldsIterator->next();
  }
  return $dataFieldsDomainsObjs;
 }
 
 function setDataFieldsDomainsObjs(array $actDataFieldsDomainsObjs):bool
 {
  $intFieldsContainer = $this->getIntFieldsContainer();  
  $intFieldsIterator = $intFieldsContainer->create();
  $intFieldsIterator->reset();
  $i=0;
  while($intFieldsIterator->hasMore())
  {
    $intField = $intFieldsIterator->current();
    if(isset($actDataFieldsDomainsObjs[$i]))
    {
     $intField->setDomainObj($actDataFieldsDomainsObjs[$i]); 
     $i++;
     $intFieldsIterator->next();
    }
    else
     return false;
  }
  return true;
 }
 
 function getDataFieldDomainObjByPos(int $actPos):?Int_domain
 {
  $dataFieldsDomainsObjs = $this->getDataFieldsDomainsObjs();
  if (isset($dataFieldsDomainsObjs[$actPos]))
   return $dataFieldsDomainsObjs[$actPos];
  else
   return NULL;
 }
 
 function getDataFieldDomainObjByName(string $actFieldName):?Int_domain
 {
  $fields = $this->getDataFields();
  $dataFieldsDomainsObjs = $this->getDataFieldsDomainsObjs();
  $num = count($fields);
  for($i=0;$i<=$num-1;$i++)
  {
   if (($fields[$i] == $actFieldName)&&(isset($dataFieldsDomainsObjs[$i])))
   {
    return $dataFieldsDomainsObjs[$i];
   }
  }
  $ret = NULL;
  return $ret;
 }
 
 function setDataFieldDomainObjByPos(int $actPos,?Int_domain $actDomObj):bool
 {
  $dataFieldsDomainsObjs = $this->getDataFieldsDomainsObjs();
  if(isset($dataFieldsDomainsObjs[$actPos]))
  {
   $dataFieldsDomainsObjs[$actPos] = $actDomObj;
   $this->setDataFieldsDomainsObjs($dataFieldsDomainsObjs);
   return true;
  }
  else
   return false;
 }
 
 function setDataFieldDomainObjByName(string $actFieldName,?Int_domain $actDomObj):bool
 {
  $fields = $this->getDataFields();
  $dataFieldsDomainsObjs = $this->getDataFieldsDomainsObjs();
  $num = count($fields);
  for($i=0;$i<=$num-1;$i++)
  {
   if (($fields[$i] == $actFieldName)&&(isset($dataFieldsDomainsObjs[$i])))
   {
    $dataFieldsDomainsObjs[$i] = $actDomObj;
    $this->setDataFieldsDomainsObjs($dataFieldsDomainsObjs);
    return true;
   }
  }
  return false;
 }  
 
 function getDataFieldType(string $actField):string
 {
  $obj = $this->getObj();
  if(is_a($obj,Classes_info::DB_ITEM_CLASS))
  {
   if(! $obj->isFieldInFields($actField))
   {
    $genEntity = $obj->getGeneralized();
    if($genEntity)
    {
     $dbStruct = $this->getDbStruct();
     $genObjs = $dbStruct->getElementsByName($genEntity);
     $genObj = $genObjs[0];
     $type = $genObj->getFieldTypeByName($actField);
    }
    else
     $type = FIELD_TYPE_NONE;
   }
   else
    $type = $obj->getFieldTypeByName($actField);
  }
  else
   $type = FIELD_TYPE_NONE;
  return $type;
 }
 
 function setDataSource(array|string|null $actDataSource):void
 {
  $this->dataSource = $actDataSource;
 } 
  
 function getDataSource():array|string|null
 {
  if((! isset($this->dataSource)) || (! is_array($this->dataSource)) 
  || (is_array($this->dataSource) && count($this->dataSource)==0))
  {
    $obj = $this->getObj();
	if(is_object($obj))
    {	
     $obj->setLogEnabled((bool)LOG_ENABLED);			
     if($obj->ready())
     {		 
 	  if(is_a($obj,Classes_info::DB_ITEM_CLASS))
      {	
       $dbStruct = $this->getDbStruct();
       $dbQueries = $this->getDbQueries();
	   
        $this->dataSource = $obj->getAllDataByQuery();
      }
      elseif((is_a($obj,Classes_info::XML_NODE_CLASS))||(is_a($obj,Classes_info::JSON_NODE_CLASS)))
      {
       $obj->loadData();
       $values = array();
       $values = $obj->getValues();
       $this->dataSource = $values;
      }
	/*  elseif (is_a ( $obj, Classes_info::JSON_NODE_CLASS )) 
	  {
		$obj->loadData();
		$values = array();
		$values = $obj->getValues();
		$this->dataSource = $values;
	  }*/
	}
	else
     die(self::ERROR_12 . STRING_SPACE . $obj->getName());		
   }
  }
  return $this->dataSource;
 }
 
 function isFieldInDataFields(string $actField):bool
 {
  $dataFields = $this->getDataFields();
  foreach($dataFields as $field)
  {
  if ($actField == $field)
   return true;
  }
  return false;
 }
 
 // Ritorna il valore del campo $actField (che può anche non essere uno scalare) in base a
 // al dominio del campo ed al valore del dominio.
 // Inoltre se $actField ha già un valore (caso dei form di modifica o con valori 
 // di default) compie delle elaborazioni sui valori restituiti.
 function getDataFieldAllValues(string $actFieldName,
 array|string|int|float|null $actFieldVal=FIELD_NO_VALUE):mixed
 {
  $domObj = $this->getDataFieldDomainObjByName($actFieldName);
  if(is_a($domObj,NS . STRING_BACKSLASH . Int_domain::CLASS_PREFIX ))
   return $domObj->getAllValues($actFieldVal);
  else
   die(self::ERROR_11);
 }
  
  function isDecorator():bool
  {
    return false;
  }
  
 function initPutData():array
 {
 }

  function initDataSource(array|string|int|float $actRows):array
  {
   $rows=$actRows;
   if((! is_array($actRows)) || ($actRows !== array(array())))
   {
    if(! is_array($actRows))
     $rows=array(array($actRows));
    elseif(! is_array_of_array($actRows))
     $rows=array($actRows);  
   }
   else
   {
   	$dataFields = $this->getDataFields();
    $rows = array();
    foreach($dataFields as $dataField)
    {
  	 $domObj = $this->getDataFieldDomainByName($dataField);
   	 if($domObj==Int_domain::FIELD_DOMAIN_SET)
   	 { 
   	  $fieldValues = $this->getDataFieldAllValues($dataField);
   	  $j=0;
      foreach($fieldValues as $fieldValue)
      {
       if(! isset($rows[$j]))
       	$row = array();
       else
       	$row = $rows[$j];
       $row[$dataField] = $fieldValue;
       $rows[$j] = $row; 
   	   $j++;
   	  }
   	 }	
    }
   }
   return $rows; 
  }
  
  function initDataSourceSingleValue(array|string|int|float $actRows,string $actFieldName):array|string|int|float
  {
  $rows = $actRows;
  $fieldName = $actFieldName;
  if(isset($rows))
  {
   if(! is_array($rows))
    $fieldValue=$rows;
   elseif(count($rows)>0)
   {
    if(isset($rows[$fieldName]) && is_array($rows[$fieldName]) 
    && isset($rows[$fieldName][0]))
     $fieldValue = $rows[$fieldName][0];
    elseif(isset($rows[0][$fieldName]))
     $fieldValue = $rows[0][$fieldName];
    elseif(isset($rows[$fieldName]))
     $fieldValue = $rows[$fieldName]; 
    else
     $fieldValue = $rows;
   }
   else
    $fieldValue = NO_VALUE;
  }
  else
   $fieldValue = NO_VALUE;
  return $fieldValue;
  }

//
// Necessita di un array associativo come parametro ($actDataSource).
// 
  function extractDataFromDataSource(array|string|int|float $actDataSource):array
  {
   $htmlWriter = $this->getHtmlWriter();
   $this->fieldsFromDataSource();
   $dataFields = $this->getDataFields();
   $dataValues = array();
   $rows = $actDataSource;
   $rows = $this->initDataSource($rows);
   /*echo "WWWW<br>";*/
  // print_r($rows);
   /*echo "WWW<br>";*/
   $j=0;
   foreach($rows as $row)
   {
    foreach($dataFields as $dataField)
    {
	 //print_r($row);
     //echo "<br>";	 
     if(array_key_exists($dataField,$row))
     {
      $fieldValue = $row[$dataField];
     }
     else
      $fieldValue = STRING_NULL;
     
	// echo $fieldValue;
     $fieldValue = $this->getDataFieldAllValues($dataField,$fieldValue);
	// print_r($fieldValue);
     if(is_array($fieldValue))
       $dataValues[$dataField] = $fieldValue;
     elseif(is_object($fieldValue) && (! is_callable($fieldValue)))
     {
     	if(is_a($fieldValue,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
     	{
       if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
       {
        if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
         $fieldValue->setPrefixBeforeName(true);
        $fieldValueObj = $fieldValue->getObj();
        if((! is_object($fieldValueObj)) && $this->getInheritData())
        {
         $row["COUNT"] = $j;
         $fieldValue->setDataSource($row);
        }
       } 
       if ($this->getInheritDataFieldName())
        $fieldValue->setNum($num . VAR_SEP . $j . VAR_SEP . $field);
//
// Se già richiamato Html_page->setAllHtmlWriters questo HtmlWriter è
// quello comune a tutte le interfacce della pagina.
// Altrimenti è diverso.
//
       $oldItemStack = $htmlWriter->getItemStack();
       $oldDumper = $oldItemStack->getDumper();
       $oldItemStack2 = clone $oldItemStack;
       $oldDumper2 = clone $oldDumper;
       $oldDumper2->setObj($oldItemStack2);
       $oldItemStack2->setDumper($oldDumper2);
//
// Imposta il dumper su memoria per il campo corrente.
// L'ItemStack del campo è impostato su memoria.
// Quello vecchio rimane inalterato.
//
       $fieldValue->setMemoryDumper();
       $newItemStack = $fieldValue->getItemStack();
       $htmlWriter->setItemStack($newItemStack);
       $fieldValue->putData();
       $dataValues[$dataField][$j]=$fieldValue->getHtmlWriter()->getItemStack()->flush();
//
// Reimposto il vecchio Item_stack.
// 
       $htmlWriter->setItemStack($oldItemStack2);
      }
      elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
      {
       $fieldValueObj = $fieldValue->getObj();
       if((! is_object($fieldValueObj)) && $this->getInheritData())
       {
        $row["COUNT"] = $j;
        $fieldValue->setDataSource($row);
       }
	   $fieldValue->putData();
	   $dataValues[$dataField][$j]=STRING_NULL;
      }
      else
       die(self::ERROR_10);
     }
     elseif(is_callable($fieldValue))
     {
      $dataFromCallable = $fieldValue($j,$dataField);
      if(is_array($dataFromCallable))
       $dataValues[$dataField] = $dataFromCallable;
      else
       $dataValues[$dataField][$j] = $dataFromCallable;
     }
     else
      $dataValues[$dataField][$j] = $fieldValue;
	}
    $j++;
   } 
   return $dataValues;
  } 
}
?>