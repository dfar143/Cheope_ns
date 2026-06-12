<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_sheet extends Html_data_interface
{ 
 
 const ERROR_1="Cheope_ns_sheet:Errore nella definizione dell'interfaccia.";
 const DEFAULT_CSS_CLASS="sheet";
 const DEFAULT_NUM_COL=2;
 const DEFAULT_NUM_EL_PER_COL=1;
 const DEFAULT_JAVASCRIPT_MODULE=JS_DYN_SHEET;
 const DEFAULT_CSS_MODULE=CSS_SHEET;
 const TABLE_CSS_CLASS="sheet";
 const FIELD_CLASS_SUFFIX="field";
 const FIELD_ID_SUFFIX="field";
 const FIELD_VALUE_CLASS_SUFFIX="field_value";
 const FIELD_LABEL_CLASS_SUFFIX="field_label";
 const FIELD_VALUE_ID_SUFFIX="field_value";
 const FIELD_LABEL_ID_SUFFIX="field_label";
 const DEFAULT_SEP = STRING_SPACE . STRING_COLON . STRING_SPACE;

 private $numCol=self::DEFAULT_NUM_COL;
 private $numElPerCol=self::DEFAULT_NUM_EL_PER_COL;
 // Array delle etichette dei campi.
 // Per default i valori sono estratti dal nome dei campi; 
 private $fieldsLabels = array();
 static private $sheetsTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement=true;
   
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$sheetsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$sheetsTotNum - 1;

  parent::__construct($actObj,$actOp,self::INT_SHEET,$actNum);
  $this->setNumElPerCol(self::DEFAULT_NUM_EL_PER_COL);
  $this->setNumCol(self::DEFAULT_NUM_COL);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
 	function useDojo():bool
	{
		return self::$useDojo;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
	
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$sheetsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$sheetsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();
 	//$serializer = $this->getSerializer();
	//$booleanPropsArray=array();
	//$this->serialize_props_exec($booleanPropsArray);
	
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item1 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item1);
 	$numCol = $this->getNumCol();
 	$item3 = array("numCol"=>$numCol);
 	$serializer->loadItems($item3);
 	$numElPerCol = $this->getNumElPerCol();
 	$item4 = array("numElPerCol"=>$numElPerCol);
 	$serializer->loadItems($item4);
 	$fieldsLabels = $this->getFieldsLabels();
 	$item5 = array("\$fieldsLabels"=>$fieldsLabels);
 	$serializer->loadItems($item5);
 }
 
 function getFieldsLabels():array
 {
 	return $this->fieldsLabels;
 }
 
 function setFieldsLabels(array $actFieldsLabels):void
 {
 	$this->fieldsLabels = $actFieldsLabels;
 }
 
 function setNumCol(int $actCol):void
 {
 	$this->numCol = $actCol;
 }
 
 function getNumCol():int
 {
 if($this->numCol == NO_VALUE)
  return self::DEFAULT_NUM_COL;
 else
  return $this->numCol;
 }
 
 function setNumElPerCol(int $actNumElPerCol):void
 {
 	$this->numElPerCol = $actNumElPerCol;
 }
 
 function getNumElPerCol():int
 {
 if($this->numElPerCol == NO_VALUE)
  return self::DEFAULT_NUM_EL_PER_COL;
 else
  return $this->numElPerCol;
 }
 
function getCssClass():string
{
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
}
  
 function isContainer():bool
 {
  return false;
 }
 
 // Effettua un' elaborazione sul nome del campo
