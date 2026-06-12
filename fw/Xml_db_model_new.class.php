<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("filesystem.fun.php");
require_once("Xml_items_serializer.class.php");
require_once("Xml_serializer.class.php");
require_once("File_dumper.class.php");
require_once("struct.fun.php");
require_once ("Creator.tra.php");

class Xml_db_model
{
 use Creator;	
	
private function __construct()
{
}

static function getDbObjsDefProps(string $actAppName):array
{
 $appDir =  $actAppName;

 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
    
 //$xmlSerializer = new Xml_items_serializer($appFileName);
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
  $newItems = array();
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $defsArray = $sectionObj->getItem();
 $j=0;
 foreach($defsArray as $ind=>$defObj)
 {
  $defElsArray = $defObj->getItem();
  $methodCallObj = $defElsArray[1];
  $argsArray = $methodCallObj->getItem();
  $argObj = $argsArray[3];
  $constObj = $argObj->getItem();
  $constObjItem = $constObj->getItem();
  $constEl = getOriginalItemName($constObjItem);
  $newItems[$j++] = $constEl; 
 }
 }
 return $newItems;    
}

static function getAllTableFields(string $actApp,string $actId):array
{
 $appDir =  $actApp;
 $ids=$actId;
 $tablePos = self::getTablePos($actApp,$actId);  
 $retStruct = array();
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if((count($sectionsArray)>0)&&(isset($sectionsArray[$tablePos])))
 {
  $sectionObj = $sectionsArray[$tablePos];
  $sectionInnerArray = $sectionObj->getItem();
  $defObj = $sectionInnerArray[0];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  $i=0;
  $fields = array();
  $j=0;
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $constObj = $argObj->getItem();
   $fields[$i++] = getOriginalItemName($constObj->getItem());
  }
  $retStruct["fields"]=$fields;
 }
 return $retStruct;
}

static function getAllAliasFields(string $actApp,string $actId):array
{
 $tableName = self::getTableFromAlias($actApp,$actId);
 $fields = self::getAllTableFields($actApp,$tableName);
 return $fields;
}

static function getAllFieldsDefProps(string $actApp,$actId):array
{
 $appDir = $actApp;
 $ids=$actId;   
 $retStruct = array();
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if((count($sectionsArray)>0)&&(isset($sectionsArray[$ids])))
 {
  $sectionObj = $sectionsArray[$ids];
  $sectionInnerArray = $sectionObj->getItem();
  $defObj = $sectionInnerArray[0];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  $i=0;
  $fields = array();
  $allFields = array();
  $j=0;
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $constObj = $argObj->getItem();
   $allFields[$j++] = $constObj->getItem();
   if(! self::isAForeignKey($sectionInnerArray[8],$constObj->getItem()))
    $fields[$i++] = getOriginalItemName($constObj->getItem());
  }
  $retStruct["fields"]=$fields;
   
  $defObj = $sectionInnerArray[2];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  $i=0;
  $fieldsTypes = array();
  $j=0;
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $constObj = $argObj->getItem();
   $fieldType = getFieldTypeItemName($constObj->getItem());
   if(! self::isAForeignKey($sectionInnerArray[8],$allFields[$j++]))
     $fieldsTypes[$i++] = $fieldType;
  }
  $retStruct["fieldsTypes"]=$fieldsTypes;
   
  $candKeysFields = array();
  $defObj = $sectionInnerArray[6];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $argObjFunctionCallObj = $argObj->getItem();
   $argObjFunctionCallObjInnerArray = $argObjFunctionCallObj->getItem();
   $candKey = array();
   foreach($argObjFunctionCallObjInnerArray as $ind1=>$val1)
   {
    $argObjFunctionCallObjArgObj = $val1;
    $argObjFunctionCallObjArgObjConstObj = $argObjFunctionCallObjArgObj->getItem(); 
    $candKey[$ind1] = $argObjFunctionCallObjArgObjConstObj->getItem();
    $candKeyField = $candKey[$ind1];
    $normCandKeyFieldName = getOriginalItemName($candKeyField);
    $candKey[$ind1] = $normCandKeyFieldName;
   }
   $candKeysFields[$ind]= $candKey;
  }
  $retStruct["candKeyFields"]= $candKeysFields;
   
  $extKeyTables = array();
  $extKeyFields = array();
  $extKeyFieldsDefObj = $sectionInnerArray[8];
  $extKeyFieldsDefInnerArray = $extKeyFieldsDefObj->getItem();
  $extKeyFieldsFunctionCallObj = $extKeyFieldsDefInnerArray[1];
  $extKeyFieldsFunctionCallObjInnerArray = $extKeyFieldsFunctionCallObj->getItem(); 
  foreach($extKeyFieldsFunctionCallObjInnerArray as $ind2=>$val2)
  {        
   $extKeyFieldsArgObj = $extKeyFieldsFunctionCallObjInnerArray[$ind2];
   $extKeyFieldsAssObj = $extKeyFieldsArgObj->getItem();
   if(is_object($extKeyFieldsAssObj)&& is_a($extKeyFieldsAssObj,Classes_info::ASSOCIATIVE_ITEM_CLASS))
   {
    $extKeyFieldsAssObjInnerArray = $extKeyFieldsAssObj->getItem();
    $extKeyFieldsConstObj = $extKeyFieldsAssObjInnerArray[0];
    $extKeyFieldsTableName = $extKeyFieldsConstObj->getItem();
    $extKeyFieldsTableName = getOriginalItemName($extKeyFieldsTableName);    
    $extKeyTables[$ind2] = $extKeyFieldsTableName;
    $extKeyFieldsConstObj = $extKeyFieldsAssObjInnerArray[1];
    $extKeyFieldsFieldName = $extKeyFieldsConstObj->getItem();
    $extKeyFieldsFieldName = getOriginalItemName($extKeyFieldsFieldName);    
    $extKeyFields[$ind2] = $extKeyFieldsFieldName;
   }
   else
   {
    $extKeyTables[$ind2] = STRING_NULL;
    $extKeyFields[$ind2] = STRING_NULL;    
   }
  }
  $retStruct["extKeyTables"] = $extKeyTables;
  $retStruct["extKeyFields"] = $extKeyFields;
 }
 return $retStruct;	
}

static function getSectionFromBindingsRelationsToObjectsDef(string $actApp,string $actTable):Section_item|bool
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "binding_relations_to_objects_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];     
 $sectionsArray = $sectionsObj->getItem(); 
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  foreach($sectionArray as $ind2=>$defObj)
  {
   $defArray=$defObj->getItem();
   $itemObj = $defArray[0];
   if(is_a($itemObj,Classes_info::METHOD_CALL_ITEM_CLASS))
   {
   	$methodCallObj = $itemObj;
   	$methodCallArray = $methodCallObj->getItem();
   	$varObj = $methodCallArray[0];
   	$tableName =  $varObj->getItem();
   	if(("dbObj" . $actTable)==$tableName)
   	 return $sectionObj;
   }
  }
 } 	
 return false;
}

static function getSectionFromAliasesDefinitionDef(string $actApp,string $actTable):Section_item|bool
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "aliases_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];     
 $sectionsArray = $sectionsObj->getItem(); 
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  foreach($sectionArray as $ind2=>$defObj)
  {
   $defArray=$defObj->getItem();
   if(count($defArray)>1)
   {
    $itemObj = $defArray[1];
    if(is_a($itemObj,Classes_info::METHOD_CALL_ITEM_CLASS))
    {
   	 $methodCallObj = $itemObj;
   	 $methodCallArray = $methodCallObj->getItem();
   	 $argObj = $methodCallArray[1];
   	 $constObj = $argObj->getItem();
   	 $tableName = getOriginalItemName($constObj->getItem());
   	 if($actTable==$tableName)
   	  return $sectionObj;
    }
   }
  }
 } 	
 return false;
}


//
// Imposta data una lista di tabelle  i files 'db_objects_definition_def', 
// 'tables_consts_def' , 'graph_definition_def'
//  ,'binding_relations_to_objects_def','aliases_definition_def'
//
static function setDbObjsDefProps(string $actApp,array $actIds):bool|string
{
 $ids = $actIds;
 $idsNum = count($ids);
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $sectionItems1 = array();
   
 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "graph_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);   
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(count($sectionsArray2)==0)
	return true;
 $sectionObj2 = $sectionsArray2[0];
 $sectionArray2 = $sectionObj2->getItem();
 $sectionItems2 = array();
 $sectionItems2[0] = $sectionArray2[0];
   
 $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "tables_const_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);  
 $xmlSerializer3->loadData();
 $allItems3 = $xmlSerializer3->getItems();
 $sectionsObj3 = $allItems3[0];
 $sectionsArray3 = $sectionsObj3->getItem();
 if(count($sectionsArray3)==0)
	 return true;
 
 //Patch per includere namespace 
 
 $sectionObj3A = $sectionsArray3[0];
 $sectionArray3 = array();   
  
 $appFileName4 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "binding_relations_to_objects_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer4 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName4);
 $xmlSerializer4->loadData();
 $allItems4 = $xmlSerializer4->getItems();
 $sectionsObj4 = $allItems4[0];     
 $sectionsItems4 = array();
 
 $appFileName5 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "aliases_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer5 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName5);
 $xmlSerializer5->loadData();
 $allItems5 = $xmlSerializer5->getItems();
 $sectionsObj5 = $allItems5[0];     
 $sectionsItems5 = array();
 
 $appFileName6 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "aliases_defines_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer6 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName6);
 $xmlSerializer6->loadData();
 $allItems6 = $xmlSerializer6->getItems();
 $sectionsObj6 = $allItems6[0];     
 $sectionsArray6 = $sectionsObj6->getItem();
 $sectionArray6 = array(); 
 if(isset($sectionsArray6[0]))
  $sectionObj6 = $sectionsArray6[0];
 else
  $sectionObj6 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray6);
     
  $j=0;
  $l=0;
  $k=1;
  $tablesConsts = array();
  $origTablesConsts = array();
  $aliases = array();
  for($i=0;$i<=$idsNum-2;$i++)
  {
   if(trim($ids[$i]) != STRING_NULL)
   {
    $itemStr = $ids[$i];
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($itemStr)));
    $baseCode1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator"); 
    $stringVar1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_node"); 
    $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringVar1);
    $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL"); 
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);   
    $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($itemStr));
    $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
    $methodCallArgs1 = array($baseCode1,$argObj1,$argObj2,$argObj3);
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArgs1);
    $methodCallObj1->setParent(true);
    $methodCallObj1->setName("create");
   // $methodCallObj1 = Creator::create("Constructor_call_item",STRING_NULL,$constructorCallArgs1);
   // $constructorCallObj1->setName("Db_node");
    $defItems1 = array($varObj1,$methodCallObj1);
    $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems1);
    $tablesConsts[$j] = ucFirst(strToLower($itemStr));
    $origTablesConsts[$j] = $itemStr;
    $sectionItems1[$j] = $defObj1; 
    
    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbStructTree");
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($itemStr)));
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array());
    $methodCallObj1->setName("add");
    $methodCallArray1 = array();
    $methodCallArray1[0] = $varObj2;
    $methodCallArray1[1] = $argObj2;
    $methodCallObj1->setItem($methodCallArray1);
    $defItems2 = array($methodCallObj1);
    $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems2);
    $sectionItems2[$k++] = $defObj2;
      
    $section4 = self::getSectionFromBindingsRelationsToObjectsDef($actApp,$itemStr);
    if($section4)
    {
     $sectionsItems4[$j++] = $section4;
    }
    else
    {
     $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");	
     $functionCallObj4 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
     $functionCallObj4->setName("array");
     $defItems4 = array($varObj4,$functionCallObj4);
     $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems4);
      	
     $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels"); 	
     $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj5);
     $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($itemStr)));
     $methodCallArray4 = array($varObj6,$argObj5);
     $methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray4);
     $methodCallObj2->setName("setRels");
     $defItems5 = array($methodCallObj2);
     $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems5);
      	
     $sectionArray4 = array($defObj4,$defObj5);
     $section4 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray4);
     $sectionsItems4[$j++] = $section4;
    }
        
    $section5 = self::getSectionFromAliasesDefinitionDef($actApp,$itemStr);    
    if($section5)
    {
     $section5->setName("aliases_definition" . STRING_UNDERSCORE . $l);
     $sectionsItems5[$l++] = $section5;
     $defsArray = $section5->getItem();
     $numDefsArray = count($defsArray);
     if($numDefsArray>0) 
     {
      $numAliases = ($numDefsArray-1) / 3;
      for ($m=0;$m<=$numAliases-1;$m++)
      {
      	$defMethodCallObj=$defsArray[2+$m*3];
      	$defMethodCallArray = $defMethodCallObj->getItem();
      	$methodCallObj = $defMethodCallArray[0];
      	$methodCallObjArray = $methodCallObj->getItem();
      	$argObj = $methodCallObjArray[1];
      	$constObj = $argObj->getItem();
      	$aliasName = getOriginalItemName($constObj->getItem());
      	$aliases[] = $aliasName;
      }
     }
    }
    else
    {
     $section5 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());
    // $section5 = new Section_item(array());
     $section5->setName("aliases_definition" . STRING_UNDERSCORE . $l);
     $sectionsItems5[$l++] = $section5;
    }
   }      
  }

  $num = count($aliases);
  for($n=0;$n<=$num-1;$n++) 
  {
  // $exprItemString = STRING_EXCLAMATION_MARK . STRING_SPACE . "defined" . 
  // STRING_OPEN_PAR . STRING_SINGLE_QUOTE . "ALIAS" . 
  //    VAR_SEP . strToUpper($aliases[$n]) . STRING_SINGLE_QUOTE . 
  //    STRING_CLOSE_PAR;
   $exprItemString = "__NAMESPACE__ . " . "'" . STRING_BACKSLASH . 
   "ALIAS" . CONST_SEP . strToUpper($aliases[$n]) . "'";
   $functionArgs = array();
   $exprObj1 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString);
   $functionArgs[0] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj1);
   $strObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$aliases[$n]);
   $strObj2->setType(String_item::DOUBLE_QUOTED);
   $functionArgs[1] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$strObj2);
   $functionObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArgs);
   $functionObj->setName("define");
   $defItems = array();
   $defItems[0] = $functionObj;
   $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems);
   $sectionArray6[$n] = $defObj;
  }    

  $num = count($tablesConsts);
  for($i=0;$i<=$num-1;$i++) 
  {
   //$exprItemString = STRING_EXCLAMATION_MARK . STRING_SPACE . "defined" . 
   //STRING_OPEN_PAR . STRING_SINGLE_QUOTE . "TABELLA" . 
   //   VAR_SEP . strToUpper($tablesConsts[$i]) . STRING_SINGLE_QUOTE . 
   //   STRING_CLOSE_PAR;
   //$exprItem = new Expr_item($exprItemString);
   //$functionArgs = array();
   $exprItemString = "__NAMESPACE__ . " . "'" . STRING_BACKSLASH . 
   "TABELLA" . CONST_SEP . strToUpper($tablesConsts[$i]) . "'";
   //$exprItem = new Expr_item($exprItemString);
   $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString);
   $functionArgs[0] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprItem);
   $strObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$origTablesConsts[$i]);
   $strObj2->setType(String_item::DOUBLE_QUOTED);
   $functionArgs[1] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$strObj2);
   $functionObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArgs);
   $functionObj->setName("define");
   $defItems = array();
   $defItems[0] = $functionObj;
   $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems);
   $sectionArray3[$i] = $defObj;
  }  
  
  $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionItems1);  
  $sectionsItems = array($sectionObj);     
  $sectionsObj = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems);
  $rootItems = array($sectionsObj);
  $xmlSerializer1->setItems($rootItems);
  $xmlSerializer1->loadItems();
  $xmlSerializer1->saveData();   
   
  $sectionObj2 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionItems2); 
  $sectionsItems2 = array($sectionObj2);
  $sectionsObj2 = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems2);
  $rootItems = array($sectionsObj2);
  $xmlSerializer2->setItems($rootItems);
  $xmlSerializer2->loadItems();
  $xmlSerializer2->saveData();
    
  $sectionsObj4  = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems4);  
  $rootItems = array($sectionsObj4);
  $xmlSerializer4->setItems($rootItems);
  $xmlSerializer4->loadItems();
  $xmlSerializer4->saveData();
  
  $sectionsObj5 = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems5);
  $rootItems = array($sectionsObj5);
  $xmlSerializer5->setItems($rootItems);
  $xmlSerializer5->loadItems();
  $xmlSerializer5->saveData();
 
  $sectionObj6->setItem($sectionArray6);
  $sectionsArray6[0]=$sectionObj6;
  $sectionsObj6->setItem($sectionsArray6);
  $rootItems = array($sectionsObj6);
  $xmlSerializer6->setItems($rootItems);
  $xmlSerializer6->loadItems();
  $xmlSerializer6->saveData();

  //Patch per includere namespace
  
  $sectionArray3B = array();
  $sectionArray3B[0]= $sectionObj3A;
  foreach($sectionArray3 as $ind=>$val)
  {
  	$sectionArray3B[] = $val;
  }
   
  $sectionObj3 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray3B); 
  $rootItems = array($sectionObj3);
  $xmlSerializer3->setItems($rootItems);
  $xmlSerializer3->loadItems();
  $xmlSerializer3->saveData();
      
 return STRING_NULL;    
}

//
// L'aggiunta dei campi nella posizione data aggiorna i campi per quella data tabella
// in generale avrò dei doppioni che verranno eliminati sulla creazione del file 
// di struttura globale db
//
static function setFieldsDefFieldsProps(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $tableNameId = $ids[0];
 $idsNum = count($ids);
 $fieldsNames = array();
 $fieldsTypes = array();
 $k=0;
 for($i=1;$i<=$idsNum-1;$i=$i+2)
 {
  if(trim($ids[$i])!=STRING_NULL)
  {
   $fieldsNames[$k] = $ids[$i];
   $fieldsTypes[$k] = $ids[$i+1];
   $k++;
  }
 }  
 $tablePos = $tableNameId;
 
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];  
 $sectionsArray = $sectionsObj->getItem();
   
 $j=0;

 foreach($sectionsArray as $ind=>$val)
 {
  if($j==$tablePos)
  {
   $fieldsNamesArgsArray=array();
   $fieldsTypesArgsArray=array();
     
     // Aggiungo le chiavi esterne
     
   $sectionObj = $sectionsArray[$ind];
   $sectionArray = $sectionObj->getItem();
     
   $extKeyDefObj = $sectionArray[8];
   $extKeyDefArray = $extKeyDefObj->getItem();
   $extKeyFunctionObj = $extKeyDefArray[1];
   $extKeyFunctionArray = $extKeyFunctionObj->getItem();
   foreach($extKeyFunctionArray as $ind=>$val)
   {
    $extKeyArgObj = $extKeyFunctionArray[$ind];
    $extKeyAssObj = $extKeyArgObj->getItem();
    $extKeyAssArray = $extKeyAssObj->getItem();
    $extKeyConstObj = $extKeyAssArray[1];
    $extKey = $extKeyConstObj->getItem();
    $extKey = getOriginalItemName($extKey);
    if (! in_array($extKey,$fieldsNames))
    {
     $fieldsNames[] = $extKey;
     $extKeyTableConstObj = $extKeyAssArray[0];
     $extKeyTable = $extKeyTableConstObj->getItem();
     $extKeyTable = getOriginalItemName($extKeyTable);
     $extKeyFieldType = self::getPkKeyFieldType($actApp,$extKeyTable);
     $fieldsTypes[] = $extKeyFieldType;             
    }
   }    
   $fieldsNum = count($fieldsNames);      

     // Aggiungo tutti i campi
     
   for($k=0;$k<=$fieldsNum-1;$k=$k+1)
   {
   	$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper(trim($fieldsNames[$k])));
    $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD_TYPE" . CONST_SEP . trim($fieldsTypes[$k]));
    $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
    $fieldsNamesArgsArray[$k] = $argObj1;
    $fieldsTypesArgsArray[$k] = $argObj2;
   }   
     
   $fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsNamesArgsArray);
  $fieldsNamesFunctionCallObj->setName("array");
   $fieldsTypesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsTypesArgsArray);
   $fieldsTypesFunctionCallObj->setName("array");    
    
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields"); 
   $defArray1 = array($varObj3,$fieldsNamesFunctionCallObj);
   $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
   $sectionArray[0] = $defObj1;
   
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");  
   $defArray2 = array($varObj4,$fieldsTypesFunctionCallObj);
   $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
   $sectionArray[2] = $defObj2;  
     
   $sectionObj->setItem($sectionArray);
   break;
  }
  $j++;
 }
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData();
 return true;
} 


static function setFieldsConstsDef(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $tablePos = $ids[0];
 $idsNum = count($ids);
 $fieldsNames = array();
 $fieldsTypes = array();
 $k=0;
 for($i=1;$i<=$idsNum-1;$i++)
 {
  if(trim($ids[$i])!=STRING_NULL)
  {
   $fieldsNames[$k++] = $ids[$i];
  }
 }  

 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_consts_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);  
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj = $allItems2[0];  
 $sectionsArray = $sectionsObj->getItem(); 

 // Patch per includere namespaces

 if(count($sectionsArray)==0) 
 {
  return true;	 
 }
 $sectionObj1 = $sectionsArray[0];
 unset($sectionsArray[0]);

 $l=0;
 
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  if($l==$tablePos)
  {
   $fieldsNamesArgsArray1=array();
   $fieldsNamesArgsArray2=array();
   $fieldsConsts = array();
   $fieldsNum = count($fieldsNames);

   for($m=0;$m<=$fieldsNum-1;$m++)
   {
   	$exprObj3 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . " . STRING_SINGLE_QUOTE . 
    STRING_BACKSLASH . "FIELD" . CONST_SEP . 
    strToUpper(trim($fieldsNames[$m])) . STRING_SINGLE_QUOTE);
    $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj3);
    $fieldsNamesArgsArray1[$m] = $argObj3;
    $fieldsConsts[$m] = "FIELD" . CONST_SEP . strToUpper(trim($fieldsNames[$m]));
    $stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$fieldsNames[$m]);
    $stringObj4->setType(String_item::DOUBLE_QUOTED);
    $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj4);
    $fieldsNamesArgsArray2[$m] = $argObj4;      
   }
   $defArray=array();
   for($n=0;$n<=$fieldsNum-1;$n++)
   { 
    $exprItemString = STRING_EXCLAMATION_MARK . STRING_SPACE . "defined" . 
     STRING_OPEN_PAR . "__NAMESPACE__ . " . STRING_SINGLE_QUOTE . STRING_BACKSLASH .
      strToUpper($fieldsConsts[$n]) . STRING_SINGLE_QUOTE . STRING_CLOSE_PAR;
    $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString);
    $fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($fieldsNamesArgsArray1[$n],$fieldsNamesArgsArray2[$n]));    
    $fieldsNamesFunctionCallObj->setName("define");
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($fieldsNamesFunctionCallObj));
    $ifElseItemArray = array($exprItem,$defObj);
    $ifElseItemObj = Creator::create(getClassNameForCreate(Classes_info::IF_ELSE_ITEM_CLASS),STRING_NULL,$ifElseItemArray);
    $defArray[$n] = $ifElseItemObj;
   }
   $sectionObj->setItem($defArray);  
   $sectionsObj->setItem($sectionsArray);
   break; 
  }
  $l++;
 }
 //Patch per includere namespace
 
 $sectionsArray1 = array();
 $sectionsArray1[0] = $sectionObj1;
 foreach($sectionsArray as $ind=>$val)
  $sectionsArray1[$ind] = $val;
 $sectionsObj->setItem($sectionsArray1); 
 
 $allItems2[0] = $sectionsObj;
 $xmlSerializer2->loadItems($allItems2);
 $xmlSerializer2->saveData();
}

//
// Rigenera tutti i campi e i tipi dei campi
// Aggiungendo anche le chiavi esterne.
//
static function setFieldsDef(string $actApp,string|int $actId):bool
{
  $appDir =  $actApp;
  $tableNameId = $actId;
  $fieldsNames = array();
  $fieldsTypes = array();
  $tablePos = $tableNameId;

  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];  
  $sectionsArray = $sectionsObj->getItem();
  
  $l=0;

  //
  // Colleziono tutti i campi e i tipi
  //

  foreach($sectionsArray as $ind=>$sectionObj)
  {
   if($l==$tablePos)
   {
    $sectionArray = $sectionObj->getItem();
    $extKeyDefObj = $sectionArray[8];
    $fieldsDefObj = $sectionArray[0];
    $fieldsDefArray = $fieldsDefObj->getItem();
    $fieldsFunctionObj = $fieldsDefArray[1];
    $fieldsFunctionArray = $fieldsFunctionObj->getItem();
    $fieldsTypesDefObj = $sectionArray[2];
    $fieldsTypesDefArray = $fieldsTypesDefObj->getItem();
    $fieldsTypesFunctionObj = $fieldsTypesDefArray[1];
    $fieldsTypesFunctionArray = $fieldsTypesFunctionObj->getItem();
    $k=0;
    foreach($fieldsFunctionArray as $ind=>$fieldsArgObj)
    {
     $fieldsConstObj = $fieldsArgObj->getItem();
     $fieldName = $fieldsConstObj->getItem();
     $fieldsTypesArgObj = $fieldsTypesFunctionArray[$ind];
     $fieldsTypesConstObj = $fieldsTypesArgObj->getItem();
     $fieldType = $fieldsTypesConstObj->getItem();
     if(! self::isAForeignKey($extKeyDefObj,$fieldName))
     {
      $fieldsNames[$k] = $fieldName;
      $fieldsTypes[$k++] = $fieldType;
     }
    }
    break; 	
   }
   $l++;
  } 
  
  $j=0;
  foreach($sectionsArray as $ind=>$val)
  {
    if($j==$tablePos)
    {
     $fieldsNamesArgsArray=array();
     $fieldsTypesArgsArray=array();
     
     // Aggiungo le chiavi esterne
     
     $sectionObj = $sectionsArray[$ind];
     $sectionArray = $sectionObj->getItem();
     
     $extKeyDefObj = $sectionArray[8];
     $extKeyDefArray = $extKeyDefObj->getItem();
     $extKeyFunctionObj = $extKeyDefArray[1];
     $extKeyFunctionArray = $extKeyFunctionObj->getItem();
     foreach($extKeyFunctionArray as $ind=>$val)
     {
      $extKeyArgObj = $extKeyFunctionArray[$ind];
      $extKeyAssObj = $extKeyArgObj->getItem();
      $extKeyAssArray = $extKeyAssObj->getItem();
      $extKeyConstObj = $extKeyAssArray[1];
      $extKey = $extKeyConstObj->getItem();
      $extKey1 = getOriginalItemName($extKey);
      if (! in_array($extKey,$fieldsNames))
      {
       $fieldsNames[] = $extKey;
       $extKeyTableConstObj = $extKeyAssArray[0];
       $extKeyTable = $extKeyTableConstObj->getItem();
       $extKeyTable = getOriginalItemName($extKeyTable);
       $extKeyFieldType = "FIELD_TYPE" . CONST_SEP . 
       self::getPkKeyFieldType($actApp,$extKeyTable);
       $fieldsTypes[] = $extKeyFieldType;             
      } 
     }    
     $fieldsNum = count($fieldsNames);      

     // Aggiungo tutti i campi
     
     for($k=0;$k<=$fieldsNum-1;$k=$k+1)
     {
     	$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$fieldsNames[$k]);
      $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$fieldsTypes[$k]);
      $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
      $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
      $fieldsNamesArgsArray[$k] = $argObj1;
      $fieldsTypesArgsArray[$k] = $argObj2;
     }   
     
     $fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsNamesArgsArray);
     $fieldsNamesFunctionCallObj->setName("array");
     $fieldsTypesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsTypesArgsArray);
     $fieldsTypesFunctionCallObj->setName("array");    
     
     $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields");
     $defArray1 = array($varObj3,$fieldsNamesFunctionCallObj);
     $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
     $sectionArray[0] = $defObj1;
     
     $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
     $defArray2 = array($varObj4,$fieldsTypesFunctionCallObj);
     $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2); 
     $sectionArray[2] = $defObj2;  
     
     $sectionObj->setItem($sectionArray);
     break;
    }
    $j++;
  }
  $xmlSerializer->loadItems($allItems);
  $xmlSerializer->saveData();
  return true;	
}

