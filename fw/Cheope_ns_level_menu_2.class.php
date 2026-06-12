<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("html.fun.php");
require_once("cheope_ns.fun.php");

//
// Menu a lista
//

class Cheope_ns_level_menu_2 extends Html_data_interface
{
 
 const ERROR_1="Cheope_ns_level_menu_2.putData:Numero campi dati errato.";
 const DEFAULT_CSS_CLASS="level_menu_2";
 const DEFAULT_CSS_MODULE=CSS_LEVEL_MENU_2;
 const ITEMS_CSS_CLASS="level_menu_2_items";
 const ITEM_LABEL_ID_SUFFIX="itemLabel";
 const ITEM_ANCHOR_ID_SUFFIX="itemAnchor";
 const ROOT_TAG_ID_SUFFIX="root";
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 const TARGETS_POS=3;
 const ONCLICKS_POS=4;

 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL; 
 private $targetsField=STRING_NULL;
 private $onClicksField=STRING_NULL;
 private $mainLabel=STRING_NULL;
 private $itemsClass=self::ITEMS_CSS_CLASS;
 private $ordered=false;
 private $gesPage=STRING_NULL;
 private $target=STRING_NULL;
 static private $levelMenusTotNum=0;
 static $hasCssManagement=true;
 
function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
 self::$levelMenusTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$levelMenusTotNum - 1;
 parent::__construct($actObj,$actOp,self::INT_LEVEL_MENU_2,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
}

	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}

 static function getInterfacesTotNum():string|int
 {
 	return self::$levelMenusTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$levelMenusTotNum=$actIntNum + 0;
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
  $voicesField = $this->getVoicesField();
 	$item2 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item2);
  $pagesField = $this->getPagesField();
 	$item3 = array("pagesField"=>$pagesField);
  $serializer->loadItems($item3);
  $idsField = $this->getIdsField();
 	$item4 = array("idsField"=>$idsField);
  $serializer->loadItems($item4);
  $targetsField = $this->getTargetsField();
 	$item5 = array("targetsField"=>$targetsField);
  $serializer->loadItems($item5); 
  $onClicksField = $this->getOnClicksField();
 	$item6 = array("onClicksField"=>$onClicksField);
  $serializer->loadItems($item6);	 	 	
 	$itemsClass = $this->getItemsClass();
 	$item7 = array("itemsClass"=>$itemsClass);
 	$serializer->loadItems($item7);	
 	$ordered = $this->getOrdered();
 	$item8 = array("*ordered"=>$ordered);
 	$serializer->loadItems($item3);
 	$gesPage = $this->getGesPage();	
 	$item9 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item9);	
 	$target = $this->getTarget();	
 	$item10 = array("target"=>$target);
 	$serializer->loadItems($item10);
 }

 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }
 
 function setPagesField(string $actPagesField):void
 {
 	$this->pagesField = $actPagesField;
 }
 
 function getPagesField():string
 {
 	return $this->pagesField;
 }
 
 function setIdsField(string $actIdsField):void
 {
 	$this->idsField = $actIdsField;
 }
 
 function getIdsField():string
 {
 	return $this->idsField;
 }
 
 function setTargetsField(string $actTargetsField):void
 {
 	$this->targetsField = $actTargetsField;
 }
 
 function getTargetsField():string
 {
 	return $this->targetsField;
 }
 
 function setOnClicksField(string $actOnClicksField):void
 {
 	$this->onClicksField = $actOnClicksField;
 }
 
 function getOnClicksField():string
 {
 	return $this->onClicksField;
 }

function setGesPage(string $actGesPage):void
{
 $this->gesPage = $actGesPage;
}

function getGesPage():string
{
 return $this->gesPage;
}

function setTarget(string $actTarget):void
{
 $this->target = $actTarget;
}

function getTarget():string
{
 return $this->target;
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
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
}

function setItemsClass(string $actItemClass):void
{
 $this->itemsClass = $actItemClass;
}

function getItemsClass():string
{
 if($this->itemsClass == STRING_NULL)
  return self::ITEMS_CSS_CLASS;
 else
  return $this->itemsClass;
}

function setOrdered(bool $actOrdered):void
{
	$this->ordered = $actOrdered;
}

function getOrdered():bool
{
	return $this->ordered;
}

function getMenuVoices():array
{
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $menuVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $menuVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $menuVoices;
}

function setMenuVoices(array $actMenuVoices):void
{
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actMenuVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actMenuVoices);
 }
}

function addMenuVoice(string $actMenuVoice):void
{
 $menuVoices = $this->getMenuVoices();
 $menuVoices[] = $actMenuVoice;
 $this->setMenuVoices($menuVoices);
}

function getMenuPages():array
{
 $dataFields = $this->getDataFields();
 $pagesField = $this->getPagesField();
  
 if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
 {
	 $menuPages = $this->getDataFieldDomainValueByPos(self::PAGES_POS);
 }
 else
 {
	$pagesDataField = $pagesField;
  $menuPages = $this->getDataFieldDomainValueByName($pagesDataField);
 }
 return $menuPages;
}

