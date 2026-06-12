<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("http.const.php");
require_once("javascript.fun.php");
require_once("std.fun.php");


class Std_curtain_menu extends Html_data_interface 
{
 
  const ERROR_1="Std_curtain_menu:Numero campi dati errato.";
  const DEFAULT_VOICE_ITEM_CSS_CLASS = "curtain_menu_voice_item";
  const DEFAULT_IMG_ITEM_CSS_CLASS = "curtain_menu_img_item";
	const DEFAULT_CSS_CLASS="curtain_menu";
	const DEFAULT_ITEMS_IMG_SRC=THIS_DIR . DIR_SEP . "Img" . DIR_SEP . "menuItems.jpg";
  const DEFAULT_JAVASCRIPT_MODULE=JS_FADE;
  const DEFAULT_CSS_MODULE=CSS_CURTAIN_MENU;	
	const MENU_ITEM_LABEL_ID_SUFFIX="menuItemLabel";
	const MENU_ITEM_IMG_ID_SUFFIX="menuItemImg";
	const BODY_WIDTH="100%";	
	const VOICES_POS=0;
	const PAGES_POS=1;
	const IDS_POS=2;	
	const DEFAULT_FADE_FPS=FADE_FPS;
	const DEFAULT_FADE_DURATION=FADE_DURATION;
	const DEFAULT_BGCOLOR="#290094";
	const DEFAULT_FADE_TO_COLOR=FADE_TO_COLOR;
	