//
// Rigenera tutti i campi e i tipi dei campi non aggiungendo i campi chiavi esterne
//
static function setFieldsDefWithoutExtKeys(string $actApp,int|string $actId):bool
{
  $appDir =  $actApp;
  $tableNameId = $actId;
  $fieldsNames = array();
  $fieldsTypes = array();
  $tablePos = $tableNameId;

  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];  
  $sectionsArray = $sectionsObj->getItem();
  
  $l=0;

  //
  // Colleziono tutti i campi e i tipi
  //

  foreach($sectionsArray as $ind=>$sectionObj)
  {
   if($l==$tablePos)
   {
    $sectionArray = $sectionObj->getItem();
    $extKeyDefObj = $sectionArray[8];
    $fieldsDefObj = $sectionArray[0];
    $fieldsDefArray = $fieldsDefObj->getItem();
    $fieldsFunctionObj = $fieldsDefArray[1];
    $fieldsFunctionArray = $fieldsFunctionObj->getItem();
    $fieldsTypesDefObj = $sectionArray[2];
    $fieldsTypesDefArray = $fieldsTypesDefObj->getItem();
    $fieldsTypesFunctionObj = $fieldsTypesDefArray[1];
    $fieldsTypesFunctionArray = $fieldsTypesFunctionObj->getItem();
    $k=0;
    foreach($fieldsFunctionArray as $ind=>$fieldsArgObj)
    {
     $fieldsConstObj = $fieldsArgObj->getItem();
     $fieldName = $fieldsConstObj->getItem();
     $fieldsTypesArgObj = $fieldsTypesFunctionArray[$ind];
     $fieldsTypesConstObj = $fieldsTypesArgObj->getItem();
     $fieldType = $fieldsTypesConstObj->getItem();
     if(! self::isAForeignKey($extKeyDefObj,$fieldName))
     {
      $fieldsNames[$k] = $fieldName;
      $fieldsTypes[$k++] = $fieldType;
     }
    }
    break; 	
   }
   $l++;
  } 
  
  $j=0;
  foreach($sectionsArray as $ind=>$val)
  {
    if($j==$tablePos)
    {
     $fieldsNamesArgsArray=array();
     $fieldsTypesArgsArray=array();
     
     $fieldsNum = count($fieldsNames);      

     // Aggiungo tutti i campi
     
     for($k=0;$k<=$fieldsNum-1;$k=$k+1)
     {
     	$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$fieldsNames[$k]);
      $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$fieldsTypes[$k]);
      $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
      $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
      $fieldsNamesArgsArray[$k] = $argObj1;
      $fieldsTypesArgsArray[$k] = $argObj2;
     }   
          
     $fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsNamesArgsArray);
     $fieldsNamesFunctionCallObj->setName("array");
     $fieldsTypesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldsTypesArgsArray);
     $fieldsTypesFunctionCallObj->setName("array");    
     
     $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields");
     $defArray1 = array($varObj3,$fieldsNamesFunctionCallObj);
     $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
     $sectionArray[0] = $defObj1;
     
     $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
     $defArray2 = array($varObj4,$fieldsTypesFunctionCallObj);
     $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
     $sectionArray[2] = $defObj2;  
     
     $sectionObj->setItem($sectionArray);
     break;
    }
    $j++;
  }
  $xmlSerializer->loadItems($allItems);
  $xmlSerializer->saveData();
  return true;
}

//
// Richiamata dopo setDbObjsDefProps elimina le definizioni dei campi per le tabelle cancellate. 
// Imposta il campo chiave di default per le tabelle nuove.
// Aggiorna anche fields_consts_def.
//
static function setFieldsDefAllFieldsProps(string $actApp):bool
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "db_objects_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];   
 $sectionsArray = $sectionsObj->getItem();
    
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[0];
  $defArray = $sectionObj->getItem();
  $exactTablesNames = array();
  $dbObjNames = array();
  $l=0;
//
// Raccolgo tutti i nomi dei nodi
// e tutti i nomi esatti delle tabelle.
// 
  foreach($defArray as $ind=>$defObj)
  {
   $defObjArray = $defObj->getItem();
   $defObjMethodCallObj = $defObjArray[1];
   $defObjVarObj = $defObjArray[0];
   $defObjMethodCallObjArray = $defObjMethodCallObj->getItem();
   $defObjMethodCallArgObj = $defObjMethodCallObjArray[3];
   $defObjMethodCallArgConstObj = $defObjMethodCallArgObj->getItem();
   $tableName = $defObjMethodCallArgConstObj->toString();
   $exactTablesNames[$l] = getOriginalItemName($tableName);
   $dbObjName = $defObjVarObj->getItem();
   $dbObjNames[$l] = $dbObjName; 
   $l++;
  }
   
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];   
  $sectionsArray = $sectionsObj->getItem();
   
  $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_consts_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;   
  $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
  $xmlSerializer2->loadData();
  $allItems2 = $xmlSerializer2->getItems();
  $sectionsObj0 = $allItems2[0];   
  $sectionsArray0 = $sectionsObj0->getItem();

  //Patch per includere namespace

  $sectionObj0 = $sectionsArray0[0];
  unset($sectionsArray0[0]); 

  $sectionsArray1 = array(); 
   
  $exactTablesNamesNum = count($exactTablesNames);
  $sectionsArrayDim = count($sectionsArray);   
  $newSectionsArray = array();
  $l=0;

//
// Ciclo su tutte le tabelle 
//   
  for($j=0;$j<=$exactTablesNamesNum-1;$j++)
  {
   $found = false;
//
// Ciclo sulle definizioni dei campi
//
   for($k=0;$k<=$sectionsArrayDim-1;$k++)
   {
    $sectionObj = $sectionsArray[$k];
    $sectionArray = $sectionObj->getItem();
    $defObj0 = $sectionArray[1];
    $defArray0 = $defObj0->getItem();   
    $methodObj = $defArray0[0];
    $methodArray = $methodObj->getItem();
    $varObj = $methodArray[0];
    $dbObjName = $varObj->getItem();
//
// Seleziono la sezione con il nome tabella dato
//
    if($dbObjName == $dbObjNames[$j])
    {
     $defObj = $sectionArray[0]; 
     $defArray = $defObj->getItem();
     $functionObj = $defArray[1];
     $functionArray = $functionObj->getItem();
     $m=0;
     $defArray4 = array();
     $defArray0=array();
//
// Raccolgo tutti i nomi dei campi per la tabella data
//
     foreach($functionArray as $ind=>$val)
     {  
      $argObj4 = $val;
      $constObj4 = $argObj4->getItem(); 
      $fieldName = $constObj4->getItem(); 
      $originalFieldName = getOriginalItemName($fieldName);
      $exprString0 = "__NAMESPACE__ . " . 
      STRING_SINGLE_QUOTE . STRING_BACKSLASH . 
      $fieldName . STRING_SINGLE_QUOTE;
      $exprObj2 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprString0);
      $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj2);
      $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$originalFieldName);
      $stringObj3->setType(String_item::DOUBLE_QUOTED);
      $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj3);
      $functionArray2 = array($argObj2,$argObj3);
      $functionObj2 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArray2);
      $functionObj2->setName("define");
      $defArray0 = array($functionObj2);
      $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray0);     
      $exprItemString = STRING_EXCLAMATION_MARK . 
      STRING_SPACE . "defined" . 
       STRING_OPEN_PAR . "__NAMESPACE__ . " . 
       STRING_SINGLE_QUOTE . STRING_BACKSLASH  . 
        strToUpper($fieldName) . STRING_SINGLE_QUOTE . 
       STRING_CLOSE_PAR;
      $exprObj = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString); 
      $ifElseArray = array($exprObj,$defObj2);
      $ifElseObj = Creator::create(getClassNameForCreate(Classes_info::IF_ELSE_ITEM_CLASS),STRING_NULL,$ifElseArray);
      $defArray4[$m++] = $ifElseObj;
     }
     $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$defArray4);
     $sectionsArray1[$l] = $sectionObj1;
     $sectionObj->setName("fields_definition" . STRING_UNDERSCORE . $l);      
     $newSectionsArray[$l++] = $sectionObj;
     $found = true;
     break;
    }
   }
   if(! $found)
   {
     //
     // Se non trovata vuol dire che è una tabella nuova 
     // Devo impostare una nuova definizione l-esima coi defaults    
     // Aggiungo la chiave primaria alla lista dei campi in $blockDefsArray1
     //
    $fieldNameArgArray = array();
    $fieldTypeArgArray = array();
    $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,
    "FIELD_ID" . CONST_SEP . strToUpper(trim($exactTablesNames[$j])));
    $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD_TYPE_INTEGER");
    $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
    $fieldNameArgArray[0] = $argObj1;
    $fieldTypeArgArray[0] = $argObj2;
   
    $fieldsNamesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldNameArgArray);
    $fieldsNamesFunctionCallObj->setName("array");
    $fieldsTypesFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$fieldTypeArgArray);
    $fieldsTypesFunctionCallObj->setName("array");    
  
    $fieldName = "FIELD_ID" . CONST_SEP . strToUpper(trim($exactTablesNames[$j]));
    $exprString2 = "__NAMESPACE__ . " . STRING_SINGLE_QUOTE . 
    STRING_BACKSLASH . $fieldName . STRING_SINGLE_QUOTE;
    $exprObj2 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprString2);
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj2);
    $keyFieldName = ucFirst(strToLower("ID" . CONST_SEP . strToUpper($exactTablesNames[$j])));
    $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$keyFieldName);
    $stringObj3->setType(String_item::DOUBLE_QUOTED);
    $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj3);
    $functionArray2 = array($argObj2,$argObj3);
    $functionObj2 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArray2);
    $functionObj2->setName("define");
    $defArray0 = array($functionObj2);
    $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray0);

    
    $exprItemString1 = STRING_EXCLAMATION_MARK . STRING_SPACE . "defined" . 
     STRING_OPEN_PAR . "__NAMESPACE__ . " . 
     STRING_SINGLE_QUOTE . STRING_BACKSLASH . "FIELD" . 
     CONST_SEP . strToUpper($keyFieldName) . STRING_SINGLE_QUOTE . 
     STRING_CLOSE_PAR;
    $exprObj1 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString1);
    $ifElseArray1 = array($exprObj1,$defObj2);
    $ifElseObj1 = Creator::create(getClassNameForCreate(Classes_info::IF_ELSE_ITEM_CLASS),STRING_NULL,$ifElseArray1);
    $defArray2 = array($defObj2);
    $sectionObj2 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$defArray2);
    $sectionsArray1[$l] = $sectionObj2;

    $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());
   
    // Imposto i campi;
    
    $sectionArray = $sectionObj->getItem();
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields");
    $defArray1 = array($varObj3,$fieldsNamesFunctionCallObj);
    $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
    $sectionArray[0] = $defObj1;

    $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $exactTablesNames[$j]);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fields"); 
    $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1); 
    $methodCallArray1 = array($varObj0,$argObj1); 
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
    $methodCallObj1->setName("setFields");
    $defArray = array($methodCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
    $sectionArray[1] = $defObj;

    // Imposto i tipi per i campi;
    
    $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
    $defArray2 = array($varObj4,$fieldsTypesFunctionCallObj);
    $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
    $sectionArray[2] = $defObj2;

    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $exactTablesNames[$j]);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"fieldsTypes");
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
    $methodCallArray1 = array($varObj2,$argObj2); 
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
    $methodCallObj1->setName("setFieldsTypes");
    $defArray = array($methodCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray); 
    $sectionArray[3] = $defObj;
     
     // definisco la chiave primaria;
    
    $constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD_ID" . CONST_SEP . strToUpper(trim($exactTablesNames[$j]))); 
    $argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
    $keyFieldArgsArray = array($argObj);
    $keyFieldFunctionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$keyFieldArgsArray);
    $keyFieldFunctionCallObj->setName("array");
    $varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"keyField");
    $defArray = array($varObj,$keyFieldFunctionCallObj);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
    $sectionArray[4] = $defObj;
 
    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $exactTablesNames[$j]);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"keyField");
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
    $methodCallArray1 = array($varObj2,$argObj2); 
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
    $methodCallObj1->setName("setKeyFields");
    $defArray = array($methodCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray); 
    $sectionArray[5] = $defObj;
 
    // definisco le candKeyFields;
    
    $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
    $functionCallObj1->setName("array");
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"candKeyFields");
    $defArray = array($varObj3,$functionCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
    $sectionArray[6] = $defObj;

    $varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $exactTablesNames[$j]);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"candKeyFields");
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
    //$argObj2 = new Arg_item($varObj1);
    $methodCallArray1 = array($varObj2,$argObj2); 
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
    $methodCallObj1->setName("setCandKeyFields");
    $defArray = array($methodCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);    
    $sectionArray[7] = $defObj;    

    // definisco le chiavi esterne
    
    $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
    $functionCallObj1->setName("array");
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"extKeyFields");
    $defArray = array($varObj3,$functionCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
    $sectionArray[8] = $defObj; 

    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $exactTablesNames[$j]);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"extKeyFields");
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
    $methodCallArray1 = array($varObj2,$argObj2); 
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
    $methodCallObj1->setName("setExtKeyFields");
    $defArray = array($methodCallObj1);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray); 
    $sectionArray[9] = $defObj;
          
    $sectionObj->setItem($sectionArray);
    $sectionObj->setName("fields_definition" . STRING_UNDERSCORE . $l);
    $newSectionsArray[$l++] = $sectionObj;
   }
  }
  $sectionsObj->setItem($newSectionsArray);
  $allItems[0] = $sectionsObj;
  $xmlSerializer->loadItems($allItems);
  $xmlSerializer->saveData();

  //Patch per includere namespace
  
  $sectionsArray2 = array();
  $sectionsArray2[0] = $sectionObj0;
  foreach($sectionsArray1 as $ind=>$val)
  {
  	$sectionsArray2[] = $val;
  }
  
  $sectionsObj0->setItem($sectionsArray2);
  $allItems2[0] = $sectionsObj0;
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData();    
 }
 return true;
}

static function setFieldsDefCandKeyFieldsProps(string $actApp,array $actIds):bool
{
	$appDir =  $actApp;
	$ids = $actIds;
  $tableNameId = $ids[0];
  $idsNum = count($ids);
  $candKeyFields = array();
  $k=0;
  for($i=1;$i<=$idsNum-1;$i++)
  {
   $candKeyFields[$k] = $ids[$i];
   $k++;
  }
  $tablePos = $tableNameId;
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
  DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];  
  $sectionsArray = $sectionsObj->getItem(); 
  $j=0;
  foreach($sectionsArray as $ind=>$val)
  {
    if($j==$tablePos)
    {
     $sectionObj = $sectionsArray[$j];
     $defsArray = $sectionObj->getItem();
     if(count($defsArray)==10)
     {
     $defObj = $defsArray[6];
     $defArray = $defObj->getItem();
     $functionCall = $defArray[1];
     $argsArray = array();     
     $num1 = count($candKeyFields);
     $n=0;
     for($k=0;$k<=$num1-1;$k++)
     {
      $candKey = $candKeyFields[$k];
      $candKeyItems = $candKey;
      $num2 = count($candKeyItems);
      $innerArgsArray = array();
      $m=0;
      for($l=0;$l<=$num2-1;$l++)
      {
        if($candKeyItems[$l] != STRING_NULL)
        {
        	$constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper($candKeyItems[$l]));
          $argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj);
          $innerArgsArray[$m++] = $argObj;
        }
      }
      if($m>0)
      {
       $innerFunctionCall = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$innerArgsArray);	
       $innerFunctionCall->setName("array");
       $arg = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$innerFunctionCall);
       $argsArray[$n++]=$arg;
      }
     }
     $functionCall->setItem($argsArray); 
     }
    }
    $j++;
  }
  $xmlSerializer->loadItems($allItems);
  $xmlSerializer->saveData();
  return true;
}

static function getPkKeyByTableName(string $actApp,string $actTableName):string
{
 $appDir =  $actApp;
 $tablePos = self::getTablePos($actApp,$actTableName);
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 //$xmlSerializer = new Xml_items_serializer($appFileName);
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(isset($sectionsArray[$tablePos]))
 {
  $sectionObj = $sectionsArray[$tablePos];
  $defsArray = $sectionObj->getItem();
  $defObj = $defsArray[4];
  $defArray = $defObj->getItem();
  $functionObj = $defArray[1];
  $functionArray = $functionObj->getItem();
  $argObj = $functionArray[0];
  $constObj = $argObj->getItem();
  $pkFieldName = getOriginalItemName($constObj->getItem());
  return $pkFieldName;
 }
 return STRING_NULL;
}

static function setFieldsDefExtKeyFieldsProps(string $actApp,array $actIds):bool
{
	$appDir = $actApp;
  $tableNameId = $actIds[0];
  $extKeyTables = $actIds[1];
  $extKeyFields = $actIds[2];
  $tablePos = $tableNameId;
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
  DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];  
  $sectionsArray = $sectionsObj->getItem(); 
  $j=0;
  foreach($sectionsArray as $ind=>$val)
  {
    if($j==$tablePos)
    {
     $sectionObj = $sectionsArray[$j];
     $defsArray = $sectionObj->getItem();
     $defObj = $defsArray[8];
     $defArray = $defObj->getItem();
     $functionCall = $defArray[1];
     $argsArray = array();
     $num1 = count($extKeyTables);
     for($k=0;$k<=$num1-1;$k++)
     {
      if(trim($extKeyTables[$k]) != STRING_NULL)
      {
       $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($extKeyTables[$k]));
       $extKeyItem = $extKeyFields[$k]; 
       $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"FIELD" . CONST_SEP . strToUpper($extKeyItem));      
       $constArray = array($constObj1 ,$constObj2);
       $assObj = Creator::create(getClassNameForCreate(Classes_info::ASSOCIATIVE_ITEM_CLASS),STRING_NULL,$constArray); 
       $argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$assObj);
       $argsArray[$k] = $argObj;
      }
     }
     $functionCall->setItem($argsArray);
    }
    $j++;
  }
  $xmlSerializer->loadItems($allItems);
  $xmlSerializer->saveData();
  return true;
}

static function get1NRelations(string $actApp,string $actId):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "binding_relations_to_objects_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $tableName = $actId;
 $tablePos = self::getTablePos($actApp,$tableName);
 //$xmlSerializer1 = new Xml_items_serializer($appFileName);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);  
 $xmlSerializer1->loadData();
 $allItems = $xmlSerializer1->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $rels1N = array(); 
 if(isset($sectionsArray[$tablePos]))
 {
  $sectionObj = $sectionsArray[$tablePos];
  $defsArray = $sectionObj->getItem();
  $defsArrayNum = count($defsArray);
  $i=1;
  $j=0;  
  while($i<=$defsArrayNum-2)
  {
   $defObj = $defsArray[$i++];
   $varArray = $defObj->getItem();
   $varObj = $varArray[1];
   $objRelName = $varObj->toString();
   $relType = substr($objRelName,7,2);
   $tablesStr = substr($objRelName,9,strlen($objRelName));
   $tables = strUppercaseSplit($tablesStr);
   if(($relType=="1N")&&($tables[1]==$tableName))
    $rels1N[$j++]=$tables[0];
  }
 } 
 return $rels1N;  
}

static function get1NSons(string $actApp,string $actId):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "binding_relations_to_objects_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $tableName = $actId;
 $tablePos = self::getTablePos($actApp,$tableName);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appfileName); 
 $xmlSerializer1->loadData();
 $allItems = $xmlSerializer1->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $relsSons = array(); 
 if(isset($sectionsArray[$tablePos]))
 {
  $sectionObj = $sectionsArray[$tablePos];
  $defsArray = $sectionObj->getItem();
  $defsArrayNum = count($defsArray);
  $i=1;
  $j=0;  
  while($i<=$defsArrayNum-2)
  {
   $defObj = $defsArray[$i++];
   $varArray = $defObj->getItem();
   $varObj = $varArray[1];
   $objRelName = $varObj->toString();
   $relType = substr($objRelName,7,2);
   $tablesStr = substr($objRelName,9,strlen($objRelName));
   $tables = strUppercaseSplit($tablesStr);
   if(($relType=="1N")&&($tables[0]==$tableName))
    $relsSons[$j++]=$tables[1];
  }
 } 
 return $relsSons;  
}


static function getMNRelations(string $actApp,string $actId):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "binding_relations_to_objects_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $tableName = $actId;
 $tablePos = self::getTablePos($actApp,$tableName);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);  
 $xmlSerializer1->loadData();
 $allItems = $xmlSerializer1->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $relsMN = array();
 if(isset($sectionsArray[$tablePos]))
 {
  $sectionObj = $sectionsArray[$tablePos];
  $defsArray = $sectionObj->getItem();
  $defsArrayNum = count($defsArray);
  $i=1; 
  $j=0;  
  while($i<=$defsArrayNum-2)
  {
   $defObj = $defsArray[$i++];
   $varArray = $defObj->getItem();
   $varObj = $varArray[1];
   $objRelName = $varObj->toString();
   $relType = substr($objRelName,7,2);
   $tablesStr = substr($objRelName,9,strlen($objRelName));
   $tables = strUppercaseSplit($tablesStr);
   if(($relType=="MN")&&($tables[1]==$tableName))
       $relsMN[$j++]=$tables[0];
  }
 }  
 return $relsMN;  
}

static function setMNRelations(string $actApp,array $actIds):bool
{
   $appDir = $actApp;
   $ids = $actIds;
   $tableName = $ids[0];
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $newSectionsArray = array();
   
   // Raccolgo tutte le relazioni in cui non compare $tableName o
   // in cui compare come REL_1_N
   
   $i=0;
   foreach($sectionsArray as $ind=>$sectionObj)
   {
    $sectionArray = $sectionObj->getItem();
    $defObj0 = $sectionArray[1];
    $defObj1 = $sectionArray[2];
    $defObj2 = $sectionArray[4];
    
    $defObj0Array = $defObj0->getItem();
    $defObj0ConstObj = $defObj0Array[1];
    $relEntFatherTableName = $defObj0ConstObj->toString();
    $relEntFatherTableName = getOriginalItemName($relEntFatherTableName);
        
    $defObj1Array = $defObj1->getItem();
    $defObj1ConstObj = $defObj1Array[1];
    $relEntSonTableName = $defObj1ConstObj->toString();
    $relEntSonTableName = getOriginalItemName($relEntSonTableName);
    
    $defObj2Array = $defObj2->getItem();
    $defObj2ConstObj = $defObj2Array[1];
    $relType = $defObj2ConstObj->toString();
    if((strToUpper(trim($relEntSonTableName)) != strToUpper(trim($tableName))) && 
    (strToUpper(trim($relEntFatherTableName)) != strToUpper(trim($tableName)))||($relType == "REL_1_N"))
    {
     $newSectionsArray[$i] = $sectionObj;
     $i++;
    }
   }
   
   // Ricalibro i nomi di sezione
   
   $newSectionsArrayNum = count($newSectionsArray);
   for($k=0;$k<=$newSectionsArrayNum-1;$k++)
   {
    $sectionObj = $newSectionsArray[$k];
    $sectionObj->setName("Relation_definition" . STRING_UNDERSCORE . $k);
   }
   
   // Aggiunge le nuovi sezioni M_N all'array delle sezioni

   $idsNum = count($ids);
   for($l=1;$l<=$idsNum-2;$l++)
   {
    $fatherTableName = $ids[$l];
    
    if(trim($fatherTableName) != STRING_NULL)
    {
    	$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
      $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
      $functionCallObj1->setName("array");
      $defArray1 = array($varObj1,$functionCallObj1);
      $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1); 
      $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_FATHER]");
      $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($fatherTableName));
      $defArray2 = array($varObj2,$constObj1);
      $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
      $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_SON]");
      $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($tableName));
      //$constObj2 = new Const_item("TABELLA" . CONST_SEP . strToUpper($tableName));
      $defArray3 = array($varObj3,$constObj2);
      $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray3);   
      $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types");
      $functionCallObj2 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
      $functionCallObj2->setName("array");
      $defArray4 = array($varObj4,$functionCallObj2);
      $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray4);
      $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_FATHER]");
      $constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_M_N");
      $defArray5 = array($varObj5,$constObj3);
      $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray5);     
      $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_SON]"); 
      $constObj4 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_M_N");
      $defArray6 = array($varObj6,$constObj4);
      $defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray6);               
      $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $fatherTableName . $tableName);
      $varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
      $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj8);
      $constObj5 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_STRUCT");
      $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj5);
      
      $codeObj = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
      $constObj6 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
      $argObj1a = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj6);
      $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_rel");
      $stringObj1->setType("double_quoted");
      $argObj1b = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
            
      $methodCallArray1 = array($codeObj,$argObj1b,$argObj1a,$argObj1,$argObj2);
      $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1); 
      $methodCallObj1->setName("create");
      $methodCallObj1->setParent(true);
      $defArray7 = array($varObj7,$methodCallObj1);
      $defObj7 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray7);
    
      $varObj10 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $fatherTableName . $tableName);
      $varObj11 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types");
      $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj11);
      $methodCallArray1 = array($varObj10,$argObj3);
      $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
      //$methodCallObj1 = new Method_call_item($methodCallArray1);
      $methodCallObj1->setName("setRelTypes");
      $defArray8 = array($methodCallObj1);
      $defObj8 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray8);
      $stringObj6 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$tableName . 
     VAR_SEP . strToLower($fatherTableName));
     $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj6);
     $varObj12 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $fatherTableName . 
     $tableName );  
     $methodCallArray2 = array($varObj12,$argObj4);
     $methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray2);
     $methodCallObj2->setName("setLinkTable");
     $defArray9 = array($methodCallObj2);
     $defObj9 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9);
    
     $sectionArray1 = array($defObj1,$defObj2,$defObj3,$defObj4,
     $defObj5,$defObj6,$defObj7,$defObj8,$defObj9);
     $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray1);  
     $sectionObj1->setName("Relation_definition" . STRING_UNDERSCORE . $k);
    
     $newSectionsArray[$k++] = $sectionObj1;
    
     if($tableName != $fatherTableName)
     {  
      $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
      $functioncallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
      $functionCallObj1->setName("array");
      $defArray1 = array($varObj1,$functionCallObj1);
      $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
    
      $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_FATHER]");
      $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($tableName));
      $defArray2 = array($varObj2,$constObj1);
      $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
    
      $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_SON]");
     // $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($fatherTableName));
      $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($fatherTableName));
      $defArray3 = array($varObj3,$constObj2);   
      $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray3);
    
      $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types");
      $functionCallObj2 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
      $functionCallObj2->setName("array");
      $defArray4 = array($varObj4,$functionCallObj2);
      $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray4);
    
      $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_FATHER]");
      $constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_M_N");
      $defArray5 = array($varObj5,$constObj3);
      $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray5);
    
      $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_SON]");
      $constObj4 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_M_N");
      $defArray6 = array($varObj6,$constObj4);
      $defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray6);
     
      $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $tableName . $fatherTableName);
      $varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
      $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj8);
      $constObj5 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_STRUCT");
      $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj5);
      
      $codeObj = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
      $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_rel");
      $stringObj1->setType("double_quoted");
      $argObj1a = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
      $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
      $argObj1b = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
            
      $methodCallArray1 = array($codeObj,$argObj1a,$argObj1b,$argObj1,$argObj2);
      $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
      $methodCallObj1->setName("create");
      $methodCallObj1->setParent(true);
      $defArray7 = array($varObj7,$methodCallObj1);
      $defObj7 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray7);
    
      $varObj10 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $tableName . $fatherTableName);
      $varObj11 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types");
      $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj11);
      $methodCallArray1 = array($varObj10,$argObj3);
      $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
      $methodCallObj1->setName("setRelTypes");
      $defArray8 = array($methodCallObj1);
      $defObj8 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray8);

      $stringObj6z = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$tableName . 
      VAR_SEP . strToLower($fatherTableName));
      $argObj4z = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj6z);
      $varObj12z = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRelMN" . $tableName . $fatherTableName);
      $methodCallArray2z = array($varObj12z,$argObj4z);
      $methodCallObj2z = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray2z);
      $methodCallObj2z->setName("setLinkTable");
      $defArray9z = array($methodCallObj2z);
      $defObj9z = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9z);
      $sectionArray1z = array($defObj1,$defObj2,$defObj3,$defObj4,$defObj5,$defObj6,
      $defObj7,$defObj8,$defObj9z);
      $sectionObj1z = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray1z);
      $sectionObj1z->setName("Relation_definition" . STRING_UNDERSCORE . $k);

      $newSectionsArray[$k++] = $sectionObj1z;
     }
    }
   }
      
   $sectionsObj->setItem($newSectionsArray);
   $xmlSerializer1->loadItems($allItems);
   $xmlSerializer1->saveData();
 
   // Carico i nomi delle tabelle attuali
   
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer2->loadData();
   $allItems = $xmlSerializer2->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   if(count($sectionsArray)>0)
   {
   $sectionObj = $sectionsArray[0];
   $defsArray = $sectionObj->getItem();
   $tablesArray = array();   
   $n=0;
   foreach($defsArray as $ind=>$defObj)
   {
    $defArray = $defObj->getItem();
    $methodCallObj = $defArray[1];
    $methodCallArray = $methodCallObj->getItem();
    $argObj = $methodCallArray[3];
    $constObj = $argObj->getItem();
    $tableName = $constObj->toString();
    $tableName = getOriginalItemName($tableName);      
    $tablesArray[$n++] = array($tableName);
   }
   
   // Raccolgo tutte le relazioni per ogni tabella
   
   $tablesArrayNum = count($tablesArray);
   for($p=0;$p<=$tablesArrayNum-1;$p++)
   {
    $tableName = $tablesArray[$p][0];
    $q=0;
    $newSectionsArrayNum = count($newSectionsArray);
    $relationsArray = array();
    $r=0;
    for($s=0;$s<=$newSectionsArrayNum-1;$s++)
    {
     $sectionObj = $newSectionsArray[$s];
     $defsArray = $sectionObj->getItem();
     $defObj1 = $defsArray[1];
     $defArray1 = $defObj1->getItem();
     $constObj1 = $defArray1[1];
     $table1 = $constObj1->toString();
     $table1 = getOriginalItemName($table1);
     $defObj2 = $defsArray[2];
     $defArray2 = $defObj2->getItem();
     $constObj2 = $defArray2[1];
     $table2 = $constObj2->toString();
     $table2 = getOriginalItemName($table2);
     
     $defsArray = $sectionObj->getItem();
     $defObj3n = $defsArray[4];
     $defArray3 = $defObj3n->getItem();
     $constObj3 = $defArray3[1];     
     $relType = $constObj3->toString();    
     
     if((trim($table1)==trim($tableName))||(trim($table2)==trim($tableName)))
     {
      if(trim($relType)=="REL_1_N")
       $relTypeStr = "1N";
      elseif(trim($relType)=="REL_M_N")
       $relTypeStr = "MN";
      else
       $relTypeStr = STRING_NULL;
       
      $relationObjName = "objRel" . $relTypeStr . $table1 . $table2;
      $relationsArray[$r++] = $relationObjName;
     }     
    }
    $tablesArray[$p][1] = $relationsArray;
   }   
   
   // Effettuo il bind fra relazioni ed oggetti

   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP . "binding_relations_to_objects_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer3->loadData();
   $allItems = $xmlSerializer3->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = array();
   for($t=0;$t<=$tablesArrayNum-1;$t++)
   {
    $sectionArray = array();
    $functionObj0 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
    $functionObj0->setName("array");
    $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");
    $defArray0 = array($varObj0,$functionObj0);
    $defObj0 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray0);
    $sectionArray[0] = $defObj0; 
    $relationsArray = $tablesArray[$t][1];
    $tableName = $tablesArray[$t][0];
    $relationsArrayNum = count($relationsArray);
    $v=1;
    
    for($u=0;$u<=$relationsArrayNum-1;$u++)
    {
    	$varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels[" . $u . "]");
      $relation = $relationsArray[$u]; 
      $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$relation);     
      $defArray1 = array($varObj0,$varObj1);
      $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
      $sectionArray[$v] = $defObj1;
      $v++;
    }  
    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");  
    $argObj0 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName);
    $methodCallArray0 = array($varObj3,$argObj0);
    $methodCallObj0 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray0);
    $methodCallObj0->setName("setRels");
    $defArray2 = array($methodCallObj0);
    $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);
    $sectionArray[$v] = $defObj2;
    $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray);
    $sectionsArray[$t] = $sectionObj1;
   }
   $sectionsObj->setItem($sectionsArray); 
   $xmlSerializer3->loadItems($allItems);
   $xmlSerializer3->saveData();   
     
   // Modifico structure_definition_def

   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "structure_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer4 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer4->loadData();
   $allItems = $xmlSerializer4->getItems();    
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   /*if(isset($sectionsArray[0]))
    $sectionObj = $sectionsArray[0];
   else
    $sectionObj = new Section_item(array()); */  
   $newSectionArray = array();
   $newSectionsArrayNum = count($newSectionsArray);
   
   $z=0;
   for($w=0;$w<=$newSectionsArrayNum-1;$w++)
   {
    $sectionObj1 = $newSectionsArray[$w];
    $sectionArray = $sectionObj1->getItem();
    $defObj1 = $sectionArray[1];
    $defObj2 = $sectionArray[2];
    $defArray1 = $defObj1->getItem();
    $defArray2 = $defObj2->getItem();
    $constObj1 = $defArray1[1];
    $tableName1 = $constObj1->toString();
    //echo $tableName1;
    $tableName1 = getOriginalItemName($tableName1);
    $constObj2 = $defArray2[1];
    $tableName2 = $constObj2->toString();
    $tableName2 = getOriginalItemName($tableName2);
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName1);
    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName2);
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
    $methodCallArray = array($varObj1,$argObj2);
    $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray);
    $methodCallObj->setName("addSon");
    $defArray4 = array($methodCallObj);
    $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray4);
    $newSectionArray[$z++] = $defObj4;
   }   
   if(count($newSectionArray)>0) 
   {
   	$sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$newSectionArray); 
    $sectionsArray[0] = $sectionObj;
   }
   else
    $sectionsArray = array(); 
   $sectionsObj->setItem($sectionsArray);
   $allItems[0] = $sectionsObj;
   $xmlSerializer4->loadItems($allItems);
   $xmlSerializer4->saveData(); 
   }   
   return true;   
}

