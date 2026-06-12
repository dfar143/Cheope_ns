<?
namespace Cheope_ns\fw;

//
// Contiene le funzioni che dipendono dalla struttura del framework 
// indipendenti dall'applicativo 
//
require_once("generic.fun.php");
require_once("filesystem.fun.php");
require_once("Db_nodes_container.class.php");
require_once("sql_server.fun.php");
require_once("Xml_interface_file_analyzer.class.php");


function addAllJsonNodeDataSourceNames(string $actApp,array $actNames):array
 {
  $appDir = $actApp;
  $appJsonDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . JSON_DIR;

  $files = scandir($appJsonDir);
  $i=0;
  foreach($files as $ind=>$file)
  {
  	$filesItems = preg_split("/"  . VAR_SEP . "/",$file);
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


 function addAllXmlNodeDataSourceNames(string $actApp,array $actNames):array
 {
  $appDir = $actApp;
  $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;

  $files = scandir($appXmlDir);
  $i=0;
  foreach($files as $ind=>$file)
  {
  	$filesItems = preg_split("/"  . VAR_SEP . "/",$file);
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

//
// Ritorna un array con chiave uguale alla pagina
// Esclude le interfaccce modello.
//
function getAllInterfacesFilesByPageName(string $actApp,
string $actNomePagina=STRING_NULL,bool $actIncludePageNull=false):array
{
 $appDir = $actApp;
 $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
 $interfacesFiles = array();
 $files = scandir($appXmlDir);
 $i=0;
 foreach($files as $ind=>$file)
 {
 	if(! is_dir($file))
 	{
   $filesItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   $num = count($filesItems2);
   if($num==1)
   {
    $filesItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
    $num1 = count($filesItems);
    if(($filesItems[1]==$actNomePagina)||(($actIncludePageNull)&&($filesItems[1]==STRING_NULL)))
    {
     $interfacesFiles[$file]=$file;
     $i++;
    }
   }
  }
 }
 return $interfacesFiles;
}


function getAllPages(string $actApp):array
{
 $appDir = $actApp;
 $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
 $pages = array();
 $files = scandir($appXmlDir);
 $i=0;
 foreach($files as $ind=>$file)
 {
 	if(! is_dir($file))
 	{
   $filesItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   $num = count($filesItems2);
   if($num==1)
   {
    $filesItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
    if((! in_array($filesItems[1],$pages))&&($filesItems[1]!=STRING_NULL))
   	  $pages[$i] = $filesItems[1];
   	$i++;
   }
  } 
 }
 return $pages;
}


function switchDb(string $actDbType):bool
{
 if (! unlink("db_op.fun.php"))
  return false;
 else
  if (! rename($actDbType . VAR_SEP . "db_op.fun.php","db_op.fun.php"))
   return false;
 return true;
}

function isFieldAGenEntityField(Db_nodes_container $actDbStruct,
Db_node $actObj,string $actField):bool
 {
  $genEntity = $actObj->getGeneralized();
  if($genEntity)
  {
   $genObjs = &$actDbStruct->getElementsByName($genEntity);
   $genObj = $genObjs[0];
	 return $genObj->isFieldInFields($actField);
  }
  return false;
 }

function isFieldASubEntityField(Db_nodes_container $actDbStruct,Db_node $actObj,string $actField):bool
{
 $subEntities = $actObj->getSubEntities();
 $num = count($subEntities);
 for($i=0;$i<=$num-1;$i++)
 {
  $objs = &$actDbStruct->getElementsByName($subEntities[$i]);
	$obj = $objs[0];
	if($obj->isFieldInFields($actField))
	 return true;
 }
 return false;
}

// Le sottoentità possono avere campi con nome 
// coincidente.
function getSubEntitiesByFieldName(Db_nodes_container $actDbStruct,
Db_node $actObj,string $actField):array|string
{
 $subEntities = $actObj->getSubEntities();
 $entities = array();
 $num = count($subEntities);
 $j=0;
 for($i=0;$i<=$num-1;$i++)
 {
  $objs = &$actDbStruct->getElementsByName($subEntities[$i]);
	$obj = $objs[0];
	if($obj->isFieldInFields($actField))
	{
	 $entities[$j++]= $subEntities[$i];
  }
 }
 if(count($entities)>0)
  return $entities;
 else
  return ENTITY_NONE;
}

//
// modifica i valori dei campi contenuti nell'array $actKey
// in tutte le tabelle di collegamento per relazioni MN
// associate a $actObj
//
function changeMNLinkTablesKeysValues(Db_nodes_container $actDbStruct,
Db_node $actObj,string $actKey,array $actOldData,array $actNewData):void
{
 $rels = &$actObj->getRels();
 $oldKeyValues = array();
 $newKeyValues = array();
 $i=0;
 foreach($actKey as $key)
 {
 	if(isset($actOldData[$key]) && isset($actNewData[$key]))
 	{
   $oldKeyValues[$i] = $actOldData[$key];
   $newKeyValues[$key] = $actNewData[$key];
   $i++;
  }
 }
 
 if($i>0)
 foreach($rels as $rel)
 {
 	$relType = $rel->getRelType(ENT_FATHER);
 	if($relType==REL_M_N)
 	{
 		$linkTableName = $rel->getLinkTable();
 		$linkObjs = &$actDbStruct->getElementsByName($linkTableName);
 		$linkObj = $linkObjs[0];
 		$linkObjKeys = &$linkObj->getKeyFields();
 		$linkObjKey = $linkObjKeys[0];
//
// Per ipotesi la $linkObjKey è atomica
// 	
 	  $rows = getFilteredData($linkTableName,$actKey,$oldKeyValues,$linkObjKey);
 		foreach($rows as $row)
 		{
//
// Per ipotesi la $linkObjKey è atomica
//
 		 $newKeyValues[$linkObjKey] = $row;
 		 updateDbRow($linkTableName,$linkObjKey,$newKeyValues);
    }	
    
 	}
 }
}


function adjustSqlServerTypeValues(Db_nodes_container $actDbStruct,
Db_node $actObj,array $actRow):array
{
 $newRow = array();
 $genEntity = $actObj->getGeneralized();
 if($genEntity)
 {
  $genObjs = &$actDbStruct->getElementsByName($genEntity);
  $genObj = $genObjs[0];
 }
 
 foreach($actRow as $fieldName => $fieldValue)
 {  
  if(isFieldAGenEntityField($actDbStruct,$actObj,$fieldName))
   $type = $genObj->getFieldTypeByName($fieldName);
  else
	 $type = $actObj->getFieldTypeByName($fieldName);

  if($type == FIELD_TYPE_DATE)
	{
   $fieldValue = adjustSqlServerTypeDataValues($fieldValue);
	}
	elseif($type == FIELD_TYPE_FLOAT)
	{
	 $fieldValue = adjustSqlServerTypeFloatValues($fieldValue);
	}	
	$newRow[$fieldName] = $fieldValue;	
 }
 return $newRow;
}

// Ipotesi di chiave atomica.
function calcFatherNum(Db_node $actObj,$actId,
Db_nodes_container $actDbStruct):int
{
 $ctLivePar=0;
 $linkTables=array();
 $objName = $actObj->getName();
 $keyFields = &$actObj->getKeyFields();
 $keyField = $keyFields[0];
 $rels = $actObj->getRelsByEntSon($objName);
 $num3 = count($rels);
 for($l=0;$l<=$num3-1;$l++)
 {
	$rel = $rels[$l];
	$type = $rel->getRelType($objName);
	$gType = $rel->getType();
  $fatherName = $rel->getFather();
  $fatherObjs = &$actDbStruct->getElementsByName();
	$fatherObj = $fatherObjs[0];
	$fatherKeyFields = $fatherObj->getKeyFields();
	$fatherKeyField = $fatherKeyFields[0];
	if($gType==REL_STRUCT)
	{
	 if($type==REL_M_N)
	 {
		$linkTable = $rel->getLinkTable();
		$row2 = getFilteredData($linkTable,$keyField,
		$actId,$fatherKeyField);
		$num4 = count($row2);
		for($m=0;$m<=$num4-1;$m++)
		 if ($row2[$m]>0)
		  $ctLivePar++;
	 }
	 elseif($type==REL_1_N)
	 {
		$row1 = getExtendedUniqueRow($objName,$keyField,$actId);
		if($row1[$fatherKeyField]>0)
		{
		 $ctLivePar++;
		}
	 }
	 else
	  die("Errore in calcFatherNum-Errore nella struttura Db.");
	}
 }
 return $ctLivePar; 
}

//
// Controlla se l'array $actRow soddisfi il vincolo di 
// chiave candidata per l'oggetto $actObj
//
function testCandKeyFields(array $actRow,Db_node &$actObj,string &$actError):bool
{
 $actError = STRING_NULL;
 $candKeyFields = &$actObj->getCandKeyFields();
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

 $keys = $actObj->getKeyFields();
 // Ipotesi chiave primaria atomica.
 //
 $key = $keys[0]; 			
 for($i=0;$i<=$num-1;$i++)
 {	
  if(count($candKeyValues[$i])>0)
	{
   $row1 = getFilteredData($actObj->getName(),$candKeyFields[$i],$candKeyValues[$i],$key);
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
	  $error = "Campo ";
	  for($j=0;$j<=$num1-1;$j++)
	  {
	   $actError = $actError . " " . $candKey[$j] ;
    }
	  $actError = $actError . " duplicato.";
	  return false;
	 }
  }
 }
 return true;
}

?>