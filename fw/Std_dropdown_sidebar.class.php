<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_dropdown_sidebar extends Html_data_interface
{ 
 const DEFAULT_CSS_CLASS="dropdown_sidebar";
 const DEFAULT_CSS_MODULE="dropdown_sidebar";

 private $gesPage=STRING_NULL;
 static private $nLevelsTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$nLevelsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_DROPDOWN_SIDEBAR,$actNum);
  $this->setCSSModule(array("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
  CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX));
  $this->setJavascriptModule(CLIENT_DROPDOWN_SIDEBAR_CODE_PATH . DIR_SEP . JS_DROPDOWN_SIDEBAR);
  $this->setDelayedModule(true);
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
 	return self::$nLevelsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$nLevelsTotNum=$actIntNum + 0;
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
 	$serializer = $this->getSerializer();
 	$gesPage = $this->getGesPage();
 	$item1 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item1);	 	
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item6 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item6);
 }

 function getGesPage():string
 {
 	return $this->gesPage;
 }
 
 function setGesPage(string $actGesPage):void
 {
 	$this->gesPage = $actGesPage;
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
 
 function putMenu_body(array $actValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
 	$gesPage = $this->getGesPage();
      	
    $i=0;
 	foreach($actValues as $ind=>$val)
 	{
   if (is_array($val))
   {
	 //$htmlWriter->putDivOpenTag(STRING_NULL,$style,"dropdown"); 
     $htmlWriter->putButtonOpenTag(STRING_NULL,STRING_NULL,"dropdown-btn-sidebar");
	 $htmlWriter->putGenericHtmlString($ind);
     $htmlWriter->putIOpenTag(STRING_NULL,STRING_NULL,"fa fa-caret-down");
     $htmlWriter->putGenericHtmlString(I_CLOSE_TAG);	 
     $htmlWriter->putGenericHtmlString(BUTTON_CLOSE_TAG);	 
     $htmlWriter->putDivOpenTag(STRING_NULL,
     STRING_NULL,"dropdown-container-sidebar");   
     $j=0;	 
     foreach($val as $ind1=>$values)
     {
      $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,$values . URL_PARS_START . PAR . URL_PAR_EQUAL . $j);
      $htmlWriter->putGenericHtmlString($ind1);
      $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
      $j++;	  
     }		 
     $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG); 
    // $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);	 
   }
   else
   {
    //$htmlWriter->putDivOpenTag(STRING_NULL,$style,"dropdown");
	$htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,$gesPage . URL_PARS_START . PAR . URL_PAR_EQUAL . $val);
	$htmlWriter->putGenericHtmlString($ind);
	$htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	//$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
   }
   $i++;
  }
 }

 function putMenu(array $actDataValues):void
 {
  $htmlWriter = $this->getHtmlWriter();
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
  $class = $this->getCssClass();  
   
  $htmlWriter->putDivOpenTag($intCode,$style,$class); 
  $this->putMenu_body($actDataValues);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
  $rows = $this->getDataSource();
  $this->fieldsFromDataSource();
  $dataFields = $this->getDataFields(); 
  $rows = $this->initDataSource($rows);

  $dataValues = array();
  
    $i=0;
	foreach($rows as $ind=>$row)
	{
     //print_r($row);	 
	 foreach($dataFields as $dataField)
	 {
	  if(array_key_exists($dataField,$row))
	   $fieldValue = $row[$dataField];
	  else
	   $fieldValue = NO_VALUE;
	 
	  $fieldValue = $this->getDataFieldAllValues($dataField,$fieldValue);    
    $fieldDom = $this->getDataFieldDomainByName($dataField);
    
		if(($fieldDom == Int_domain::FIELD_DOMAIN_SET)||($fieldDom == Int_domain::FIELD_DOMAIN_ATOMIC_STATIC))
		{	
      $dataValues[$dataField] = $fieldValue;   
	  }
	  elseif($fieldDom == Int_domain::FIELD_DOMAIN_ATOMIC)
	  {
		$dataValues[$dataField][$i]=$fieldValue;  
	  }   
   }
   $i++;
  }
/* $rows = $this->getDataSource();
 $dataValues = array(); 
 $dataValues = $this->extractDataFromDataSource($rows);*/
  $this->putMenu($dataValues);
 }
 
}


?>