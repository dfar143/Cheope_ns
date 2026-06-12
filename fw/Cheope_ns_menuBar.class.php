<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("javascript.fun.php");
require_once("cheope_ns.fun.php");

//
// MenuBar tabella
//

class Cheope_ns_menuBar extends Html_data_interface
{
 
 //const ERROR_1="Cheope_ns_menuBar:Errore nell'inserimento dell'interface container.";
 const ERROR_2="Cheope_ns_menuBar:Numero campi dati errato.";
 const INNER_CSS_CLASS="menuBar_inner";
 const DEFAULT_CSS_CLASS="menuBar";
 const FULL_VOICES_CSS_CLASS="menuBar_full_voices";
 const DEFAULT_JAVASCRIPT_MODULE=JS_MENU;
 const DEFAULT_CSS_MODULE=CSS_MENUBAR;
 /*const BOOTSTRAP_CSS_ROW_TYPE = "row";
 const BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_1 = "xs";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_2 = "sm";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_3 = "md";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_4 = "lg";
 const BOOTSTRAP_VIEWPORT_SIZE_TYPE_5 = "xl";*/
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 
 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL;
// private $interfacesContainer=null;
/* private $bootstrapContainerType = self::BOOTSTRAP_CONTAINER_TYPE_1;
 private $bootstrapViewPortSizeType = self::BOOTSTRAP_VIEWPORT_SIZE_TYPE_3; */
 static private $lMenuBarsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement=true;
   
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lMenuBarsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$lMenuBarsTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_MENUBAR,$actNum);
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
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$i=0;
 	$htmlWriter = $this->getHtmlWriter();
  $menuBarType = $this->getType();
  $menuBarId = $this->getInterfaceId();
  $menuBarIntCont = $this->getInterfacesContainer();
  $menuBarIter = $menuBarIntCont->create();
  $htmlWriter->putGenericHtmlString("\$(document).ready(function(){");
  while($menuBarIter->hasMore())
  {
   $menuObj = $menuBarIter->current();
   $menuObjId = $menuObj->getInterfaceId();
   $htmlWriter->put("\$(\"#" . $menuObjId . "\")" .
   ".get(0).style.position=\"absolute\";");
   $htmlWriter->put("\$(\"#" . $menuObjId . "\")" .
   ".get(0).style.visibility=\"hidden\";");
   $contId = $menuBarId . VAR_SEP . "col_div" . VAR_SEP . ($i++);
   $htmlWriter->putGenericHtmlString("\$(\"#" . $contId . "\")" .
    ".hover(function(){},function(){" .
		"setTimeout(function(){\$(\"#" . $contId . 
	  " > div\").get(0).style.visibility=\"hidden\";},50);});");
	 $menuBarIter->next();
	}
	$menuBarIter->reset();
  $htmlWriter->putGenericHtmlString("});");
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$lMenuBarsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lMenuBarsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 	$this->setBootstrapEnabled(true);	
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();
	
 	//parent::serialize();
 	$serializer = $this->getSerializer();
  $voicesField = $this->getVoicesField();
 	$item1 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item1);
  $pagesField = $this->getPagesField();
 	$item2 = array("pagesField"=>$pagesField);
  $serializer->loadItems($item2);
  $idsField = $this->getIdsField();
 	$item3 = array("idsField"=>$idsField);
  $serializer->loadItems($item3);
 /*	$item4 = array("bootstrapContainerType"=>$bootstrapContainerType);
 	$serializer->loadItems($item4);
 	$item5 = array("bootstrapViewPortSizeType"=>$bootstrapViewPortSizeType);
 	$serializer->loadItems($item5);*/
 	/*$interfacesContainer = $this->getInterfacesContainer();
 	$item4 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item4);*/	
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
 }
 
 function setVoicesField(string $actVoicesField)
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }
 
 function setPagesField(string $actPagesField)
 {
 	$this->pagesField = $actPagesField;
 }
 
 function getPagesField():string
 {
 	return $this->pagesField;
 }
 
 function setIdsField(string $actIdsField)
 {
 	$this->idsField = $actIdsField;
 }
 
 function getIdsField():string
 {
 	return $this->idsField;
 }
 
 function getMenuBarVoices():array
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

 function setMenuBarVoices(array $actMenuBarVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actMenuBarVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actMenuBarVoices);
 } 
 }

 function addMenuBarVoice(string $actMenuBarVoice):void
 {
  $menuBarVoices = $this->getMenuBarVoices();
  $menuBarVoices[] = $actMenuBarVoice;
  $this->setMenuBarVoices($menuBarVoices);
 }

 function getMenuBarPages():array
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

 function setMenuBarPages(array $actMenuBarPages):void
 {
 $dataFields = $this->getDataFields();
 $pagesField = $this->getPagesField();
  
 if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::PAGES_POS,$actMenuBarPages);
 }
 else
 {
	$pagesDataField = $pagesField;
  $this->setDataFieldDomainValueByName($pagesDataField,$actMenuBarPages);
 } 
 }

 function addMenuBarPage(string $actMenuBarPage):void
 {
  $menuBarPages = $this->getMenuBarPages();
  $menuBarPages[] = $actMenuBarPage;
  $this->setMenuBarPages($menuBarPages);
 }

 function getMenuBarIds():array
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

 function setMenuBarIds(array $actMenuBarIds):void
 {
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::IDS_POS,$actMenuBarIds);
 }
 else
 {
	$idsDataField = $idsField;
  $this->setDataFieldDomainValueByName($idsDataField,$actMenuBarIds);
 } 
 }

 function addMenuBarId(string $actMenuBarId):void
 {
  $menuBarIds = $this->getMenuBarIds();
  $menuBarIds[] = $actMenuBarId;
  $this->setMenuBarIds($menuBarIds);
 }

 function deleteItem(int $actPos):bool
 {
  $voices = $this->getMenuBarVoices();
  $pages = $this->getMenuBarPages();
  $ids = $this->getMenuBarIds();
  $num = count($voices);
  
  if(($actPos <= $num-1)&&($actPos>=0))
  {
   unset($voices[$actPos]);
   unset($pages[$actPos]);
   unset($ids[$actPos]);
   for($i=$actPos;$i<=$num-1;$i++)
   {
    $j = $i + 1;
    if($j <= $num-1)
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
   $this->setMenuBarVoices($voices);
   $this->setMenuBarPages($pages);
   $this->setMenuBarIds($ids);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getMenuBarVoices();
  return count($voices); 
 }

 function isContainer():bool
 {
  return true;
 }
 
 function putContainer(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
	$interfacesContainer = $this->getInterfacesContainer();
	$intCode = $this->getInterfaceId();
	$iterator = $interfacesContainer->create();
  $dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 3)
   die(self::ERROR_2);  

	((count($dataFields) !== 0)?
	($bootstrapColDim = round(12 / count($dataFields))):
	($bootstrapColDim=self::BOOTSTRAP_COL_DIM)); 

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
  
	$num = count($labels);
  $cssClass = $this->getCssClass();
  $style = $this->getStyle();
  //$bootstrapContainerType = $this->getBootstrapContainerType();
  //$cssClass .= STRING_SPACE . $bootstrapContainerType;
	$htmlWriter->putDivOpenTag($intCode,$style,$cssClass); 
	$htmlWriter->putTableOpenTag($intCode . VAR_SEP . "inner_table",STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "row"/*,self::BOOTSTRAP_CSS_ROW_TYPE*/);
	$i=0;
	foreach($labels as $ind=>$val)
	{
	 $ctl = $iterator->current();
	 $label = $labels[$ind];
   $page = $pages[$ind];
   if(isset($ids[$ind]))
   {
    $id = $ids[$ind];
    $page = $page . URL_PARS_START . PAR . URL_PAR_EQUAL . $id;
	 }
	 if(is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
	 {
	 	$ctl->setHtmlWriter($htmlWriter);
      /*  $bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
      //  $bootstrapColClass = "col" . STRING_MINUS . $bootstrapViewPortSizeType . 
      //  STRING_MINUS . (string)$bootstrapColDim;
	  
	  //$fieldCssClass .= STRING_SPACE . $bootstrapColClass;*/
	 	$htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col" .
	 	  VAR_SEP . $i);
    $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "col_div" . VAR_SEP . $i,STRING_NULL,
	  self::INNER_CSS_CLASS,STRING_NULL,"menu.showMenu('" . $ctl->getInterfaceId() . "')");
    $htmlWriter->putHrefOpenTag($intCode . VAR_SEP . "col_div_a" . VAR_SEP . $i,STRING_NULL,
    self::FULL_VOICES_CSS_CLASS,($page == STRING_NULL)?(STRING_CANCELLETTO):($page),STRING_NULL,STRING_NULL);
    $htmlWriter->putGenericHtmlString($label);
    $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
    $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
    $ctl->putData();
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	  $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0); 
   }
   else
   {
	 	$htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col" .
	 	  VAR_SEP . $i);
	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "col_div" . VAR_SEP . $i,STRING_NULL,
	  self::INNER_CSS_CLASS,STRING_NULL,STRING_NULL,STRING_NULL);
    $htmlWriter->putHrefOpenTag($intCode . VAR_SEP . "col_div_a" . VAR_SEP . $i,
    STRING_NULL,STRING_NULL,($page == STRING_NULL)?(STRING_CANCELLETTO):($page),STRING_NULL,STRING_NULL);
    $htmlWriter->putGenericHtmlString($label);
    $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);
    $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	  $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0); 
   }
	 $iterator->next();	
	 $i++;
	}
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	
 }
 
 function initPutData():array
 {
 }

 function putData():void
 {
	$rows = $this->getDataSource();
  $dataValues = array(); 
  $dataValues = $this->extractDataFromDataSource($rows);
	$this->putContainer($dataValues);
 }

}

?>