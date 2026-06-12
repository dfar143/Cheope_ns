<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");

//
// Menu di ancore
//

class Std_level_menu extends Html_data_interface
{	
	
 const ERROR_1="Std_level_menu.putData:Numero campi dati errato.";
 const DEFAULT_CSS_CLASS="level_menu";
 const DEFAULT_ITEMS_CSS_CLASS="level_menu_items";
 const DEFAULT_CSS_MODULE=CSS_LEVEL_MENU;
 const ITEM_LABEL_ID_SUFFIX="item_label";
 const SEP_CHAR=STRING_MINUS;
 const SEP_STRING_DIM=10;
 const ROOT_TAG_ID_SUFFIX="root";
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 
 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL; 
 private $mainLabel=STRING_NULL;
 private $itemsClass=self::DEFAULT_ITEMS_CSS_CLASS;
 private $sepString=self::SEP_CHAR;
 private $gesPage=STRING_NULL;
 static private $levelMenusTotNum=0;
 static $hasCssManagement=true;

function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
 self::$levelMenusTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$levelMenusTotNum - 1;

 parent::__construct($actObj,$actOp,self::INT_LEVEL_MENU,$actNum);
 $sepString = self::SEP_CHAR;
 for ($i=0;$i<=self::SEP_STRING_DIM-1;$i++)
  $sepString = $sepString . self::SEP_CHAR;
 $this->setSepString($sepString); 
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
 	$mainLabel = $this->getMainLabel();
 	$item1 = array("mainLabel"=>$mainlabel);
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
 	$itemsClass = $this->getItemsClass();
 	$item5 = array("itemsClass"=>$itemsClass);
 	$serializer->loadItems($item5);	
 	$sepString = $this->getSepString();
 	$item6 = array("sepString"=>$sepString);
 	$serializer->loadItems($item6);
 	$gesPage = $this->getGesPage();	
 	$item7 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item7);	
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

function setGesPage(string $actGesPage):void
{
 $this->gesPage = $actGesPage;
}

function getGesPage():string
{
 return $this->gesPage;
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
  return self::DEFAULT_ITEMS_CSS_CLASS;
 else
  return $this->itemsClass;
}

function setSepString(string $actSepString):void
{
 $this->sepString = $actSepString;
}