function setMenuPages(array $actMenuPages):void
{
 $dataFields = $this->getDataFields();
 $pagesField = $this->getPagesField();
  
 if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::PAGES_POS,$actMenuPages);
 }
 else
 {
	$pagesDataField = $pagesField;
  $this->setDataFieldDomainValueByName($pagesDataField,$actMenuPages);
 }
}

function addMenuPage(string $actMenuPage):void
{
 $menuPages = $this->getMenuPages();
 $menuPages[] = $actMenuPage;
 $this->setMenuPages($menuPages);
}

function getMenuIds():array
{
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
	 $menuIds = $this->getDataFieldDomainValueByPos(self::IDS_POS);
 }
 else
 {
	$idsDataField = $idsField;
  $menuIds = $this->getDataFieldDomainValueByName($idsDataField);
 }
 return $menuIds;
}

function setMenuIds(array $actMenuIds):void
{
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::IDS_POS,$actMenuIds);
 }
 else
 {
	$idsDataField = $idsField;
  $this->setDataFieldDomainValueByName($idsDataField,$actMenuIds);
 }
}

function addMenuId(string $actMenuId):void
{
 $menuIds = $this->getMenuIds();
 $menuIds[] = $actMenuId;
 $this->setMenuIds($menuIds);
}

function getMenuTargets():array
{
 $dataFields = $this->getDataFields();
 $targetsField = $this->getTargetsField();
  
 if(($targetsField==STRING_NULL)||(! in_array($targetsField,$dataFields)))
 {
	 $menuTargets = $this->getDataFieldDomainValueByPos(self::TARGETS_POS);
 }
 else
 {
	$targetsDataField = $targetsField;
  $menuTargets = $this->getDataFieldDomainValueByName($targetsDataField);
 }
 return $menuTargets;
}

