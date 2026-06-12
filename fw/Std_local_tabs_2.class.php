<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("javascript.fun.php");
require_once("std.fun.php");


class Std_local_tabs_2 extends Html_data_interface
{
	 
// const ERROR_1="Std_local_tabs_2:Errore nell'inserimento dell'interface container.";
 const ERROR_2="Std_local_tabs_2:Numero campi dati errato.";
 const INNER_CSS_CLASS="local_tabs_2_inner";
 const DEFAULT_CSS_CLASS="local_tabs_2";
 const DEFAULT_EVENT="mouseover";
 const VOICES_POS = 0;
//
// Il campo id deve essere del tipo #id-n già sul database.
//
 const IDS_POS = 1;	
 const DEFAULT_CSS_MODULE=CSS_LOCAL_TABS_2;
 
 private $voicesField=STRING_NULL;
 private $idsField=STRING_NULL;
 private $collapsible=true; 
 private $event=self::DEFAULT_EVENT;
 static private $lTabsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lTabsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$lTabsTotNum - 1; 
 	$interfacesContainer=Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 	$this->setInterfacesContainer($interfacesContainer);
  parent::__construct($actObj,$actOp,self::INT_LOCAL_TABS_2,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 function enableBootstrap():void
 {
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
 	$htmlWriter = $this->getHtmlWriter();
  $localTabObjId = $this->getInterfaceId();
  $event = $this->getEvent();
  $collapsible = $this->getCollapsible();
  $htmlWriter->putGenericHtmlString("\$(document).ready(function() {"  .
	"\$('#" .  $localTabObjId . "').tabs({" .
	"event:'" . $event . "'" . "," .
	"collapsible:" . boolToString($collapsible) . 
	"});" . "} );");	
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$lTabsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lTabsTotNum=$actIntNum + 0;
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
 	$item1 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item1);
  $idsField = $this->getIdsField();
 	$item2 = array("idsField"=>$idsField);
  $serializer->loadItems($item2);
  $event = $this->getEvent();
 	$item3 = array("event"=>$event);
 	$serializer->loadItems($item3);
	$collapsible = $this->getCollapsible();
 	$item4 = array("*collapsible"=>$collapsible);
 	$serializer->loadItems($item4);
 	/*$interfacesContainer = $this->getInterfacesContainer();
 	$item5 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item5);*/
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item6 = array("javascriptEnabled");
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
 
 function getCollapsible():bool
 {
  return $this->collapsible;	
 }
 
 function setCollapsible(bool $actCollapsible):void
 {
 	$this->collapsible = $actCollapsible;
 }
 
 function getEvent():string
 {
 	if($this->event == STRING_NULL)
 	 return self::DEFAULT_EVENT;
 	else
 	 return $this->event;
 }
 
 function setEvent(string $actEvent):void
 {
 	$this->event=$actEvent;
 }
 
 function getLocalTabs2Voices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $localTabs2Voices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $localTabs2Voices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $localTabs2Voices;
 }

 function setLocalTabs2Voices(array $actLocalTabs2Voices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actLocalTabs2Voices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actLocalTabs2Voices);
 } 
 }

 function addLocalTabs2Voice(string $actLocalTabs2Voice):void
 {
  $localTabs2Voices = $this->getLocalTabs2Voices();
  $localTabs2Voices[] = $actLocalTabs2Voice;
  $this->setLocalTabs2Voices($localTabs2Voices);
 }

 function getLocalTabs2Ids():array
 {
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
	 $localTabs2Ids = $this->getDataFieldDomainValueByPos(self::IDS_POS);
 }
 else
 {
	$idsDataField = $idsField;
  $localTabs2Ids = $this->getDataFieldDomainValueByName($idsDataField);
 }
 return $localTabs2Ids;
 }

 function setLocalTabs2Ids(array $actLocalTabs2Ids):void
 {
 $dataFields = $this->getDataFields();
 $idsField = $this->getIdsField();
  
 if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::IDS_POS,$actLocalTabs2Ids);
 }
 else
 {
	$idsDataField = $idsField;
  $this->setDataFieldDomainValueByName($idsDataField,$actLocalTabs2Ids);
 }
 }

 function addLocalTabs2Id(string $actLocalTabs2Id):void
 {
  $localTabs2Ids = $this->getLocalTabs2Ids();
  $localTabs2Ids[] = $actLocalTabs2Id;
  $this->setLocalTabs2Ids($localTabs2Ids);
 }

 function deleteItem(int $actPos):bool
 {
  $voices = $this->getLocalTabs2Voices();
  $ids = $this->getLocalTabs2Ids();
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
   $this->setLocalTabs2Voices($voices);
   $this->setLocalTabs2Ids($ids);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getLocalTabs2Voices();
  return count($voices); 
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
   die(self::ERROR_2);
	$interfacesContainer = $this->getInterfacesContainer();
	$intCode = $this->getInterfaceId();
  $style = $this->getStyle();
  $cssClass = $this->getCssClass();
	$iterator = $interfacesContainer->create();

  $voicesField = $this->getVoicesField();
  $idsField = $this->getIdsField();

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
	
	$htmlWriter->putUlOpenTag();
	$num = count($labels);
	for($k=0;$k<=$num-1;$k++)
	{
	 $id = $ids[$k];
	 $label = $labels[$k];
	 $htmlWriter->putLiOpenTag();
	 $htmlWriter->putHrefOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,$id);
	 $htmlWriter->putGenericHtmlString($label);
	 $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);
	 $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
	}
	$htmlWriter->putGenericHtmlString(UL_CLOSE_TAG);
  
	for($i=0;$i<=$num-1;$i++)
	{
	 //$pars1 = STRING_NULL;
	 //$pars2 = STRING_NULL;
	 $id = $ids[$i];			

	 $ctl = $iterator->current();
	 if (is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
	 {
	 	$ctl->setHtmlWriter($htmlWriter);
	  $ctlType = $ctl->getType();
	  $htmlWriter->putDivOpenTag(substr($id,1,strlen($id)-1),STRING_NULL,
	  self::INNER_CSS_CLASS);
	 	$ctl->putData();
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);  
   }
	 $iterator->next();	
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
	$this->putContainer($dataValues);
 }

}

?>