function getSepString():string
{
 if($this->sepString == STRING_NULL)
  return self::SEP_CHAR;
 else
  return $this->sepString;
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

function setSepPos(int $actPos):void
{
 $sepString = $this->getSepString();
 
 $menuVoices = $this->getMenuVoices();
 $menuPages = $this->getMenuPages();
 $menuIds = $this->getMenuIds();
 
 $num = count($menuVoices);
 $newMenuVoices = array();
 $newMenuPages = array();
 $newMenuIds = array();
 
 $j=0;
 
 for($i=0;$i<=$num-1;$i++)
 {
  if($i==$actPos)
	{
	 $newMenuVoices[$j] = $sepString;
   $newMenuPages[$j] = STRING_NULL;
   $newMenuIds[$j] = STRING_NULL;	
	 $j++;
	}
	$newMenuVoices[$j] = $menuVoices[$i];
  $newMenuPages[$j] = $menuPages[$i];
  $newMenuIds[$j] = $menuIds[$i];	
	$j++;
 }
 $this->setMenuVoices($newMenuVoices);
 $this->setMenuPages($newMenuPages);
 $this->setMenuIds($newMenuIds);
}

function delSep():void
{

 $sepString = $this->getSepString();
 
 $menuVoices = $this->getMenuVoices();
 $menuPages = $this->getMenuPages();
 $menuIds = $this->getMenuIds();
 
 $num = count($menuVoices);
 $newMenuVoices = array();
 $newMenuPages = array();
 $newMenuIds = array();
 
 $j=0;
 
 for($i=0;$i<=$num-1;$i++)
 {
  if($menuVoices[$i] != $sepString)
	{
	 $newMenuVoices[$j] = $menuVoices[$i];
   $newMenuPages[$j] = $menuPages[$i];
   $newMenuIds[$j] = $menuIds[$i];	
	 $j++;
	}
 }
 $this->setMenuVoices($newMenuVoices);
 $this->setMenuPages($newMenuPages);
 $this->setMenuIds($newMenuIds);
}

function deleteItem(int $actPos):bool
{
 $voices = $this->getMenuVoices();
 $pages = $this->getMenuPages();
 $ids = $this->getMenuIds();
 $num = count($voices);
 
 if(($actPos <= $num-1)&&($actPos>=0))
 {
  unset($voices[$actPos]);
  unset($pages[$actPos]);
  unset($ids[$actPos]);

  for($i=$actPos;$i<=$num-1;$i++)
  {
 	 $j=$i+1;
 	 if($j<=$num-1)
 	 {
 	  $voices[$i] = $voices[$j];
 	  $pages[$i] = $pages[$j];
 	  $ids[$i] = $ids[$j];
 	 }
 	 else
 	 {
 	  unset($voices[$i]);
 	  unset($pages[$i]);
 	  unset($ids[$i]);
 	 }
 	}
 	$this->setMenuVoices($voices);
 	$this->setMenuPages($pages);
 	$this->setMenuIds($ids);
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
 /*$this->setMenuVoices(array());
 $this->setMenuPages(array());
 $this->setMenuIds(array());*/
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
 $intCode = $this->getInterfaceId();
 $page = $this->getGesPage();
 $dataFields = $this->getDataFields();
 $num = count($dataFields);
 if($num < 3)
  die(self::ERROR_1);	
 $style = $this->getStyle();
 $cssClass = $this->getCssClass();
 $mainLabel = $this->getMainLabel();
 $itemsClass = $this->getItemsClass();
 
 $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
 if($mainLabel != STRING_NULL)
  $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG . $mainLabel . SEP_OPEN_TAG);
 $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,$itemsClass);
	
  $voicesField = $this->getVoicesField();
  $pagesField = $this->getPagesField();
  $idsField = $this->getIdsField();
  
	if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelsDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelsDataField = $voicesField;
	$labels = $actDataValues[$labelsDataField];	  
  
	if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
	{
	 	$pagesDataField = $dataFields[self::PAGES_POS];
	}
	else
	 $pagesDataField = $pagesField;
	$pages = $actDataValues[$pagesDataField];

	if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
	{
	 	$idsDataField = $dataFields[self::IDS_POS];
	}
	else
	 $idsDataField = $idsField;
	$ids = $actDataValues[$idsDataField];
  
 $num = count($labels);
 for($j=0;$j<=$num-1;$j++)
 {
	$pars1 = STRING_NULL;
	$pars2 = STRING_NULL;
	
	if(is_array($ids) && isset($ids[$j]) && ($ids[$j]!=STRING_NULL))
	 $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids[$j];
	elseif(! is_array($ids))
	 $pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $ids;
	 
	if(is_array($pages) && isset($pages[$j]) && ($pages[$j]!=STRING_NULL))
	 $pars2 = $pages[$j] . $pars1;
	elseif($page != STRING_NULL)
	 $pars2 = $page . $pars1;
	else
	 $pars2 = STRING_NULL;

  if(is_array($labels) && isset($labels[$j]))
   $label = $labels[$j];
  else
   $label = STRING_NULL;
	
  $sepString = $this->getSepString();
	if(($labels[$j] == self::SEP_CHAR)||($labels[$j]==$sepString))
	{
	 $label = $sepString;
    $htmlWriter->putGenericHtmlString($label);	
	}
	else
	{
	 if($pars2 != STRING_NULL)
	 {
	  $htmlWriter->putHrefOpenTag($intCode . VAR_SEP . 
	  self::ITEM_LABEL_ID_SUFFIX . VAR_SEP . $j,STRING_NULL,STRING_NULL,$pars2);
	  $htmlWriter->putGenericHtmlString($label);
	  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	 }
	 else
	  $htmlWriter->putGenericHtmlString($label);
	}	 

	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
 }
 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
 if($mainLabel != STRING_NULL)
 $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
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