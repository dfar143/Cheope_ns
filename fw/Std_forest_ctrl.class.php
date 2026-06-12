<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("html.fun.php");
require_once("std.fun.php");


abstract class Std_forest_ctrl extends Html_data_interface
{
 
 const DEFAULT_MOUSE_EVENT="mouseover";
 const DEFAULT_SUBITEMS_HTML_TYPE="a";
 const DEFAULT_ROOT_ITEM_HTML_TYPE="span";
 const DEFAULT_ITEM_CSS_CLASS="forest_ctrl_item";
 const DEFAULT_MAIN_CSS_CLASS="forest_ctrl";
 const DEFAULT_VER=STRING_NULL;
 const DEFAULT_OPEN_IMG="plus.gif";
 const DEFAULT_CLOSE_IMG="minus.gif";
 const DEFAULT_IMG_DIR=THIS_DIR . DIR_SEP ."img";
 const DEFAULT_JAVASCRIPT_MODULE=JS_FOREST_CTRL;
 const DEFAULT_CSS_MODULE=CSS_FOREST_CTRL;
 
private $mainLabel=STRING_NULL;
private $itemClass = self::DEFAULT_ITEM_CSS_CLASS;
private $target=STRING_NULL;
private $gesPage=STRING_NULL;
private $mouseEvent = self::DEFAULT_MOUSE_EVENT;
private $subItemsHtmlType = self::DEFAULT_SUBITEMS_HTML_TYPE;
private $rootItemHtmlType = self::DEFAULT_ROOT_ITEM_HTML_TYPE;
private $forestCtrlVer = self::DEFAULT_VER;
private $openImg = self::DEFAULT_OPEN_IMG;
private $closeImg = self::DEFAULT_CLOSE_IMG;
private $imgDir = self::DEFAULT_IMG_DIR;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement=true;
 
function __construct($actObj=OBJ_NONE,string $actOp,string $actType,$actNum=STRING_NULL)
{
 parent::__construct($actObj,$actOp,$actType,$actNum);
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

 function isStandard():bool
 {
 	return false;
 }

 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$mainLabel = $this->getMainLabel();
 	$item1 = array("mainLabel"=>$mainLabel);
 	$serializer->loadItems($item1);
 	$itemClass = $this->getItemClass();
 	$item2 = array("itemClass"=>$itemClass);
 	$serializer->loadItems($item2);
 	$target = $this->getTarget();
 	$item3 = array("target"=>$target);
 	$serializer->loadItems($item3);
 	$gesPage = $this->getGesPage();
 	$item4 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item4);	
 	$mouseEvent = $this->getMouseEvent();
 	$item5 = array("mouseEvent"=>$mouseEvent);
 	$serializer->loadItems($item5);	
 	$subItemsHtmlType = $this->getSubItemsHtmlType();
 	$item6 = array("subItemsHtmlType"=>$subItemsHtmlType);
 	$serializer->loadItems($item6);	
 	$rootItemHtmlType = $this->getRootItemHtmlType();
 	$item7 = array("rootItemHtmlType"=>$rootItemHtmlType);
 	$serializer->loadItems($item7);
 	$forestCtrlVer = $this->getForestCtrlVer();
 	$item8 = array("forestCtrlVer"=>$forestCtrlVer);
 	$serializer->loadItems($item8);					
 }

function getMainLabel():string
{
 return $this->mainLabel;
}

function setMainLabel(string $actMainLabel):void
{
 $this->mainLabel = $actMainLabel; 
}

function getCssClass():string
{
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_MAIN_CSS_CLASS;
 else
  return $this->cssClass;
}

function setItemClass(string $actItemClass):void
{
 $this->itemClass = $actItemClass;
}

function getItemClass():string
{
 if($this->itemClass == STRING_NULL)
  return self::DEFAULT_ITEM_CSS_CLASS;
 else
  return $this->itemClass;
}

