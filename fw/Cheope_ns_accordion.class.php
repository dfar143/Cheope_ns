<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("javascript.fun.php");
require_once("cheope_ns.fun.php");


class Cheope_ns_accordion extends Html_data_interface
{
 	
// const ERROR_1 = "Cheope_ns_accordion:Errore nell'inserimento dell'interface container.";
 const ERROR_2 = "Cheope_ns_accordion:Numero campi dati errato.";
 const INNER_CSS_CLASS = "accordion_inner";
 const DEFAULT_CSS_CLASS = "accordion";
 const DEFAULT_EVENT = "click";
 const DEFAULT_FILLSPACE = true;
 const DEFAULT_AUTOHEIGHT = false;
 const DEFAULT_COLLAPSIBLE = true;
 const VOICES_POS = 0;	
	
 private $fillSpace=self::DEFAULT_FILLSPACE;
 private $autoHeight=self::DEFAULT_AUTOHEIGHT;
 private $collapsible=self::DEFAULT_COLLAPSIBLE;
 private $event=self::DEFAULT_EVENT;
 private $voicesField=STRING_NULL;
 static private $accordionsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$accordionsTotNum++;
 	if($actNum === STRING_NULL)
 	 $actNum = self::$accordionsTotNum - 1; 	
  parent::__construct($actObj,$actOp,self::INT_ACCORDION,$actNum);
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
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $accordionObjId = $this->getInterfaceId();
  $fillSpace = $this->getFillSpace();
  $autoHeight = $this->getAutoHeight();
  $collapsible = $this->getCollapsible();
  $event = $this->getEvent();
  $htmlWriter->putGenericHtmlString("\$(document).ready(function() {"  .
	    "\$('#" .  $accordionObjId . "').accordion({" .
	    "fillSpace:" . boolToString($fillSpace) . "," .
	    "autoHeight:" . boolToString($autoHeight) . "," .
	    "collapsible:" . boolToString($collapsible) . "," .
	    "event:\"" . $event . "\"" .  
	    "});" . "} );");
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$accordionsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$accordionsTotNum=$actIntNum + 0;
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
 	$fillSpace = $this->getFillSpace();
 	$item1 = array("*fillSpace"=>$fillSpace);
  $serializer->loadItems($item1);
  $autoHeight = $this->getAutoHeight();
 	$item2 = array("*autoHeight"=>$autoHeight);
  $serializer->loadItems($item2);
  $collapsible = $this->getCollapsible();
 	$item3 = array("*collapsible"=>$collapsible);
  $serializer->loadItems($item3);
  $event = $this->getEvent();
 	$item4 = array("event"=>$event);
  $serializer->loadItems($item4);
  $voicesField = $this->getVoicesField();
 	$item5 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item5);
 	$interfacesContainer = $this->getInterfacesContainer();
 	$item6 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item6);  	
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item7 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item7);	
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
 
 function getEvent():string
 {
 	if($this->event == STRING_NULL)
 	 return self::DEFAULT_EVENT;
 	else
 	 return $this->event;
 }
 
 function setEvent(string $actEvent):void
 {
 	$this->event = $actEvent;
 }
 
 function getCollapsible():bool
 {
 	if($this->collapsible == STRING_NULL)
 	 return self::DEFAULT_COLLAPSIBLE;
 	else
   return $this->collapsible;	
 }
 
 function setCollapsible(bool $actCollapsible):void
 {
 	$this->collapsible = $actCollapsible;
 }
 
 function getFillSpace():bool
 {
 	if($this->fillSpace == STRING_NULL)
 	 return self::DEFAULT_FILLSPACE;
 	else
 	 return $this->fillSpace;
 }
 
 function setFillSpace(bool $actFillSpace):void
 {
 	$this->fillSpace = $actFillSpace;
 }
 
 function getAutoHeight():bool
 {
 	if($this->autoHeight == STRING_NULL)
 	 return self::DEFAULT_AUTOHEIGHT;
 	else
 	 return $this->autoHeight;
 }
 
 function setAutoHeight(bool $actAutoHeight):void
 {
 	$this->autoHeight = $actAutoHeight;
 }
 
 function getAccordionVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $accordionVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $accordionVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $accordionVoices;
 }

 function setAccordionVoices(array $actAccordionVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actAccordionVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actAccordionVoices);
 }  
 }

 function addAccordionVoice(string $actAccordionVoice):void
 {
  $accordionVoices = $this->getAccordionVoices();
  $accordionVoices[] = $actAccordionVoice;
  $this->setAccordionVoices($accordionVoices);
 }

 function deleteItem(int $actPos):bool
 {
  $voices = $this->getAccordionVoices();
  $num = count($voices);
  
  if(($actPos <= $num-1)&&($actPos>=0))
  {
   unset($voices[$actPos]);
   for($i=$actPos;$i<=$num-1;$i++)
   {
    $j = $i + 1;
    if($j <= $num-1)
    {
   	 $voices[$i] = $voices[$j];
    }
    else
    {
   	 unset($voices[$i]);
    }
   }
   $this->setAccordionVoices($voices);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getAccordionVoices();
  return count($voices); 
 }

 function isContainer():bool
 {
  return true;
 }
 
 function putContainer(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
	$cssClass = $this->getCssClass();
	$dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 1)
   die(self::ERROR_2); 
	$style = $this->getStyle(); 	
	$intCode = $this->getInterfaceId();
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);	
	$interfacesContainer = $this->getInterfacesContainer();
	$iterator = $interfacesContainer->create();
	if(count($actDataValues)>0)
	{ 	
	 $voicesField = $this->getVoicesField();
	 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	 {
	 	$labelDataField = $dataFields[self::VOICES_POS];
	 }
	 else
	  $labelDataField = $voicesField;

	 $labels = $actDataValues[$labelDataField];	
	 $num = count($labels);
	 foreach($labels as $ind=>$label)
	 {
	  $ctl = $iterator->current();
	  if(is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
	  {
	 	 $ctl->setHtmlWriter($htmlWriter);
	   $ctlType = $ctl->getType();
	 	 $htmlWriter->putH3OpenTag($intCode . VAR_SEP . "h" .
	 	  VAR_SEP . $ind);
     $htmlWriter->putHrefOpenTag($intCode . VAR_SEP . "a" . VAR_SEP . $ind,
     STRING_NULL,STRING_NULL,STRING_CANCELLETTO);
     $htmlWriter->putGenericHtmlString($label);
     $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);   
     $htmlWriter->putGenericHtmlString(H3_CLOSE_TAG,0); 
	   $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "div" . VAR_SEP . $ind,STRING_NULL,
	   self::INNER_CSS_CLASS);
     $ctl->putData();
	   $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);  
    }
	  $iterator->next();
	 }	
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