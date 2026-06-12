<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_bootstrap_navbar extends Html_data_interface
{
 
 const ERROR_1 = "Std_bootstrap_navbar:Errore nell'inserimento dell'interface container.";
 const ERROR_2 = "Std_bootstrap_navbar:Numero campi dati errato.";	
	
 const DEFAULT_CSS_CLASS = "navbar";
 const DEFAULT_HAMBURGER_LINK = "navigation";
 const DEFAULT_IS_THERE_HAMBURGER = false;
 const NAVBAR_EXPAND = "navbar-expand-sm";
 const NAVBAR_LIGHT = "navbar-light";
 const NAVBAR_BRAND = "navbar-brand";
 const COLLAPSE = "collapse";
 const NAVBAR_COLLAPSE = "navbar-collapse";
 const NAVBAR_NAV = "navbar-nav";
 const MR_AUTO = "mr-auto";
 const NAV_LINK = "nav-link";
 const NAV_ITEM = "nav-item";
 const NAVBAR_TOGGLER_ICON = "navbar-toggler-icon";
 const NAVBAR_TOGGLER = "navbar-toggler";
 const NAVBAR_DATA_TOGGLE = "collapse";
 const HAMBURGER_CLASS = "navbar-toggle collapsed";
 const DROPDOWN = "dropdown";
 const DROPDOWN_TOGGLE = "dropdown-toggle";
 const DROPDOWN_MENU = "dropdown-menu";
 const DROPDOWN_MENU_RIGHT = "dropdown-menu-right";
 const DROPDOWN_ITEM = "dropdown-item";
 //const DEFAULT_HAMBURGER_LINK = STRING_CANCELLETTO;
 
 const VOICES_POS = 0;
 const PAGES_POS = 1;
 const IDS_POS = 2;
 const DEFAULT_CSS_MODULE = CSS_BOOTSTRAP_NAVBAR;
 
  private $voicesField = STRING_NULL;
  private $pagesField = STRING_NULL;
  private $idsField = STRING_NULL;
  private $isThereHamburger = self::DEFAULT_IS_THERE_HAMBURGER;
  private $hamburgerLink = self::DEFAULT_HAMBURGER_LINK;
  private $navHeader = STRING_NULL;
  static private $tablesTotNum = 0;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = false;
  static $hasJavascriptManagement = false;
  static $hasCssManagement = true;
     
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_BOOTSTRAP_NAVBAR,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 function getNavHeader():string
 {
 	return $this->navHeader;
 }
 
 function setNavHeader(string $actNavHeader):void
 {
 	$this->navHeader = $actNavHeader;
 }
 
 function enableBootstrap():void
 {
 	$this->setBootstrapEnabled(true);	
 }
 
 function setIsThereHamburger(bool $actIsThereHamburger):void
 {
 	$this->isThereHamburger = $actIsThereHamburger;
 }
 
 function getIsThereHamburger():bool
 {
 	if($this->isThereHamburger==STRING_NULL)
 	 return self::DEFAULT_IS_THERE_HAMBURGER;
 	else
 	 return $this->isThereHamburger;
 }
 
 function setHamburgerLink(string $actHamburgerLink):void
 {
 	$this->hamburgerLink = $actHamburgerLink;
 }
 
 function getHamburgerLink():string
 {
 	if($this->hamburgerLink==STRING_NULL)
 	 return self::DEFAULT_HAMBURGER_LINK;
 	else
 	 return $this->hamburgerLink;
 }
 
 function getBootstrapNavbarVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $bootstrapNavbarVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $bootstrapNavbarVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $bootstrapNavbarVoices;
 }

 function setBootstrapNavbarVoices(array $actBootstrapNavbarVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actBootstrapNavbarVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actBootstrapNavbarVoices);
 } 
 }

 function addBootstrapNavbarVoice(string $actBootstrapNavbarVoice):void
 {
  $bootstrapNavbarVoices = $this->getBootstrapNavbarVoices();
  $bootstrapNavbarVoices[] = $actBootstrapNavbarVoice;
  $this->setBootstrapNavbarVoices($bootstrapNavbarVoices);
 }
 
 function deleteItem(int $actPos):bool
 {
  $voices = $this->getBootstrapNavbarVoices();
  $num = count($voices);
  
  if(($actPos <= $num-1)&&($actPos>=0))
  {
   unset($voices[$actPos]);
   unset($ids[$actPos]);
   for($i=$actPos;$i<=$num-1;$i++)
   {
    $j = $i + 1;
    if($j <= $num-1)
    {
   	 $voices[$i] = $voices[$j];
   	 $ids[$i] = $ids[$j];
    }
    else
    {
   	 unset($voices[$i]);
   	 unset($ids[$i]);
    }
   }
   $this->setBootstrapNavbarVoices($voices);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getBootstrapNavbarVoices();
  return count($voices); 
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tablesTotNum=$actIntNum + 0;
 }
 
 function isStandard():bool
 {
 	return false;
 }

 function serialize():void
 {
	parent::serialize();
	
 	$serializer = $this->getSerializer();
 	$javascriptEnabled = $this->getJavascriptEnabled();
 	$item1 = array("*javascriptEnabled"=>$javascriptEnabled);
 	$serializer->loadItems($item1);
  $voicesField = $this->getVoicesField();
 	$item2 = array("voicesField"=>$voicesField);
 	$serializer->loadItems($item2);
  $pagesField = $this->getPagesField();
 	$item3 = array("pagesField"=>$pagesField);
 	$serializer->loadItems($item3);
  $idsField = $this->getIdsField();
 	$item4 = array("idsField"=>$idsField);
 	$serializer->loadItems($item4);
  $navHeader = $this->getNavHeader();
 	$item5 = array("header"=>$navHeader);
 	$serializer->loadItems($item5);
 	$isThereHamburger = $this->getIsThereHamburger();
 	$item7 = array("*isThereHamburger"=>$isThereHamburger);
 	$serializer->loadItems($item7);
 	$hamburgerLink = $this->getHamburgerLink();
 	$item8 = array("hamburgerLink"=>$hamburgerLink);
 	$serializer->loadItems($item8);	
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }

 function getPagesField():string
 {
 	return $this->pagesField;
 }

 function setPagesField(string $actPagesField):void
 {
 	$this->pagesField = $actPagesField;
 }
 
 function getIdsField():string
 {
 	return $this->idsField;
 } 
 
 function setIdsField(string $actIdsField):void
 {
 	$this->idsField = $actIdsField;
 } 
 
 function isContainer():bool
 {
  return false;
 }
 
 function putNav(array $actDataValues):void
 { 
  $htmlWriter = $this->getHtmlWriter();
 	$dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 3)
   die(self::ERROR_2);
  $intCode = $this->getInterfaceId();
  $voicesField = $this->getVoicesField();
  $pagesField = $this->getPagesField();
  $idsField = $this->getIdsField();
  $navHeader = $this->getNavHeader();
 
  if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;
	$labels = $actDataValues[$labelDataField];
		  
  if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
	{
	 	$pageDataField = $dataFields[self::PAGES_POS];
	}
	else
	 $pageDataField = $pagesField;
	$pages = $actDataValues[$pageDataField];
  
  if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
	{
	 	$idDataField = $dataFields[self::IDS_POS];
	}
	else
	 $idDataField = $idsField;
	$ids = $actDataValues[$idDataField];  
	
  $class0 = self::DEFAULT_CSS_CLASS . STRING_SPACE . 
  self::NAVBAR_EXPAND . STRING_SPACE . 
  self::NAVBAR_LIGHT;
 
  $class1 = 
   //self::COLLAPSE . STRING_SPACE . 
  self::NAVBAR_COLLAPSE . STRING_SPACE;
  
  $class2 = self::NAVBAR_NAV . STRING_SPACE .
  self::MR_AUTO;

  $class3 = self::COLLAPSE . STRING_SPACE . 
  self::NAVBAR_COLLAPSE . STRING_SPACE;
  
    $style = $this->getStyle();
  
  $htmlWriter->putNavOpenTag($intCode,$style,$class0);
  $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,
  self::NAVBAR_BRAND,STRING_CANCELLETTO);
  $htmlWriter->putGenericHtmlString($navHeader);
  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
  
  if($this->getIsThereHamburger())
  {
  	$hamburgerLink = $this->getHamburgerLink();
    $htmlWriter->putDivOpenTag($hamburgerLink,STRING_NULL,$class3);
  	$htmlWriter->putGenericArrayOpenTag(BUTTON_TAG,
  	array("class"=>self::HAMBURGER_CLASS,
  	"type"=>"button","data-target"=>STRING_CANCELLETTO . $hamburgerLink,
  	"data-toggle"=>self::NAVBAR_DATA_TOGGLE,
  	"aria-expanded"=>"false",
  	"aria-controls"=>"navigation",
  	"aria-label"=>"Toggle navigation"));
  	$htmlWriter->putSpanOpenTag(STRING_NULL,self::NAVBAR_TOGGLER_ICON);
  	$htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
  	$htmlWriter->putGenericHtmlString(BUTTON_CLOSE_TAG);
    $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  }
  
  $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,$class1);
  $htmlWriter->putUlOpenTag(STRING_NULL,STRING_NULL,$class2);
  foreach ($labels as $ind=>$label)
  {
//   $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids[$ind];
//	 $pars2 = $pages[$ind] . $pars1;
 
   $class4 = self::NAV_ITEM . 
   ((is_array($label))?(STRING_SPACE . self::DROPDOWN):STRING_NULL);
 
   $htmlWriter->putLiOpenTag(STRING_NULL,STRING_NULL,$class4);
   $class6 = self::NAV_LINK . STRING_SPACE . self::DROPDOWN_TOGGLE;
   $htmlWriter->putGenericArrayOpenTag(ANCHOR_TAG, 
   	 array("class" => $class6,"data-toggle" => self::DROPDOWN,
   	 "role" => "button","aria-haspopup" => "true",
   	 "aria-expanded" => "false","href" => STRING_CANCELLETTO));
   $htmlWriter->putGenericHtmlString(((is_array($label))? $ind : $label));
   $htmlWriter->putSpanOpenTag(STRING_NULL,"caret");
   $htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
   $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG); 
   
   $class5 = self::DROPDOWN_MENU;
   $class5 .= STRING_SPACE . self::DROPDOWN_MENU_RIGHT;

   $id = $ids[$ind];
   $page = $pages[$ind];

   if (is_array($label)&&(is_array($id))&&(is_array($page)))
   {
   	$htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,$class5);
   	foreach($label as $ind1=>$val1)
   	{
   	 $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids[$ind][$ind1];
	   $pars2 = $pages[$ind][$ind1] . $pars1;

   	 $htmlWriter->putHrefOpenTag(STRING_NULL,"color:black;",
   	 self::DROPDOWN_ITEM,$pars2);
   	  $htmlWriter->putGenericHtmlString($val1);
   	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
   	}
   	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
   }
   
   $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
  } 
  $htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  $htmlWriter->putGenericHtmlString(NAV_CLOSE_TAG);
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
	$rows = $this->getDataSource();
  $dataValues = array(); 
  $dataValues = $this->extractDataFromDataSource($rows);
	$this->putNav($dataValues);
 } 
}


?>