// così come è definito nei $dataFields ai fini di
// visualizzarlo come etichetta
 function adjustFieldName(string $actFieldName):string
 {
	return normalizeString($actFieldName);
 }
 
 function putSheetBody(array $actRow):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
  $numCol = $this->getNumCol();
  $numElPerCol = $this->getNumElPerCol();
  $dataFields = $this->getDataFields();
  $fieldsLabels = $this->getFieldsLabels();
  $ct1=0;
  $ct2=0;
  $htmlWriter->putTableOpenTag(STRING_NULL,self::TABLE_CSS_CLASS,"100%");
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
	$htmlWriter->putTableColumnOpenTag(STRING_NULL);
	if(count($dataFields)==0)
	{
	 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG);
   $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG);
  }
  foreach($dataFields as $ind=>$fieldName)
  {
   $fieldDom = $this->getDataFieldDomainByName($fieldName);
	 if($ct2 > $numElPerCol-1)
	 {
		$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG);
	  $ct2=0;
	  $ct1++;
	  if($ct1>$numCol-1)
	  { 
	   $ct1=0;
	   $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG);
	   $htmlWriter->putTableRowOpenTag(STRING_NULL);
	   $htmlWriter->putTableColumnOpenTag(STRING_NULL);
	  }
	  else
	  {
	   $htmlWriter->putTableColumnOpenTag(STRING_NULL);
	  }
	 }
	 if($ct2<=$numElPerCol-1)
	 {
	 	if(array_key_exists($fieldName,$actRow))
	   $fieldValue = $actRow[$fieldName];
	  else
	   $fieldValue = NO_VALUE;
	    
		$fieldValues = $this->getDataFieldAllValues($fieldName,$fieldValue);
		  
    if(is_array($fieldValues) && isset($fieldValues[$fieldName]))
    {
    	$fieldValue = $fieldValues[$fieldName];
    }
    elseif(is_array($fieldValues))
	  {
	   $fieldValue = $fieldValues;
	  }
	  else
		 $fieldValue = $fieldValues;
		   
		//Sezione di output delle righe html.
		//
		
		$htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::FIELD_ID_SUFFIX . VAR_SEP . $fieldName,STRING_NULL,
		$intCode . VAR_SEP . self::FIELD_CLASS_SUFFIX . VAR_SEP . $fieldName . VAR_SEP . LEVEL_TAG);
		$htmlWriter->putSpanOpenTag($intCode . VAR_SEP . self::FIELD_LABEL_ID_SUFFIX . VAR_SEP . $fieldName,
		$intCode . VAR_SEP . self::FIELD_LABEL_CLASS_SUFFIX . VAR_SEP . $fieldName);
		$htmlWriter->putGenericHtmlString(EMBOLD_OPEN_TAG,0);
		  
		if(isset($fieldsLabels[$ind]))
		 $htmlWriter->putGenericHtmlString($fieldsLabels[$ind] .  self::DEFAULT_SEP,0);
		else
		 $htmlWriter->putGenericHtmlString($this->adjustFieldName($fieldName) .  self::DEFAULT_SEP,0);
		  
		$htmlWriter->putGenericHtmlString(EMBOLD_CLOSE_TAG,0);
		$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
		$htmlWriter->putSpanOpenTag($intCode . VAR_SEP . self::FIELD_VALUE_ID_SUFFIX . VAR_SEP . $fieldName,
		$intCode . VAR_SEP . self::FIELD_VALUE_CLASS_SUFFIX . VAR_SEP . $fieldName);
		 
		if(($fieldDom != Int_domain::FIELD_DOMAIN_OBJ)&&($fieldDom != Int_domain::FIELD_DOMAIN_FUNCTION))
		{
     $htmlWriter->putGenericHtmlString($fieldValue,0);
    } 
    elseif($fieldDom == Int_domain::FIELD_DOMAIN_FUNCTION)
    {
     $htmlWriter->putGenericHtmlString($fieldValue(),0);
		}
		else
		{
		 if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	   {
 	   	$fieldValueObj = $fieldValue->getObj();
		  if((! is_object($fieldValueObj)) && $this->getInheritData())
			 $fieldValue->setDataSource($actRow);
		  $fieldValue->setHtmlWriter($htmlWriter);
 	   }		
     elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
     {
      $fieldValueObj = $fieldValue->getObj();
      if((! is_object($fieldValueObj)) && $this->getInheritData())
       $fieldValue->setDataSource($actRow);    	
     }
		 $fieldValue->putData();
		} 		 	
		$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
		$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 		$ct2++;
	 }
  }
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG);
 }

 function initPutData():array
 {
 } 
 
 function putData():void
 { 
 	$htmlWriter = $this->getHtmlWriter();
  $rows = $this->getDataSource();
  $intCode = $this->getInterfaceId();
	$class = $this->getCssClass();
	$op = $this->getOp();
	$style = $this->getStyle();
	
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
  
	$htmlWriter->putDivOpenTag($intCode,$style,$class);
  $this->putSheetBody($row);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
}


?>