static function checkIfIs1NRelationFather(string $actApp,string $actId):bool
{
   $appDir =  $actApp;
   $tableName = $actId;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $found=false;
   foreach($sectionsArray as $sectionObj)
   {
   	$defsArray = $sectionObj->getItem();
   	$defObj = $defsArray[1];
    $relTypeObj = $defsArray[4];
   	$relTypeObjArray = $relTypeObj->getItem();
   	$relTypeConstObj = $relTypeObjArray[1];
   	$relType = $relTypeConstObj->getItem();
   	if($relType=="REL_1_N")
   	{
   	 $defArray = $defObj->getItem();
   	 $constObj = $defArray[1];
   	 $constObjVal = $constObj->getItem();
   	 $constObjTable = getOriginalItemName($constObjVal);   	 
   	 if($constObjTable==$tableName)
   	 {
   	  $found=true;
   	  break;
     }
    }
   }
   if($found)
    return true;
   else
    return false;
}

static function checkIfIsInRelation(string $actApp,string $actId):bool
{
   $appDir =  $actApp;
   $tableName = $actId;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $found=false;
   foreach($sectionsArray as $sectionObj)
   {
   	$defsArray = $sectionObj->getItem();
   	$defObj = $defsArray[1];
    $relTypeObj = $defsArray[4];
   	$relTypeObjArray = $relTypeObj->getItem();
   	$relTypeConstObj = $relTypeObjArray[1];
   	$relType = $relTypeConstObj->getItem();
   	if(($relType=="REL_1_N")||($relType=="REL_M_N"))
   	{
   	 $defArray = $defObj->getItem();
   	 $constObj = $defArray[1];
   	 $constObjVal = $constObj->getItem();
   	 $constObjTable = getOriginalItemName($constObjVal);   	 
   	 if($constObjTable==$tableName)
   	 {
   	  $found=true;
   	  break;
     }
    }
   	$defObj = $defsArray[2];
    $relTypeObj = $defsArray[5];
   	$relTypeObjArray = $relTypeObj->getItem();
   	$relTypeConstObj = $relTypeObjArray[1];
   	$relType = $relTypeConstObj->getItem();
   	if(($relType=="REL_1_1")||($relType=="REL_M_N"))
   	{
   	 $defArray = $defObj->getItem();
   	 $constObj = $defArray[1];
   	 $constObjVal = $constObj->getItem();
   	 $constObjTable = getOriginalItemName($constObjVal); 	 
   	 if($constObjTable==$tableName)
   	 {
   	   $found=true;
   	   break;
     }     
    }
   }
   if($found)
   {
    return true;
   }
   else
   {
    return false;
   }
}

static function checkIfIsIn1NRelation(string $actApp,string $actId):bool
{
   $appDir =  $actApp;
   $tableName = $actId;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $found=false;
   foreach($sectionsArray as $sectionObj)
   {
   	$defsArray = $sectionObj->getItem();
   	$defObj = $defsArray[1];
    $relTypeObj = $defsArray[4];
   	$relTypeObjArray = $relTypeObj->getItem();
   	$relTypeConstObj = $relTypeObjArray[1];
   	$relType = $relTypeConstObj->getItem();
   	if($relType=="REL_1_N")
   	{
   	 $defArray = $defObj->getItem();
   	 $constObj = $defArray[1];
   	 $constObjVal = $constObj->getItem();
   	 $constObjTable = getOriginalItemName($constObjVal);   	 
   	 if($constObjTable==$tableName)
   	 {
   	  $found=true;
   	  break;
     }
    }
   }
   if($found)
   {
    return true;
   }
   else
   {
    return false;
   }
}



static function checkIfKeyCollides(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $tableName = $ids[0];
 $targetTableName = $ids[1];
 $tablePos = self::getTablePos($actApp,$tableName);
 $targetTablePos = self::getTablePos($actApp,$targetTableName);
 $tablePk = self::getPkField($actApp,$tablePos);
 $targetTablePk = self::getPkField($actApp,$targetTablePos);
 if($tablePk==$targetTablePk)
  return true;
 else
  return false;
} 

static function checkIfIs1NRelationFatherOf(string $actApp,array $actId):bool
{
	 $appDir = $actApp;
	 $ids = $actId;
   $tableName = $ids[0];
   $targetTableName = $ids[1];
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $found=false;
   foreach($sectionsArray as $sectionObj)
   {
   	$defsArray = $sectionObj->getItem();
   	$defObj = $defsArray[1];
   	$relTypeObj = $defsArray[4];
   	$relTypeObjArray = $relTypeObj->getItem();
   	$relTypeConstObj = $relTypeObjArray[1];
   	$relType = $relTypeConstObj->getItem();
   	if($relType=="REL_1_N")
   	{
   	 $defArray = $defObj->getItem();
   	 $constObj1 = $defArray[1];
   	 $constObjVal1 = $constObj1->getItem();
   	 $constObjTable = getOriginalItemName($constObjVal1);   	
   	 $defObj2 = $defsArray[2];
   	 $defArray2 = $defObj2->getItem();
   	 $constObj2 = $defArray2[1];
   	 $constObjVal2 = $constObj2->getItem();
   	 $constObjTargetTable = getOriginalItemName($constObjVal2);   	
   	 if($constObjTable==$tableName)
   	 {
   	  if($constObjTargetTable==$targetTableName)
   	  {
   	   $found=true;
   	   break;
   	  }
     } 
    }
   }
   if($found)
    return true;
   else
    return false;

}

static function checkIfExistMNRelationLinkTable(string $actApp,array $actIds):bool
{
   $appDir =  $actApp;	
   $ids = $actIds;
   $tableName1 = $ids[0];
   $tableName2 = $ids[1];
   $tableName1 = "TABELLA" . CONST_SEP . strToUpper($tableName1); 
   $tableName2 = "TABELLA" . CONST_SEP . strToUpper($tableName2);
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $found=false;
   foreach($sectionsArray as $sectionObj)
   {
   	$defsArray = $sectionObj->getItem();
   	$defObj = $defsArray[4];
   	$defArray = $defObj->getItem();
   	$constObj = $defArray[1];
   	$relType = $constObj->getItem();
   	if($relType = 'REL_M_N')
   	{
   	 $defObj1 = $defsArray[1];
   	 $defArray1 = $defObj1->getItem();
   	 $constObj1 = $defArray1[1];
   	 $constObjVal1 = $constObj1->getItem();
   	 $defObj2 = $defsArray[2];
   	 $defArray2 = $defObj2->getItem();
   	 $constObj2 = $defArray2[1];
   	 $constObjVal2 = $constObj2->getItem(); 
   	 if(($constObjVal1==$tableName2)&&($constObjVal2==$tableName1))
   	 {
   	 	$defObj4 = $defsArray[8];
   	 	$defArray4 = $defObj4->getItem(); 
   	 	$methodCallObj = $defArray4[0];
   	 	$methodCallArray = $methodCallObj->getItem();
   	 	$argObj = $methodCallArray[1];
   	 	$stringObj = $argObj->getItem();
   	 	$linkTableName = $stringObj->getItem();
      $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . 
      DIR_SEP . XML_DIR . DIR_SEP . "db_objects_definition_def" .
      FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
      $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
      $xmlSerializer1->loadData();
      $allItems1 = $xmlSerializer1->getItems();
      $sectionsObj1 = $allItems1[0];
      $sectionsArray1 = $sectionsObj1->getItem();
      $sectionObj1 = $sectionsArray1[0];
      $defsArray1 = $sectionObj1->getItem();
      foreach($defsArray1 as $defObj3)
      {
      	$defArray3 = $defObj3->getItem();
      	$methodCallObj = $defArray3[1];
      	$argsArray = $methodCallObj->getItem();
      	$argObj1 = $argsArray[3];
      	$constObj3=$argObj1->getItem();
      	$constObj3TableName = $constObj3->getItem();
      	$constObj3TableName = getOriginalItemName($constObj3TableName);      	
      	if($linkTableName==$constObj3TableName)
      	{
      		$found=true;
      		break;
        } 
      }
      if($found)    	  
   	   break;
   	 }
   	}
   }
   if($found)
    return true;
   else
    return $linkTableName;	
}

static function getFieldsDefProps(string $actApp,int $actId):array
{   
   $appDir =  $actApp;
   $retStruct = array();
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   if(isset($sectionsArray[$actId]))
   {
    $sectionObj = $sectionsArray[$actId];
    $sectionInnerArray = $sectionObj->getItem();
    $defObj = $sectionInnerArray[0];
    $defObjInnerArray = $defObj->getItem();
    $functionCallObj = $defObjInnerArray[1];
    $functionCallObjInnerArray = $functionCallObj->getItem();
    $i=0;
    $j=0;
    $fields = array();
    $allFields = array();
    foreach($functionCallObjInnerArray as $ind=>$val)
    {
     $argObj = $val;
     $constObj = $argObj->getItem();
     $allFields[$j] = $constObj->getItem();
     if(! self::isAForeignKey($sectionInnerArray[8],$allFields[$j++]))
      $fields[$i++] = getOriginalItemName($constObj->getItem());
    }
    $retStruct["fields"]=$fields;
    $defObj2 = $sectionInnerArray[2];
    $defObjInnerArray2 = $defObj2->getItem();
    $functionCallObj2 = $defObjInnerArray2[1];
    $functionCallObjInnerArray2 = $functionCallObj2->getItem();
    $i=0;
    $j=0;
    $fieldsTypes = array();
    foreach($functionCallObjInnerArray2 as $ind2=>$val2)
    {
     $argObj2 = $val2;
     $constObj2 = $argObj2->getItem();
     $fieldType = getFieldTypeItemName($constObj2->getItem());
     if(! self::isAForeignKey($sectionInnerArray[8],$allFields[$j++]))
     $fieldsTypes[$i++] = $fieldType;
    }
    $retStruct["fieldsTypes"]=$fieldsTypes;
   }
  return $retStruct;
}

static function getCandKeyFieldsProps(string $actApp,int $actId):array
{
   $appDir =  $actApp;
   $retStruct = array();
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   if(isset($sectionsArray[$actId]))
   {
    $sectionObj = $sectionsArray[$actId];
    $sectionInnerArray = $sectionObj->getItem();   
    $candKeysFields = array();
    $defObj = $sectionInnerArray[6];
    $defObjInnerArray = $defObj->getItem();
    $functionCallObj = $defObjInnerArray[1];
    $functionCallObjInnerArray = $functionCallObj->getItem();
    foreach($functionCallObjInnerArray as $ind=>$val)
    {
     $argObj = $val;
     $argObjFunctionCallObj = $argObj->getItem();
     $argObjFunctionCallObjInnerArray = $argObjFunctionCallObj->getItem();
     $candKey = array();
     foreach($argObjFunctionCallObjInnerArray as $ind1=>$val1)
     {
      $argObjFunctionCallObjArgObj = $val1;
      $argObjFunctionCallObjArgObjConstObj = $argObjFunctionCallObjArgObj->getItem(); 
      $candKey[$ind1] = $argObjFunctionCallObjArgObjConstObj->getItem();
      $candKeyField = $candKey[$ind1];
      $candKey[$ind1] = getOriginalItemName($candKeyField);     
     }
     $candKeysFields[$ind]= $candKey;
    }
    $retStruct["candKeyFields"]= $candKeysFields;
   }
   return $retStruct;
}

static function getExtKeyFieldsProps(string $actApp,int $actId):array
{
   $appDir =  $actApp;
   $retStruct = array();
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   if(isset($sectionsArray[$actId]))
   {
    $sectionObj = $sectionsArray[$actId];
    $sectionInnerArray = $sectionObj->getItem();   
    $extKeyFields = array();
    $extKeyFieldsNames = array();
    $extKeyFieldsDefObj = $sectionInnerArray[8];
    $extKeyFieldsDefInnerArray = $extKeyFieldsDefObj->getItem();
    $extKeyFieldsFunctionCallObj = $extKeyFieldsDefInnerArray[1];
    $extKeyFieldsFunctionCallObjInnerArray = $extKeyFieldsFunctionCallObj->getItem(); 
    foreach($extKeyFieldsFunctionCallObjInnerArray as $ind2=>$val2)
    {        
     $extKeyFieldsArgObj = $extKeyFieldsFunctionCallObjInnerArray[$ind2];
     $extKeyFieldsAssObj = $extKeyFieldsArgObj->getItem();
     if(is_object($extKeyFieldsAssObj)&& is_a($extKeyFieldsAssObj,Classes_info::ASSOCIATIVE_ITEM_CLASS))
     {
      $extKeyFieldsAssObjInnerArray = $extKeyFieldsAssObj->getItem();
      $extKeyFieldsConstObj = $extKeyFieldsAssObjInnerArray[0];
      $extKeyFieldsTableName = $extKeyFieldsConstObj->getItem();
      $extKeyFieldsTableName = getOriginalItemName($extKeyFieldsTableName);
      $extKeyFieldsValueConstObj = $extKeyFieldsAssObjInnerArray[1];
      $extKeyFieldsKeyValue = $extKeyFieldsValueConstObj->getItem();
      $extKeyFieldsKeyValue = getOriginalItemName($extKeyFieldsKeyValue);
      $extKeyFieldsNames[$ind2] = $extKeyFieldsKeyValue;
      $extKeyFields[$ind2] = $extKeyFieldsTableName;
      //break;
     }
     else
     {
      $extKeyFields[$ind2] = STRING_NULL;
      $extKeyFieldsValues[$ind2] = STRING_NULL;
     }
    }
    $retStruct["extKeyFields"] = $extKeyFields;
    $retStruct["extKeyFieldsNames"] = $extKeyFieldsNames;
   }
   return $retStruct;
}

 //
 // Quando cambio la pk in una tabella devo aggiornare le 
 // chiavi esterne in tutte le tabelle in relazione 1N.
 //
static function setPk(string $actApp,array $actIds):string
{
	 $ids =$actIds;
	 $appDir = $actApp;
   $tablePos = $ids[0];
   $tableName = self::getTableName($actApp,$tablePos);
   $pk = $ids[1];
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   if(isset($sectionsArray[$tablePos]))
   {
    $sectionObj = $sectionsArray[$tablePos];
    $sectionInnerArray = $sectionObj->getItem();
    $defObj = $sectionInnerArray[4];
    $defArray = $defObj->getItem();
    $functionObj = $defArray[1];
    $functionArray = $functionObj->getItem();
    $argObj = $functionArray[0];
    $constObj = $argObj->getItem();
    $pkConstName = strToUpper("FIELD" . CONST_SEP . strToUpper(trim($pk)));
    $constObj->setItem($pkConstName);
    $allItems[0] = $sectionsObj;
    $xmlSerializer->loadItems($allItems);
    $xmlSerializer->saveData(); 
   }
   return STRING_NULL;
}

static function checkIfIsSuitablePkKey(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $tablePos = $ids[0];
 $pkKey = $ids[1];
 $appDir =  $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];  
 $sectionsArray1 = $sectionsObj1->getItem();  
   
 $res = true;
 foreach($sectionsArray1 as $ind1=>$sectionObj1)
 {
  if($ind1 != $tablePos)
  {
   $defsArray1 = $sectionObj1->getItem();
   $defObj1 = $defsArray1[4];
   $defArray1 = $defObj1->getItem();
   $functionCall1 = $defArray1[1];
   $functionArray1 = $functionCall1->getItem();
   $argObj0 = $functionArray1[0];
   $constObj0 = $argObj0->getItem();
   $pkKey1 = $constObj0->getItem();
   $pkKey1 = getOriginalItemName($pkKey1);
   if($pkKey1==$pkKey)
   {
    $res=false;
    break;
   }
  }
 }
 return $res;
}

//
// Controlla che la chiave della tabella data non collida con
// la chiave delle tabelle esterne
//
static function checkIfKeyCollidesWithSonsKeys(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $tablePos = $ids[0];
 $tableName = self::getTableName($actApp,$tablePos);
 $pkKey = $ids[1];
 $appDir =  $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1); 
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];  
 $sectionsArray1 = $sectionsObj1->getItem();  
 
 $res = false;
 $sons = self::get1NSons($actApp,$tableName);
 foreach($sons as $ind=>$son)
 {
 	$sonPkKey = self::getPkKeyByTableName($actApp,$son);
 	if($sonPkKey==$pkKey)
 	{
 		$res=true;
 		break;
 	}
 }
 return $res;
}

static function checkIfIsSuitableField(string $actApp,array $actIds):bool
{
	 $ids = $actIds;
   $tablePos = $ids[0];
   $fieldName = $ids[1];
   $appDir =  $actApp;
   $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
   $xmlSerializer1->loadData();
   $allItems1 = $xmlSerializer1->getItems();
   $sectionsObj1 = $allItems1[0];  
   $sectionsArray1 = $sectionsObj1->getItem();  
	
   if(isset($sectionsArray1[$tablePos]))
   {
   $res=true;
   $sectionObj1 = $sectionsArray1[$tablePos];
   $defsArray1 = $sectionObj1->getItem();
   $defObj1 = $defsArray1[8];
   $defArray1 = $defObj1->getItem();
   $functionCall1 = $defArray1[1];
   $functionArray1 = $functionCall1->getItem();
   foreach($functionArray1 as $ind2=>$argObj)
   {
    $assObj = $argObj->getItem();
    $assArray = $assObj->getItem();
    $constObj = $assArray[0];
    $tableName1 = $constObj->getItem();
    $tableName1 = getOriginalItemName($tableName1);
    $constObj1 = $assArray[1];
    $extKey = $constObj1->getItem();
    $extKey = getOriginalItemName($extKey);
    if($extKey==$fieldName)
    {
     $res = false;
    } 	 
   }
   }
   else
	 return STRING_NULL;
   return $res;   
}

static function deleteDuplicatedFields(array $actAllItems):array
{
 $sectionsObj1 = $actAllItems[0];
 $sectionsArray = $sectionsObj1->getItem();
 $fieldsArray = array();
 foreach($sectionsArray as $ind=>$val)
 {
  $sectionObj2 = $val;
  $sectionArray = $sectionObj2->getItem();
  $ifElseBufArray = array();
  $sectionArray1 = array();
  
  $num = count($sectionArray);
  
  for($i=1;$i<=$num-1;$i++)
   $sectionArray1 = $sectionArray[$i];
  
  foreach($sectionArray1 as $ind1=>$val1)
  {
   $ifElseObj = $val1;
   $ifElseArray = $ifElseObj->getItem();
   $defObj = $ifElseArray[1];
   $defArray = $defObj->getItem();
   $functionObj = $defArray[0];
   $functionArray = $functionObj->getItem();
   $argObj = $functionArray[0];
   $strObj = $argObj->getItem();
   $str = $strObj->getItem();
   if(! in_array($str,$fieldsArray))
   {
    $fieldsArray[] = $str;
    $ifElseBufArray[] = $ifElseObj;
   }
  }
  $sectionObj2->setItem($ifElseBufArray);
 }
 return $actAllItems;
}

//   
// Genera il file php di struttura della base dati.
// 
static function createDbStruct(string $actApp):bool
{
	 $appDir = $actApp;
   $dbStructSourceFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "db_struct_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $dbStructFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "db_struct" . 
   FILE_NAME_ELEMENTS_SEP . "def" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
   $newSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL);
   $newSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
   $newSerializer->setFileName($dbStructSourceFileName);
   $newSerializer->loadData();
   $actItems = $newSerializer->getItems();
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$actItems[0]);
   $fileDumper->setFileName($dbStructFileName);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump(); 

//   
// Legge il file xml di definizione delle costanti dei campi, 
// per raccogliere gli items 
//   
   $fieldsConstsXmlFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "fields_consts_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $newSerializer->setFileName($fieldsConstsXmlFileName);
   $newSerializer->loadData();
   $allItems = $newSerializer->getItems(); 
            
//
// Genera il file php con le costanti dei nomi dei campi
//  
//   print_r($allItems); 
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $fieldsConstsFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "fields" . 
   FILE_NAME_ELEMENTS_SEP . "def" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
   echo $fieldsConstsFileName;
   $fileDumper->setFileName($fieldsConstsFileName);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump();

//   
// Legge il file xml di definizione delle costanti delle tabelle, 
// per raccogliere gli items 
//   
   $tablesConstsXmlFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "tables_const_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $newSerializer->setFileName($tablesConstsXmlFileName);
   $newSerializer->loadData();
   $allItems = $newSerializer->getItems();       
//
// Genera il file php con le costanti dei nomi delle tabelle
//  
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]); 
   $tablesConstsFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "tables" . 
   FILE_NAME_ELEMENTS_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
   $fileDumper->setFileName($tablesConstsFileName);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump();
   return true;  

}

static function isAForeignKey(Def_item $actDefObj,string $actField):bool
{
 $defArray = $actDefObj->getItem();
 $functionObj = $defArray[1];
 $functionArray = $functionObj->getItem();
 $found=false;
 foreach($functionArray as $ind=>$argObj)
 {
  $assObj = $argObj->getItem();
  $assArray = $assObj->getItem();
  $constObj = $assArray[1];
  $extKey = $constObj->getItem();
  if($extKey==$actField)
  {
   $found=true;
   break;
  }
 }
 return $found;
}
  
static function getExtKeyFieldType(string $actAppName,
string $actExtKeyFieldsTableName,string $actExtKeyFieldName):string
{
 $appName = $actAppName;
 $appDir =  $appName;
 $tablePos = self::getTablePos($appName,$actExtKeyFieldsTableName);
  
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
 DIR_SEP . "fields_definition_def" .
 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(isset($sectionsArray[$tablePos]))
 {
 $sectionObj = $sectionsArray[$tablePos];
 $sectionInnerArray = $sectionObj->getItem();
 $defObj = $sectionInnerArray[0];
 $defArray = $defObj->getItem();
 $functionObj = $defArray[1];
 $functionArray = $functionObj->getItem();
 $num = count($functionArray);
 for($j=0;$j<=$num-1;$j++)
 {
  $argObj = $functionArray[$j];
  $constObj = $argObj->getItem();
  $fieldName = $constObj->getItem();
  $normFieldName = getOriginalItemName($fieldName); 	
  if($normFieldName==$actExtKeyFieldName)
   break;
 }
 //
 // Ricerca tipo campo
 //
 $defObj1 = $sectionInnerArray[2];
 $defArray1 = $defObj1->getItem();
 $functionObj1 = $defArray1[1];
 $functionArray1 = $functionObj1->getItem();
 $argObj = $functionArray1[$j];
 $constObj = $argObj->getItem();
 $fieldType = getFieldTypeItemName($constObj->getItem());
 return $fieldType;
 }
 return STRING_NULL;
}

