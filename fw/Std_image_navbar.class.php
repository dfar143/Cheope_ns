<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_image_navbar extends Html_data_interface
{ 
 const ERROR_1="Std_image_navbar.putData:Numero campi dati errato.";
 const DEFAULT_CSS_CLASS="image_navbar";
 const DEFAULT_CSS_MODULE="image_navbar";
 const DIV_IMAGE_CLASS="bg-img";
 const TITLES_POS=0;
 const PAGES_POS=1;
 const LINKS_POS=2;

 private $gesPage=STRING_NULL;
 private $titlesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $linksField=STRING_NULL;
 static private $nLevelsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = false;
 static $hasCssManagement = true;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$nLevelsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_IMAGE_NAVBAR,$actNum);
  $this->setCSSModule(array(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX));
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
	$titlesField = $this->getTitlesField();
	$item3 = array("titlesField"=>$titlesField);
	$serializer->loadItems($item3);
	$pagesField = $this->getPagesField();
	$item4 = array("pagesField"=>$pagesField);
	$serializer->loadItems($item4);
	$linksField = $this->getLinksField();
	$item5 = array("linksField"=>$linksField);
	$serializer->loadItems($item5);
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
 
 function setTitlesField(string $actTitlesField):void
 {
  $this->menuTitlesField = $actTitlesField;
 }
 
 function getTitlesField():string
 {
  return $this->menuTitlesField;
 }
 
 function setPagesField(string $actPagesField):void
 {
  $this->pagesField = $actPagesField;
 }
 
 function getPagesField():string
 {
  return $this->pagesField;
 }
 
 function setLinksField(string $actLinksField):void
 {
  $this->linksField = $actLinksField;
 }
 
 function getLinksField():string
 {
  return $this->linksField;
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
  
  $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,self::DIV_IMAGE_CLASS);
  $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,"container");
  $htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass);
  $i=0;
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
    $i++;
  }
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
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
 }
 
}


?>