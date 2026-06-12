<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_sidebar extends Html_data_interface
{
 const ERROR_1="Cheope_ns_sidebar.putData:Numero campi dati errato.";
 const TITLES_POS=0;
 const ICONS_NAMES_POS=1;
 const PAGES_POS=2;
 const LINKS_POS=3;
 const DEFAULT_CSS_CLASS="sidebar";
 const DEFAULT_CSS_MODULE="sidebar";

 private $gesPage=STRING_NULL;
 private $titlesField=STRING_NULL;
 private $iconsNamesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $linksField=STRING_NULL;
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

  parent::__construct($actObj,$actOp,self::INT_SIDEBAR,$actNum);
  $this->setCSSModule(array("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
  CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX));
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
 	//$serializer = $this->getSerializer();
	//$booleanPropsArray=array("javascriptEnabled");
	//$this->serialize_props_exec($booleanPropsArray);
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$gesPage = $this->getGesPage();
 	$item1 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item1);
    $titlesField = $this->getTitlesField();
    $item1 = array("titlesField"=>$titlesField);
    $serializer->loadItems($item1);	
    $iconsNamesField = $this->getIconsNamesDataField();
    $item2 = array("iconsNamesField"=>$iconsNamesField);
    $serializer->loadItems($item2);
    $pagesField = $this->getPagesField();
    $item3 = array("pagesField"=>$pagesField);
    $serializer->loadItems($item3);	
    $linksField = $this->getLinksField();
    $item4 = array("linksField"=>$linksField);
    $serializer->loadItems($item4);
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
 
 function getIconsNamesField():string
 {
	return $this->iconsNamesField;
 }
 
 function setIconsNamesField(string $actIconsNamesField):void
 {
	$this->iconsNamesField = $actIconsNamesField; 
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
  if($num < 4)
   die(self::ERROR_1);	

   $titlesField = $this->getTitlesField();
  
   if(($titlesField==STRING_NULL)||(! in_array($titlesField,$dataFields)))
   {
	$titlesField = $dataFields[self::TITLES_POS];
   }

  $titles = $actDataValues[$titlesField];
    
   $iconsNamesField = $this->getIconsNamesField();
  
   if(($iconsNamesField==STRING_NULL)||(! in_array($iconsNamesField,$dataFields)))
   {
	$iconsNamesField = $dataFields[self::ICONS_NAMES_POS];
   }

  $iconsNames = $actDataValues[$iconsNamesField];
  
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

  $i=0;
  $htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass);
  foreach($iconsNames as $ind=>$iconName)
  {
	if(isset($pages[$ind]))
     $page = $pages[$ind];		
	  
	if(isset($links[$ind]))
	 $link = $page . URL_PARS_START . PAR . URL_PAR_EQUAL . $links[$ind];
    else
	 $link = $page;
 
	$link = $page . URL_PARS_START . PAR . URL_PAR_EQUAL . $links[$ind];
	if($i==0)
	{
     $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,"active",$link);
    }
	else
    {
     $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,$link);
	}
    $class = "fa fa-w fa-" . $iconName;
	$htmlWriter->putIOpenTag(STRING_NULL,STRING_NULL,$class);
	$htmlWriter->putGenericHtmlString(I_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString($titles[$i]);
    $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
    $i++;	
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
 }
 
}


?>