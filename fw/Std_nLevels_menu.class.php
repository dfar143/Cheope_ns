<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_nLevels_menu extends Html_data_interface
{ 
 
 const DEFAULT_CSS_CLASS="nLevels_menu";
 const DEFAULT_ITEM_CSS_CLASS= "nLevels_menu_item";
 const DEFAULT_JAVASCRIPT_MODULE=JS_JMENU;
 const DEFAULT_CSS_MODULE=CSS_JMENU;
 const TYPE_UNORDERED="U";
 const TYPE_ORDERED="O";
 const DEFAULT_TYPE=self::TYPE_UNORDERED;
 const ITEM_ID_SUFFIX="id";

 private $gesPage=STRING_NULL;
 private $itemsEvents=array();
 private $menuType=self::DEFAULT_TYPE;
 private $typeAttr=STRING_NULL;
 private $itemCssClass=self::DEFAULT_ITEM_CSS_CLASS;
 static private $nLevelsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = true;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$nLevelsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;

  parent::__construct($actObj,$actOp,self::INT_NLEVELS_MENU,$actNum);
  $this->setJavascriptModule(CLIENT_JMENU_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCSSModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX);
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
 	$htmlWriter = $this->getHtmlWriter();
  $NLevelsMenuObjId = $this->getInterfaceId();
  $htmlWriter->putGenericHtmlString("\$(document).ready(function() {"  .
	    "\$('#" .  $NLevelsMenuObjId . "').jMenu();});");
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
 	$itemsEvents = $this->getItemsEvents();
 	$item2 = array("itemsEvents"=>$itemsEvents);
 	$serializer->loadItems($item2);	
 	$menuType = $this->getMenuType();
 	$item3 = array("menuType"=>$menuType);
 	$serializer->loadItems($item3);
 	$typeAttr = $this->getTypeAttr();
 	$item4 = array("typeAttr"=>$typeAttr);
 	$serializer->loadItems($item4);
 	$itemCssClass = $this->getItemCssClass();
 	$item5 = array("itemCssClass"=>$itemCssClass);
 	$serializer->loadItems($item5);
 	//$javascriptEnabled = $this->getJavascriptuEnabled();
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
 
 function getItemCssClass():string
 {
  if($this->itemCssClass == STRING_NULL)
   return self::DEFAULT_ITEM_CSS_CLASS;
  else
   return $this->itemCssClass;
 }
 
 function setItemCssClass(string $actItemCssClass):void
 {
 	$this->itemCssClass = $actItemCssClass;
 } 
 
 function getMenuType():string
 {
  if($this->menuType == STRING_NULL)
   return self::DEFAULT_TYPE;
  else
   return $this->menuType;
 }
 
 function setMenuType(string $actMenuType):void
 {
 	$this->menuType = $actMenuType;
 }
 
 function getTypeAttr():string
 {
 	return $this->typeAttr;
 }
 
 function setTypeAttr(string $actTypeAttr):void
 {
 	$this->typeAttr = $actTypeAttr;
 }
 
 function getItemsEvents():array
 {
  return $this->itemsEvents;
 }
 
 function setItemsEvents(array $actItemsEvents):void
 {
 	$itemsEvents = $actItemsEvents;
 	if(isset($actItemsEvents[0]))
 	{
 	 $itemsEvents["onclick"] = $actItemsEvents[0];
   unset($itemsEvents[0]);
  }
  $this->itemsEvents = $itemsEvents;
 }
  
 function isContainer()
 {
  return false;
 }
 
 function putData_recurse(array $actValues,string $actOldLevel):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
 	$typeAttr = $this->getTypeAttr();
 	$menuType = $this->getMenuType();
 	$gesPage = $this->getGesPage();
	$level = $actOldLevel;
 	
  if ($this->getJavascriptEnabled())
  { 	
 	 $class = STRING_NULL;
   $itemClass = STRING_NULL;
  }
  else
  {
 	 $class = $this->getCssClass();
   $itemClass = $this->getItemCssClass();
  }
  $itemsEvents = $this->getItemsEvents();
  
  if(isset($itemsEvents["onclick"]))
	 $onClickEventCode = $itemsEvents["onclick"];
  else
   $onClickEventCode = NO_VALUE;
  
  $i=0;
      	
 	foreach($actValues as $ind=>$val)
 	{
   if (is_array($val))
   {
	//echo "WWWWWWW";
    if($menuType==self::TYPE_UNORDERED)
    {
	 $level = $level . VAR_SEP . $i;
     $htmlWriter->putLiOpenTag($intCode  . VAR_SEP . "li" .
      VAR_SEP . $level,STRING_NULL,
     $itemClass,STRING_NULL,STRING_NULL,
     $typeAttr,$onClickEventCode);
   	 if ($this->getJavascriptEnabled())
   	 {
   	  $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,
   	  ($actOldLevel=='level_')?"fNiv":$itemClass,STRING_NULL);
   	  $htmlWriter->putGenericHtmlString($ind);
	  //echo "QQQQQ1";
   	  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
   	 } 
   	 else
   	 {
	  //echo "QQQQQ2";
   	  $htmlWriter->putGenericHtmlString($ind);
     }
     //$level = $level . VAR_SEP . $i;
	 $i++;	
     $htmlWriter->putUlOpenTag($intCode  . VAR_SEP . "ul" .
     VAR_SEP . $level,
     STRING_NULL,$class,$typeAttr);
    // $this->putData_recurse($val,$level,++$actLevel);
	 $this->putData_recurse($val,$level);
     $htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);
     $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
    }
    else
    {
     $htmlWriter->putLiOpenTag($intCode  . VAR_SEP .  "li" .
      VAR_SEP . $level . VAR_SEP . $i,STRING_NULL,
     $itemClass,STRING_NULL,STRING_NULL,
     $typeAttr,$onClickEventCode);
     $htmlWriter->putGenericHtmlString($ind);
	 //$level = $level . VAR_SEP . $i;
	 $i++;   
     $htmlWriter->putOlOpenTag($intCode  . VAR_SEP . "ol" . 
     VAR_SEP . $level,
     STRING_NULL,$class,$typeAttr);
    // $this->putData_recurse($val,$level,++$actLevel);
     $this->putData_recurse($val,$level);
    // $actLevel--;
     $htmlWriter->putGenericHtmlString(OL_CLOSE_TAG);
     $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
    }   	 	
   }
   elseif(! is_object($val))
   {
   	$id = $ind . VAR_SEP . self::ITEM_ID_SUFFIX;
   	$htmlWriter->putLiOpenTag(
   	$id,STRING_NULL,$itemClass,STRING_NULL,STRING_NULL,
   	$typeAttr,$onClickEventCode);
   	if((! is_numeric($ind))&&($val!==STRING_NULL))
    {
   	 $page = $ind;
   	}
   	else
   	 $page = STRING_NULL;
   	 
   	if ($this->getJavascriptEnabled())
   	{
   	 $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,$itemClass,
   	 (($page===STRING_NULL)?($gesPage . URL_PARS_START . PAR1 . 
   	 URL_PAR_EQUAL . (($val!==STRING_NULL)?$val:$ind)):$page));
   	 $htmlWriter->putGenericHtmlString($val);
   	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
   	} 
   	else
   	{
   	 if($page === STRING_NULL)
   	  $htmlWriter->putGenericHtmlString((($val!==STRING_NULL)?$val:$ind));
   	 else
   	 {
   	  $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,$itemClass,
   	  $page);
   	  $htmlWriter->putGenericHtmlString($val);
   	  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
   	 }
   	}
   	$htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
   }
   else
   {
   	$id = $ind . VAR_SEP . self::ITEM_ID_SUFFIX;
    $htmlWriter->putLiOpenTag(
   	$id,STRING_NULL,$itemClass,STRING_NULL,STRING_NULL,
   	$typeAttr,$onClickEventCode);
   	$htmlWriter->putGenericHtmlString($ind);
   	$val->putData();
    $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
   }    
  }
 }
 
 function putMenu(array $actDataValues):void
 {
  $htmlWriter = $this->getHtmlWriter();
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
  $menuType = $this->getMenuType();
  $typeAttr = $this->getTypeAttr();
  $class = $this->getCssClass();
    
  $htmlWriter->putDivOpenTag($intCode,$style,$class); 
  if($menuType==self::TYPE_UNORDERED)
  {
   if($this->getJavascriptEnabled())
   {
     $htmlWriter->putUlOpenTag("jMenu",STRING_NULL,STRING_NULL,$typeAttr);
   }
   else
    $htmlWriter->putUlOpenTag($intCode . VAR_SEP . 'ul_menu',
    STRING_NULL,STRING_NULL,$typeAttr);
   $this->putData_recurse($actDataValues,"level_");
   $htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);
  }
  else
  {
   $htmlWriter->putOlOpenTag($intCode . VAR_SEP . 'ol_menu',
   STRING_NULL,STRING_NULL,$typeAttr);
   $this->putData_recurse($actDataValues,"level_");
   $htmlWriter->putGenericHtmlString(OL_CLOSE_TAG);
  }
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }

 function initPutData():array
 {
 }

 function putData():void
 { 
  $rows = $this->getDataSource();
  $numRows = count($rows);
  $dataFields = $this->getDataFields();
  $gesPage = $this->getGesPage();
  $htmlWriter = $this->getHtmlWriter();
  $obj = $this->getObj();
    
  $rows = $this->initDataSource($rows);

  $dataValues = array();

  $i=0;  
	foreach($rows as $ind=>$row)
	{
	 foreach($dataFields as $dataField)
	 {
	  if(array_key_exists($dataField,$row))
	   $fieldValue = $row[$dataField];
	  else
	   $fieldValue = NO_VALUE;
	 
	  $fieldValue = $this->getDataFieldAllValues($dataField,$fieldValue);    
    $fieldDom = $this->getDataFieldDomainByName($dataField);
    
		if($fieldDom == Int_domain::FIELD_DOMAIN_OBJ)
		{	
		 $newFieldValue = $fieldValue; 		 	
 	   if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	   {
 	   	$fieldValueObj = $newFieldValue->getObj();
			if(! is_object($fieldValueObj) && ($this->getInheritData()))
			 $newFieldValue->setObj($obj);
			if($this->getInheritData())
			 $newFieldValue->setDataSource($row);			 	
			$newFieldValue->setHtmlWriter($htmlWriter);
		 }
		 elseif(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
		 {
		  $fieldValueObj = $fieldValue->getObj();
      if((! is_object($fieldValueObj)) && $this->getInheritData())
      {
       $newFieldValue->setDataSource($row);
      }
		 }
		 $dataValues[$dataField] = $newFieldValue;
	  }
	  elseif((is_array($fieldValue))||($fieldValue == NO_VALUE))
     $dataValues[$dataField] = $fieldValue;
    else
    {
     if($numRows==0)
      $dataValues[$dataField] = $fieldValue;
     else
      $dataValues[$dataField][$i] = $fieldValue;     
	  }
   }
   $i++;
  }
  $this->putMenu($dataValues);
 }
 
}


?>