<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_scrolling_table extends Html_data_interface
{ 
  
// const ERROR_1="Cheope_ns_scrolling_table: errore nella definizione dell'interfaccia.";
 const DEFAULT_CSS_CLASS="scrolling_table";
 const DEFAULT_ROWS_CSS_CLASS="scrolling_table_rows";
 const DEFAULT_SUMMARY=STRING_NULL;
 const DEFAULT_JAVASCRIPT_MODULE=JS_DYN_TABLE;
 const DEFAULT_CSS_MODULE=CSS_SCROLLING_TABLE;
 const FIELD_ID_SUFFIX="field";
 const HEADER_FIELD_ID_SUFFIX="header_field";
 const HEADER_CSS_CLASS="scrolling_table_header";
 const COLUMNS_CSS_CLASS="scrolling_table_columns";
 const INNER_TABLE_CLASS="scrolling_table_inner_table";
 const NUM_LINES=15;

 private $columnsDims = array();
 private $fieldsCssClasses = array();
 private $rowsCssClass=self::DEFAULT_ROWS_CSS_CLASS;
 private $summary=self::DEFAULT_SUMMARY;
 static private $tablesTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = true;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;

  parent::__construct($actObj,$actOp,self::INT_SCROLL_TABLE,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . 
  self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
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
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tablesTotNum=$actIntNum + 0;
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
	//$arrayPropsArray=array("columnsDims","fieldsCssClasses");
	//$this->serialize_props_exec($booleanPropsArray,$arrayPropsArray);
	//$serializer = $this->getSerializer();
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$columnsDims = $this->getColumnsDims();
 	$item1 = array("\$columnsDims"=>$columnsDims);
 	$serializer->loadItems($item1);		
 	$fieldsCssClasses = $this->getFieldsCssClasses();
 	$item2 = array("\$fieldsCssClasses"=>$fieldsCssClasses);
 	$serializer->loadItems($item2);
 	$rowsCssClass = $this->getRowsCssClass();
 	$item3 = array("rowsCssClass"=>$rowsCssClass);
 	$serializer->loadItems($item3);
 	$summary = $this->getSummary();
 	$item4 = array("summary"=>$summary);
 	$serializer->loadItems($item4);
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item8 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item8);	 	
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
 }
 
 function setColumnsDims(array $actColDims):void
 {
 	$columnsDims = $this->convertToKeysNumeric($actColDims);
  $this->columnsDims = $columnsDims;
 }
 
 function getColumnsDims():array
 {
  return $this->columnsDims;
 }
 
 function getRowsCssClass():string
 {
 	if($this->rowsCssClass == STRING_NULL)
 	 return self::DEFAULT_ROWS_CSS_CLASS;
 	else
 	 return $this->rowsCssClass;
 }
 
 function setRowsCssClass(string $actRowsCssClass):void
 {
 	$this->rowsCssClass = $actRowsCssClass;
 }
 
 function getSummary():string
 {
  if($this->summary == STRING_NULL)
   return self::DEFAULT_SUMMARY;
  else
   return $this->summary; 	 	
 }
 
 function setSummary(string $actSummary):void
 {
 	$this->summary = $actSummary;
 } 
 
 function getFieldsCssClasses():array
 {
 	return $this->fieldsCssClasses;
 }
 
 function setFieldsCssClasses(array $actFieldsCssClasses):void
 {
 	$fieldsCssClasses = $this->convertToKeysNumeric($actFieldsCssClasses);
  $this->fieldsCssClasses=$actFieldsCssClasses;
 }

 
 function isContainer():bool
 {
  return false;
 }
 
 // Effettua un' elaborazione sul nome del campo