function setTarget(string $actTarget):void
{
	$this->target = $actTarget;
}

function getTarget():string
{
	return $this->target;
}

function setGesPage(string $actGesPage):void
{
 $this->gesPage = $actGesPage;
}

function getGesPage():string
{
 return $this->gesPage;
}

function setMouseEvent(string $actMouseEvent):void
{
 $this->mouseEvent = $actMouseEvent;
}

function getMouseEvent():string
{
 if($this->mouseEvent == STRING_NULL)
  return self::DEFAULT_MOUSE_EVENT;
 else
  return $this->mouseEvent;
}

function setSubItemsHtmlType(string $actSubItemsHtmlType):void
{
 $this->subItemsHtmlType = $actSubItemsHtmlType;
}

function getSubItemsHtmlType():string
{
 if($this->subItemsHtmlType == STRING_NULL)
  return self::DEFAULT_SUBITEMS_HTML_TYPE;
 else
  return $this->subItemsHtmlType;
}

function setRootItemHtmlType(string $actRootItemHtmlType):void
{
 $this->rootItemHtmlType = $actRootItemHtmlType;
}

function getRootItemHtmlType():string
{
 if($this->rootItemHtmlType == STRING_NULL)
  return self::DEFAULT_ROOT_ITEM_HTML_TYPE;
 else
  return $this->rootItemHtmlType;
}

function setForestCtrlVer(string $actForestCtrlVer):void
{
 $this->forestCtrlVer = $actForestCtrlVer;
}

function getForestCtrlVer():string
{
 if($this->forestCtrlVer == STRING_NULL)
  return self::DEFAULT_VER;
 else
  return $this->forestCtrlVer;
}

function setOpenImg(string $actOpenImg):void
{
 $this->openImg = $actOpenImg;
}

function getOpenImg():string
{
 if($this->openImg == STRING_NULL)
  return self::DEFAULT_OPEN_IMG;
 else
  return $this->openImg;
}

function setCloseImg(string $actCloseImg):void
{
 $this->closeImg = $actCloseImg;
}

function getCloseImg():string
{
 if($this->closeImg == STRING_NULL)
  return self::DEFAULT_CLOSE_IMG;
 else
  return $this->closeImg;
}

function setImgDir(string $actImgDir):void
{
 $this->imgDir = $actImgDir;
}

function getImgDir():string
{
 if($this->imgDir == STRING_NULL)
  return self::DEFAULT_IMG_DIR;
 else
  return $this->imgDir;
}

function getMenuVoices():array
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 return  $fieldsDomainsValues[self::VOICES_POS];
}

function setMenuVoices(array $actMenuVoices):void
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 $fieldsDomainsValues[self::VOICES_POS] = $actMenuVoices;
 $this->setDataFieldsDomainsValues($fieldsDomainsValues);
}

function addMenuVoice(string $actMenuVoice):void
{
 $menuVoices = $this->getMenuVoices();
// $num = count($menuVoices);
 $menuVoices[] = $actMenuVoice;
 $this->setMenuVoices($menuVoices);
}

function getMenuPages():array
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 return  $fieldsDomainsValues[self::PAGES_POS];
}

function setMenuPages(array $actMenuPages):void
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 $fieldsDomainsValues[self::PAGES_POS] = $actMenuPages;
 $this->setDataFieldsDomainsValues($fieldsDomainsValues);
}

function addMenuPage(string $actMenuPage):void
{
 $menuPages = $this->getMenuPages();
 $menuPages[] = $actMenuPage;
 $this->setMenuPages($menuPages);
}

function getMenuIds():array
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 return  $fieldsDomainsValues[self::IDS_POS];
}

function setMenuIds(array $actMenuIds):void
{
 $fieldsDomainsValues = $this->getDataFieldsDomainsValues();
 $fieldsDomainsValues[self::IDS_POS] = $actMenuIds;
 $this->setDataFieldsDomainsValues($fieldsDomainsValues);
}

