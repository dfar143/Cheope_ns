<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_bootstrap_table extends Html_data_interface
{
 const COLUMNS_CSS_CLASS_ID_PREFIX="bootstrap_table_column";
 const FIELD_ID_SUFFIX="field_id";
 const DEFAULT_CSS_CLASS="bootstrap_table";
 const BOOTSTRAP_CSS_ROW_TYPE = "row";
 const BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_1 = "xs";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_2 = "sm";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_3 = "md";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_4 = "lg";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_5 = "xl";
 const BOOTSTRAP_COL_DIM = "50";
      
  private $fieldsCssClasses = array();
  private $tableHeader = STRING_NULL;
  private $tableFooter = STRING_NULL;
  private $bootstrapContainerType = self::BOOTSTRAP_CONTAINER_TYPE_1;
  private $bootstrapViewPortSizeType = self::BOOTSTRAP_VIEWPORT_SIZE_TYPE_3;
  static private $tablesTotNum=0;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = false;
  static $hasJavascriptManagement = false;
  static $hasCssManagement = false;
     
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_BOOTSTRAP_TABLE,$actNum);
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
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
 	return self::$tablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tablesTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 	$this->setBootstrapEnabled(true);	
 }
 
 function isStandard():bool
 {
 	return false;
 }

 function serialize():void
 {
	parent::serialize();
	
 	$serializer = $this->getSerializer();
 	$tableHeader = $this->getTableHeader();
 	$tableFooter = $this->getTableFooter();
 	$fieldsCssClasses = $this->getFieldsCssClasses();
 	$bootstrapContainerType = $this->getBootstrapContainerType();
 	$bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
 	$javascriptEnabled = $this->getJavascriptEnabled();
 	$item1 = array("\$fieldsCssClasses"=>$fieldsCssClasses);
 	$serializer->loadItems($item1);
 	$item2 = array("tableHeader"=>$tableHeader);
 	$serializer->loadItems($item2);
 	$item3 = array("tableFooter"=>$tableFooter);
 	$serializer->loadItems($item3);
 	$item4 = array("bootstrapContainerType"=>$bootstrapContainerType);
 	$serializer->loadItems($item4);
 	$item5 = array("bootstrapViewPortSizeType"=>$bootstrapViewPortSizeType);
 	$serializer->loadItems($item5);
 	//$item6 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item6); 
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
function setBootstrapContainerType(string $actBootstrapContainerType):void
{
	$this->bootstrapContainerType = $actBootstrapContainerType; 
}

 function getBootstrapContainerType():string
 {
 	if($this->bootstrapContainerType==STRING_NULL)
 	 return self::BOOTSTRAP_CONTAINER_TYPE_1;
 	else
 	 return $this->bootstrapContainerType;
 }

function setBootstrapViewPortSizeType(string $actBootstrapViewPortSizeType):void
{
	$this->bootstrapViewPortSizeType = $actBootstrapViewPortSizeType; 
}

 function getBootstrapViewPortSizeType():string
 {
 	if($this->bootstrapViewPortSizeType==STRING_NULL)
 	 return self::BOOTSTRAP_VIEWPORT_SIZE_TYPE_3;
 	else
 	 return $this->bootstrapViewPortSizeType;
 }
 
 function getFieldsCssClasses():array
 {
 	return $this->fieldsCssClasses;
 }
 
 function setFieldsCssClasses(array $actFieldsCssClasses):void
 {
 	$fieldsCssClasses = $this->convertToKeysNumeric($actFieldsCssClasses);
  $this->fieldsCssClasses=$fieldsCssClasses;
 }
  
 function setTableHeader(string $actTableHeader):void
 {
  $this->tableHeader = $actTableHeader;
 }
 
 function getTableHeader():string
 {
  return $this->tableHeader;
 }
 
 function setTableFooter(string $actTableFooter):void
 {
  $this->tableFooter = $actTableFooter;
 }
 
 function getTableFooter():string
 {
  return $this->tableFooter;
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
  $this->fieldsFromDataSource();
  $dataFields = $this->getDataFields();
  $cssClass = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  $fieldsCssClasses = $this->getFieldsCssClasses();
  $rows = $this->initDataSource($rows);
  $style = $this->getStyle();
  $bootstrapContainerType = $this->getBootstrapContainerType();
  $cssClass .= STRING_SPACE . $bootstrapContainerType;
  
 	$htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass);
 	$tableHeader = $this->getTableHeader();
	$htmlWriter->putGenericHtmlString(STRING_OPEN_ANGLE_BRACKET . H1_TAG . 
	STRING_CLOSE_ANGLE_BRACKET . $tableHeader . H1_CLOSE_TAG,0);
	$i=0;

	((count($dataFields) !== 0)?
	($bootstrapColDim = round(12 / count($dataFields))):
	($bootstrapColDim=self::BOOTSTRAP_COL_DIM));
  
  if((count(current($rows))>0)||(count($rows[0])>0))
  foreach($rows as $rowVal)
  {   
   $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,
   self::BOOTSTRAP_CSS_ROW_TYPE);
	 $k=0;
   foreach($dataFields as $field)
	 {
	 	$fieldDom = $this->getDataFieldDomainByName($field);
	 	
	  if(array_key_exists($field,$rowVal))
	   $fieldValue = $rowVal[$field];
	  else
	   $fieldValue = NO_VALUE;	
	     	   
	  if (isset($fieldsCssClasses[$k]))
	   $fieldCssClass = $fieldsCssClasses[$k];
	  else
	   $fieldCssClass = self::COLUMNS_CSS_CLASS_ID_PREFIX . VAR_SEP . $field;	 
	
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

    $bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
    $bootstrapColClass = "col" . STRING_MINUS . $bootstrapViewPortSizeType . 
    STRING_MINUS . (string)$bootstrapColDim;
	  
	  $fieldCssClass .= STRING_SPACE . $bootstrapColClass;
		
		$htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::FIELD_ID_SUFFIX . 
		  VAR_SEP . $field . VAR_SEP . $i,STRING_NULL,$fieldCssClass);

		if(($fieldDom != Int_domain::FIELD_DOMAIN_OBJ)&&
		($fieldDom != Int_domain::FIELD_DOMAIN_FUNCTION))
       $htmlWriter->putGenericHtmlString($fieldValue,0);
    elseif($fieldDom == Int_domain::FIELD_DOMAIN_FUNCTION)
    {
       $htmlWriter->putGenericHtmlString($fieldValue(),0);
		} 
		else
		{			 	
 	   	if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	   	{
 	   	 if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	   $fieldValue->setPrefixBeforeName(true);
 	   	 $fieldValueObj = $fieldValue->getObj();
		   if((! is_object($fieldValueObj)) && $this->getInheritData())
		   {
			   $fieldValue->setDataSource($rowVal);
			 }
			 $fieldValue->setHtmlWriter($htmlWriter);
 	   	}	
 	   	elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
 	   	{
 	   	 if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	   $fieldValue->setPrefixBeforeName(true);
 	   	 $fieldValueObj = $fieldValue->getObj();
		   if((! is_object($fieldValueObj)) && $this->getInheritData())
			   $fieldValue->setDataSource($rowVal);
 	   	}
 	    if ($this->getInheritDataFieldName())
		      $fieldValue->setNum($num . VAR_SEP . $i . VAR_SEP . $field);
		 	
			$fieldValue->putData();
		}
		 
		$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
		$k++;
	 } 
	 $i++;
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	}
  $tableFooter = $this->getTableFooter();
  $htmlWriter->putGenericHtmlString(STRING_OPEN_ANGLE_BRACKET . H1_TAG . 
	STRING_CLOSE_ANGLE_BRACKET . $tableFooter . H1_CLOSE_TAG,0);
 }
}


?>