// così come è definito nei $dataFields ai fini di
// visualizzarlo come etichetta
 function adjustField(string $actFieldName):string
 {
  $actFieldName = str_replace(STRING_OPEN_SQUARE_BRACKET,STRING_NULL,$actFieldName);
	$actFieldName = str_replace(STRING_CLOSE_SQUARE_BRACKET,STRING_NULL,$actFieldName);
	return $actFieldName;
 }
 
 function putHeader():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
	$columnsDims = $this->getColumnsDims();
	$dataFields = $this->getDataFields();
	$rows = $this->getDataSource();
	if((count($rows)) >= self::NUM_LINES)
	{
	 $htmlWriter->putTableOpenTag(STRING_NULL,STRING_NULL,"98%");
	}
	else
	{
	 $htmlWriter->putTableOpenTag(STRING_NULL,STRING_NULL,"100%");
	}
	 
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
	 
	$i = 0;
	foreach($dataFields as $field)
	{	 	
	 if(isset($columnsDims[$i]))
	  $colDim = $columnsDims[$i];
	 else
	  $colDim=0;	   
	 $field = $this->adjustField($field);
	 $htmlWriter->putTableColumnOpenTag(STRING_NULL,STRING_NULL,$colDim,STRING_NULL);
	 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::HEADER_FIELD_ID_SUFFIX . 
			 VAR_SEP . $field,STRING_NULL,self::HEADER_CSS_CLASS);
   $field = normalizeString($field);
	 $htmlWriter->putGenericHtmlString($field,0);
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0); 	  
	 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	 $i++;
	}
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG);
 }
 
 function putFooter():void
 {
 }
 
 function initPutData():array
 {
 } 
 
 function putData():void
 {  	
 	$htmlWriter = $this->getHtmlWriter(); 	
 	$intCode = $this->getInterfaceId();
  $rows = $this->getDataSource();
  if($this->getFieldsFromDataSource())
   $this->fieldsFromDataSource();
  $summary = $this->getSummary();

  $rows = $this->initDataSource($rows);   
  $dataFields = $this->getDataFields();
  $fieldsCssClasses = $this->getFieldsCssClasses();
	$num = $this->getNum();
  $class = $this->getCssClass();
  $style = $this->getStyle();
	$columnsDims = $this->getColumnsDims();
	   
  $htmlWriter->putDivOpenTag($intCode,$style,$class);
	$htmlWriter->putDivOpenTag($intCode . VAR_SEP . "header",STRING_NULL,self::HEADER_CSS_CLASS);
	$this->putHeader();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0); 
	$htmlWriter->putDivOpenTag($intCode . VAR_SEP . "inner_table",STRING_NULL,self::INNER_TABLE_CLASS);
  $htmlWriter->putTableOpenTag(STRING_NULL,self::INNER_TABLE_CLASS,"100%",
  STRING_NULL,"1",STRING_NULL,STRING_NULL,$summary);
	$i=0;
  if((count(current($rows))>0)||(count($rows[0])>0))
  foreach($rows as $rowVal)
  {
   $rowsCssClass = $this->getRowsCssClass();
   $htmlWriter->putTableRowOpenTag(STRING_NULL,$rowsCssClass);
	 $j=0;
   foreach($dataFields as $field)
	 {
		$fieldDom = $this->getDataFieldDomainByName($field);
	   
	  if(isset($columnsDims[$j]))
		 $colDim = $columnsDims[$j];
		else
		 $colDim = 0;
		   
	  if (isset($fieldsCssClasses[$j]))
	   $fieldCssClass = $fieldsCssClasses[$j];
	  else
	   $fieldCssClass = self::COLUMNS_CSS_CLASS;	
	    	
	  if(array_key_exists($field,$rowVal))
	   $fieldValue = $rowVal[$field];
	  else
	   $fieldValue = NO_VALUE;
	 
		$fieldValues = $this->getDataFieldAllValues($field,$fieldValue);

    if(is_array($fieldValues) && isset($fieldValues[$field]))
    {
     $fieldValue = $fieldValues[$field];
    }
    elseif(is_array($fieldValues))
	  {
	   $fieldValue = current($fieldValues);
	  }
	  else
		 $fieldValue = $fieldValues;	
	    	   		   
		$htmlWriter->putTableColumnOpenTag(STRING_NULL,$fieldCssClass,$colDim,STRING_NULL,STRING_NULL,STRING_NULL);
	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::FIELD_ID_SUFFIX . 
			VAR_SEP . $field . VAR_SEP . $i);
			 
		if($fieldDom != Int_domain::FIELD_DOMAIN_OBJ)
      $htmlWriter->putGenericHtmlString($fieldValue,0); 
		else
		{			 	
 	   if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	   {
 	   	if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	 $fieldValue->setPrefixBeforeName(true);
 	   	$fieldValueObj = $fieldValue->getObj();
		  if((! is_object($fieldValueObj)) && $this->getInheritData())
      {
       $rowVal["COUNT"] = $j;
       $fieldValue->setDataSource($rowVal);
      }
		  $fieldValue->setHtmlWriter($htmlWriter);
 	   }
 	   elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
     {
      $fieldValueObj = $fieldValue->getObj();
      if((! is_object($fieldValueObj)) && $this->getInheritData())
      {
       $rowVal["COUNT"] = $j;
       $fieldValue->setDataSource($rowVal);
      }
     }
 	   if ($this->getInheritDataFieldName())
		   $fieldValue->setNum($num . VAR_SEP . $i . VAR_SEP . $field);

		 $fieldValue->putData();
		}
		$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	  $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
		$j++;
	 }	 
	 $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	 $i++;
  }
  $htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  $this->putFooter();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
}


?>