  private $voicesField=STRING_NULL;
  private $pagesField=STRING_NULL;
  private $idsField=STRING_NULL;
  private $voiceItemClass=self::DEFAULT_VOICE_ITEM_CSS_CLASS;
  private $imgItemClass=self::DEFAULT_IMG_ITEM_CSS_CLASS;
  private $itemsImgSrc=self::DEFAULT_ITEMS_IMG_SRC;
  private $fadeFps = self::DEFAULT_FADE_FPS;
  private $fadeDuration = self::DEFAULT_FADE_DURATION;
  private $fadeFromColor = self::DEFAULT_BGCOLOR;
  private $fadeToColor = self::DEFAULT_FADE_TO_COLOR;
  static private $curtainMenusTotNum=0;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = true;
  static $hasJavascriptManagement = true;
 	static $hasCssManagement=true;  

function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
	self::$curtainMenusTotNum++;
 	if($actNum === STRING_NULL)
 	 $actNum = self::$curtainMenusTotNum - 1;  
  parent::__construct($actObj,$actOp,self::INT_CURTAIN_MENU,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCssModule(array(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX));  
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
 	return self::$curtainMenusTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$curtainMenusTotNum=$actIntNum + 0;
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
 	$voiceItemClass = $this->getVoiceItemClass();	
 	$item5 = array("voiceItemClass"=>$voiceItemClass);
 	$serializer->loadItems($item5);	
 	$imgItemClass = $this->getImgItemClass();	
 	$item6 = array("imgItemClass"=>$imgItemClass);
 	$serializer->loadItems($item6);	
 	$itemsImgSrc = $this->getItemsImgSrc();
 	$item7 = array("itemsImgSrc"=>$itemsImgSrc);
 	$serializer->loadItems($item7);	
 	$fadeFps = $this->getFadeFps();
 	$item8 = array("fadeFps"=>$fadeFps);
 	$serializer->loadItems($item8);
 	//$javascriptEnabled = $this->getJavascriptEnabled();	
 	//$item9 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item9);
 	$fadeDuration = $this->getFadeDuration();
 	$item10 = array("fadeDuration"=>$fadeDuration);
 	$serializer->loadItems($item10);
 	$fadeFromColor = $this->getFadeFromColor();
 	$item11 = array("fadeFromColor"=>$fadeFromColor);
 	$serializer->loadItems($item11);
 	$fadeToColor = $this->getFadeToColor();
 	$item12 = array("fadeToColor"=>$fadeToColor);
 	$serializer->loadItems($item12);
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
 

 function getFadeFps():int
 {
 	if($this->fadeFps == NO_VALUE)
 	 return self::DEFAULT_FADE_FPS;
 	else
 	 return $this->fadeFps;
 }
 
 function setFadeFps(int $actFadeFps):void
 {
 	$this->fadeFps = $actFadeFps;
 }
 
 function getFadeDuration():int
 {
 	if($this->fadeDuration == NO_VALUE)
 	 return self::DEFAULT_FADE_DURATION;
 	else
 	 return $this->fadeDuration;
 }
 
 function setFadeDuration(int $actFadeDuration):void
 {
 	$this->fadeDuration = $actFadeDuration;
 }
 
 function getFadeFromColor():string
 {
 	if($this->fadeFromColor == STRING_NULL)
 	 return self::DEFAULT_BGCOLOR;
 	else
 	 return $this->fadeFromColor;
 }
 
 function setFadeFromColor(string $actFadeFromColor):void
 {
 	$this->fadeFromColor = $actFadeFromColor;
 }

 function getFadeToColor():string
 {
 	if($this->fadeToColor == STRING_NULL)
 	 return  self::DEFAULT_FADE_TO_COLOR;
 	else
 	 return $this->fadeToColor;
 }
 
 function setFadeToColor(string $actFadeToColor):void
 {
 	$this->fadeToColor = $actFadeToColor;
 }


function getCssClass():string
{
 if ($this->cssClass==STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
}

function setImgItemClass(string $actImgItemClass):void
{
 $this->imgItemClass = $actImgItemClass;
}

function getImgItemClass():string
{
 if($this->imgItemClass == STRING_NULL)
  return self::DEFAULT_IMG_ITEM_CSS_CLASS;
 else
  return $this->imgItemClass;
}

function setVoiceItemClass(string $actVoiceItemClass):void
{
 $this->voiceItemClass = $actVoiceItemClass;
}

function getVoiceItemClass():string
{
 if($this->voiceItemClass == STRING_NULL)
  return self::DEFAULT_VOICE_ITEM_CSS_CLASS;
 else
  return $this->voiceItemClass;
}

function setItemsImgSrc(string $actImgSrc):void
{
 $this->itemsImgSrc = $actImgSrc;
}

function getItemsImgSrc():string
{
 if ($this->itemsImgSrc == STRING_NULL)
  return self::DEFAULT_ITEMS_IMG_SRC;
 else
  return $this->itemsImgSrc; 
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
 $num = $this->getNumItems();
 for($i=0;$i<=$num-1;$i++)
  $this->deleteItem(0);
}

 function isContainer():bool
 {
  return false;
 }
 

// Il primo contiene un'array con le etichette.
// Il secondo contiene un array con tutte le pagine puntate dalle etichette.
// Il terzo contiene i parametri associati alle etichette.
// Queste chiavi servono per comporre gli url di chiamata alle pagine corrispondenti.
//
function putCurtainMenu(array $actDataValues):void
{
 $htmlWriter = $this->getHtmlWriter();
 $dataFields = $this->getDataFields();
 $num = count($dataFields);
 if($num < 3)
   die(self::ERROR_1);
 $menuBodyId = $this->getInterfaceId();
 $cssClass = $this->getCssClass();
 $style = $this->getStyle();	
 $htmlWriter->putDivOpenTag($menuBodyId,$style,$cssClass,STRING_NULL);
 $imgItemClass = $this->getImgItemClass();
 $voiceItemClass = $this->getVoiceItemClass();
 $itemsImgSrc = $this->getItemsImgSrc();
 
  $voicesField = $this->getVoicesField();
  $pagesField = $this->getPagesField();
  $idsField = $this->getIdsField();
  
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

 $javascriptEnabled = $this->getJavascriptEnabled(); 	
 $fadeFps = $this->getFadeFps();
 $fadeDuration = $this->getFadeDuration();
 $fadeFromColor = $this->getFadeFromColor();
 $fadeToColor = $this->getFadeToColor(); 
 
 $htmlWriter->putTableOpenTag($menuBodyId . VAR_SEP . "inner_table",STRING_NULL,
 self::BODY_WIDTH);
 foreach($labels as $ind => $val)
 {
 	if((isset($ids[$ind]))&&($ids[$ind]!=STRING_NULL))
	 $pars = URL_PARS_START . PAR . URL_PAR_EQUAL .  $ids[$ind];
	else
	 $pars = STRING_NULL;
	 
	$htmlWriter->putTableRowOpenTag($menuBodyId . VAR_SEP . "row" . VAR_SEP . $ind);
	$htmlWriter->putTableColumnOpenTag($menuBodyId . VAR_SEP . "row" . VAR_SEP . $ind . 
	VAR_SEP . "col" . VAR_SEP . "1");
	if($itemsImgSrc != STRING_NULL)
	{
	 $htmlWriter->putDivOpenTag($menuBodyId . VAR_SEP .  
	 self::MENU_ITEM_IMG_ID_SUFFIX . VAR_SEP . $ind,STRING_NULL,$imgItemClass);
	 $htmlWriter->putImgTag(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	 $itemsImgSrc);
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	}
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG);
	$htmlWriter->putTableColumnOpenTag($menuBodyId . VAR_SEP . "row" . VAR_SEP . $ind . 
	VAR_SEP . "col" . VAR_SEP . "2");
	$htmlWriter->putDivOpenTag($menuBodyId . VAR_SEP . 
	self::MENU_ITEM_LABEL_ID_SUFFIX . VAR_SEP . $ind . VAR_SEP . 
	LEVEL_TAG,STRING_NULL,$voiceItemClass,STRING_NULL,($javascriptEnabled)?("fade=new Fade('" . $menuBodyId . VAR_SEP .
	 self::MENU_ITEM_LABEL_ID_SUFFIX . VAR_SEP . $ind . VAR_SEP . LEVEL_TAG . "',0," . 
	 $fadeFps . "," . $fadeDuration . 
		",'" . $fadeToColor . "','" . $fadeFromColor . "');fade.fade_element()"):STRING_NULL); 
	$htmlWriter->putHrefOpenTag($menuBodyId .  VAR_SEP .
	self::MENU_ITEM_LABEL_ID_SUFFIX . VAR_SEP . $ind . VAR_SEP . ANCHOR_TAG ,
	STRING_NULL,STRING_NULL,$pages[$ind] . $pars);
	$htmlWriter->putGenericHtmlString($labels[$ind]);
	$htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG);
 }
 $htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG);
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
 $this->putCurtainMenu($dataValues); 
}

}

?>