static function getPkKeyFieldType(string $actAppName,string $actExtTableName):string
{
 $appName = $actAppName;
 $appDir =  $appName;
 $tablePos = self::getTablePos($appName,$actExtTableName);

 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
 DIR_SEP . "fields_definition_def" .
 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(isset($sectionsArray[$tablePos]))
 {
 $sectionObj = $sectionsArray[$tablePos];
 $sectionInnerArray = $sectionObj->getItem();
 $defObj = $sectionInnerArray[4];
 $defArray = $defObj->getItem();
 $functionObj = $defArray[1];
 $functionArray = $functionObj->getItem();
 $argObj = $functionArray[0];
 $constObj = $argObj->getItem();
 $pkKey = getOriginalItemName($constObj->getItem());

 $defObj = $sectionInnerArray[0];
 $defArray = $defObj->getItem();
 $functionObj = $defArray[1];
 $functionArray = $functionObj->getItem();
 $num = count($functionArray);
 for($j=0;$j<=$num-1;$j++)
 {
  $argObj = $functionArray[$j];
  $constObj = $argObj->getItem();
  $fieldName = $constObj->getItem();
  $normFieldName = getOriginalItemName($fieldName); 	
  if($normFieldName==$pkKey)
   break;
 }
 //
 // Ricerca tipo campo
 //
 $defObj1 = $sectionInnerArray[2];
 $defArray1 = $defObj1->getItem();
 $functionObj1 = $defArray1[1];
 $functionArray1 = $functionObj1->getItem();
 $argObj = $functionArray1[$j];
 $constObj = $argObj->getItem();
 $fieldType=getFieldTypeItemName($constObj->getItem());
 return $fieldType;
 }
 return STRING_NULL;
}
  
static function getPkField(string $actAppName,int $actTablePos):string
{
 $appDir =  $actAppName;
 $ids = $actTablePos;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
 DIR_SEP . "fields_definition_def" .
 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $keyFieldName=STRING_NULL;
 if(isset($sectionsArray[$ids]))
 {
  $sectionObj = $sectionsArray[$ids];
  $sectionInnerArray = $sectionObj->getItem();
  $defObj = $sectionInnerArray[4];
  $defArray = $defObj->getItem();
  $functionObj = $defArray[1];
  $functionArray = $functionObj->getItem();
  $argObj = $functionArray[0];
  $constObj = $argObj->getItem();
  $keyFieldName = getOriginalItemName($constObj->getItem());
 }
 return $keyFieldName;
}

//
// $actIds è un'array di tabelle di cui
// il primo elemento è la tabella oggetto
//
static function set1NRelations(string $actApp,array $actIds):bool
{
 $appDir = $actApp;
 $ids=$actIds;
 $tableName = $ids[0];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
 DIR_SEP . XML_DIR . DIR_SEP . "relations_definition_def" .
 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer1->loadData();
 $allItems = $xmlSerializer1->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $newSectionsArray = array();
   
 // Raccolgo tutte le relazioni in cui non compare $tableName come figlia o
 // in cui compare come REL_M_N
   
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  if(count($sectionArray)>1)
  {
   $defObj1 = $sectionArray[2];
   $defObj2 = $sectionArray[4];
    
   $defObj1Array = $defObj1->getItem();
   $defObj1ConstObj = $defObj1Array[1];
   $relEntSonTableName = $defObj1ConstObj->toString();
   $relEntSonTableName = getOriginalItemName($relEntSonTableName);
  
   $defObj2Array = $defObj2->getItem();
   $defObj2ConstObj = $defObj2Array[1];
   $relType = $defObj2ConstObj->toString();
   if((strToUpper(trim($relEntSonTableName)) != strToUpper(trim($tableName)))||($relType == "REL_M_N"))
   {
     $newSectionsArray[$i] = $sectionObj;
     $i++;
   }
  }
 }
   
 // Ricalibro i nomi di sezione
   
 $newSectionsArrayNum = count($newSectionsArray);
 for($k=0;$k<=$newSectionsArrayNum-1;$k++)
 {
  $sectionObj = $newSectionsArray[$k];
  $sectionObj->setName("Relation_definition" . STRING_UNDERSCORE . $k);
 }
   
 // Aggiunge le nuovi sezioni 1_N all'array delle sezioni

 $idsNum = count($ids);
 for($l=1;$l<=$idsNum-1;$l++)
 {
  $fatherTableName = $ids[$l];
    
  if(trim($fatherTableName) != STRING_NULL)
  {
   $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
   $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
   $functionCallObj1->setName("array");
   $defArray1 = array($varObj1,$functionCallObj1);
   $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
    
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_FATHER]"); 
   $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($fatherTableName));
   $defArray2 = array($varObj2,$constObj1);
   $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2); 
   
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities[ENT_SON]"); 
   $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($tableName));
   $defArray3 = array($varObj3,$constObj2);
   $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray3);   
   
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types"); 
   $functionCallObj2 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
   $functionCallObj2->setName("array");
   $defArray4 = array($varObj4,$functionCallObj2);
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray4);
    
   $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_FATHER]");
   $constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_1_N");
   $defArray5 = array($varObj5,$constObj3);
   $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray5);
   
   $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types[ENT_SON]"); 
   $constObj4 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_1_1");
   $defArray6 = array($varObj6,$constObj4);
   $defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray6);        
   
   $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRel1N" . $fatherTableName . $tableName);  
   $varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"entities");
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj8);
   $constObj5 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"REL_STRUCT");
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj5);
   
   $codeObj = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_rel");
   $stringObj1->setType("double_quoted");
   $argObj1a = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
   $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $argObj1b = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
   
   $methodCallArray1 = array($codeObj,$argObj1a,$argObj1b,$argObj1,$argObj2);
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj1->setName("create");
   $methodCallObj1->setParent(true);
   $defArray7 = array($varObj7,$methodCallObj1);
   $defObj7 =Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray7);
    
   $varObj10 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"objRel1N" . $fatherTableName . $tableName);
   $varObj11 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"types");
   $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj11);
   $methodCallArray1 = array($varObj10,$argObj3);
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj1->setName("setRelTypes");
   $defArray8 = array($methodCallObj1);
   $defObj8 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray8);
    
   $sectionArray1 = array($defObj1,$defObj2,$defObj3,$defObj4,$defObj5,$defObj6,$defObj7,$defObj8);
   $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray1);
   $sectionObj1->setName("Relation_definition" . STRING_UNDERSCORE . $k);
    
   $newSectionsArray[$k++] = $sectionObj1;
  }
 }

 $sectionsObj->setItem($newSectionsArray);
 $xmlSerializer1->loadItems($allItems);
 $xmlSerializer1->saveData();
 
 // Carico i nomi delle tabelle attuali
   
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
 DIR_SEP . "db_objects_definition_def" .
 FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer2->loadData();
 $allItems = $xmlSerializer2->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[0];
  $defsArray = $sectionObj->getItem();
  $tablesArray = array();   
  $n=0;
  foreach($defsArray as $ind=>$defObj)
  {
   $defArray = $defObj->getItem();
   $methodCallObj = $defArray[1];
   $methodCallArray = $methodCallObj->getItem();
   $argObj = $methodCallArray[3];
   $constObj = $argObj->getItem();
   $tableName = $constObj->toString();
   $tableName = getOriginalItemName($tableName);      
   $tablesArray[$n++] = array($tableName);
  }
   
   // Raccolgo tutte le relazioni per ogni tabella
   
  $tablesArrayNum = count($tablesArray);
   
  for($p=0;$p<=$tablesArrayNum-1;$p++)
  {
   $tableName = $tablesArray[$p][0];
   $q=0;
   $newSectionsArrayNum = count($newSectionsArray);
   $relationsArray = array();
   $r=0;
   for($s=0;$s<=$newSectionsArrayNum-1;$s++)
   {
    $sectionObj = $newSectionsArray[$s];
    $defsArray = $sectionObj->getItem();
    $defObj1 = $defsArray[1];
    $defArray1 = $defObj1->getItem();
    $constObj1 = $defArray1[1];
    $table1 = $constObj1->toString();
    $table1 = getOriginalItemName($table1);
    $defObj2 = $defsArray[2];
    $defArray2 = $defObj2->getItem();
    $constObj2 = $defArray2[1];
    $table2 = $constObj2->toString();
    $table2 = getOriginalItemName($table2);
     
    $defsArray = $sectionObj->getItem();
    $defObj3n = $defsArray[4];
    $defArray3 = $defObj3n->getItem();
    $constObj3 = $defArray3[1];     
    $relType = $constObj3->toString();    

    if((trim($table1)==trim($tableName))||(trim($table2)==trim($tableName)))
    {
     if(trim($relType)=="REL_1_N")
     {       
     	$relTypeStr = "1N";
     }
     elseif(trim($relType)=="REL_M_N")
      $relTypeStr = "MN";
     else
      $relTypeStr = STRING_NULL;
       
     $relationObjName = "objRel" . $relTypeStr . $table1 . $table2;
     $relationsArray[$r++] = $relationObjName;
    }     
   }
   $tablesArray[$p][1] = $relationsArray;
  }   
   
  // Effettuo il bind fra relazioni ed oggetti

   
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "binding_relations_to_objects_def" .
  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer3->loadData();
  $allItems = $xmlSerializer3->getItems();
  $sectionsObj = $allItems[0];
  $sectionsArray = array();
  for($t=0;$t<=$tablesArrayNum-1;$t++)
  {
   $sectionArray = array();
   $functionObj0 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
   $functionObj0->setName("array");
   $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");
   $defArray0 = array($varObj0,$functionObj0);
   $defObj0 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray0);
   $sectionArray[0] = $defObj0; 
   $relationsArray = $tablesArray[$t][1];
   $tableName = $tablesArray[$t][0];
   $relationsArrayNum = count($relationsArray);
   $v=1;
    
   for($u=0;$u<=$relationsArrayNum-1;$u++)
   {
   	$varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels[" . $u . "]");
    $relation = $relationsArray[$u];  
    $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$relation);    
    $defArray1 = array($varObj0,$varObj1);
    $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
    $sectionArray[$v] = $defObj1;
    $v++;
   }  
   
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");   
   $argObj0 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName);
   $methodCallArray0 = array($varObj3,$argObj0);
   $methodCallObj0 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray0);
   $methodCallObj0->setName("setRels"); 
   $defArray2 = array($methodCallObj0);
   $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray2);    
    
   $sectionArray[$v] = $defObj2;
   $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray);
   $sectionsArray[$t] = $sectionObj1;
  }
  $sectionsObj->setItem($sectionsArray); 
  $xmlSerializer3->loadItems($allItems);  
  $xmlSerializer3->saveData();   
  //  
  // Modifico structure_definition_def
  //
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "structure_definition_def" .   
  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  //$xmlSerializer4 = new Xml_items_serializer($appFileName);
  $xmlSerializer4 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer4->loadData();
  $allItems = $xmlSerializer4->getItems();    
  $sectionsObj = $allItems[0];
  $sectionsArray = $sectionsObj->getItem();    
  $newSectionArray = array();
  $newSectionsArrayNum = count($newSectionsArray);
   
  $z=0;
  for($w=0;$w<=$newSectionsArrayNum-1;$w++)
  {
   $sectionObj1 = $newSectionsArray[$w];
   $sectionArray = $sectionObj1->getItem();
   $defObj1 = $sectionArray[1];
   $defObj2 = $sectionArray[2];
   $defArray1 = $defObj1->getItem();
   $defArray2 = $defObj2->getItem();
   $constObj1 = $defArray1[1];
   $tableName1 = $constObj1->toString();
  // echo $tableName1;
   $tableName1 = getOriginalItemName($tableName1);
   $constObj2 = $defArray2[1];
   $tableName2 = $constObj2->toString();
   $tableName2 = getOriginalItemName($tableName2);
   $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName1);
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . $tableName2);
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2); 
   $methodCallArray = array($varObj1,$argObj2);
   $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray);
   $methodCallObj->setName("addSon");
   $defArray4 = array($methodCallObj);
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray4);
   $newSectionArray[$z++] = $defObj4;
  } 
  if(count($newSectionArray)>0) 
  { 
   $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$newSectionArray);
   $sectionsArray[0] = $sectionObj;
  }
  else
   $sectionsArray = array();  
  $sectionsObj->setItem($sectionsArray);
  $xmlSerializer4->loadItems($allItems);
  $xmlSerializer4->saveData();
 }  
 return true;	
}

static function getTablePos(string $actAppName,string $actTableName):int 
{
 $appDir =  $actAppName;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $i=0; 
 $j=false;
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $defsArray = $sectionObj->getItem();
 foreach($defsArray as $ind=>$val)
 {
  $defObj = $val;
  $defInnerArray = $defObj->getItem();
  $varObj = $defInnerArray[0];
  $varObjItem = $varObj->getItem();
  if(trim($varObjItem)==("dbObj" . ucFirst(strToLower($actTableName))))
  {
   $j=$i;  
   break;
  }
  $i++;
 }
 }
 return $j;
}

static function getTableName(string $actAppName,int $actTablePos):string
{
 $appDir =  $actAppName;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $tableName = STRING_NULL;
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $defsArray = $sectionObj->getItem();
 $i=0; 
 foreach($defsArray as $ind=>$val)
 {
  $defObj = $val;
  $defInnerArray = $defObj->getItem();
  $varObj = $defInnerArray[0];
  $varObjItem = $varObj->getItem();
  $tableName = substr($varObjItem,5,strlen($varObjItem)-1);
  if($i==$actTablePos)
   break;
  $i++;
 }
 }
 return $tableName;
}

static function setTable(string $actApp,string $actTable):bool
{
   $appDir =  $actApp;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

   $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "tables_const_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);   
   $xmlSerializer1->loadData();
   $allItems1 = $xmlSerializer1->getItems();
   $sectionsObj1 = $allItems1[0];
   $sectionsArray1 = $sectionsObj1->getItem();
 
   if(! isset($sectionsArray1[0]))
   {
	return true;
   }	   
 
   //Patch per includere namespace  
   
   $sectionObj1A = $sectionsArray1[0];
   $sectionArray1 = array();
   
   $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "binding_relations_to_objects_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
   $xmlSerializer2->loadData();
   $allItems2 = $xmlSerializer2->getItems();
   $sectionsObj2 = $allItems2[0];
   $sectionsArray2 = $sectionsObj2->getItem();
   $dim = count($sectionsArray2);

   $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "graph_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
   $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);  
   $xmlSerializer3->loadData();
   $allItems3 = $xmlSerializer3->getItems();
   $sectionsObj3 = $allItems3[0];
   $sectionsArray3 = $sectionsObj3->getItem();
   if(! isset($sectionsArray3[0]))
   {
	return true;
   }	
   $sectionObj3 = $sectionsArray3[0];
   $sectionArray4 = $sectionObj3->getItem();
   
   $appFileName5 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "aliases_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer5 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName5);
   $xmlSerializer5->loadData();
   $allItems5 = $xmlSerializer5->getItems();
   $sectionsObj5 = $allItems5[0];     
   $sectionsItems5 = array();
   
   // raccolgo le informazioni relative alle sezioni degli alias per la tabella $actTable e li metto nell'array $sectionsItem5
   
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $j=0;
   if(count($sectionsArray)>0)
   {
    $sectionObj = $sectionsArray[0];
    $defsArray = $sectionObj->getItem();
    $tablesConsts=array();
    $origTablesConsts=array();
    $delTab = STRING_NULL;
    foreach($defsArray as $ind=>$defObj)
    {
     $defElsArray = $defObj->getItem();
     $methodCallObj = $defElsArray[1];
     $argsArray = $methodCallObj->getItem();
     $argsObj = $argsArray[3];
     $constObj = $argsObj->getItem();
     $constObjItem = $constObj->getItem();
     $constEl = getOriginalItemName($constObjItem);
     $tablesConsts[$j] = $constEl;
     $origTablesConsts[$j] = $constEl;
     $section5 = self::getSectionFromAliasesDefinitionDef($actApp,$constEl);
    
     if($section5)
     {
      $section5->setName("aliases_definition" . STRING_UNDERSCORE . $j);
      $sectionsItems5[$j] = $section5;
     }
     else
     {
      $section5 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());
      $section5->setName("aliases_definition" . STRING_UNDERSCORE . $j);
      $sectionsItems5[$j] = $section5;
     }
     
     if($constEl==ucFirst(strToLower($actTable)))      
     {
      $pos = $j;
     }
     $j++; 
    }
   }  
   
   // Se la tabella non è stata trovata aggiungo una nuova sezione in coda.
   
   if(! isset($pos))
   {
   	$pos=$j;
   	$varObj = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($actTable)));
    $baseCode1 = Creator::create(Classes_info::CODE_ITEM_CLASS,STRING_NULL,"Creator");
    $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_node");
    $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);    
    $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);        
    $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($actTable));
    $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
    $methodCallArgs = array($argObj1,$argObj2,$argObj3);
    $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArgs);
    $methodCallObj->setName("Db_node");
    $defItems = array($varObj,$methodCallObj);
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems);
    $tablesConsts[$pos] = ucFirst(strToLower($actTable));
    $origTablesConsts[$pos] = $actTable;
    $defsArray[] = $defObj; 

    $section5 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());
    $section5->setName("aliases_definition" . STRING_UNDERSCORE . $pos);
    $sectionsItems5[$pos] = $section5;	
   } 
   
   
   // raccolgo le sezioni in un'array per tables_consts_def
   
   $num = count($tablesConsts);
   for($i=0;$i<=$num-1;$i++) 
   {
    //$exprItemString = STRING_EXCLAMATION_MARK . STRING_SPACE . "defined" . 
    //STRING_OPEN_PAR . STRING_SINGLE_QUOTE . "TABELLA" . 
    //  VAR_SEP . strToUpper($tablesConsts[$i]) . STRING_SINGLE_QUOTE . 
    //  STRING_CLOSE_PAR;
    //$functionArgs = array();
   $exprItemString = "__NAMESPACE__ . " . "'" . STRING_BACKSLASH . 
   "TABELLA" . CONST_SEP . strToUpper($tablesConsts[$i]) . "'";
   
   $exprItem = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,$exprItemString);
    //$strObj1->setType(String_item::SINGLE_QUOTED);
    $functionArgs[0] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprItem);
    $strObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$origTablesConsts[$i]);
    $strObj2->setType(String_item::DOUBLE_QUOTED);
    $functionArgs[1]= Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$strObj2);
    $functionObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArgs);
    $functionObj->setName("define");
    //$ifElseItemArray = array($exprItem,$functionObj);
    //$ifElseItemObj = new If_else_item($ifElseItemArray);
    $defItems = array();
    $defItems[0] = $functionObj;
    $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems);
    $sectionArray1[$i] = $defObj;
   }  

   // Patch per includere namespace per tables_consts_def

   $sectionArray2A = array();
   $sectionArray2A[0]= $sectionObj1A;
   foreach($sectionArray1 as $ind=>$val)
    $sectionArray2A[] = $val;
   $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray2A); 
   $rootItems = array($sectionObj1);
   
   // Scrivo su tables_consts_def
   
   $xmlSerializer1->setItems($rootItems);
   $xmlSerializer1->loadItems();
   $xmlSerializer1->saveData();    
   
   $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$defsArray);
   $sectionsItems = array($sectionObj);
   $sectionsObj = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems);
   $rootItems = array($sectionsObj);
   
   // Scrivo su db_objects_definition_def
   
   $xmlSerializer->setItems($rootItems);
   $xmlSerializer->loadItems();
   $xmlSerializer->saveData();   

   $sectionArray3 = array();
   
   // Se la posizione della tabella indica che l'oggetto è nuovo (cioè $pos > $dim - 1) 
   // aggiungo una nuova defnizione per graph_definition_def  e per binding_relations_to_objects_def
   
   if($pos > $dim-1)
   {
   	$functionObj0 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array());
    $functionObj0->setName("array");
    $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");
    $defArray0 = array($varObj0,$functionObj0);
    $defObj0 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray0);
    $sectionArray3[0] = $defObj0; 
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"rels");
    $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
    $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($actTable)));
    $methodCallArray0 = array($varObj4,$argObj3);
    $methodCallObj0 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray0);
    $methodCallObj0->setName("setRels"); 
    $defArray3 = array($methodCallObj0);
    $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray3);
    $sectionArray3[1] = $defObj3;
    $sectionObj1 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray3);
    $sectionsArray2[] = $sectionObj1;
    
    $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbStructTree");
    $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($actTable)));
    $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
    $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array());
    $methodCallObj1->setName("add");
    $methodCallArray1 = array();
    $methodCallArray1[0] = $varObj2;
    $methodCallArray1[1] = $argObj2;
    $methodCallObj1->setItem($methodCallArray1);
    $defItems2 = array($methodCallObj1);
    $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItems2);
    $sectionArray4[] = $defObj2;        
   }

  // scrivo su binding_relations_to_objects_def

   $sectionsObj2->setItem($sectionsArray2); 
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();    
 
  // scrivo su graph_definition_def
 
   $sectionObj3 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,$sectionArray4);
   $sectionsItems3 = array($sectionObj3);
   $sectionsObj3 = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems3);
   $rootItems = array($sectionsObj3);
   $xmlSerializer3->setItems($rootItems);
   $xmlSerializer3->loadItems();
   $xmlSerializer3->saveData(); 
   
  // scrivo su aliases_definition_def 
   
  $sectionsObj5 = Creator::create(getClassNameForCreate(Classes_info::SECTIONS_ITEM_CLASS),STRING_NULL,$sectionsItems5);
  $rootItems = array($sectionsObj5);
  $xmlSerializer5->setItems($rootItems);
  $xmlSerializer5->loadItems();
  $xmlSerializer5->saveData();
     
  return true;
}

// Ritorna un array con tutti i campi per la tabella di posizione $actPos.

static function getFields(string $actApp,int $actPos):array
{
 $appDir =  $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $fields = array();
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[$actPos];
  $sectionInnerArray = $sectionObj->getItem();
  $defObj = $sectionInnerArray[0];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = &$functionCallObj->getItem();
  $i=0;
  $j=0;
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $constObj = $argObj->getItem();
   $fields[$i++] = getOriginalItemName($constObj->getItem());
  }
 }
 return $fields;
}

static function getFieldsTypes(string $actApp,int $actPos):array
{
 $appDir =  $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $fieldsTypes = array();
 if(isset($sectionsArray[$actPos]))
 {
  $sectionObj = $sectionsArray[$actPos];
  $sectionInnerArray = $sectionObj->getItem();
  $defObj = $sectionInnerArray[2];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  $i=0;
  $j=0;
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj2 = $val;
   $constObj2 = $argObj2->getItem();
   $fieldType=getFieldTypeItemName($constObj2->getItem());
   $fieldsTypes[$i++] = $fieldType;
  }
 }
 return $fieldsTypes;
}

static function getForeignKeys(string $actApp,int $actTablePos):array
{
   $appDir =  $actApp;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer5= Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $extKeyFields = array();
   if(isset($sectionsArray[$actTablePos]))
   {
    $sectionObj = $sectionsArray[$actTablePos];
    $sectionInnerArray = $sectionObj->getItem();   
    $extKeyFieldsDefObj = $sectionInnerArray[8];
    $extKeyFieldsDefInnerArray = $extKeyFieldsDefObj->getItem();
    $extKeyFieldsFunctionCallObj = $extKeyFieldsDefInnerArray[1];
    $extKeyFieldsFunctionCallObjInnerArray = $extKeyFieldsFunctionCallObj->getItem(); 
    foreach($extKeyFieldsFunctionCallObjInnerArray as $ind2=>$val2)
    {        
     $extKeyFieldsArgObj = $extKeyFieldsFunctionCallObjInnerArray[$ind2];
     $extKeyFieldsAssObj = $extKeyFieldsArgObj->getItem();
     if(is_object($extKeyFieldsAssObj)&& is_a($extKeyFieldsAssObj,Classes_info::ASSOCIATIVE_ITEM_CLASS))
     {
      $extKeyFieldsAssObjInnerArray = $extKeyFieldsAssObj->getItem();
      $extKeyFieldsConstObj = $extKeyFieldsAssObjInnerArray[0];
      $extKeyFieldsTableName = $extKeyFieldsConstObj->getItem();
      $extKeyFieldsTableName = getOriginalItemName($extKeyFieldsTableName);
      $extKeyFieldsValueConstObj = $extKeyFieldsAssObjInnerArray[1];
      $extKeyFieldsKeyValue = $extKeyFieldsValueConstObj->getItem();
      $extKeyFieldsKeyValue = getOriginalItemName($extKeyFieldsKeyValue);
      $extKeyFields[$extKeyFieldsTableName] = $extKeyFieldsKeyValue;
     }
     else
     {
      $extKeyFields[STRING_NULL] = STRING_NULL;
     }
    }
   }
   return $extKeyFields;
}

static function getUniqueKeys(string $actApp,int $actPos):array
{
 $appDir =  $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "fields_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
  $candKeysFields = array();
 if(isset($sectionsArray[$actPos]))
 {
  $sectionObj = $sectionsArray[$actPos];
  $sectionInnerArray = $sectionObj->getItem();   
  $defObj = $sectionInnerArray[6];
  $defObjInnerArray = $defObj->getItem();
  $functionCallObj = $defObjInnerArray[1];
  $functionCallObjInnerArray = $functionCallObj->getItem();
  foreach($functionCallObjInnerArray as $ind=>$val)
  {
   $argObj = $val;
   $argObjFunctionCallObj = $argObj->getItem();
   $argObjFunctionCallObjInnerArray = $argObjFunctionCallObj->getItem();
   $candKey = array();
   foreach($argObjFunctionCallObjInnerArray as $ind1=>$val1)
   {
    $argObjFunctionCallObjArgObj = $val1;
    $argObjFunctionCallObjArgObjConstObj = $argObjFunctionCallObjArgObj->getItem(); 
    $candKey[$ind1] = $argObjFunctionCallObjArgObjConstObj->getItem();
    $candKeyField = $candKey[$ind1];
    $candKey[$ind1] = getOriginalItemName($candKeyField);     
   }
   $candKeysFields[$ind]= $candKey;
  }
 }
 return $candKeysFields;
}

static function getAllRelations(string $actAppName):array
{
 $appDir=$actAppName;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "relations_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $retStruct = array();
// if(count($sectionsArray)>0)
// {
 	$i=0;
 	foreach($sectionsArray as $ind=>$sectionObj)
 	{
 		$sectionArray = $sectionObj->getItem();
 		
 		$defObj1 = $sectionArray[1];
 		$defArray1 = $defObj1->getItem(); 
 		$constObj1 = $defArray1[1];
 		$fatherTable = $constObj1->getItem();
 		$fatherTable = getOriginalItemName($fatherTable);

 		$defObj2 = $sectionArray[2];
 		$defArray2 = $defObj2->getItem(); 
 		$constObj2 = $defArray2[1];
 		$sonTable = $constObj2->getItem();
 		$sonTable = getOriginalItemName($sonTable);

 		$defObj3 = $sectionArray[4];
 		$defArray3 = $defObj3->getItem(); 
 		$constObj3 = $defArray3[1];
 		$relType = $constObj3->getItem(); 		
 		 		
 		$relationArray = array("Father"=>$fatherTable,"Son"=>$sonTable,"Type"=>$relType);
 		$retStruct[$i++] = $relationArray; 		
 	}
// }
 return $retStruct;
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in db_objects_definition_def

static function renameTableInDbObjDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "db_objects_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $sectionArray = $sectionObj->getItem();
 $defObj = $sectionArray[$tablePos];
 $defArray = $defObj->getItem();
 $methodCallObj = $defArray[1];
 $methodCallArray = $methodCallObj->getItem();
 $argObj = $methodCallArray[3];
 $constObj = $argObj->getItem();
 $origName = getOriginalItemName($constObj->getItem());
 $varObj = $defArray[0];
 $varName = $varObj->getItem();
 if($origName==$oldTable)
 {
 	$constObj->setItem("TABELLA" . CONST_SEP . strToUpper($newTable));
  $varNewName = preg_replace('/' . $origName . '/',$newTable,$varName);
  $varObj->setItem($varNewName);
 }
 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData(); 
 }
 return true; 
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in binding_relations_to_objects_def

static function renameTableInBindingRelationsToObjectsDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "binding_relations_to_objects_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	if($ind!=$tablePos)
 	{
 		$num = count($sectionArray); 
 		for($i=1;$i<=$num-2;$i++)
 		{
 			$defObj = $sectionArray[$i];
 			$defArray = $defObj->getItem();
 			$varObj = $defArray[1];
 			$relVarName = $varObj->getItem();
 			$relVarItems = strUppercaseSplit($relVarName);
 			if(($pos = array_getPos($relVarItems,$oldTable)))
 			{
 				$relVarItems[$pos] = $newTable;
 				$newVarName = join(STRING_NULL,$relVarItems);
 				$varObj->setItem($newVarName);
 			}
 		}
 	}
 	else
 	{
 		$num1 = count($sectionArray); 
 		for($i=1;$i<=$num1-2;$i++)
 		{
 			$defObj1 = $sectionArray[$i];
 			$defArray1 = $defObj1->getItem();
 			$varObj1 = $defArray1[1];
 			$relVarName1 = $varObj1->getItem();
 			$relVarItems1 = strUppercaseSplit($relVarName1);
 			if(($pos = array_getPos($relVarItems1,$oldTable)))
 			{
 				$relVarItems1[$pos] = $newTable;
 				$newVarName1 = join(STRING_NULL,$relVarItems1);
 				$varObj1->setItem($newVarName1);
 			}
 		}
 		$defObj2 = $sectionArray[$num1-1];
 		$defArray2 = $defObj2->getItem();
 	  $methodCallObj = $defArray2[0];
 	  $methodCallArray = $methodCallObj->getItem();
 	  $varObj2 = $methodCallArray[0];
 	  $varName2 = $varObj2->getItem();
    $varNewName2 = preg_replace('/' . $oldTable . '/',$newTable,$varName2);
    $varObj2->setItem($varNewName2); 	  	   				
 	}
 }

 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData(); 
 return true;  
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in fields_definition_def

static function renameTableInFieldsDefinitionDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "fields_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(isset($sectionsArray[$tablePos]))
 {
 $sectionObj = $sectionsArray[$tablePos];
 $sectionArray = $sectionObj->getItem();

 $defObj = $sectionArray[1];
 $defArray = $defObj->getItem();
 $methodCallObj = $defArray[0];
 $methodCallArray = $methodCallObj->getItem();
 $varObj = $methodCallArray[0];
 $varName = $varObj->getItem();
 $varNewName = preg_replace('/' . $oldTable . '/',$newTable,$varName);
 $varObj->setItem($varNewName); 

 $defObj1 = $sectionArray[3];
 $defArray1 = $defObj1->getItem();
 $methodCallObj1 = $defArray1[0];
 $methodCallArray1 = $methodCallObj1->getItem();
 $varObj1 = $methodCallArray1[0];
 $varName1 = $varObj1->getItem();
 $varNewName1 = preg_replace('/' . $oldTable . '/',$newTable,$varName1);
 $varObj1->setItem($varNewName); 

 $defObj2 = $sectionArray[5];
 $defArray2 = $defObj2->getItem();
 $methodCallObj2 = $defArray2[0];
 $methodCallArray2 = $methodCallObj2->getItem();
 $varObj2 = $methodCallArray2[0];
 $varName2 = $varObj2->getItem();
 $varNewName2 = preg_replace('/' . $oldTable . '/',$newTable,$varName2);
 $varObj2->setItem($varNewName2);
 
 $defObj3 = $sectionArray[7];
 $defArray3 = $defObj3->getItem();
 $methodCallObj3 = $defArray3[0];
 $methodCallArray3 = $methodCallObj3->getItem();
 $varObj3 = $methodCallArray3[0];
 $varName3 = $varObj3->getItem();
 $varNewName3 = preg_replace('/' . $oldTable . '/',$newTable,$varName3);
 $varObj3->setItem($varNewName3);
 
 $defObj4 = $sectionArray[9];
 $defArray4 = $defObj4->getItem();
 $methodCallObj4 = $defArray4[0];
 $methodCallArray4 = $methodCallObj4->getItem();
 $varObj4 = $methodCallArray4[0];
 $varName4 = $varObj4->getItem();
 $varNewName4 = preg_replace('/' . $oldTable . '/',$newTable,$varName4);
 $varObj4->setItem($varNewName4);  

 foreach($sectionsArray as $ind=>$sectionObj1)
 {
  $sectionArray1 = $sectionObj1->getItem();
  $defObj5 = $sectionArray1[8];
  $defArray5 = $defObj5->getItem();
  $functionObj5 = $defArray5[1];
  $functionArray5 = $functionObj5->getItem();
  foreach($functionArray5 as $ind1=>$arg1)
  {
   $assObj = $arg1->getItem();
   $assArray = $assObj->getItem();
   $constObj5 = $assArray[0];
   $origName = getOriginalItemName($constObj5->getItem());
   if($origName==$oldTable)
   {
 	  $constObj5->setItem("TABELLA" . CONST_SEP . strToUpper($newTable));
   }
  }
 }   

 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData();
 } 
 return true; 
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in relations_definition_def

static function renameTableInRelationsDefinitionDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "relations_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 foreach($sectionsArray as $ind=>$sectionObj1)
 {
  $sectionArray1 = $sectionObj1->getItem();
  $defObj1 = $sectionArray1[1];
  $defArray1 = $defObj1->getItem();
  $constObj1 = $defArray1[1];
  $origName = getOriginalItemName($constObj1->getItem());
  if($origName==$oldTable)
  {
 	 $constObj1->setItem("TABELLA" . CONST_SEP . strToUpper($newTable));
  }
  $defObj2 = $sectionArray1[2];
  $defArray2 = $defObj2->getItem();
  $constObj2 = $defArray2[1];
  $origName = getOriginalItemName($constObj2->getItem());
  if($origName==$oldTable)
  {
 	 $constObj2->setItem("TABELLA" . CONST_SEP . strToUpper($newTable));
  }
  $defObj3 = $sectionArray1[6]; 
  $defArray3 = $defObj3->getItem();
  $varObj3 = $defArray3[0]; 
  $relVarName1 = $varObj3->getItem();
  $relVarItems1 = strUppercaseSplit($relVarName1);
  if(($pos = array_getPos($relVarItems1,$oldTable)))
 	{
 	 $relVarItems1[$pos] = $newTable;
 	 $newVarName1 = join(STRING_NULL,$relVarItems1);
 	 $varObj3->setItem($newVarName1);
 	}
 	$defObj4 = $sectionArray1[7]; 
  $defArray4 = $defObj4->getItem();
  $methodCallObj4 = $defArray4[0];
  $methodCallArray4 = $methodCallObj4->getItem();
  $varObj4 = $methodCallArray4[0];    
  $relVarName2 = $varObj4->getItem();
  $relVarItems2 = strUppercaseSplit($relVarName2);
  if(($pos = array_getPos($relVarItems2,$oldTable)))
 	{
 	 $relVarItems2[$pos] = $newTable;
 	 $newVarName2 = join(STRING_NULL,$relVarItems2);
 	 $varObj4->setItem($newVarName2);
 	} 
 }   

 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData(); 
 return true;  
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in graph_definition_def

static function renameTableInGraphDefinitionDef(string $actAppName,array $actIds):bool
{
 $appDir = $actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "graph_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $sectionArray = $sectionObj->getItem();
 $defObj = $sectionArray[$tablePos+1];
 $defArray = $defObj->getItem();
 $methodCallObj = $defArray[0];
 $methodCallArray = $methodCallObj->getItem();
 $argObj = $methodCallArray[1];
 $varObj = $argObj->getItem();
 $relVarName = $varObj->getItem();
 $relVarItems = strUppercaseSplit($relVarName);
 if(($pos = array_getPos($relVarItems,$oldTable)))
 {
 	 $relVarItems[$pos] = $newTable;
 	 $newVarName = join(STRING_NULL,$relVarItems);
 	 $varObj->setItem($newVarName);
 } 
 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData();
 } 
 return true;  
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in structure_definition_def

static function renameTableInStructureDefinitionDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "structure_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[0];
  $sectionArray = $sectionObj->getItem();
  foreach($sectionArray as $ind=>$defObj)
  {
   $defArray = $defObj->getItem();
   $methodCallObj = $defArray[0];
   $methodCallArray = $methodCallObj->getItem();
   $varObj1 = $methodCallArray[0];
   $relVarName1 = $varObj1->getItem();
 
   $relVarItems1 = strUppercaseSplit($relVarName1);
   if(($pos = array_getPos($relVarItems1,$oldTable)))
   {
    $relVarItems1[$pos] = $newTable;
    $newVarName1 = join(STRING_NULL,$relVarItems1);
    $varObj1->setItem($newVarName1);
   }
   $argObj2 = $methodCallArray[1];
   $varObj2 = $argObj2->getItem();
   $relVarName2 = $varObj2->getItem();
   $relVarItems2 = strUppercaseSplit($relVarName2);
   if(($pos = array_getPos($relVarItems2,$oldTable)))
   {
    $relVarItems2[$pos] = $newTable;
    $newVarName2 = join(STRING_NULL,$relVarItems2);
    $varObj2->setItem($newVarName2);
   }
  }
  $xmlSerializer->setItems($allItems);
  $xmlSerializer->loadItems();
  $xmlSerializer->saveData();
 } 
 return true;  
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in tables_consts_def

static function renameTableInTablesConstsDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 $tablePos = self::getTablePos($appDir,$oldTable);
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_const_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionObj = $allItems[0];
 $sectionArray = $sectionObj->getItem();
 if(isset($sectionArray[$tablePos + 1]))
 {
 $defObj = $sectionArray[$tablePos + 1];
 $defArray = $defObj->getItem();
 $functionCallObj = $defArray[0];
 $functionCallArray = $functionCallObj->getItem();
 $argObj0 = $functionCallArray[0];
 $exprObj0 = $argObj0->getItem(); 
 $argObj1 = $functionCallArray[1];
 $strObj1 = $argObj0->getItem();
 $strVal1 = $strObj1->getItem();
 $origTable = strToupper($strVal1);
 if($origTable == $oldTable)
 {
  $strVal2= "__NAMESPACE__ . '" . STRING_BACKSLASH . 
  "TABELLA" . CONST_SEP . strToUpper($newTable); 
  $exprObj0->setItem($strVal2);
 }
 $strObj1->setItem($newTable); 
 $xmlSerializer->setItems($allItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData(); 
 }
 return true;  
}

// l'array $actIds contiene nella posizione 0 il nome della vecchia tabella e in 1 il nome nuovo.
// Modifico il nome in aliases_definition_def

static function renameTableInAliasesDefinitionDef(string $actAppName,array $actIds):bool
{
 $appDir=$actAppName;
 $oldTable = $actIds[0];
 echo $oldTable;
 $tablePos = self::getTablePos($appDir,$oldTable);
 echo $tablePos;
 $newTable = $actIds[1];
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(isset($sectionsArray[$tablePos]))
 {
 $sectionObj = $sectionsArray[$tablePos];
 $sectionArray = $sectionObj->getItem();
 if(count($sectionArray)>0)
 {
  $defObj = $sectionArray[0];
  $defArray = $defObj->getItem();
  $methodCallObj = $defArray[1];
  $methodCallArray = $methodCallObj->getItem();
  $argObj = $methodCallArray[1];
  $constObj = $argObj->getItem(); 
  $constObj->setItem("TABELLA" . CONST_SEP . strToUpper($newTable));
  $xmlSerializer->setItems($allItems);
  $xmlSerializer->loadItems();
  $xmlSerializer->saveData(); 
 }
 }
 return true;  
}

static function getQuery(string $actApp,array $actIds):bool
{
 $appDir = $actApp;
 $ids = $actIds;
 //$appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
 //DIR_SEP . "queries_defines_def" .
 //FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 
 //$queryName = $ids[0];
 $queryPos = $ids[0];
 /*$xmlSerializer1 = new Xml_items_serializer($appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
 $num = count($sectionArray1);*/
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "queries_definition_def" .
  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);   
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)>0)
 {
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem(); 
 $retArray = array();
 if($queryPos <= $num-2)
 {
 /* $ifElseObj1 = $sectionArray1[$queryPos+1];
  $ifElseArray1 = $ifElseObj1->getItem();
  $defObj1 = $ifElseArray1[1];
  $functionArray1 = $defObj1->getItem();
  $functionObj1 = $functionArray1[0];
  $argArray1 = $functionObj1->getItem();
  $argObj1 = $argArray1[0];
  $stringObj1 = $argObj1->getItem();
  $innerQueryName = $stringObj1->getItem();
  $argObj2 = $argArray1[1];
  $stringObj2 = $argObj2->getItem();    
  $queryName = $stringObj2->getItem();
  $retArray[0] = $queryName;*/

 /* $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "queries_definition_def" .
  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;    
  $xmlSerializer2 = new Xml_items_serializer($appFileName2);
  $xmlSerializer2->loadData();
  $allItems2 = $xmlSerializer2->getItems();
  $sectionsObj2 = $allItems2[0];
  $sectionsArray2 = $sectionsObj2->getItem();
  $sectionObj2 = $sectionsArray2[0];
  $sectionArray2 = $sectionObj2->getItem(); */ 
  
  $defObj1 = $sectionArray1[$queryPos*2];
  $stringArray1 = $defObj1->getItem();
  $stringObj2 = $stringArray1[1];
  $queryBody = $stringObj2->getItem();
  $retArray[0] = $queryBody;
  return $retArray;   
 }
 else
 {
  return false;
 }
 }
 return false;
}

static function setQuery(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $queryName = trim(ucFirst(strToLower($ids[0])));
 $queryPos = $ids[1];
 $queryBody = trim($ids[2]);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)==0)
  return true;
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
   
 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "queries_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);    
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(count($sectionsArray2)==0)
  return true; 
 $sectionObj2 = $sectionsArray2[0];
 $sectionArray2 = $sectionObj2->getItem();
  
 $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "queries_container_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);     
 $xmlSerializer3->loadData();
 $allItems3 = $xmlSerializer3->getItems();
 $sectionsObj3 = $allItems3[0];
 $sectionsArray3 = $sectionsObj3->getItem();
 if(count($sectionsArray3)==0)
  return true;
 $sectionObj3 = $sectionsArray3[0];
 $sectionArray3 = $sectionObj3->getItem();     
   
 $num = count($sectionArray1);
 if($queryName == STRING_NULL)
 {
  $num1 = count($sectionArray1);
  $newSectionArray1 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $queryPos+1)
    $newSectionArray1[$j++]=$sectionArray1[$i];
  }
  $sectionObj1->setItem($newSectionArray1);
  $xmlSerializer1->loadItems($allItems1);
  $xmlSerializer1->saveData();
    
  $num1 = $num1-1;
  $newSectionArray2 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $queryPos)
   {
    $k=$i*3;
    $newSectionArray2[$j++]=$sectionArray2[$k];
    $newSectionArray2[$j++]=$sectionArray2[$k+1];
    $newSectionArray2[$j++]=$sectionArray2[$k+2];
   }
  }
  $sectionObj2->setItem($newSectionArray2);
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData();
    
  $num1 = count($sectionArray1);
  $newSectionArray3 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $queryPos+1)
    $newSectionArray3[$j++]=$sectionArray3[$i];
  }
  $sectionObj3->setItem($newSectionArray3);
  $xmlSerializer3->loadItems($allItems3);
  $xmlSerializer3->saveData();              
 }
 else
 {
  if(($queryPos != false) && ($queryPos <= $num-3))
  {   
   $defObj1 = $sectionArray1[$queryPos+1];
   //$ifElseArray1 = $ifElseObj1->getItem();
   //$defObj1 = $ifElseArray1[1];
   $functionArray1 = $defObj1->getItem();
   $functionObj1 = $functionArray1[0];
   $argArray1 = $functionObj1->getItem();
   $argObj1 = $argArray1[0];
   $exprObj1 = $argObj1->getItem();
   $exprObj1->setItem("__NAMESPACE__ . '" .  
   STRING_BACKSLASH . 'QUERY' . CONST_SEP . 
   strToUpper($queryName) . "'");
   $argObj2 = $argArray1[1];
   $stringObj2 = $argObj2->getItem();     
   $stringObj2->setItem($queryName);
   $xmlSerializer1->loadItems($allItems1);
   $xmlSerializer1->saveData();
    
   $defObj2 = $sectionArray2[$queryPos*2];
   $stringArray2 = $defObj2->getItem();
   $stringObj3 = $stringArray2[1];
   $stringObj3->setItem(trim($queryBody));
    
   $defObj3 = $sectionArray2[$queryPos*2 + 1];
   $itemsArray = $defObj3->getItem();
   $varObj = $itemsArray[0];
   $varObj->setItem('dbQuery' . $queryName);
   $methodCallObj = $itemsArray[1];
   $argArray = $methodCallObj->getItem();
   $argObj = $argArray[3];
   $constObj = $argObj->getItem();
   $constObj->setItem('QUERY' . CONST_SEP . strToUpper($queryName));        
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();
        
   $defObj4 = $sectionArray3[$queryPos + 1];
   $methodArray = $defObj4->getItem();
   $methodObj = $methodArray[0];
   $itemsArray1 = $methodObj->getItem();
   $argObj4 = $itemsArray1[1];
   $varObj1 = $argObj4->getItem();
   $varObj1->setItem('dbQuery' . $queryName);
   $xmlSerializer3->loadItems($allItems3);
   $xmlSerializer3->saveData();           
  }
  else
  {
   //$exprObj1 = new Expr_item("__NAMESPACE__ . '" . 
   //STRING_BACKSLASH . 'QUERY' . CONST_SEP . 
   //strToUpper($queryName) . "'");
   $exprObj1 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . 
   STRING_BACKSLASH . 'QUERY' . CONST_SEP . 
   strToUpper($queryName) . "'");
   //$exprObj1->setType(String_item::SINGLE_QUOTED);
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj1);
   $stringObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$queryName);    
   $stringObj2->setType(String_item::DOUBLE_QUOTED);
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj2);
   $functionArray1 = array();
   $functionArray1[0] = $argObj1;
   $functionArray1[1] = $argObj2;
   $functionObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionArray1);    
   $functionObj1->setName("define");
   $defArray1 = array();
   $defArray1[0] = $functionObj1;
   $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray1);
   //$ifElseArray1 = array();
   //$exprObj = new Expr_item("! defined('" . 
   //'QUERY' . VAR_SEP . strToUpper($queryName) . "')"); 
   //$ifElseArray1[0] = $exprObj;
   //$ifElseArray1[1] = $defObj1;
   //$ifElseObj1 = new If_else_item($ifElseArray1);
   $sectionArray1[$queryPos+1] = $defObj1;
   $sectionObj1->setItem($sectionArray1);
    
   $xmlSerializer1->loadItems($allItems1);
   $xmlSerializer1->saveData();

   $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$queryBody);
   $stringObj3->setType(String_item::DOUBLE_QUOTED);
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'queryStr');
   $defItemsArray3 = array();
   $defItemsArray3[0] = $varObj3;
   $defItemsArray3[1] = $stringObj3;
   $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItemsArray3);
   $sectionArray2[($queryPos)*3] = $defObj3;
   
   $codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   
   $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_query");
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
   
   $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);   
   
   $constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'QUERY' . 
   CONST_SEP . strToUpper($queryName));  
   $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
   $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbStructTree');
   $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'ricSql2DefRules');
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'ricSql2DefGrRules');
   $argObj6 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
   
   $methodCallArray1 = array();
   $methodCallArray1[0] = $codeObj1;
   $methodCallArray1[1] = $argObj1;
   $methodCallArray1[2] = $argObj2;
   $methodCallArray1[3] = $argObj3;
   $methodCallArray1[4] = $argObj4; 
   $methodCallArray1[5] = $argObj5;
   $methodCallArray1[6] = $argObj6;
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj1->setName("create");
   $methodCallObj1->setParent(true);   
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $queryName);
   $itemsArray1 = array();
   $itemsArray1[0] = $varObj2;
   $itemsArray1[1] = $methodCallObj1;
   $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$itemsArray1);
   $sectionArray2[($queryPos)*3+1] = $defObj2;
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $queryName);
   $methodCallArray = array();
   $methodCallArray[0] = $varObj3; 
   $methodCallArray[1] = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'queryStr'));
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray);
   $methodCallObj1->setName("setQueryStr");
   $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj1));
   $sectionArray2[($queryPos)*3+2] = $defObj3;

   $sectionObj2->setItem($sectionArray2);
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();
   
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $queryName);   
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
   $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQueriesContainer');
   $methodCallArray1 = array();
   $methodCallArray1[0] = $varObj5;
   $methodCallArray1[1] = $argObj5;
   $methodObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodObj1->setName('add');
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodObj1));
   $sectionArray3[$queryPos+1] = $defObj4;
   $sectionObj3->setItem($sectionArray3);
   $xmlSerializer3->loadItems($allItems3);
   $xmlSerializer3->saveData();    
  }
 }
 return true;
}

static function setQueryInRepository(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $queryName = trim(ucFirst(strToLower($ids[0])));
 $queryPos = $ids[1];
 $queryBody = trim($ids[2]);
 $isDataSource = $ids[3];
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->loadData();
 $items = $xmlSerializer->getItems();
 $num = count($items);
 $newItems = array();
 $found=false;
 $i=0;
 foreach($items as $ind=>$item)
 {
  if(($queryPos == $ind)&&($queryName != STRING_NULL))
  {
   $newItems[$i]["queryName"]=$queryName;
   $newItems[$i]["queryBody"]=$queryBody;
   $newItems[$i++]["dataSource"]=$isDataSource;
   $found=true;
  }
  elseif($queryPos != $ind)
   $newItems[$i++]=$item;
 }
 if((! $found)&&($queryName != STRING_NULL))
 {
  $newItems[$num]["queryName"]=$queryName;
  $newItems[$num]["queryBody"]=$queryBody;
  $newItems[$num]["dataSource"]=$isDataSource;
 }
 $xmlSerializer->setItems($newItems);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData();
 return true;  
}

static function getQueryPos(string $actApp,string $actQueryName):int
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)==0)
  return true;
 $sectionObj = $sectionsArray[0];
 $sectionArray = $sectionObj->getItem();
 $num = count($sectionArray);
 $queryPos=$num-1;
 for($i=1;$i<=$num-1;$i++)
 {
 	$defObj = $sectionArray[$i];
 //	$ifElseArray = $ifElseObj->getItem();
 //	$defObj = $ifElseArray[1];
 	$defArray = $defObj->getItem();
 	$functionCallObj = $defArray[0];
 	$functionCallArray = $functionCallObj->getItem();
 	$argObj = $functionCallArray[1];
 	$stringObj = $argObj->getItem();
 	$queryName = $stringObj->getItem();
 	if($queryName==$actQueryName)
 	{
 	 $queryPos = $i-1;
   break;
  }
 }
 return $queryPos;
}

static function getQueryNameInRepository(string $actApp,int $queryPos):string
{
 $appDir = $actApp;
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->loadData();
 $items = $xmlSerializer->getItems();
 $queryName = STRING_NULL;
 foreach($items as $ind=>$item)
 {
 	 if($ind==$queryPos)
   $queryName = $items[$ind]["queryName"];
 }    
 return $queryName;
}

static function getQueryFromRepository(string $actApp,array $actIds):array|bool
{
 $appDir = $actApp;
 $ids=$actIds;
 $queryName = $ids[0];
 $queryPos = $ids[1];
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->loadData();
 $items = $xmlSerializer->getItems();
 $retArray=array();
 $num = count($items);
 if($queryPos <= $num-1)
 {
  $queryBody = $items[$queryPos]["queryBody"];
  $retArray[0]=$queryName;
  $retArray[1]=$queryBody;
  $retArray[2]=$items[$queryPos]["dataSource"];
  return $retArray;
 }
 else
  return false;
}

static function getAllQueriesFromRepository(string $actApp):array
{
 $appDir = $actApp;
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->loadData();
 $items = $xmlSerializer->getItems();
 return $items;
}

static function getAllDataSourceQueries(string $actApp):array
{
 $appDir = $actApp;
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir( PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->loadData();
 $items = $xmlSerializer->getItems();
 $items2 = array();
 $i=0;
 foreach($items as $ind=>$val)
 {
 	if($items[$ind]["dataSource"]=="true")
 	$items2[$i++] = $items[$ind]["queryName"];
 }
 return $items2;
}

static function setAllQueriesInRepository(string $actApp,array $actIds):bool
{
 $appDir = $actApp;
 $appFileName = "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->setDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP);
 $xmlSerializer->setItems($actIds);
 $xmlSerializer->loadItems();
 $xmlSerializer->saveData();
 return true;
}

// Imposta  le queries definite nell'array $actIds nei files di configurazone.

static function setAllQueries(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)==0)
  return true;
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
   
 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);   
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(count($sectionsArray2)==0)
  return true;
 $sectionObj2 = $sectionsArray2[0];
 $sectionArray2 = $sectionObj2->getItem();

 $appFileName3 =  PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "queries_container_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX; 
 $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);    
 $xmlSerializer3->loadData();
 $allItems3 = $xmlSerializer3->getItems();
 $sectionsObj3 = $allItems3[0];
 $sectionsArray3 = $sectionsObj3->getItem();
 if(count($sectionsArray3)==0)
  return true;
 $sectionObj3 = $sectionsArray3[0];
 $sectionArray3 = $sectionObj3->getItem();
 
 $newSectionArray1 = array();
 $newSectionArray1[0] = $sectionArray1[0];
 $i=1;
 foreach($ids as $ind=>$id)
 {
 	$exprObj1 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . STRING_BACKSLASH . 
 	"QUERY" . CONST_SEP . strToUpper($id["queryName"]) . "'");
 	//$exprObj1 = new Expr_item("__NAMESPACE__ . '" . STRING_BACKSLASH . 
 	//"QUERY" . CONST_SEP . strToUpper($id["queryName"]) . "'");
 	$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj1);
 	$stringObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,ucfirst(strToLower($id["queryName"]))); 
 	$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj2);
 	$functionCallArray = array($argObj1,$argObj2);
 	$functionCallObj = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$functionCallArray);
 	$functionCallObj->setName("define");
 	$defArray = array($functionCallObj);
 	$defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray);
 	//$defObj = new Def_item($defArray);
 //	$ifElseArray = array();
 //	$exprObj = new Expr_item("! defined('" . "QUERY" . CONST_SEP . 
 //	strToUpper($id["queryName"]) . "')");
 //	$ifElseArray[0] = $exprObj;
 //	$ifElseArray[1] = $defObj;
 //	$ifElseObj = new If_else_item($ifElseArray);
 	$newSectionArray1[$i++]=$defObj;
 } 
 $sectionObj1->setItem($newSectionArray1);
 $xmlSerializer1->loadItems();
 $xmlSerializer1->saveData();

 $newSectionArray2 = array(); 
 $i=0;
 foreach($ids as $ind=>$id)
 {
 	 $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$id["queryBody"]);
   $stringObj3->setType(String_item::DOUBLE_QUOTED);
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'queryStr');
   $defItemsArray3 = array();
   $defItemsArray3[0] = $varObj3;
   $defItemsArray3[1] = $stringObj3;
   $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defItemsArray3);
   $newSectionArray2[($i)*3] = $defObj3;
   
   $codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   
   $stringObj5 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"Db_query");
   $stringObj5->setType(String_item::DOUBLE_QUOTED);
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj5);
   
   $constObj0 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj0);
   
   $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,'QUERY' . CONST_SEP . 
   strToUpper($id["queryName"])); 
   $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
   
   $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbStructTree');
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);

   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'ricSql2DefRules');
   $argObj6 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
   
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'ricSql2DefGrRules');
   $argObj7 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);   
   
   $methodCallArray1 = array();
   $methodCallArray1[0] = $codeObj1;
   $methodCallArray1[1] = $argObj2; 
   $methodCallArray1[2] = $argObj3;
   $methodCallArray1[3] = $argObj4;
   $methodCallArray1[4] = $argObj5; 
   $methodCallArray1[5] = $argObj6;
   $methodCallArray1[6] = $argObj7;
 
   $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $id["queryName"]);
 
   $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj->setParent(true);
   $methodCallObj->setName("create");
   $defArray9 = array($varObj5,$methodCallObj);
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9);
 
   $newSectionArray2[($i)*3+1] = $defObj4;

   $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $id["queryName"]); 	
   $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"queryStr");
   $argObj8 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj7);
   $itemsArray2 = array();
   $itemsArray2[0] = $varObj6;
   $itemsArray2[1] = $argObj8;
   $methodObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$itemsArray2);
   $methodObj1->setName('setQueryStr');
   $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodObj1));

   $newSectionArray2[($i)*3+2] = $defObj5;
   $i++;
 }
 $sectionObj2->setItem($newSectionArray2);
 $xmlSerializer2->loadItems();
 $xmlSerializer2->saveData();

 $newSectionArray3 = array();
 $newSectionArray3[0] = $sectionArray3[0];
 $i=0; 
 foreach($ids as $ind=>$id)
 {
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQuery' . $id["queryName"]); 	
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
   $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbQueriesContainer');
   $itemsArray2 = array();
   $itemsArray2[0] = $varObj5;
   $itemsArray2[1] = $argObj5;
   $methodObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$itemsArray2);
   $methodObj1->setName('add');
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodObj1));
   $newSectionArray3[$i+1] = $defObj4;
   $i++;
 }
 $sectionObj3->setItem($newSectionArray3);
 $xmlSerializer3->loadItems();
 $xmlSerializer3->saveData(); 
 return true;    
}

