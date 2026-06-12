<?
namespace Cheope_ns\fw;
require_once("Data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");
require_once("filesystem.fun.php");


class Std_csv_table extends Data_interface
{ 
 
 const DEFAULT_ITEMS_SEP = STRING_SEMICOLON;
 const DEFAULT_DIR = THIS_DIR . DIR_SEP . CSV_DIR;
 const ERROR_1 = "Std_csv_table: errore nella definizione dell'interfaccia.";

 private $fileName=STRING_NULL;	
 private $dir = self::DEFAULT_DIR;
 static private $csvTablesTotNum=0;
 	
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$csvTablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$csvTablesTotNum - 1; 
  parent::__construct($actObj,$actOp,Interfaces_info::INT_CSV_TABLE,$actNum);
 }
 
  function action(string $actStr,Interfaces_container $actInterfacesContainer):void
  {
 	 $this->putData();
  } 
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$csvTablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$csvTablesTotNum=$actIntNum + 0;
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$fileName = $this->getFileName();
 	$item1 = array("fileName"=>$fileName);
 	$serializer->loadItems($item1);
 	$dir = $this->getDir();
 	$item2 = array("dir"=>$dir);
 	$serializer->loadItems($item2);
 }
 
 function setDir(string $actDir):void
 {
 	$this->dir = $actDir;
 }
 
 function getDir():string
 {
 	return $this->dir;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function getHeader():string
 {
 	$head = STRING_NULL;
 	$i=0;
 	$fields = $this->getDataFields();
  foreach($fields as $dataField)
  {
  	$head = $head . $dataField;
  	$i++;
  	if($i<=count($fields)-1)
  	 $head = $head . self::DEFAULT_ITEMS_SEP;
  }
	return $head;
 }
 
 function putFooter():void
 {
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
  $rows = $this->getDataSource();
  $this->setFieldsFromDataSource(true);
  $this->fieldsFromDataSource();
  $dataFields = $this->getDataFields();
  $fileName = $this->getFileName();
  $dir = $this->getDir();
  $head = $this->getHeader();
  
  $rows = $this->initDataSource($rows); 
  $path = $dir . DIR_SEP . $fileName;	
  $handle = fopen($path,"wb");

   fwrite($handle,$head);
	 fwrite($handle,STRING_RETURN);
	 fwrite($handle,STRING_LINE_FEED); 
   foreach($rows as $rowVal)
   {
    $i=0;
    foreach($dataFields as $field)
	  {
	   if(array_key_exists($field,$rowVal))
	   {
      $fieldValue = $rowVal[$field];
	    
		  $fieldValues = $this->getDataFieldAllValues($field,$fieldValue);
		   
      if(is_array($fieldValues) && isset($fieldValues[$field]))
      {
    	 $fieldValue = $fieldValues[$field];
      }
      elseif(is_array($fieldValues))
	    {
	     $fieldValue = array_getKey($fieldValues,current($fieldValues));
	    }
	    else
		   $fieldValue = $fieldValues;
	    
      fwrite($handle,$fieldValue); 
		 }
		 $i++;
     if($i<=count($dataFields)-1)
		  fwrite($handle,self::DEFAULT_ITEMS_SEP);
		}	
		fwrite($handle,STRING_RETURN);
		fwrite($handle,STRING_LINE_FEED); 
   }
  fclose($handle);
 }
 
}


?>