function setMenuTargets(array $actMenuTargets):void
{
 $dataFields = $this->getDataFields();
 $targetsField = $this->getTargetsField();
  
 if(($targetsField==STRING_NULL)||(! in_array($targetsField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::TARGETS_POS,$actMenuTargets);
 }
 else
 {
	$targetsDataField = $targetsField;
  $this->setDataFieldDomainValueByName($targetsDataField,$actMenuTargets);
 }
}

function addMenuTarget(string $actMenuTarget):void
{
 $menuTarget = $this->getMenuTargets();
 $menuTargets[] = $actMenuTarget;
 $this->setMenuTargets($menuTargets);
}

function getMenuOnClicks():array
{
 $dataFields = $this->getDataFields();
 $onClicksField = $this->getOnClicksField();
  
 if(($onClicksField==STRING_NULL)||(! in_array($onClicksField,$dataFields)))
 {
	 $menuOnClicks = $this->getDataFieldDomainValueByPos(self::ONCLICKS_POS);
 }
 else
 {
	$onClicksDataField = $onClicksField;
  $menuOnClicks = $this->getDataFieldDomainValueByName($onClicksDataField);
 }
 return $menuOnClicks;
}

function setMenuOnClicks(array $actMenuOnClicks):void
{
 $dataFields = $this->getDataFields();
 $onClicksField = $this->getOnClicksField();
  
 if(($onClicksField==STRING_NULL)||(! in_array($onClicksField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::TARGETS_POS,$actMenuOnClicks);
 }
 else
 {
	$onClicksDataField = $onClicksField;
  $this->setDataFieldDomainValueByName($onClicksDataField,$actMenuOnClicks);
 }
}

function addMenuOnClick(string $actMenuOnClick):void
{
 $menuOnClicks = $this->getMenuOnClicks();
 $menuOnClicks[] = $actMenuOnClick;
 $this->setMenuOnClicks($menuOnClicks);
}

function deleteItem(int $actPos):bool
{
 $voices = $this->getMenuVoices();
 $pages = $this->getMenuPages();
 $ids = $this->getMenuIds();
 $targets = $this->getMenuTargets();
 $onClicks = $this->getMenuOnClicks();
 $num = count($voices);
 
 if(($actPos <= $num-1)&&($actPos>=0))
 {
  unset($voices[$actPos]);
  unset($pages[$actPos]);
  unset($ids[$actPos]);
  unset($targets[$actPos]);
  unset($onClicks[$actPos]);
  
  for($i=$actPos;$i<=$num-1;$i++)
  {
 	 $j=$i+1;
 	 if($j<=$num-1)
 	 {
 	  $voices[$i] = $voices[$j];
 	  $pages[$i] = $pages[$j];
 	  $ids[$i] = $ids[$j];
 	  $targets[$i] = $targets[$j];
 	  $onClicks[$i] = $onClicks[$j];
 	 }
 	 else
 	 {
 	  unset($voices[$i]);
 	  unset($pages[$i]);
 	  unset($ids[$i]);
 	  unset($targets[$i]);
 	  unset($onClicks[$i]);
 	 }
 	}
  $this->setMenuVoices($voices);
  $this->setMenuPages($pages);
  $this->setMenuIds($ids);
  $this->setMenuTargets($targets);
  $this->setMenuOnClicks($onClicks);
 }
 else
  return false;
 return true;
}

function getNumItems():int
{
 $voices = $this->getMenuVoices();
 return count($voices); 
}

function resetMenu():void
{
 $voices = $this->getNumItems();
 $num = count($voices);
 for($i=0;$i<=$num-1;$i++)
  $this->deleteItem(0);
}

 function isContainer():bool
 {
  return false;
 }

// L'argomento $actData è un'array avente tre elementi: il primo elemento sono le etichette,
// il secondo contiene tutte le pagine puntate dalle etichette ed il terzo sono
// gli id associati alle etichette; 
// Questi ultimi servono per comporre gli url di chiamata alle pagine corrispondenti.
//
function putMenu(array $actDataValues):void
{
 $htmlWriter = $this->getHtmlWriter();
 $page = $this->getGesPage();
 $target = $this->getTarget();
 $dataFields = $this->getDataFields(); 

 $num = count($dataFields);
 if($num < 5)
  die(self::ERROR_1);	
    
  $voicesField = $this->getVoicesField();
  $pagesField = $this->getPagesField();
  $idsField = $this->getIdsField();
  $targetsField = $this->getTargetsField();
  $onClicksField = $this->getOnClicksField();
  
	if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;
	$labels = $actDataValues[$labelDataField];	
    //print_r($labels);	
  
	if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
	{
	 	$pageDataField = $dataFields[self::PAGES_POS];
	}
	else
	 $pageDataField = $pagesField;
	$pages = $actDataValues[$pageDataField];
   // print_r($pages);

	if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
	{
	 	$idDataField = $dataFields[self::IDS_POS];
	}
	else
	 $idDataField = $idsField;
	$ids = $actDataValues[$idDataField];
	//print_r($ids);
  
 if(($targetsField==STRING_NULL)||(! in_array($targetsField,$dataFields)))
 {
  $targetsDataField = $dataFields[self::TARGETS_POS];
 }
 else
  $targetsDataField = $targetsField;
 $targets = $actDataValues[$targetsDataField];
	//print_r($targets); 
 if(($onClicksField==STRING_NULL)||(! in_array($onClicksField,$dataFields)))
 {
  $onClicksDataField = $dataFields[self::ONCLICKS_POS];
 }
 else
  $onClicksDataField = $onClicksField;
 $onClicks = $actDataValues[$onClicksDataField];
	//print_r($onClicks);
 $cssClass = $this->getCssClass();
 $mainLabel = $this->getMainLabel();
 $intCode = $this->getInterfaceId();
 $style = $this->getStyle();
 $itemsClass = $this->getItemsClass();
 
 $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
 if($mainLabel != STRING_NULL)
  $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG . $mainLabel . SEP_OPEN_TAG);
 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "menu",STRING_NULL,$itemsClass);
 
 $num = count($labels);
 $ordered = $this->getOrdered();

 if($ordered)
  $htmlWriter->putOlOpenTag($intCode .  VAR_SEP . "menu" . VAR_SEP . "inner");
 else
  $htmlWriter->putUlOpenTag($intCode .  VAR_SEP . "menu" . VAR_SEP . "inner");

 for($j=0;$j<=$num-1;$j++)
 {
	$pars1 = STRING_NULL;
	$pars2 = STRING_NULL;
	
	if(is_array($ids) && isset($ids[$j]) && ($ids[$j] != STRING_NULL))
	 $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids[$j];
	elseif(! is_array($ids))
	 $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids;
	else
	 $pars1 = STRING_NULL;
	 	
	if(is_array($pages) && isset($pages[$j]) && ($pages[$j]!=STRING_NULL))
	 $pars2 = $pages[$j] . $pars1;
	elseif($page != STRING_NULL)
	 $pars2 = $page . $pars1;
	else
	 $pars2 = STRING_NULL;
	 
	if(is_array($targets) && isset($targets[$j]))
   $target = $targets[$j];
      
  if(is_array($onClicks) && isset($onClicks[$j]))
   $onClick = $onClicks[$j];
  else
   $onClick = STRING_NULL; 
   
  if(is_array($labels) && isset($labels[$j]))
   $label = $labels[$j];
  else
   $label = STRING_NULL;

	$htmlWriter->putLiOpenTag($intCode . VAR_SEP . 
	self::ITEM_LABEL_ID_SUFFIX . VAR_SEP . $j);
	if($pars2 != STRING_NULL)
	{
	 $htmlWriter->putHrefOpenTag($intCode . VAR_SEP . 
	 self::ITEM_ANCHOR_ID_SUFFIX . VAR_SEP . $j,STRING_NULL,STRING_NULL,
	 $pars2,$target,STRING_NULL,STRING_NULL,STRING_NULL,$onClick);
	 $htmlWriter->putGenericHtmlString($label);
	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
  }
  else
   $htmlWriter->putGenericHtmlString($label);
  $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
 }
 if($ordered)
  $htmlWriter->putGenericHtmlString(OL_CLOSE_TAG);
 else
  $htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);
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
 //print_r($dataValues);
 $this->putMenu($dataValues);
}

}

?>