// Colleziono i parametri del database (es: Odbc,SqlSrv...) in base al nome del database.

static function getDbOpPars(string $actApp,string $actId):array
{
 $appDir = $actApp;
 $fileName = strToLower($actId . VAR_SEP . "const");
 $appFileName =  PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . $fileName .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items = array();
 if(count($sectionsArray)>0)
 {
 $sectionObj = $sectionsArray[0];
 $sectionArray = $sectionObj->getItem();
 $pars = array();
 $parsTypes = array();
 $i=0;
 foreach($sectionArray as $ind=>$defObj)
 {
 	$defArray = $defObj->getItem();
 	$functionCallObj = $defArray[0];
 	$functionCallArray = $functionCallObj->getItem();
  $argObj = $functionCallArray[0];
  $exprObj = $argObj->getItem();
  $par = $exprObj->getItem();
  /*$parItems = explode(VAR_SEP,$par);
  $num = count($parItems);
  $par = $parItems[1];
  for($j=2;$j<=$num-1;$j++)
   $par = $par . VAR_SEP . $parItems[$j]; */
  //$pars[$i] = ucFirst(strToLower(getDbOpParsExpr($par)));
  if(strpos($par,STRING_BACKSLASH)>0)
	$pars[$i] = getOriginalItemName(ucFirst(strToLower(getDbOpParsExpr($par))));
  else
   $pars[$i] = getOriginalItemName(ucFirst(strToLower($par)));
  $argObj = $functionCallArray[1];
  $stringObj = $argObj->getItem();  
  $parType = $stringObj->getName();
  $parsTypes[$i++]=$parType;  
 }
 unset($pars[$i-1]);
 unset($parsTypes[$i-1]);
 $items[0]=$pars;
 $items[1]=$parsTypes;
 } 
 return $items;
}

// Ritorna i parametri della connessione $actId

static function getConnection(string $actApp,int $actId):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if($actId <= count($sectionsArray)-1)
 {
  $sectionObj = $sectionsArray[$actId];
  $sectionArray = $sectionObj->getItem();
 }
 else
  $sectionArray = array();
 $items = array();
 $parsNames = array();
 $parsValues = array();
 $parsTypes = array();
 $dbName=STRING_NULL;
 $i=0;
 foreach($sectionArray as $ind=>$defObj)
 {
 	$defArray = $defObj->getItem();
 	if(isset($defArray[1]) && is_a($defArray[1],Classes_info::METHOD_CALL_ITEM_CLASS))
 	{
 	 $methodCallObj = $defArray[1];
 	 $methodCallArray = $methodCallObj->getItem();
 	 $argObj = $methodCallArray[1];
 	 $stringObj = $argObj->getItem();
 	 $dbOpClassName = $stringObj->getItem();
 	 $dbNameItems = explode(VAR_SEP,$dbOpClassName);
   $dbName = strToUpper($dbNameItems[0]);
 	}
 	elseif(isset($defArray[1]))
 	{
   $varObj = $defArray[0];
   $parName = $varObj->getItem(); 
   $parsNames[$i] = ucFirst(strToLower($parName));
   $stringObj = $defArray[1];
   $parValue = $stringObj->getItem();
   $parsValues[$i] = $parValue;
   $parType = $stringObj->getName();
   $parsTypes[$i++]=$parType;  
  }
 }
 $items[0]=$dbName;
 $items[1]=$parsNames;
 $items[2]=$parsValues;
 $items[3]=$parsTypes; 
 return $items;
}

// Ritorna il nome della connessione in posizione $actPos

static function getConnectionName(string $actApp,int $actPos):string
{
 $appDir = $actApp;
 $appFileName1 =  PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $connName = false;
 if(count($sectionsArray1)>0)
 {
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
 if($actPos<=count($sectionArray1)-2)
 {
  $defObj1 = $sectionArray1[$actPos+1];
  $defArray1 = $defObj1->getItem();
  $functionCallObj = $defArray1[0];
  $functionCallArray = $functionCallObj->getItem();
  $argObj = $functionCallArray[1];
  $stringObj = $argObj->getItem();
  $connName = $stringObj->getItem();
 } 
 }
 return $connName;
}

// Imposta la connessione in base ai paraetri passati tramite $actIds

static function setConnection(string $actApp,array $actIds):bool
{
 $ids = $actIds;
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $connectionName = trim(ucFirst(strToLower($ids["connectionName"])));
 $connectionPos = $ids["connectionPos"];
 $availableDb = trim(ucFirst(strToLower($ids["availableDb"])));
 unset($ids["connectionName"]);
 unset($ids["connectionPos"]);
 unset($ids["availableDb"]);
 
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)==0)
 {
	return true;
 }
 $sectionObj1 = $sectionsArray1[0];
 $defArray1 = $sectionObj1->getItem();
   
 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "connections_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;  
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);   
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
  
 $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "connections_container_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);     
 $xmlSerializer3->loadData();
 $allItems3 = $xmlSerializer3->getItems();
 $sectionsObj3 = $allItems3[0];
 $sectionsArray3 = $sectionsObj3->getItem();
 if(count($sectionsArray3)==0)
 {
	return true;
 }
 $sectionObj3 = $sectionsArray3[0];
 $defArray3 = $sectionObj3->getItem();     
   
 $num = count($defArray1);
 if($connectionName == STRING_NULL)
 {
  $num1 = count($defArray1);
  $newDefArray1 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $connectionPos+1)
    $newDefArray1[$j++]=$defArray1[$i];
  }
  $sectionObj1->setItem($newDefArray1);
  $xmlSerializer1->loadItems($allItems1);
  $xmlSerializer1->saveData();

  $num1 = $num1-1;
  $newSectionsArray2 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $connectionPos)
   {
    $newSectionsArray2[$j++]=$sectionsArray2[$i];
   }
  }
  $sectionsObj2->setItem($newSectionsArray2);
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData();

  $num1 = count($defArray1);
  $newDefArray3 = array();
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
   if($i != $connectionPos+1)
    $newDefArray3[$j++]=$defArray3[$i];
  }
  $sectionObj3->setItem($newDefArray3);
  $xmlSerializer3->loadItems($allItems3);
  $xmlSerializer3->saveData();              
 }
 else
 {
  if($connectionPos <= $num-2)
  {
   $defObj1 = $defArray1[$connectionPos+1];
   $functionArray1 = $defObj1->getItem();
   $functionObj1 = $functionArray1[0];
   $argArray1 = $functionObj1->getItem();
   $argObj1 = $argArray1[0];
   $exprObj1 = $argObj1->getItem();
   $exprObj1->setItem("__NAMESPACE__ . '" . STRING_BACKSLASH . 
   'CONNECTION' . CONST_SEP . strToUpper($connectionName) . "'");
   $argObj2 = $argArray1[1];
   $stringObj2 = $argObj2->getItem();     
   $stringObj2->setItem($connectionName);
   $sectionObj1->setItem($defArray1);
   $xmlSerializer1->loadItems($allItems1);
   $xmlSerializer1->saveData();
   
   $sectionObj2 = $sectionsArray2[$connectionPos]; 
   $newDefArray2 = array();
   $found = false;
   $i=0;
   foreach($ids as $idKey=>$idVal)
   {
   	$varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,strToLower($idKey));
   	$idVal =str_replace("\r\n",STRING_NULL,$idVal);
   	$idVal =str_replace("\r",STRING_NULL,$idVal);
    $idVal =str_replace("\n",STRING_NULL,$idVal);
    $stringObj6 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$idVal);
   	if(strToLower($idKey)=="connection_string")
   	{
   	 $found = true;
   	 $stringObj6->setName(STRING_AT);
   	}
   	$stringObj6->setType(String_item::DOUBLE_QUOTED);
   	$defArray6 = array($varObj6,$stringObj6);
   	$defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray6);
   	$newDefArray2[$i++] = $defObj6;
   }
   $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnection" . $connectionName);
   if($found)
    $varObj7->setName('Key');
    
   $constructorCallArray = array();
   $j=0;
   foreach($ids as $idKey=>$idVal)
   {
   	$varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,strToLower($idKey));
   	$argObj8 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj8);
   	$constructorCallArray[$j++] = $argObj8;
   } 
   
   $baseExpr1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   $baseVar1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$availableDb . VAR_SEP . "db_op");
   $baseArg1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$baseVar1);
   $baseVar2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $baseArg2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$baseVar2);
   
   $baseArray = array($baseExpr1,$baseArg1,$baseArg2);
   $methodCallArray = array_merge($baseArray,$constructorCallArray);  
   
   $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray);
   $methodCallObj->setParent(true);
   $methodCallObj->setName("create");
  // $constructorCallObj = Creator::create(Classes_info::CONSTRUCTOR_CALL_ITEM_CLASS,STRING_NULL,$constructorCallArray);   
  // $constructorCallObj->setName($availableDb . VAR_SEP . "db_op");
   $defArray9 = array($varObj7,$methodCallObj);
   $defObj7 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9);
   $newDefArray2[$i++] = $defObj7;
   
   $varObj9 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnection" . $connectionName);
   $constObj9 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"CONNECTION" . CONST_SEP . strToUpper($connectionName));
   $argObj9 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj9);
   $methodCallObj9 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj9,$argObj9));
   $methodCallObj9->setName("setName");
   $defObj8 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj9));
   $newDefArray2[$i] = $defObj8;
   
   $sectionObj2->setItem($newDefArray2);
   $sectionsObj2->setItem($sectionsArray2);
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();

   $defObj3 = $defArray3[$connectionPos + 1];
   $methodArray = $defObj3->getItem();
   $methodObj = $methodArray[0];
   $itemsArray1 = $methodObj->getItem();
   $argObj4 = $itemsArray1[1];
   $varObj1 = $argObj4->getItem();
   $varObj1->setItem('dbConnection' . $connectionName);
   $sectionObj3->setItem($defArray3);
   $xmlSerializer3->loadItems($allItems3);
   $xmlSerializer3->saveData();           
  }
  else
  {
   $exprObj1 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . STRING_BACKSLASH . 
   'CONNECTION' . CONST_SEP . strToUpper($connectionName) . "'");
   //$exprObj1->setType(String_item::SINGLE_QUOTED);
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj1);
   $stringObj2 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$connectionName);
   $stringObj2->setType(String_item::DOUBLE_QUOTED);
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj2);
   $argArray1 = array();
   $argArray1[0] = $argObj1;
   $argArray1[1] = $argObj2;    
   $functionObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,$argArray1);
   $functionObj1->setName("define");
   $functionArray1 = array();
   $functionArray1[0] = $functionObj1;
   $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$functionArray1);
   $defArray1[$connectionPos+1] = $defObj1;
   $sectionObj1->setItem($defArray1);    
   $xmlSerializer1->loadItems($allItems1);
   $xmlSerializer1->saveData();

   $sectionObj2 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());
   $sectionObj2->setName("Connection" . STRING_UNDERSCORE . $connectionPos); 
   $newDefArray2 = array();
   $found=false;
   $i=0;
   foreach($ids as $idKey=>$idVal)
   {
   	$varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,strToLower($idKey));
   	$idVal =str_replace("\r\n",STRING_NULL,$idVal);
   	$idVal =str_replace("\r",STRING_NULL,$idVal);
    $idVal =str_replace("\n",STRING_NULL,$idVal);
   	$stringObj6 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$idVal);
   	$stringObj6->setType(String_item::DOUBLE_QUOTED);
   	if(strToLower($idKey)=="connection_string")
   	{
   	 $found = true;
   	 $stringObj6->setName(STRING_AT);
   	}
   	$defArray6 = array($varObj6,$stringObj6);
   	$defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray6);
   	$newDefArray2[$i++] = $defObj6;
   }
   $varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnection" . $connectionName);
   if($found)
    $varObj7->setName("Key");
   $nextArray = array();
   $j=0;
   foreach($ids as $idKey=>$idVal)
   {
   	$varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,strToLower($idKey));
   	$argObj8 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj8);
   	$nextArray[$j++] = $argObj8;
   }
   
   $codeObj = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   $stringObj = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$availableDb . VAR_SEP . "db_op");
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj);
   $constObj = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj); 
   $baseArray = array($codeObj,$argObj1,$argObj2);
   $methodCallArray = array_merge($baseArray,$nextArray);  
   
   $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray);
   $methodCallObj->setParent("true");
   $methodCallObj->setName("create");
   
  // $constructorCallObj = Creator::create(Classes_info::CONSTRUCTOR_CALL_ITEM_CLASS,STRING_NULL,$constructorCallArray);    
  // $constructorCallObj->setName($availableDb . VAR_SEP . "db_op");
   $defArray9 = array($varObj7,$methodCallObj);
   $defObj7 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,$defArray9);
   $newDefArray2[$i++] = $defObj7;
   
   $varObj9 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnection" . $connectionName);
   $constObj9 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"CONNECTION" . CONST_SEP . strToUpper($connectionName));
   $argObj9 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj9);
   
   $methodCallObj9 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj9,$argObj9));
   $methodCallObj9->setName("setName");
   $defObj8 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj9));
   $newDefArray2[$i] = $defObj8;
   
   $sectionObj2->setItem($newDefArray2);
   $sectionsArray2[$connectionPos] = $sectionObj2;
   $sectionsObj2->setItem($sectionsArray2);
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();
      
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbConnection' . $connectionName);
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
   $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,'dbConnectionsContainer');
   $itemsArray2 = array();
   $itemsArray2[0] = $varObj5;
   $itemsArray2[1] = $argObj5;
   $methodObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$itemsArray2);
   $methodObj1->setName('add');
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodObj1));
   $defArray3[$connectionPos+1] = $defObj4;
   $sectionObj3->setItem($defArray3);
   $xmlSerializer3->loadItems($allItems3);
   $xmlSerializer3->saveData();    
  }
 }
 return true;
}

static function createQueriesStruct(string $actApp):bool
{
 $appDir = $actApp;
   
 $dbQueriesSourceFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "db_queries_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $dbQueriesFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "db_queries" . 
   FILE_NAME_ELEMENTS_SEP . "def" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $newSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL);
 $newSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
 $newSerializer->setFileName($dbQueriesSourceFileName);
 $newSerializer->loadData();
 $actItems = $newSerializer->getItems();
 $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$actItems[0]);
 $fileDumper->setFileName($dbQueriesFileName);
 $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
 $fileDumper->dump();
 return true;
}

static function createConnectionsStruct(string $actApp):bool
{
 $appDir = $actApp;
   
 $dbConnectionsSourceFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "db_connections_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $dbConnectionsFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "db_connections" . 
   FILE_NAME_ELEMENTS_SEP . "def" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $newSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL);
 $newSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
 $newSerializer->setFileName($dbConnectionsSourceFileName);
 $newSerializer->loadData();
 $actItems = $newSerializer->getItems();
 $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$actItems[0]);
 $fileDumper->setFileName($dbConnectionsFileName);
 $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
 $fileDumper->dump();
 return true;
}

// Ritorna una struttura con tutte le definizioni delle connessioni dell'applicazione $actApp

static function getAllConnections(string $actApp):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items = array();
 $i=0;
 foreach($sectionsArray as $sectionObj)
 {
  $pars = array();
  $dbName=STRING_NULL;
  $sectionArray=$sectionObj->getItem();
  foreach($sectionArray as $ind=>$defObj)
  {
 	 $defArray = $defObj->getItem();
 	 if(isset($defArray[0]) && is_a($defArray[0],Classes_info::METHOD_CALL_ITEM_CLASS))
 	 {
 	 	$methodCallObj = $defArray[0];
 	 	$methodCallArray = $methodCallObj->getItem();
 	 	$argObj = $methodCallArray[1];
 	 	$constObj = $argObj->getItem();
 	 	$connectionName = getOriginalItemName($constObj->getItem());
 	 	$pars["Connection_name"] = $connectionName;
 	 }
 	 if(isset($defArray[1]) && is_a($defArray[1],Classes_info::METHOD_CALL_ITEM_CLASS))
 	 {
 	  $methodCallObj = $defArray[1];
    $methodCallArray = $methodCallObj->getItem();
    $argObj = $methodCallArray[1];
    $stringObj = $argObj->getItem(); 	  
 	  $dbOpClassName = $stringObj->getItem();
 	  $dbNameItems = explode(VAR_SEP,$dbOpClassName);
    $dbName = strToUpper($dbNameItems[0]);
    $pars["Type"] = $dbName;
 	 }
 	 elseif(isset($defArray[1]))
 	 {
    $varObj = $defArray[0];
    $parName = $varObj->getItem(); 
    $parName = ucFirst(strToLower($parName));
    $stringObj = $defArray[1];
    $parValue = $stringObj->getItem();
    $pars[$parName]=$parValue; 
   }
  }
  //print_r($pars);
  $items[$i++] = $pars;
 }
 return $items;
}


// Copia i parametri della connessione in posizione $actId sul file di definizione del database 

static function copyConnectionToDbPars(string $actApp,int $actId):string|bool
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if($actId <= count($sectionsArray)-1)
 {
  $sectionObj = $sectionsArray[$actId];
  $sectionArray = $sectionObj->getItem();
 }
 else
  $sectionArray = array();
 $pars = array();
 $dbName=STRING_NULL;
 $i=0;
 foreach($sectionArray as $ind=>$defObj)
 {
 	$defArray = $defObj->getItem();
 	if(isset($defArray[1]) && is_a($defArray[1],Classes_info::METHOD_CALL_ITEM_CLASS))
 	{
 	 $methodCallObj = $defArray[1];
	 $methodCallArray = $methodCallObj->getItem();
	 $argObj1 = $methodCallArray[1];
	 $stringObj1 = $argObj1->getItem();
 	 $dbOpClassName = $stringObj1->getItem();
 	 $dbNameItems = explode(VAR_SEP,$dbOpClassName);
   $dbName = strToUpper($dbNameItems[0]);
 	}
 	elseif(isset($defArray[1]))
 	{
   $stringObj = $defArray[1];
   $parValue = $stringObj->getItem();
   $pars[$i++] = $parValue;
  }
 }

 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . strToLower($dbName) . VAR_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(count($sectionsArray2)==0)
 {
	return true;
 }
 $sectionObj2 = $sectionsArray2[0];
 $defArray2 = $sectionObj2->getItem();
 foreach($pars as $ind=>$val)
 { 
  $defObj2 = $defArray2[$ind];
  $functionArray2 = $defObj2->getItem();
  $functionObj2 = $functionArray2[0];
  $argArray2 = $functionObj2->getItem();
  $argObj2 = $argArray2[1];
  $stringObj2 = $argObj2->getItem();
  $stringObj2->setItem($val);
 }
 $xmlSerializer2->loadItems($allItems2);
 $xmlSerializer2->saveData();	
 return $dbName;
}

// Ritorna tutti gli alias della tabella in posizione $actId  

static function getAllAliases(string $actApp,string $actId):array
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items = array();
 if((count($sectionsArray)>0)&&(isset($sectionsArray[$actId])))
 {
  $sectionObj = $sectionsArray[$actId];
  $sectionArray = $sectionObj->getItem();
  $num = count($sectionArray);
  $k=0;
  for($j=1;$j<=$num-1;$j=$j+3)
  {
 	 $defObj1 = $sectionArray[$j+1];
 	 $defArray1 = $defObj1->getItem();
 	 $methodCallObj1 = $defArray1[0];
 	 $methodCallArray1 = $methodCallObj1->getItem();
 	 $argObj1 = $methodCallArray1[1];
 	 $constObj1 = $argObj1->getItem();
 	 $items[$k++] = getOriginalItemName($constObj1->getItem());
  }
 }
 return $items;
}

// Imposta tutti gli alias per la tabella di posizione $actIds[0]

static function setAllAliases(string $actApp,array $actIds):bool
{
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
    
 $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 
 $tablePos = $actIds[0];
 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items = array();
 
 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(isset($sectionsArray2[0]))
  $sectionObj2 = $sectionsArray2[0];
 else
  $sectionObj2 = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array());

 $tableName = self::getTableName($actApp,$tablePos);
 $sectionObj = $sectionsArray[$tablePos];
 $oldSectionObj = clone $sectionObj;
 $sectionPos = $tablePos;
 $sectionArray = array();
 $num = count($actIds);

 $constObj0 =  Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"TABELLA" . CONST_SEP . strToUpper($tableName)); 
 $argObj0 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj0);
 $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbStructTree");
 $methodCallObj0 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj0,$argObj0));
 $methodCallObj0->setName("getElementByAliasName");
 $varObj00 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
 $defObj0 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj00,$methodCallObj0));
 
 $sectionArray[] = $defObj0;
 
 for($i=1;$i<=$num-1;$i++)
 {
 	if(trim($actIds[$i]) != STRING_NULL)
 	{
 	 $aliasName = $actIds[$i];
 	 $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbNode");
 	 $cloneCallObj = Creator::create(getClassNameForCreate(Classes_info::CLONE_CALL_ITEM_CLASS),STRING_NULL,$varObj1);
 	 $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strToLower($aliasName)));
 	 $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj2,$cloneCallObj));
 	
 	 $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"ALIAS" . CONST_SEP . strToUpper($aliasName));
 	 $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
 	 $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strTolower($aliasName)));
 	 $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj3,$argObj1));
 	 $methodCallObj1->setName("setAliasName");
 	 $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj1));
 	
 	 $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbObj" . ucFirst(strTolower($aliasName)));
 	 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
 	 $varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbStructTree");
 	 $methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj5,$argObj2));
 	 $methodCallObj2->setName("add");
 	 $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj2));
 	
 	 $sectionArray[] = $defObj1;
 	 $sectionArray[] = $defObj2;
 	 $sectionArray[] = $defObj3;
  }
 }
 $sectionObj->setItem($sectionArray);
 $sectionsArray[$tablePos]=$sectionObj;
 $sectionsObj->setItem($sectionsArray); 
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData();

 $newSectionArray = array();
 foreach($sectionsArray as $sectionObj3)
 {
 	$sectionArray3 = $sectionObj3->getItem();
  $num = count($sectionArray3);
  for($j=1;$j<=$num-1;$j=$j+3)
  {
 	 $defObj3 = $sectionArray3[$j+1];
 	 $defArray3 = $defObj3->getItem();
 	 $methodCallObj3 = $defArray3[0];
 	 $methodCallArray3 = $methodCallObj3->getItem();
 	 $argObj3 = $methodCallArray3[1];
 	 $constObj3 = $argObj3->getItem();
 	 $aliasName = getOriginalItemName($constObj3->getItem());
 	 $stringObj4 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$aliasName);
 	 $stringObj4->setType(String_item::DOUBLE_QUOTED);
 	 $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj4);
 	 $exprObj3 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . STRING_BACKSLASH .  
 	 "ALIAS" . CONST_SEP . strToUpper($aliasName) . "'");
 	 //$stringObj3->setType(String_item::DOUBLE_QUOTED);
 	 $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj3);
 	 $functionCallObj3 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argObj3,$argObj4));
 	 $functionCallObj3->setName("define");
 	 $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($functionCallObj3));
 	 $newSectionArray[] = $defObj4;
  }
 } 
 
 $sectionObj2->setItem($newSectionArray);
 $sectionsArray2[0] = $sectionObj2;
 $sectionsObj2->setItem($sectionsArray2);
 $xmlSerializer2->loadItems($allItems2);
 $xmlSerializer2->saveData(); 
 
 return true;	
}

static function checkIfAliasExists(string $actApp,string $actAlias):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[0];
  $sectionArray = $sectionObj->getItem(); 
  foreach($sectionArray as $ind=>$defObj)
  {
 	 $defArray = $defObj->getItem();
 	 $functionCallObj = $defArray[0];
 	 $functionCallArray = $functionCallObj->getItem();  
   $argObj = $functionCallArray[1];
   $stringObj = $argObj->getItem();
   $itemStr = $stringObj->getItem();
   if($actAlias == $itemStr)
    return true;
  }
 } 
 return false; 
}

static function checkIfBindExists(string $actApp,string $actBind):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($sectionsArray)>0)
 {
  $sectionObj = $sectionsArray[0];
  $sectionArray = $sectionObj->getItem();
  foreach($sectionArray as $ind=>$defObj)
  {
 	 $defArray = $defObj->getItem();
// 	 $ifElseObj = $defArray[0];
// 	 $ifElseArray = $ifElseObj->getItem();
 	 $functionCallObj = $defArray[0];
 	 $functionCallArray = $functionCallObj->getItem();  
   $argObj = $functionCallArray[1];
   $stringObj = $argObj->getItem();
   $itemStr = $stringObj->getItem();
   if($actBind == $itemStr)
    return true;
  }
 } 
 return false; 

}

static function checkIfTableExists(string $actApp,string $actTable):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_const_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionObj = $allItems[0];
 $sectionArray = $sectionObj->getItem();
 
 //Patch per includere namespace 
 
 unset($sectionArray[0]);
 $sectionArray1 = $sectionArray;
 foreach($sectionArray1 as $ind=>$defObj)
 {
 	$defArray = $defObj->getItem();
 	$functionCallObj = $defArray[0];
 	$functionCallArray = $functionCallObj->getItem();  
  $argObj = $functionCallArray[1];
  $stringObj = $argObj->getItem();
  $itemStr = $stringObj->getItem();
  if($actTable == $itemStr)
   return true;
 } 
 return false; 
}

static function checkIfDataSourceQueryExists(string $actApp,string $actQuery):bool
{
 $appDir = $actApp;
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
  DIR_SEP . "queries_defines_def" .
  FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1); 
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)==0)
 {
	return false;
 }
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
 $num = count($sectionArray1);
 $res=false;
 for($i=1;$i<=$num-1;$i++)
 {
 	$defObj1 = $sectionArray1[$i];
 //	$ifElseArray1 = $ifElseObj1->getItem();
 //	$defObj1 = $ifElseArray1[1];
  $functionArray1 = $defObj1->getItem();
  $functionObj1 = $functionArray1[0];
  $argArray1 = $functionObj1->getItem();
  $argObj2 = $argArray1[1];
  $stringObj2 = $argObj2->getItem();    
  $queryName = $stringObj2->getItem();
  if($queryName==$actQuery)
  {
  	$res=true;
  	break;
  }
 }
 return $res;
}

static function checkIfConnectionExists(string $actApp,string $actConn):bool
{
  $conns = self::getAllConnections($actApp);
  foreach($conns as $ind=>$conn)
  {
  	if($actConn=$conn["Connection_name"])
  	 return true;
  }
  return false;
}

// Passo il nome della connessione ritorna il nome della tabella associata

static function getNodeConnectionName(string $actApp,string $actNodeName):string|bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  $defObj = $sectionArray[0];
 	$defArray = $defObj->getItem();
 	$varObj = $defArray[0];
 	$itemStr = $varObj->getItem();
 	$methodCallObj = $defArray[1];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem();
 	if($actNodeName==getOriginalItemName($constObj->getItem()))
 	{
 	 $defObj1 = $sectionArray[1];
 	 $defArray1 = $defObj1->getItem();
 	 $methodCallObj1 = $defArray1[1];	
 	 $methodCallArray1 = $methodCallObj1->getItem();
 	 $argObj1 = $methodCallArray1[1];
 	 $constObj1 = $argObj1->getItem(); 
 	 return getOriginalItemName($constObj1->getItem());	 
 	}
 }
 return false;
}

