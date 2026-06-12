<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_bootstrap_tabs extends Html_data_interface
{
 
const ERROR_1="Prova_ns_bootstrap_tabs:Numero campi dati errato.";
 const DEFAULT_CSS_CLASS="bootstrap_tabs";
 const BOOTSTRAP_CSS_NAV_UL = "nav nav-tabs nav-justified";
 const BOOTSTRAP_CSS_NAV_LI = "nav-item";
 const BOOTSTRAP_CSS_NAV_LINK = "nav-link";
 const TAB_CONTENT = "tab-content";
 const TAB_PANEL = "tab-pane";
 const TAB_PANEL_ACTIVE = "tab-pane active";
 const TAB_ID_SUFFIX = "tab_id_suffix";
 const VOICES_POS = 0;
 const IDS_POS = 1;	
 const DEFAULT_LINK_ACTIVE=0;
 const DEFAULT_CSS_MODULE = CSS_BOOTSTRAP_TABS;
 
  private $voicesField=STRING_NULL;
  private $idsField=STRING_NULL;    
  private $linkActive=self::DEFAULT_LINK_ACTIVE;
  static private $tablesTotNum=0;
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
  parent::__construct($actObj,$actOp,self::INT_BOOTSTRAP_TABS,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
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
 
 function enableBootstrap():void
 {
  $this->setBootstrapEnabled(true);
 }
 
 function getBootstrapTabsVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $bootstrapTabsVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $bootstrapTabsVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $bootstrapTabsVoices;
 }

 function setBootstrapTabsVoices(array $actBootstrapTabsVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actBootstrapTabsVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actBootstrapTabsVoices);
 } 
 }

 function addBootstrapTabsVoice(string $actBootstrapTabsVoice):void
 {
  $bootstrapTabsVoices = $this->getBootstrapTabsVoices();
  $bootstrapTabsVoices[] = $actBootstarpTabsVoice;
  $this->setBootstrapTabsVoices($bootstrapTabsVoices);
 }
 
 function getBootstrapTabsIds():array
 {
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
	 $bootstrapTabsIds = $this->getDataFieldDomainValueByPos(self::IDS_POS);
 }
 else
 {
	$idsDataField = $idsField;
  $bootstrapTabsIds = $this->getDataFieldDomainValueByName($idsDataField);
 }
 return $bootstrapTabsIds;
 }

 function setBootstrapTabsIds(array $actBootstrapTabsIds):void
 {
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::IDS_POS,$actBootstrapTabsIds);
 }
 else
 {
	$idsDataField = $idsField;
  $this->setDataFieldDomainValueByName($idsDataField,$actBootstrapTabsIds);
 }
 }

 function addBootstrapTabsId(string $actBootstrapTabsId):void
 {
  $bootstrapTabsIds = $this->getLocalTabs2Ids();
  $bootstrapTabsIds[] = $actBootstrapTabsId;
  $this->setBootstrapTabsIds($bootstrapTabsIds);
 }

 function deleteItem(int $actPos):bool
 {
  $voices = $this->getBootstrapTabsVoices();
  $ids = $this->getBootstrapTabsIds();
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
   $this->setBootstrapTabsVoices($voices);
   $this->setBootstrapTabsIds($ids);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getBootstrapTabsVoices();
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
  $voicesField = $this->getVoicesField();
 	$item3 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item3);
  $idsField = $this->getIdsField();
 	$item4 = array("idsField"=>$idsField);
  $serializer->loadItems($item4);
  $linkActive = $this->getLinkActive();
 	$item5 = array("linkActive"=>$linkActive);
  $serializer->loadItems($item5);
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item6 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item6); 
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
 
 function setIdsField(string $actIdsField):void
 {
 	$this->idsField = $actIdsField;
 }
 
 function getIdsField():string
 {
 	return $this->idsField;
 }
 
 function setLinkActive(int $actLinkActive):void
 {
  $this->linkActive=$actLinkActive;
 }
 
 function getLinkActive():int
 {
 	if($this->linkActive == STRING_NULL)
 	 return  self::DEFAULT_LINK_ACTIVE;
 	else
 	 return $this->linkActive;
 }
 
 function isContainer():bool
 {
  return true;
 }
 
 function putContainer(array $actDataValues):void
 { 
  $htmlWriter = $this->getHtmlWriter();
 	$dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 2)
   die(self::ERROR_1);
	$interfacesContainer = $this->getInterfacesContainer();
  $cssClass = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
	$iterator = $interfacesContainer->create();
  $voicesField = $this->getVoicesField();
  $idsField = $this->getIdsField();
  $linkActive = $this->getLinkActive();
  
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);	
  if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;
	$labels = $actDataValues[$labelDataField];	  

	if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
	{
	 	$idDataField = $dataFields[self::IDS_POS];
	}
	else
	 $idDataField = $idsField;
	$ids = $actDataValues[$idDataField];  
  
	$htmlWriter->putUlOpenTag(STRING_NULL,STRING_NULL,
	self::BOOTSTRAP_CSS_NAV_UL);
	$num = count($labels);
	for($k=0;$k<=$num-1;$k++)
	{
	 $id = $ids[$k];
	 $label = $labels[$k];
	 $htmlWriter->putLiOpenTag(STRING_NULL,STRING_NULL,
	 self::BOOTSTRAP_CSS_NAV_LI);
	 $htmlWriter->putGenericArrayOpenTag(ANCHOR_TAG,
	 array("id"=>STRING_NULL,"style"=>STRING_NULL,
	 "class"=>self::BOOTSTRAP_CSS_NAV_LINK . 
	 (($k==$linkActive)?STRING_SPACE . "active":STRING_NULL),
	 "href"=>STRING_CANCELLETTO . self::TAB_ID_SUFFIX . 
	 VAR_SEP . $k,"data-toggle"=>"tab"));
	 $htmlWriter->putGenericHtmlString($label);
	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	 $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
	}	
	$htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);

  $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,self::TAB_CONTENT);

	for($i=0;$i<=$num-1;$i++)
	{
	 $id = $ids[$i];			
	 $ctl = $iterator->current();
	 if (is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
	 {
	 	$ctl->setHtmlWriter($htmlWriter);
	  $ctlType = $ctl->getType();
	  $htmlWriter->putDivOpenTag(self::TAB_ID_SUFFIX . VAR_SEP . $i,
	  STRING_NULL,
	  self::TAB_PANEL . 
	 (($i==$linkActive)?STRING_SPACE . "active":STRING_NULL));
	 	$ctl->putData();
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);  
   }
	 $iterator->next();	
	}

	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);   	
	
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