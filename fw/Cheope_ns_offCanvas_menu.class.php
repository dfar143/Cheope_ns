<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_offCanvas_menu extends Html_data_interface
{
 const ERROR_1="Cheope_ns_offCanvas_menu.putData:Numero campi dati errato.";
 const TITLES_POS=0;
 const PAGES_POS=1;
 const LINKS_POS=2;
 const DEFAULT_CSS_CLASS="offCanvas";
 const DEFAULT_CSS_MODULE="offCanvas";
 const DEFAULT_JAVASCRIPT_MODULE_1 = "offCanvas";

 private $gesPage=STRING_NULL;
 private $titlesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $linksField=STRING_NULL;
 private $isThereOpenButton=true;
 private $openButtonString=STRING_NULL;
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

  parent::__construct($actObj,$actOp,self::INT_OFFCANVAS_MENU,$actNum);
  $this->setCSSModule(array(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX));
  $this->setJavascriptModule(CLIENT_OFFCANVAS_CODE_PATH . DIR_SEP . JS_OFFCANVAS . namespace\JAVASCRIPT_SOURCE_FILE_POSTFIX);
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
    $titlesField = $this->getTitlesDataField();
    $item2 = array("titlesField"=>$titlesField);
    $serializer->loadItems($item2);
    $pagesField = $this->getPagesField();
    $item3 = array("pagesField"=>$pagesField);
    $serializer->loadItems($item3);	
    $linksField = $this->getLinksField();
    $item4 = array("linksField"=>$linksField);
    $serializer->loadItems($item4);
	$isThereOpenButton = $this->getIsThereOpenButton();
	$item5 = array("isThereOpenButton"=>$isThereOpenButton);
	$serializer->loadItems($item5);
	$openButtonString = $this->getOpenButtonString();
	$item6 = array("openButtonString"=>$openButtonString);
    $serializer->loadItems($item6);	
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item6 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item6);
 }
 
 function getTitlesField():string
 {
	return $this->titlesField;
 }
 
 function setTitlesField(string $actTitlesField):void
 {
	$this->titlesField = $actTitlesField; 
 }
 
 function getPagesField():string
 {
	return $this->pagesField;
 }
 
 function setPagesField(string $actPagesField):void
 {
	$this->pagesField = $actPagesField; 
 }
 
 
 function getLinksField():string
 {
	return $this->linksField;
 }
 
 function setLinksField(string $actLinksField):void
 {
	$this->linksField = $actLinksField; 
 }
 
 function getIsThereOpenButton():bool
 {
  return $this->isThereOpenButton;
 }
 
 function setIsThereOpenButton(bool $actIsThereOpenButton):void
 {
  $this->isThereOpenButton = $actIsThereOpenButton;
 }
 
 function getOpenButtonString():string
 {
  return $this->openButtonString;
 }
 
 function setOpenButtonString(string $actOpenButtonString):void
 {
	$this->openButtonString = $actOpenButtonString;
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

 function putMenu(array $actDataValues):void
 {
  $htmlWriter = $this->getHtmlWriter();
  $page = $this->getGesPage();
  $dataFields = $this->getDataFields(); 
  $cssClass = $this->getCssClass();
  $style = $this->getStyle();
  
  $num = count($dataFields);
  if($num < 3)
   die(self::ERROR_1);	
    
   $titlesField = $this->getTitlesField();
  
   if(($titlesField==STRING_NULL)||(! in_array($titlesField,$dataFields)))
   {
	$titlesField = $dataFields[self::TITLES_POS];
   }

  $titles = $actDataValues[$titlesField];

  $pagesField = $this->getPagesField();
  
   if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
   {
	$pagesField = $dataFields[self::PAGES_POS];
   }

  $pages = $actDataValues[$pagesField];
  
  $linksField = $this->getLinksField();
  
   if(($linksField==STRING_NULL)||(! in_array($linksField,$dataFields)))
   {
	$linksField = $dataFields[self::LINKS_POS];
   }

  $links = $actDataValues[$linksField];

  $htmlWriter->putDivOpenTag("offCanvas",$style,$cssClass);
  $i=0;
  $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,"closebtn","javascript:void(0)",STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,"offCanvas_closeNav()");
  $htmlWriter->putGenericHtmlString("&times;");
  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
  foreach($titles as $ind=>$title)
  {    
     if(isset($pages[$ind]))		
	  $page = $pages[$ind];	
	 if(isset($links[$ind]))
	  $link = $page . URL_PARS_START . PAR . URL_PAR_EQUAL . $links[$ind];
     else
	  $link = $page;
    	
	 $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,$link);
     $htmlWriter->putGenericHtmlString($title);
     $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);	
  }
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
  $rows = $this->getDataSource();
  $dataValues = array(); 
  $dataValues = $this->extractDataFromDataSource($rows);
  $this->putMenu($dataValues);
  $isThereOpenButton = $this->getIsThereOpenButton();
  $openButtonString = $this->getOpenButtonString();
  $htmlWriter = $this->getHtmlWriter();
  if($isThereOpenButton)
  { 
   $htmlWriter->putSpanOpenTag(STRING_NULL,STRING_NULL,"offCanvas_openNav()");
   $htmlWriter->putGenericHtmlString($openButtonString);
   $htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
  }
 }
 
}


?>