// Ritorna tutte le associazioni tabella - commessione contenute in tables_and_queries_binds_def

static function getBindsFromTablesAndQueriesDef(string $actApp):array
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items=array();
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$nodesArray = array();
 	
  $sectionArray = $sectionObj->getItem();
  $defObj = $sectionArray[0];
 	$defArray = $defObj->getItem();
 	$varObj = $defArray[0];
 	$itemStr = $varObj->getItem();
 	$methodCallObj = $defArray[1];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem();
 	$suffixArray = explode(CONST_SEP,$constObj->getItem());
 	$suffix=$suffixArray[0];
 	$nodeName = getOriginalItemName($constObj->getItem());
 	if($suffix=="TABELLA")
 	 $nodesArray["Type"]="Table"; 
 	elseif($suffix=="ALIAS")
 	 $nodesArray["Type"]="Alias";
 	else
 	 $nodesArray["Type"]="Query";  	 	
  $nodesArray["Tables_queries"] = $nodeName;
  $connName = self::getNodeConnectionName($actApp,$nodeName);
  $nodesArray["Connection_name"] = $connName;
  $items[$ind] = $nodesArray;
 }
 return $items;
}

// Ritorna tutti i binds della'pplicazione $actApp

static function getBindsDef(string $actApp):array
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items=array();
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$bindsArray = array();
 	
  $sectionArray = $sectionObj->getItem();
  $defObj = $sectionArray[0];
 	$defArray = $defObj->getItem();
 	$methodCallObj = $defArray[1];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem();
 	$nodeName = getOriginalItemName($constObj->getItem());
 	
  $defObj = $sectionArray[2];
 	$defArray = $defObj->getItem();
 	$methodCallObj = $defArray[0];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem();
 	$bindName = getOriginalItemName($constObj->getItem()); 
 	
 	if(count($sectionArray)==7)
   $defObj = $sectionArray[4];
  else
   $defObj = $sectionArray[3];
   
 	$defArray = $defObj->getItem();
 	$methodCallObj = $defArray[1];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem();
 	$connName = getOriginalItemName($constObj->getItem());	

 	$bindsArray["Bind_name"]=$bindName;  	 	
  $bindsArray["Node_name"] = $nodeName;
  $bindsArray["Connection_name"] = $connName;
  $items[$ind] = $bindsArray;
 }
 return $items;
}

// Ritorna il nome della tabella associata al bind di nome $actId

static function getBindNodeName(string $actApp,string $actId):string
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items=array();
 $nodeName =STRING_NULL;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  $defObj = $sectionArray[2];
 	$defArray = $defObj->getItem();
 	$methodCallObj = $defArray[0];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem(); 	
 	$bindName = getOriginalItemName($constObj->getItem());
 	if($bindName==$actId)
 	{
   $defObj = $sectionArray[0];
 	 $defArray = $defObj->getItem();
 	 $methodCallObj = $defArray[1];	
 	 $methodCallArray = $methodCallObj->getItem();
 	 $argObj = $methodCallArray[1];
 	 $constObj = $argObj->getItem();
 	 $nodeName = getOriginalItemName($constObj->getItem());
 	 break;
  }
 }
 return $nodeName; 
}

// Ritorna il nome della tipo di nodo associata al bind di nome $actId

static function getBindNodeType(string $actApp,string $actId):string
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items=array();
 $nodeType =STRING_NULL;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
  $sectionArray = $sectionObj->getItem();
  $defObj = $sectionArray[2];
 	$defArray = $defObj->getItem();
 	$methodCallObj = $defArray[0];	
 	$methodCallArray = $methodCallObj->getItem();
 	$argObj = $methodCallArray[1];
 	$constObj = $argObj->getItem(); 	
 	$bindName = getOriginalItemName($constObj->getItem());
 	if($bindName==$actId)
 	{
   $defObj = $sectionArray[0];
 	 $defArray = $defObj->getItem();
 	 $methodCallObj = $defArray[1];	
 	 $methodCallArray = $methodCallObj->getItem();
 	 $argObj = $methodCallArray[1];
 	 $constObj = $argObj->getItem();
 	 $constItems = explode(CONST_SEP,$constObj->getItem());
 	 $nodeType = $constItems[0];
 	 if($nodeType=='TABELLA')
 	  $nodeType = 'Table';
 	 elseif($nodeType=='QUERY')
 	  $nodeType = 'Query';
 	 elseif($nodeType=='ALIAS')
 	  $nodeType='Alias';
 	 break;
  }
 }
 return $nodeType; 
}



static function checkIfXmlModuleExists(string $actApp,string $actId):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . $actId;
 $res=false;
 if((! is_dir($appFileName)) && file_exists($appFileName))
  $res=true;
 return $res;  
}

static function checkIfJsonModuleExists(string $actApp,string $actId):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . JSON_DIR . 
    DIR_SEP . $actId;
 $res=false;
 if((! is_dir($appFileName)) && file_exists($appFileName))
  $res=true;
 return $res;  
}

static function getNodeType(string $actApp,string $actId):bool
{
 $bindExists = self::checkIfBindExists($actApp,$actId);
 $res=STRING_NULL;
 if($bindExists==true)
  $res='Bind';
 else
 {	
  $tableExists = self::checkIfTableExists($actApp,$actId);
  if($tableExists==true)
  {
   $res="Table";
  }
  else
  {
 	 $aliasExists = self::checkIfAliasExists($actApp,$actId);
 	 if($aliasExists==true)
 	  $res="Alias";
 	 else
 	 {
    $queryExists = self::checkIfDataSourceQueryExists($actApp,$actId);
    if($queryExists==true)
     $res="Query";
    else
    {
   	 $xmlExists = self::checkIfXmlModuleExists($actApp,$actId);
   	 if($xmlExists==true)
   	  $res="Xml";
   	 else
   	 {
   	  $jsonExists = self::checkIfJsonModuleExists($actApp,$actId);
   	  if($jsonExists==true)
   	   $res="Json";   		
   	 } 
    }
   }
  }
 }
 return $res;
}


// Imposta la tabella tables_and_queries_binds_def coi valori della struttura $actIds

static function setAllTablesAndQueriesBinds(string $actApp,array $actIds):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 if(count($actIds)==0)
 {
 	$sectionsArray = array();
 }
 foreach($actIds as $ind=>$bind)
 {
 	$node = $bind[0];
 	$type = $bind[1];
 	$conn = $bind[2];
 	if($type=="Table")
 	{
 		$varStr = "dbNode";
 		$constStr = "TABELLA" . CONST_SEP . strToUpper($node);
 		$methodCallName = "getElementByAliasName";
 		$varStr1 = "dbStructTree";
 	}
 	elseif($type=="Alias")
 	{
 		$varStr = "dbAlias";
 		$constStr = "ALIAS" . CONST_SEP . strToUpper($node);
 		$methodCallName = "getElementByAliasName";
 		$varStr1 = "dbStructTree";
 	}
 	else
 	{
 		$varStr = "dbQuery";
 		$constStr = "QUERY" . CONST_SEP . strToUpper($node);
 	  $methodCallName = "getQuery";
 	  $varStr1 = "dbQueriesContainer";		
 	}
 	$constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$constStr);
 	$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
 	$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr1);
 	$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj1,$argObj1));
 	$methodCallObj1->setName($methodCallName);
 	$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr);
 	$defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj2,$methodCallObj1));
 	
 	$connStr = "CONNECTION" . CONST_SEP . strToUpper($conn);
 	$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$connStr);
 	$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
 	$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnectionsContainer");
 	$methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj2,$argObj2));
 	$methodCallObj2->setName("getDbOp");
 	$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConn");
 	$defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj3,$methodCallObj2));
 	
 	$varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr);
 	$varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConn");
 	$argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj5);
 	$methodCallObj3 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj4,$argObj3));
 	//$methodCallObj3 = new Method_call_item(array($varObj4,$argObj3));
 	$methodCallObj3->setName("setDbOp");

  $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj3));
 	 
 	$sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array($defObj1,$defObj2,$defObj3));	
 	$sectionObj->setName("Bind" . STRING_UNDERSCORE . $ind);
 	$sectionsArray[$ind] = $sectionObj;
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 
 
 return true;	 
}


// Imposta tutti i binds della tabella binds_defines_def in base ai valori della struttura $actIds

static function setAllBinds(string $actApp,array $actIds):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer0 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer0->loadData();
 $allItems0 = $xmlSerializer0->getItems();
 $sectionsObj0 = $allItems0[0];
 $sectionsArray0 = $sectionsObj0->getItem();
 if(count($sectionsArray0)==0)
 {
 	$sectionObj0 = new Section_item(array());
 	$sectionsArray0[0] = $sectionObj0;
 }
 else
  $sectionObj0 = $sectionsArray0[0];
 if(count($actIds)==0)
 {
 	$sectionsArray0 = array();
 }
 $newSectionArray0 = array();
 foreach($actIds as $ind=>$bind)
 {
 	$bindName = $bind[0];	
 	$exprObj0 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . STRING_BACKSLASH . 
	"BINDING" . CONST_SEP . strToUpper($bindName) . "'");
	//$exprObj0->setType(String_item::SINGLE_QUOTED);
  $argObj0 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj0);
	$stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$bindName);
	$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
	$functionCallObj0 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argObj0,$argObj1));
	$functionCallObj0->setName("define");
	$defObj0 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($functionCallObj0));
	$newSectionArray0[] = $defObj0;
 }
 $sectionObj0->setItem($newSectionArray0);
 $sectionsObj0->setItem($sectionsArray0);
 $xmlSerializer0->loadItems($allItems0);
 $xmlSerializer0->saveData();
  
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 if(count($actIds)==0)
 {
 	$sectionsArray = array();
 }
 else 
  $sectionsArray = $sectionsObj->getItem();
 
 foreach($actIds as $ind=>$bind)
 {
 	$bindName = $bind[0];
 	$bindNode = $bind[1];
 	$bindConn = $bind[2];
  
  $type = self::getNodeType($actApp,$bindNode);
  
 	if($type=="Table")
 	{
 		$varStr = "dbNode";
 		$constStr = "TABELLA" . CONST_SEP . strToUpper($bindNode);
 		$methodCallName = "getElementByAliasName";
 		$varStr1 = "dbStructTree";
 	}
 	elseif($type=="Alias")
 	{
 		$varStr = "dbAlias";
 		$constStr = "ALIAS" . CONST_SEP . strToUpper($bindNode);
 		$methodCallName = "getElementByAliasName";
 		$varStr1 = "dbStructTree";
 	}
 	else
 	{
 		$varStr = "dbQuery";
 		$constStr = "QUERY" . CONST_SEP . strToUpper($bindNode);
 	  $methodCallName = "getQuery";
 	  $varStr1 = "dbQueriesContainer";		
 	}

  $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$constStr);
 	$argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
 	$varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr1);
 	$methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj1,$argObj1));
 	$methodCallObj1->setName($methodCallName);
 	$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr . $bindNode);
 	$defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj2,$methodCallObj1));
 	
 	$connStr = "CONNECTION" . CONST_SEP . strToUpper($bindConn);
 	$constObj2 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$connStr);
 	$argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj2);
 	$varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConnectionsContainer");
 	$methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj2,$argObj2));
 	$methodCallObj2->setName("getDbOp");
 	$varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConn");
 	$defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj3,$methodCallObj2));
 	
 	$bindStr = "BINDING" . CONST_SEP . strToUpper($bindName);
 	$constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$bindStr);
 	$argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj3);
 	$varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName);
 	$methodCallObj4 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj6,$argObj4));
 	if($varStr=="dbQuery")
 	 $methodCallObj4->setName("setNodeName");
 	else
 	 $methodCallObj4->setName("setAliasName");
 	$defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj4));
 	
 	if($varStr=="dbQuery")
 	{
 	 $bindStr = "BINDING" . CONST_SEP . strToUpper($bindName);
 	 $constObj3 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,$bindStr);
 	 $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj3);
 	 $varObj6 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName);
 	 $methodCallObj4 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj6,$argObj4));
 	 $methodCallObj4->setName("setAliasName");
 	 $defObj41 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj4));
 	}
 	else
 	{
 		$defObj41=null;
 	}

  $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName); 	
 	$varObj5 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbConn");
 	$argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj5);
 	$methodCallObj3 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj4,$argObj3));
 	$methodCallObj3->setName("setDbOp");
 	$defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj3));
 	
 	$varObj7 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName);
 	$varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr . $bindNode);
 	$cloneObj1 = Creator::create(getClassNameForCreate(Classes_info::CLONE_CALL_ITEM_CLASS),STRING_NULL,$varObj8);
 	$defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($varObj7,$cloneObj1));
 	
 	$varObj8 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varStr1);
 	$varObj9 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName);
 	$argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj9);
 	$methodCallObj5 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj8,$argObj5));
 	$methodCallObj5->setName("add");
 	$defObj6 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj5));
 	
 	if(! is_null($defObj41)) 
 	 $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array($defObj1,$defObj5,
 	 $defObj4,$defObj41,$defObj2,$defObj3,$defObj6));	
 	else
 	 $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array($defObj1,$defObj5,
 	 $defObj4,$defObj2,$defObj3,$defObj6));
 	  	 
 	$sectionObj->setName("Bind" . STRING_UNDERSCORE . $ind);
 	$sectionsArray[$ind] = $sectionObj;
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_container_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 //$xmlSerializer1 = new Xml_items_serializer($appFileName);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 if(count($sectionsArray1)==0)
 {
	return true;
 }
 $sectionObj1 = $sectionsArray1[0];
 $sectionArray1 = $sectionObj1->getItem();
  $newSectionArray = array($sectionArray1[0]);
 
 foreach($actIds as $ind=>$bind)
 {
 	$bindName = $bind[0]; 

  $varObj0 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBindsContainer");  
  $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,"dbBind" . $bindName);
  $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj1);
  $methodCallObj = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,array($varObj0,$argObj1));
  $methodCallObj->setName("add");
  $defObj = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($methodCallObj));
  $newSectionArray[] = $defObj;
 }
 $sectionObj1->setItem($newSectionArray);
 $sectionsArray1[0] = $sectionObj1;
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData();  
 return true;	 
}



static function createDbBinds(string $actApp):bool
{
 $appDir = $actApp;
   
 $dbBindsSourceFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . 
   XML_DIR . DIR_SEP .
   "db_binds_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 $dbBindsFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . strToLower($appDir) . VAR_SEP . "db_binds" . 
   FILE_NAME_ELEMENTS_SEP . "def" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE;
 $newSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL);
 $newSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
 $newSerializer->setFileName($dbBindsSourceFileName);
 $newSerializer->loadData();
 $actItems = $newSerializer->getItems();
 $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$actItems[0]);
 $fileDumper->setFileName($dbBindsFileName);
 $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
 $fileDumper->dump();
 return true;
}

// Aggiorna tutti le definizioni (nei vari files) dei binds coi valori attuali di tabelle e connessioni.

static function updateBinds(string $actApp):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $newSectionsArray = array();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$check1=false;
 	$check2=false;
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	$suffix = $items[0];
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	if($suffix=="TABELLA")
 	 $check1 = self::checkIfTableExists($actApp,$itemStr);
 	elseif($suffix=="ALIAS")
 	 $check1 = self::checkIfAliasExists($actApp,$itemStr);
 	else
 	 $check1 = self::checkIfDataSourceQueryExists($actApp,$itemStr);
 	$defObj2 = $sectionArray[1];
 	$defArray2 =$defObj2->getItem();
 	$methodCallObj2 = $defArray2[1];
 	$methodCallArray2 = $methodCallObj2->getItem();
 	$argObj2 = $methodCallArray2[1];
 	$constObj2 =$argObj2->getItem();
 	$connStr = getOriginalItemName($constObj2->getItem());
 	$check2 = self::checkIfConnectionExists($actApp,$connStr); 	
 	if(($check1==true)&&($check2==true))
 	 $newSectionsArray[$i++]=$sectionObj;
 }
 $sectionsObj->setItem($newSectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $newSectionsArray1 = array();
 $i=0;
 $indexArray = array();
 $j=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$check1=false;
 	$check2=false;
 	$sectionArray1 = $sectionObj1->getItem();
 	$defObj1 = $sectionArray1[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	$suffix = $items[0];
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	
 	if($suffix=="TABELLA")
 	 $check1 = self::checkIfTableExists($actApp,$itemStr);
 	elseif($suffix=="ALIAS")
 	 $check1 = self::checkIfAliasExists($actApp,$itemStr);
 	else
 	 $check1 = self::checkIfDataSourceQueryExists($actApp,$itemStr);
 	 
 	if(count($sectionArray1)==7)
   $defObj2 = $sectionArray1[4];
  else
   $defObj2 = $sectionArray1[3]; 	 

 	$defArray2 =$defObj2->getItem();
 	$methodCallObj2 = $defArray2[1];
 	$methodCallArray2 = $methodCallObj2->getItem();
 	$argObj2 = $methodCallArray2[1];
 	$constObj2 =$argObj2->getItem();
 	$connStr = getOriginalItemName($constObj2->getItem());
 	$check2 = self::checkIfConnectionExists($actApp,$connStr); 	
 	if(($check1==true)&&($check2==true))
 	{
 	 $indexArray[$j] = $i;
 	 $newSectionsArray1[$j++]=$sectionObj1;
  }
  $i++;
 }
 $sectionsObj1->setItem($newSectionsArray1);
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData(); 
 
  $appFileName2 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_container_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
 $xmlSerializer2->loadData();
 $allItems2 = $xmlSerializer2->getItems();
 $sectionsObj2 = $allItems2[0];
 $sectionsArray2 = $sectionsObj2->getItem();
 if(count($sectionsArray2)>0)
 {
  $sectionObj2 = $sectionsArray2[0];
  $sectionArray2 = $sectionObj2->getItem();
  $newSectionArray2 = array();
  $newSectionArray2[0] = $sectionArray2[0];
  unset($sectionArray2[0]);
  $i=1;
  $j=0;
  foreach($sectionArray2 as $ind=>$defObj2)
  {
 	if(in_array($j,$indexArray))
 	 $newSectionArray2[$i++]=$defObj2;
 	$j++;
  }
  $sectionObj2->setItem($newSectionArray2);
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData(); 
 }
 
  $appFileName3 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);
 $xmlSerializer3->loadData();
 $allItems3 = $xmlSerializer3->getItems();
 $sectionsObj3 = $allItems3[0];
 $sectionsArray3 = $sectionsObj3->getItem();
 if(count($sectionsArray3)>0)
 {
  $sectionObj3 = $sectionsArray3[0];
  $sectionArray3 = $sectionObj3->getItem();
  $newSectionArray3 = array();
  $i=0;
  $j=0;
  foreach($sectionArray3 as $ind=>$defObj3)
  {
 	if(in_array($j,$indexArray))
 	 $newSectionArray3[$i++] = $defObj3;
 	$j++;
  }
  $sectionObj3->setItem($newSectionArray3);
  $xmlSerializer3->loadItems($allItems3);
  $xmlSerializer3->saveData(); 
 }
 return true;	  
}

// Rinomina il nome delle connessioni nei binds.

static function renameConnectionsNamesInDbBinds(string $actApp,
string $actOldConnName,string $actConnName):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[1];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	if($itemStr==$actOldConnName)
 	 $constObj1->setItem("CONNECTION" . CONST_SEP . strToUpper($actConnName));
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();
 	
 	if(count($sectionArray1)==7)
   $defObj1 = $sectionArray1[4];
  else
   $defObj1 = $sectionArray1[3];
   	
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	if($itemStr==$actOldConnName)
 	 $constObj1->setItem("CONNECTION" . CONST_SEP . strToUpper($actConnName));
 }
 $sectionsObj1->setItem($sectionsArray1);
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData(); 
 
 return true;	  
}

// Ritorna tutti i nomi di tabella bindati in tables_and_queries_binds_def e binds_def, alla connessione di nome $actConnName.

static function getAllBoundItemsOfConnection(string $actApp,string $actConnName):array
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $items = array();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[1];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	if($itemStr == $actConnName)
  {
   $defObj2 = $sectionArray[0];
	 $defArray2 =$defObj2->getItem();
 	 $methodCallObj2 = $defArray2[1];
 	 $methodCallArray2 = $methodCallObj2->getItem();
 	 $argObj2 = $methodCallArray2[1];
 	 $constObj2 =$argObj2->getItem();
 	 $itemStr2 = getOriginalItemName($constObj2->getItem());
 	 if(! in_array($itemStr2,$items))
   $items[] = $itemStr2;
  }
 }

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();

 	if(count($sectionArray1)==7)
   $defObj3 = $sectionArray1[4];
  else
   $defObj3 = $sectionArray1[3];
   	
 	$defArray3 =$defObj3->getItem();
 	$methodCallObj3 = $defArray3[1];
 	$methodCallArray3 = $methodCallObj3->getItem();
 	$argObj3 = $methodCallArray3[1];
 	$constObj3 = $argObj3->getItem();
 	$itemStr = getOriginalItemName($constObj3->getItem());
 	if($itemStr == $actConnName)
  {
   $defObj4 = $sectionArray1[0];
	 $defArray4 = $defObj4->getItem();
 	 $methodCallObj4 = $defArray4[1];
 	 $methodCallArray4 = $methodCallObj4->getItem();
 	 $argObj4 = $methodCallArray4[1];
 	 $constObj4 = $argObj4->getItem();
 	 //print_r($constObj4);
 	 $itemStr2 = getOriginalItemName($constObj4->getItem());
   if(! in_array($itemStr2,$items))
    $items[] = $itemStr2;
   $defObj5 = $sectionArray1[2];
	 $defArray5 = $defObj5->getItem();
 	 $methodCallObj5 = $defArray5[0];
 	 $methodCallArray5 = $methodCallObj5->getItem();
 	 $argObj5 = $methodCallArray5[1];
 	 $constObj5 = $argObj5->getItem();
 	 $itemStr3 = getOriginalItemName($constObj5->getItem());
 	 $items[] = $itemStr3;   
  }
 } 
 return $items;	  
}


// Rinomina il nome di una query nei files di definizione dei binds.

static function renameQueriesNamesInDbBinds(string $actApp,
string $actOldQueryName,string $actQueryName):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;


 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="QUERY")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldQueryName)
 	  $constObj1->setItem("QUERY" . CONST_SEP . strToUpper($actQueryName));
  }
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();
 	$defObj1 = $sectionArray1[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="QUERY")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldQueryName)
 	  $constObj1->setItem("QUERY" . CONST_SEP . strToUpper($actQueryName));
  }
 }
 $sectionsObj1->setItem($sectionsArray1);
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData(); 
 
 return true;	  

}


// Rinomina il nome degli alias nella tabella tables_and_queries_binds_def e nella tabella binds_def.

static function renameAliasesNamesInDbBinds(string $actApp,
string $actOldAliasName,string $actAliasName):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="ALIAS")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldAliasName)
 	  $constObj1->setItem("ALIAS" . CONST_SEP . strToUpper($actAliasName));
  }
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 //$xmlSerializer1 = new Xml_items_serializer($appFileName1);
 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();
 	$defObj1 = $sectionArray1[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="ALIAS")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldAliasName)
 	  $constObj1->setItem("ALIAS" . CONST_SEP . strToUpper($actAliasName));
  }
 }
 $sectionsObj1->setItem($sectionsArray1);
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData(); 
 
 return true;	  

}

// Rinomina il nome di una tabella dei files tables_and_queries_binds_def e binds_def.

static function renameTableInDbBinds(string $actApp,string $actOldTable,string $actTable):bool
{
 $appFileName = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "tables_and_queries_binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $i=0;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$defObj1 = $sectionArray[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="TABELLA")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldTable)
 	  $constObj1->setItem("TABELLA" . CONST_SEP . strToUpper($actTable));
  }
 }
 $sectionsObj->setItem($sectionsArray);
 $xmlSerializer->loadItems($allItems);
 $xmlSerializer->saveData(); 

 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();
 	$defObj1 = $sectionArray1[0];
 	$defArray1 = $defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 = $argObj1->getItem();
 	$items = explode(CONST_SEP,$constObj1->getItem());
 	if($items[0]=="TABELLA")
 	{
 	 $itemStr = getOriginalItemName($constObj1->getItem());
 	 if($itemStr==$actOldTable)
 	  $constObj1->setItem("TABELLA" . CONST_SEP . strToUpper($actTable));
  }
 }
 $sectionsObj1->setItem($sectionsArray1);
 $xmlSerializer1->loadItems($allItems1);
 $xmlSerializer1->saveData(); 

 return true;	  
}


// Ritorna tutti i nomi dei binds associati al nodo (di databses) $actNodeName nel file binds_def

static function getAllBindsOfNode(string $actApp,string $actNodeName):array
{
 $appFileName1 = PREVIOUS_DIR . DIR_SEP . $actApp . DIR_SEP . XML_DIR . 
    DIR_SEP . "binds_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
 $xmlSerializer1->loadData();
 $allItems1 = $xmlSerializer1->getItems();
 $sectionsObj1 = $allItems1[0];
 $sectionsArray1 = $sectionsObj1->getItem();
 $i=0;
 $binds = array();
 foreach($sectionsArray1 as $ind=>$sectionObj1)
 {
 	$sectionArray1 = $sectionObj1->getItem();
 	$defObj1 = $sectionArray1[0];
 	$defArray1 =$defObj1->getItem();
 	$methodCallObj1 = $defArray1[1];
 	$methodCallArray1 = $methodCallObj1->getItem();
 	$argObj1 = $methodCallArray1[1];
 	$constObj1 =$argObj1->getItem();
 	$itemStr = getOriginalItemName($constObj1->getItem());
 	if($itemStr==$actNodeName)
 	{
 	 $defObj2 = $sectionArray1[2];
 	 $defArray2 = $defObj2->getItem();
 	 $methodCallObj2 = $defArray2[0];
 	 $methodCallArray2 = $methodCallObj2->getItem();
 	 $argObj2 = $methodCallArray2[1];
 	 $constObj2 = $argObj2->getItem();
 	 $bind = getOriginalItemName($constObj2->getItem());
 	 $binds[] = $bind;
  }
 }
 return $binds;
}

// Ritorna il nome della tabella associata all'alias fornito.

static function getTableFromAlias(string $actApp,string $actAlias):string
{
 $appDir = $actApp;
 $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "aliases_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

 $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
 $xmlSerializer->loadData();
 $allItems = $xmlSerializer->getItems();
 $sectionsObj = $allItems[0];
 $sectionsArray = $sectionsObj->getItem();
 $table = STRING_NULL;
 $found=false;
 foreach($sectionsArray as $ind=>$sectionObj)
 {
 	$sectionArray = $sectionObj->getItem();
 	$num = count($sectionArray);
 	for($i=1;$i<=$num-1;$i=$i+3)
 	{
 	 $defObj1 = $sectionArray[$i+1];
 	 $defArray1 = $defObj1->getItem();
 	 $methodCallObj1 = $defArray1[0];
 	 $methodCallArray1 = $methodCallObj1->getItem();
 	 $argObj1 = $methodCallArray1[1];
 	 $constObj1 = $argObj1->getItem();
 	 $alias = getOriginalItemName($constObj1->getItem());
 	 if($alias==$actAlias)
 	 {
 	  $defObj2 = $sectionArray[0];
 	  $defArray2 = $defObj2->getItem();
 	  $methodCallObj2 = $defArray2[1];
 	  $methodCallArray2 =$methodCallObj2->getItem();
 	  $argObj2 = $methodCallArray2[1];
 	  $constObj2 = $argObj2->getItem();
 	  $table = getOriginalItemName($constObj2->getItem());
 	  $found=true;
 	  break;
   }
  }
  if($found)
   break;
 }
 return $table;
}

// Controlla se un nodo, i suoi alias e i suoi binds sono utilizzati in qualche interfaccia.