function addMenuId(string $actMenuId):void
{
 $menuIds = $this->getMenuIds();
 $menuIds[] = $actMenuId;
 $this->setMenuIds($menuIds);
}

function resetMenu():void
{
 $this->setMenuVoices(array());
 $this->setMenuPages(array());
 $this->setMenuIds(array());
}	

 function enableBootstrap():void
 {
 }

 function isContainer():bool
 {
  return false;
 }

function putMenuModules():void
{
 $htmlWriter = $this->getHtmlWriter();
 $intCode = $this->getInterfaceId();
 $itemClass = $this->getItemClass();
 $mouseEvent = $this->getMouseEvent();
 $subItemsHtmlType = $this->getSubItemsHtmlType();
 $rootItemHtmlType = $this->getRootItemHtmlType();
 $forestCtrlVer = $this->getForestCtrlVer();
 $num = $this->getNum();
 $openImg = $this->getOpenImg();
 $closeImg = $this->getCloseImg();
 $imgDir = $this->getImgDir();
 $htmlWriter->putGenericHtmlString("var fun = function(){");
 $htmlWriter->putGenericHtmlString("forestCtrlObj$num = util.cloner().clone(forestCtrl" . $forestCtrlVer . ");");
 $htmlWriter->putGenericHtmlString("forestCtrlObj=forestCtrlObj$num;");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setRootId('" . $intCode . "');");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setMouseEvent('" . $mouseEvent . "');");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setItemClass('" . $itemClass . "');");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setRootItemHtmlType('" . $rootItemHtmlType . "');");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setSubItemsHtmlType('" . $subItemsHtmlType . "');");
 if($forestCtrlVer == "2")
 {
  $htmlWriter->putGenericHtmlString("forestCtrlObj.setOpenImg('" . $openImg . "');");
  $htmlWriter->putGenericHtmlString("forestCtrlObj.setCloseImg('" . $closeImg . "');");
  $htmlWriter->putGenericHtmlString("forestCtrlObj.setImgDir('" . $imgDir . "');");
 }
 $htmlWriter->putGenericHtmlString("forestCtrlObj.setObjName('forestCtrlObj$num');");
 $htmlWriter->putGenericHtmlString("forestCtrlObj.putMenu();"); 
 $mouseEvent = 'on' .  $mouseEvent;  
 $htmlWriter->putGenericHtmlString("if(navigator.appName==\"Microsoft Internet Explorer\")");
 $htmlWriter->putGenericHtmlString("{");
 $htmlWriter->putGenericHtmlString("el = document.getElementById('" . 
 $intCode . "');");
 $htmlWriter->putGenericHtmlString("el.$mouseEvent = function(){forestCtrlObj.trigMenu(null)};");
 $htmlWriter->putGenericHtmlString("}};");
 $htmlWriter->putGenericHtmlString("common.getEventStack().push(fun);");
} 

//
// Le classi figlie implementano.
//
abstract function putMenuPars(array $actDataValues):void;

function putHeader(string $actRow=STRING_NULL):void
{
 $htmlWriter = $this->getHtmlWriter();
 $cssClass = $this->getCssClass();
 $mainLabel = $this->getMainLabel();
 $intCode = $this->getInterfaceId();
 $style = $this->getStyle();
 $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
 if($mainLabel != null)
 {
  $htmlWriter->putSpanOpenTag(STRING_NULL,STRING_NULL);
  $htmlWriter->putGenericHtmlString($mainLabel);
  $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
  $htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
 }
 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
}

 function initPutData():array
 {
 }
 
function putJavascriptInitializationCode(string $actPar):void
{
  $htmlWriter = $this->getHtmlWriter();
  $dataValues = $this->initPutData();									 
  $this->putMenuPars($dataValues);
  $htmlWriter->putGenericHtmlString(STRING_ESC_RETURN);
  $this->putMenuModules();
}

function putData():void
{
  $this->putHeader();    
}

}

?>