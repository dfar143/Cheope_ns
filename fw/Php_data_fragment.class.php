<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_data_interface.class.php");


class Php_data_fragment extends Html_data_interface
{
 
 const ERROR_1="Php_data_fragment:Errore nel valore dell' array.";
 const PHP_DATA_FRAGMENT_UNIQUE_CHAR = STRING_CANCELLETTO;
 const DEFAULT_EXECUTE_AT_ONCE = true;
	
 private $phpFragment=STRING_NULL;
 private $executeAtOnce=self::DEFAULT_EXECUTE_AT_ONCE;
 private $externalPar=STRING_NULL;
 private $externalProc=STRING_NULL;
 static private $phpDataFragmentsTotNum=0;
 static $hasCssManagement=false;
 static $hasJavascriptManagement = false;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$phpDataFragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$phpDataFragmentsTotNum - 1;
 	parent::__construct($actObj,$actOp,self::INT_PHP_DATA_FRAGMENT,$actNum);
 }
 
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$phpDataFragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$phpDataFragmentsTotNum=$actIntNum + 0;
 }
 
 function setExecuteAtOnce(bool $actExecuteAtOnce):void
 {
  $this->executeAtOnce = $actExecuteAtOnce;
 }
 
 function getExecuteAtOnce():bool
 {
 	if($this->executeAtOnce == STRING_NULL)
 	 return self::DEFAULT_EXECUTE_AT_ONCE;
 	else 
 	 return $this->executeAtOnce;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$executeAtOnce = $this->getExecuteAtOnce();
 	$item1 = array("executeAtOnce"=>$executeAtOnce);
 	$serializer->loadItems($item1);	
 	$phpFragment = $this->getPhpFragment();
 	$item2 = array("@phpFragment"=>$phpFragment);
 	$serializer->loadItems($item2);					
 }
 
 function loadFragmentFromFile(string $actFileName):void
 {
 	$fileRows = file($actFileName);
 	$phpFragment = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $phpFragment = $phpFragment . $fileRow;
 	}
 	$this->setPhpCode($phpFragment);
 }
 
 function setExternalProc(Callable $actProc):void
 {
 	$this->externalProc = $actProc;
 }  
 
 function getExternalProc():Callable
 {
 	return $this->externalProc;
 }
 
 function getExternalParFromProc(string ...$actPars):array|string
 {
 	$extProc = $this->getExternalProc();
 	return $extProc($actPars);
 }
 
 function setExternalPar(array $actExternalPar):void
 {
 	$this->externalPar = $actExternalPar;
 }
 
 function getExternalPar():array
 {
 	return $this->externalPar;
 }
 
 function setPhpFragment(string $actPhpFragment):void
 {
 	$this->phpFragment = $actPhpFragment;
 }
 
 function getPhpFragment():string
 {
 	return $this->phpFragment;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $rows = $this->getDataSource();
  $dataFields = $this->getDataFields();	
  
//
// Mi aspetto un array;
//		
  if(isset($rows))
  {
   if(! is_array($rows))
    $row=array($rows);
   elseif(is_array_of_array($rows))
    $row = current($rows);
   else
    $row=$rows;
  }
  else
   $row = array();

 	$phpFragment = $this->getPhpFragment();

  foreach($dataFields as $field)
  {  	
   if(isset($row[$field]))
   	$fieldValue = $row[$field];
   else
   	$fieldValue = NO_VALUE;
   	
   $fieldValues = $this->getDataFieldAllValues($field,$fieldValue);	  
 	 $fieldValue = $fieldValues;
 	 $domain = $this->getDataFieldDomainByName($field);
 	 if($domain == Int_domain::FIELD_DOMAIN_OBJ)
 	 {
 	  if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS) || 
 	  is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
 	  {
 	   $fieldValueObj = $fieldValue->getObj();
		 if((! is_object($fieldValueObj)) && $this->getInheritData())
			 $fieldValue->setDataSource($row);
 	  }
		$oldItemStack = $htmlWriter->getItemStack();
		$oldDumper = $oldItemStack->getDumper();
		$oldItemStack2 = clone $oldItemStack;
		$oldDumper2 = clone $oldDumper;
		$oldDumper2->setObj($oldItemStack2);
		$oldItemStack2->setDumper($oldDumper2);
		
    $fieldValue->setMemoryDumper();
    $newItemStack = $fieldValue->getItemStack();
    $htmlWriter->setItemStack($newItemStack);
    $fieldValue->putData();
 	  $phpFragment = preg_replace("/" . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . 
 	  strToUpper($field) . 
 	  self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . 
 	  "/",$fieldValue->getHtmlWriter()->getItemStack()->dump(),$phpFragment); 	    
 	  $htmlWriter->setItemStack($oldItemStack2);
 	 }
   elseif($domain == Int_domain::FIELD_DOMAIN_FUNCTION)
   {
   	$phpFragment = preg_replace("/" . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . 
   	strToUpper($field) . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR .
   	 "/",$fieldValue($field),$phpFragment); 	    
	 }
 	 else
 	 {
 	 	if(is_array($fieldValue))
 	 	{
 	 	 //$arrayDataStr = preg_replace("/[']/","\"",var_export($fieldValue,true));
 	 	 $arrayDataStr = var_export($fieldValue,true);
 	   $phpFragment = preg_replace("/" . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . 
 	   strToUpper($field) . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . "/",
 	   $arrayDataStr,$phpFragment); 	 	 
 	  }
 	  else
 	  {
 	   $phpFragment = preg_replace("/" . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR
 	    . strToUpper($field) . self::PHP_DATA_FRAGMENT_UNIQUE_CHAR . "/",
 	   $fieldValue,$phpFragment);
    }
   }
  }
  //echo $phpFragment;
 	$executeAtOnce = $this->getExecuteAtOnce();
 	$htmlWriter = $this->getHtmlWriter();
 	//echo $phpFragment;
 	if($executeAtOnce)
 	{
 	 $thisObj = $this;
 	 $fragmentFun = static function($actPhpFragment) use ($thisObj)
 	 {
		//echo $actPhpFragment;
 	 	eval($actPhpFragment);
 	 };
 	 $fragmentFun($phpFragment);		
 	/* $thisObj = $this;
 	 $fragmentFun = (function($actPhpFragment) use ($thisObj)
 	 {
		//echo $actPhpFragment;
		$this=null;
 	 	return ['fun'=>function(){eval($actPhpFragment)}];
 	 })($phpFragment);
 	 $fragmentFun['fun']();*/
 	}
 	else
 	 $htmlWriter->put($phpFragment);
 }
}

?>