static function checkIfNodeIsUsed(string $actAppName,string $actNodeName):bool
{
 $appDir = $actAppName;
 $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
 $files = scandir($appXmlDir);
 $nodeType = self::getNodeType($actAppName,$actNodeName);
 if($nodeType == "Table")
  $nodes = self::getAllAliases($actAppName,$actNodeName);

 if($nodeType != "Bind")
 {
  $binds = self::getAllBindsOfNode($actAppName,$actNodeName);
  foreach($binds as $bind)
 	 $nodes[] = $bind;
 }
 
 $nodes[] = $actNodeName;
 /*echo $actNodeName;
 echo $nodeType;
 print_r($nodes);*/
 $i=0;
 foreach($files as $ind=>$file)
 {
  $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
  $fileItemsNum = count($fileItems);
  if((! is_dir($file))&&($fileItemsNum==1) && (Xml_interface_file_analyzer::is_interface_file(
  PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $file)))
  {
   $objName = Xml_interface_file_analyzer::getScalarProperty(
   PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR . DIR_SEP . $file,"obj");
   foreach($nodes as $nodeName) 
   if($objName == $nodeName)
    return true;
  }
 }
 return false;
}
 

static function checkIfConnectionIsUsed(string $actAppName,string $actConnName):bool
{
 $appDir = $actAppName;
 $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
 $files = scandir($appXmlDir);
 $items = self::getAllBoundItemsOfConnection($actAppName,$actConnName);
 //print_r($items);
 $i=0;
 foreach($files as $ind=>$file)
 {
  $fileItems = explode(FILE_NAME_ELEMENTS_SEP,$file);
  $fileItemsNum = count($fileItems);
  if((! is_dir($file))&&($fileItemsNum==1) && (Xml_interface_file_analyzer::is_interface_file(
  PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . DIR_SEP . $file)))
  {
   $objName = Xml_interface_file_analyzer::getScalarProperty(
   PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . DIR_SEP . $file,"obj");
   foreach($items as $itemName) 
   if($objName == $itemName)
    return true;
  }
 }
 return false;
}

 static function replaceInAllInterfaces(string $actAppName,
 string $actOldStr,string $actNewStr):bool
 {
 	$appXmlDir = PREVIOUS_DIR . DIR_SEP . $actAppName . DIR_SEP . XML_DIR;
 	$files = scandir($appXmlDir);
 	$nFiles = array();
 	$res=STRING_NULL;
 	foreach($files as $file)
 	{
 	 $fileItems = explode(STRING_POINT,$file);
 		if(! is_dir($file) && (count($fileItems)==1))
 		 $nFiles[] = $file;
 	}
  foreach($nFiles as $fileName)
  {
   $res = replace_in_file_content($appXmlDir . DIR_SEP . $fileName,
   $actOldStr,$actNewStr); 
  }
 	return $res;
 }
 
  static function addAllJsonNodeDataSourceNames(string $actApp,array $actNames):array
  {
   $appDir = $actApp;
   $appJsonDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . JSON_DIR;

   $files = scandir($appJsonDir);
   $i=0;
   foreach($files as $ind=>$file)
   {
  	$filesItems = preg_split("/"  . STRING_UNDERSCORE . "/",$file);
  	$filesItemsNum = count($filesItems);
  	if(isset($filesItems[$filesItemsNum-1]))
  	{
  	 $fileItem1 = $filesItems[$filesItemsNum-1];
  	 if(isset($filesItems[$filesItemsNum-2]))
  	 {
  	  $fileItem2 = $filesItems[$filesItemsNum-2];
  	  $fileNames = explode(FILE_NAME_ELEMENTS_SEP,$fileItem2);
  	  $fileName = $fileNames[0];
  	  if(($fileItem1=="source.json")&&($fileItem2=="data"))
  	   $actNames[$file] = $file;
  	 }
  	}
   } 	
 	 return $actNames;
  }

  static function addAllXmlNodeDataSourceNames(string $actApp,array $actNames):array
  {
   $appDir = $actApp;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;

   $files = scandir($appXmlDir);
   $i=0;
   foreach($files as $ind=>$file)
   {
  	$filesItems = preg_split("/"  . STRING_UNDERSCORE . "/",$file);
  	$filesItemsNum = count($filesItems);
  	if(isset($filesItems[$filesItemsNum-1]))
  	{
  	 $fileItem1 = $filesItems[$filesItemsNum-1];
  	 if(isset($filesItems[$filesItemsNum-2]))
  	 {
  	  $fileItem2 = $filesItems[$filesItemsNum-2];
  	  $fileNames = explode(FILE_NAME_ELEMENTS_SEP,$file);
  	  $fileName = $fileNames[0];
  	  if(($fileItem1=="source.xml")&&($fileItem2=="data"))
  	   $actNames[$file] = $file;
  	 }
  	}
   } 	
 	 return $actNames;
  }

 
 static function getAllNodes(string $actApp):array
 {
 	 $app = $actApp;
 	 $items = array();
   $nodes = array();
   $nodes[] = STRING_NULL;
   $i=1;   
   $binds = self::getBindsDef($app);
   foreach($binds as $bind)
   {
   	$nodes[$i++] = $bind["Bind_name"];
   }   
   $tables = self::getDbObjsDefProps($app);
   foreach($tables as $ind=>$table)
   {
   	$nodes[$i++] = $table;
   	$tablePos = self::getTablePos($app,$table);
   	$aliases = self::getAllAliases($app,$tablePos);
   	foreach($aliases as $alias)
   	{
   		$nodes[$i++] = $alias;
   	}
   } 
   
   $queries = self::getAllDataSourceQueries($app);
   foreach($queries as $ind=>$query)
   {
   	$nodes[$i++] = $query;
   }
   
   $nodes = self::addAllXmlNodeDataSourceNames($app,$nodes);
   $nodes = self::addAllJsonNodeDataSourceNames($app,$nodes);
   
 	 return $nodes; 		
 }

// Ritorna tutte le operazioni ajax  per l'applicazione data da $actAppDir
 
 static function getAllAjaxOps(string $actAppDir):array|bool
 {
  $appDir = $actAppDir;
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];
  $sectionsArray = $sectionsObj->getItem();
  $ajaxOps = array();
 if(count($sectionsArray)==0)
 {
	return true;
 }
  $sectionObj1 = $sectionsArray[0];
  $sectionArray = $sectionObj1->getItem();
  //$ifElseObj = $sectionArray[1];
  //$ifElseArray = $ifElseObj->getItem();
  $blockDefObj = $sectionArray[1];
  $blockDefArray = $blockDefObj->getItem();
  $i=0;
  foreach($blockDefArray as $ind=>$defObj)
  {
   $defArray = $defObj->getItem();
   $functionCallObj = $defArray[0];
   $functionCallArray1 = $functionCallObj->getItem();
   $argObj1 = $functionCallArray1[1];
   $stringObj1 = $argObj1->getItem();
   $stringObj1->setType(String_item::NO_QUOTED);
   $className = $stringObj1->toString();
   $ajaxOps[$i++] = $className;
  }
  
  return $ajaxOps;
 }
 
 // Ritorna tutte le operazioni ajax abilitate json.

 static function getAllJsonAbilities(string $actAppDir):array|bool
 {
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_set_json_enabled_flags_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);	
  $xmlSerializer1->loadData();
  $allItems1 = $xmlSerializer1->getItems();
  $sectionsObj1 = $allItems1[0];
  $sectionsArray1 = $sectionsObj1->getItem();
  $jsonAb = array();
  if(count($sectionsArray1)==0)
  {
	return true;
  }
  $sectionObj1 = $sectionsArray1[0];
  $sectionArray1 = $sectionObj1->getItem();
  $i=0;
  foreach($sectionArray1 as $ind=>$defObj1)
  {
   $defArray1 = $defObj1->getItem();
   $methodCallObj1 = $defArray1[0];
   $methodCallArray1 = $methodCallObj1->getItem();
   $argObj1 = $methodCallArray1[1];
   $stringObj1 = $argObj1->getItem();
   $jsonAb[$i++] = (($stringObj1->getItem()=='true')?'checked':STRING_NULL);
  }
  return $jsonAb;
 }

 // Accede all'array $_POST per impostare tutte operazioni ajax nei vari files di configurazione
 
 static function setAllAjaxOps(array $actIds,string $actAppDir):bool
 {
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_generate_instances_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
  $xmlSerializer1->loadData();
  $allItems1 = $xmlSerializer1->getItems();
  $sectionsObj1 = $allItems1[0];
  $sectionsArray1 = $sectionsObj1->getItem();
  if(count($sectionsArray1)==0)
  {
	return true;
  }
  $sectionObj1 = $sectionsArray1[0];
  $sectionArray1 = array();
  
  $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_add_instances_to_container_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);	
  $xmlSerializer2->loadData();
  $allItems2 = $xmlSerializer2->getItems();
  $sectionsObj2 = $allItems2[0];
  $sectionsArray2 = $sectionsObj2->getItem();
  if(count($sectionsArray2)==0)
  {
	return true;
  }
  $sectionObj2 = $sectionsArray2[0];
  $sectionArray2 = array();  
  
  $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_set_json_enabled_flags_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3);	
  $xmlSerializer3->loadData();
  $allItems3 = $xmlSerializer3->getItems();
  $sectionsObj3 = $allItems3[0];
  $sectionsArray3 = $sectionsObj3->getItem();
  if(count($sectionsArray3)==0)
  {
	return true;
  }
  $sectionObj3 = $sectionsArray3[0];
  $sectionArray3 = array(); 
  
  $appFileName4 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer4 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName4);	
  $xmlSerializer4->loadData();
  $allItems4 = $xmlSerializer4->getItems();
  $sectionsObj4 = $allItems4[0];
  $sectionsArray4 = $sectionsObj4->getItem();
  if(count($sectionsArray4)==0)
  {
	return true;
  }
  $sectionObj4 = $sectionsArray4[0];
  $blockDefArray = array();
  $blockDefObj = Creator::create(getClassNameForCreate(Classes_info::BLOCK_DEF_ITEM_CLASS),STRING_NULL,array());
  $blockDefObj->setBrackets(true);
  $namespaceObj = Creator::create(getClassNameForCreate(Classes_info::NAMESPACE_ITEM_CLASS),STRING_NULL,$appDir . STRING_BACKSLASH . FW_DIR);
  $defObj5 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array($namespaceObj));

  $ids = $_POST;
  $num = count($ids); 
  $num1 = $num / 2 ;
  
  $j=0;
  for($i=0;$i<=$num1-1;$i++)
  {
  	$id = $ids["ajaxOp" . STRING_UNDERSCORE . (string)$i];
  	$isJE = $ids["isJsonEnabledStr" . STRING_UNDERSCORE . (string)$i];

  	 $className = "AjaxOp" . ucFirst($id);
  	 $varName = "ajaxOp" . ucFirst($id);
  	 $ajaxOpArrayName = strUppercaseSplit($className);
  	 $ajaxOpArraySuffix = join(CONST_SEP,$ajaxOpArrayName);
  	 $ajaxOpConstName = strToUpper($ajaxOpArraySuffix);
  	 $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
  	 //$defArray1 = array();
  	 
  	 $codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
  	 $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$className);
  	 $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
  	 $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
  	 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
  	 $methodCallArray1 = array($codeObj1,$argObj1,$argObj2);
  	 $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
  	 $methodCallObj1->setParent(true);
  	 $methodCallObj1->setName("create");
  	  	 
  	 /*$constructorCallObj1 = Creator::create(Classes_info::CONSTRUCTOR_CALL_ITEM_CLASS,STRING_NULL,array());
  	 $constructorCallObj1->setName($className);
  	 $constructorCallArray1 = array();
  	 $constructorCallObj1->setItem($constructorCallArray1);*/
  	 $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
  	 $defObj1->setItem(array($varObj1,$methodCallObj1));
  	 
  	 $sectionArray1[$j]=$defObj1;
  	
  	 $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
  	 $varAjaxOps = "ajaxOps";
  	 $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varAjaxOps);
  	 $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
  	 $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
  	 $argObj3 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj3);
  	 $methodCallArray1 = array($argObj2,$argObj3);
  	 $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
  	 $methodCallObj1->setName("add");
  	 $defObj2->setItem(array($methodCallObj1));
  	 $sectionArray2[$j]=$defObj2;
  	
  	 $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array()); 
  	 $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
  	 $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
  	 $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,(string)$isJE);
  	 $stringObj1->setType(String_item::NO_QUOTED);
  	 $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
  	 $methodCallArray2 = array($argObj4,$argObj5);
  	 $methodCallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray2);
  	 $methodCallObj2->setName("setIsJsonEnabled");
  	 $defObj3->setItem(array($methodCallObj2));
  	 $sectionArray3[$j] = $defObj3;
  	 
  	 $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
  	 $exprObj2 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . 
  	 STRING_BACKSLASH . $ajaxOpConstName . "'");
  	 $argObj6 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj2);
  	 $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,lcFirst($id));
  	 $argObj7 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj3);
  	 $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argObj6,$argObj7));
     $defObj4->setItem(array($functionCallObj1));
     $functionCallObj1->setName("define");
     $blockDefArray[] = $defObj4;
     
     $j++;    
  } 
  
  $sectionObj1->setItem($sectionArray1);
  $xmlSerializer1->loadItems($allItems1);
  $xmlSerializer1->saveData(); 
  $sectionObj2->setItem($sectionArray2);
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData();
  $sectionObj3->setItem($sectionArray3);
  $xmlSerializer3->loadItems($allItems3);
  $xmlSerializer3->saveData(); 
  
  $blockDefObj->setItem($blockDefArray);
      
  $sectionArray4[] = $defObj5;   
  $sectionArray4[] = $blockDefObj;
  
  $sectionObj4->setItem($sectionArray4);
  $xmlSerializer4->loadItems($allItems4);
  $xmlSerializer4->saveData(); 
  return true; 
 }
 
 // Ritorna un'array con tutte le classi ajax, contenute nel file ajaxOps_class.xml
 
 static function getAllAjaxClasses(string $actAppDir):array
 {
 	$appDir = $actAppDir;
  $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_class" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);	
  $xmlSerializer->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . AJAXOPS_DIR);
  $xmlSerializer->setResolveRef(false);
  $xmlSerializer->loadData();
  $allItems = $xmlSerializer->getItems();
  $sectionsObj = $allItems[0];
  $sectionsArray = $sectionsObj->getItem();
  $ajaxClasses = array();
  if(isset($sectionsArray[1]))
  {
  $sectionObj1 = $sectionsArray[1];
  $sectionArray = $sectionObj1->getItem();
  $ajaxClasses = array();
  $i=0;
  foreach($sectionArray as $ind=>$refObj)
  {
   $refName = $refObj->toString();
   $refName = substr($refName,6,strlen($refName)-6);
   $ajaxClasses[$i++] = $refName;
  }
  }
  return $ajaxClasses;
 }
 
 
 
 static function createAjaxOpClassFile(string $actAjaxOpClass,string $actAppDir):void
 {
 	$ajaxOpClass = ucFirst($actAjaxOpClass);
 	$ajaxOpClassSep = separateStringItems($ajaxOpClass);
 	$appFileName1 = PREVIOUS_DIR . DIR_SEP . $actAppDir . DIR_SEP . AJAXOPS_DIR . 
    DIR_SEP . "ajaxOp" . $ajaxOpClass . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $ajaxOpClassCode = "class " . "AjaxOp" . $ajaxOpClass . " extends AjaxOp" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "{" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "function " . "__construct" . "()" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "{" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "parent::__construct(AJAX_OP_" . 
  strToUpper(substr($ajaxOpClassSep,1,strlen($ajaxOpClassSep)-1)) . ");" . PHP_EOL; 
  $ajaxOpClassCode = $ajaxOpClassCode  . "}" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "function exec_1(\$actId)" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "{" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "}" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . "}" . PHP_EOL;
  $ajaxOpClassCode = $ajaxOpClassCode  . PHP_EOL;	
  $codeObj = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,$ajaxOpClassCode);
  $sectionObj = Creator::create(getClassNameForCreate(Classes_info::SECTION_ITEM_CLASS),STRING_NULL,array($codeObj));
  $allItemsObj = array($sectionObj);
  $xmlItemsSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
  $xmlItemsSerializer->setForceCData(true);
  $xmlItemsSerializer->loadItems($allItemsObj);
  $xmlItemsSerializer->saveData();
 }

 
 static function setAllAjaxOpsClasses(array $actIds,string $actAppDir):bool
 {
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_class" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $appFileDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . AJAXOPS_DIR; 
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1); 
  $xmlSerializer1->setResolveRef(false);
  $xmlSerializer1->setAppDir($appFileDir);
  $xmlSerializer1->loadData();
  $allItems1 = $xmlSerializer1->getItems();
  $sectionsObj1 = $allItems1[0];
  $sectionsArray1 = $sectionsObj1->getItem();
  if( ! isset($sectionsArray1[1]))
  {
	return true;
  }
  $sectionObj1 = $sectionsArray1[1];
  $sectionArray1 = $sectionObj1->getItem();  
  $sectionArray = array();
  
  unset($actIds[count($actIds)-1]);

  foreach($sectionArray1 as $refObj)
  {
  	$found = false;
  	$refItem = trim($refObj->getItem());
  	foreach($actIds as $ajaxOpsClass)
  	{
  		if($refItem == "ajaxOp" . ucFirst($ajaxOpsClass))
  		{
  			$found = true;
  			break;
  		}
  	}
  	if($found)
  	{
  	 $refObj1 = Creator::create(getClassNameForCreate(Classes_info::REF_ITEM_CLASS),STRING_NULL,"ajaxOp" . ucFirst($ajaxOpsClass));
  	 $sectionArray[] = $refObj1;
  	}
  	else
  	{
  	 unlink(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . AJAXOPS_DIR . 
     DIR_SEP . $refItem .
     FILE_NAME_ELEMENTS_SEP . XML_SUFFIX);
    }
   }
  
  foreach($actIds as $ajaxOpsClass)
  {
  	$found = false;
  	foreach($sectionArray as $refObj)
  	{
  		$refItem = $refObj->getItem();
  		if($refItem=="ajaxOp" . ucFirst($ajaxOpsClass))
  		{
  			$found=true;
  			break;
  		}  		
  	}
  	if(! $found)
  	{
  		$refObj = Creator::create(getClassNameForCreate(Classes_info::REF_ITEM_CLASS),STRING_NULL,"ajaxOp" . ucFirst($ajaxOpsClass));
  		self::createAjaxOpClassFile($ajaxOpsClass,$actAppDir);
  		$sectionArray[] = $refObj;
  	}
  }

  $sectionObj1->setItem($sectionArray);
  $xmlSerializer1->loadItems($allItems1);
  $xmlSerializer1->saveData(); 
  return true; 
 }

 static function addAjaxOps(array $actIds,string $actAppDir):bool
 {  
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_generate_instances_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1); 
  $xmlSerializer1->loadData();
  $allItems1 = $xmlSerializer1->getItems();
  $sectionsObj1 = $allItems1[0];
  $sectionsArray1 = $sectionsObj1->getItem();
  if(count($sectionsArray1)==0)
	 return true;
  $sectionObj1 = $sectionsArray1[0];
  $sectionArray1 = $sectionObj1->getItem();
  
  $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_add_instances_to_container_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2); 	
  $xmlSerializer2->loadData();
  $allItems2 = $xmlSerializer2->getItems();
  $sectionsObj2 = $allItems2[0];
  $sectionsArray2 = $sectionsObj2->getItem();
  if(count($sectionsArray2)==0)
	 return true;
  $sectionObj2 = $sectionsArray2[0];
  $sectionArray2 = $sectionObj2->getItem();  
  
  $appFileName3 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_set_json_enabled_flags_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer3 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName3); 	
  $xmlSerializer3->loadData();
  $allItems3 = $xmlSerializer3->getItems();
  $sectionsObj3 = $allItems3[0];
  $sectionsArray3 = $sectionsObj3->getItem();
  if(count($sectionsArray3)==0)
	 return true;
  $sectionObj3 = $sectionsArray3[0];
  $sectionArray3 = $sectionObj3->getItem(); 
  
  $appFileName4 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer4 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName4); 	
  $xmlSerializer4->loadData();
  $allItems4 = $xmlSerializer4->getItems();
  $sectionsObj4 = $allItems4[0];
  $sectionsArray4 = $sectionsObj4->getItem();
  if(count($sectionsArray4)==0)
	 return true;
  $sectionObj4 = $sectionsArray4[0];
  $sectionArray4 = $sectionObj4->getItem(); 
  
  $addingOps = array();
  foreach($actIds as $op)
  {
   $found = false;
   $op = ucFirst(strToLower($op));
   foreach($sectionArray4 as $ind=>$defObj)
   {
  	$defArray = $defObj->getItem();
  	$functionObj = $defArray[0];
  	$functionArray = $functionObj->getItem();
  	$argObj = $functionArray[1];
  	$stringObj = $argObj->getItem();
  	$itemStr = ucFirst(strToLower($stringObj->getItem()));
  	if($op==$itemStr)
  	{
  	 $found=true;
     break;
    }
   }
   if(! $found)
   {
    $addingOps[] = $op;
   }
  }
  
  foreach($addingOps as $ind=>$op)
  {
   $className = "AjaxOp" . $op;
   $varName = "ajaxOp" . $op;
   $ajaxOpArrayName = strUppercaseSplit($className);
   $ajaxOpArraySuffix = join(CONST_SEP,$ajaxOpArrayName);
   $ajaxOpConstName = strToUpper($ajaxOpArraySuffix);
   $defObj1 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
   $defArray1 = array();
   
   $codeObj1 = Creator::create(getClassNameForCreate(Classes_info::CODE_ITEM_CLASS),STRING_NULL,"Creator");
   $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$className);
   $argObj1 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
   $constObj1 = Creator::create(getClassNameForCreate(Classes_info::CONST_ITEM_CLASS),STRING_NULL,"STRING_NULL");
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$constObj1);
   $methodCallArray1 = array($codeObj1,$argObj1,$argObj2);
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj1->setParent(true);
   $methodCallObj1->setName("create");   
   
   /*$constructorCallObj1 = Creator::create(Classes_info::CONSTRUCTOR_CALL_ITEM_CLASS,STRING_NULL,array());
   $constructorCallObj1->setName($className);
   $constructorCallArray1 = array();
   $constructorCallObj1->setItem($constructorCallArray1);*/
   $varObj1 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
   $defObj1->setItem(array($varObj1,$methodCallObj1));
   $sectionArray1[]=$defObj1;
  	
   $defObj2 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
   $varAjaxOps = "ajaxOps";
   $varObj2 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varAjaxOps);
   $argObj2 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj2);
   $varObj3 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
   $argObj = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$argObj3);
   $methodCallArray1 = array($argObj2,$argObj3);
   $methodCallObj1 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray1);
   $methodCallObj1->setName("add");
   $defObj2->setItem(array($methodCallObj1));
   $sectionArray2[]=$defObj2;
  	
   $defObj3 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());
   $varObj4 = Creator::create(getClassNameForCreate(Classes_info::VAR_ITEM_CLASS),STRING_NULL,$varName);
   $argObj4 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$varObj4);
   $stringObj1 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,"false");
   $stringObj1->setType(String_item::NO_QUOTED);
   $argObj5 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj1);
   $methodCallArray2 = array($argObj4,$argObj5);
   $methodcallObj2 = Creator::create(getClassNameForCreate(Classes_info::METHOD_CALL_ITEM_CLASS),STRING_NULL,$methodCallArray2);
   $methodCallObj2->setName("setIsJsonEnabled");
   $defObj3->setItem(array($methodCallObj2));
   $sectionArray3[] = $defObj3;
  	
   $defObj4 = Creator::create(getClassNameForCreate(Classes_info::DEF_ITEM_CLASS),STRING_NULL,array());	 
   $exprObj2 = Creator::create(getClassNameForCreate(Classes_info::EXPR_ITEM_CLASS),STRING_NULL,"__NAMESPACE__ . '" . 
  	 STRING_BACKSPACE . $ajaxOpConstName . "'");
   $argObj6 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$exprObj2);
   $stringObj3 = Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,$stringObj3);
   $argObj7 = Creator::create(getClassNameForCreate(Classes_info::ARG_ITEM_CLASS),STRING_NULL,$stringObj3);
   $functionCallObj1 = Creator::create(getClassNameForCreate(Classes_info::FUNCTION_CALL_ITEM_CLASS),STRING_NULL,array($argObj6,$argObj7));
   $functionCallObj1->setName("define");	 
   $defObj4->setItem(array($functionCallObj1));
   $sectionArray4[] = $defObj4;
  } 
  $sectionObj1->setItem($sectionArray1);
  $xmlSerializer1->loadItems($allItems1);
  $xmlSerializer1->saveData(); 
  $sectionObj2->setItem($sectionArray2);
  $xmlSerializer2->loadItems($allItems2);
  $xmlSerializer2->saveData();
  $sectionObj3->setItem($sectionArray3);
  $xmlSerializer3->loadItems($allItems3);
  $xmlSerializer3->saveData(); 
  $sectionObj4->setItem($sectionArray4);
  $xmlSerializer4->loadItems($allItems4);
  $xmlSerializer4->saveData(); 
  return true; 

 }
 
 static function dumpAjaxOpsConstsFile(string $actAppDir):bool
 {
   $appDir = $actAppDir;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);   
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $xmlSerializer->loadItems($allItems);
   $xmlSerializer->saveData();
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR .
   DIR_SEP . strToLower($appDir) . VAR_SEP . "ajaxOps" .  FILE_NAME_ELEMENTS_SEP . 
   "const" . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump(); 
   return true;
 }
 
 static function generateAjaxOpsConfigurationFiles(string $actAppDir):bool
 {
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajax_handler_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
  $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
  $xmlSerializer1->loadData();
  $allItems = $xmlSerializer1->getItems();
  $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
  $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . "ajax_handler" .  FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
  $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
  $fileDumper->dump();
  
  $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;	
  $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2);
  $xmlSerializer2->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
  $xmlSerializer2->loadData();
  $allItems = $xmlSerializer2->getItems();
  $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
  $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR .
   DIR_SEP .  strToLower($appDir) . VAR_SEP . "ajaxOps" .  FILE_NAME_ELEMENTS_SEP . "const" . 
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
  $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
  $fileDumper->dump();

  return true;
 }
 
 static function generateAjaxOpsClassesFiles(string $actAppDir):bool
 {
 	$appDir = $actAppDir;
  $appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "ajaxOps" . VAR_SEP . "class" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
  $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);	
  $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . AJAXOPS_DIR);
  $xmlSerializer1->loadData();
  $allItems = $xmlSerializer1->getItems();
  $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
  $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FW_DIR .
   DIR_SEP . ucFirst($appDir) . VAR_SEP . "ajaxOps" . FILE_NAME_ELEMENTS_SEP . "class" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
  $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
  $fileDumper->dump();
  
  return true;  
 }
 
 static function deleteRelationsDefs(string $actAppDir,array $actIds):void
 {
	$appDir = $actAppDir;
	$ids = $actIds;
	$appFileName1 = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR .
	DIR_SEP . "relations_definition_def" . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
	$xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName1);
	$xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR);
	$xmlSerializer1->loadData();
	$allItems = $xmlSerializer1->getItems();
    $sectionsObj1 = $allItems[0];
    $sectionsArray1 = $sectionsObj1->getItem();
	$i=0;
    $newSectionsArray = array();

    //echo "WWWWWWW";
	
	foreach($sectionsArray1 as $ind=>$val)
	{
	 $sectionObj = $val;
     $sectionArray = $sectionObj->getItem();
     $defObj1 = $sectionArray[1];
     $defArray1 = $defObj1->getItem();
     $constObj1 = $defArray1[1];	
     $item1 = $constObj1->getItem();	 
	 $defObj2 = $sectionArray[2];
	 $defArray2 = $defObj2->getItem();
	 $constObj2 = $defArray2[1];
	 $item2 = $constObj2->getItem();
	 
	 $items1 = explode(CONST_SEP,$item1);
 	 if($items1[0]=="TABELLA")
 	 {
 	  $itemStr1 = getOriginalItemName($item1);
     }
	 
	 $items2 = explode(CONST_SEP,$item2);
 	 if($items2[0]=="TABELLA")
 	 {
 	  $itemStr2 = getOriginalItemName($item2);
     }
	 
	/* echo $itemStr1;
	 echo $itemStr2;*/
	 
     if((! in_array($itemStr1,$ids)) && (! in_array($itemStr2,$ids)))	
       $newSectionsArray[$i++] = $sectionObj;		 
	}
	$sectionsObj1->setItem($newSectionsArray);
    $xmlSerializer1->loadItems($allItems);
    $xmlSerializer1->saveData(); 	
 }
 
}

?>