<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");

class Cheope_ns_simple_local_tabs extends Html_data_interface
{ 
 const ERROR_3="Cheope_ns_simple_local_tabs.putData:Numero campi dati errato.";
 const VOICES_POS=0;
 const DEFAULT_CSS_CLASS="tab";
 const DEFAULT_CSS_MODULE=CSS_SIMPLE_LOCAL_TABS;

 private $voicesField=STRING_NULL;
 static $hasCssManagement = true;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $useJQuery=true;
 static $useDojo = false;
 static private $lTabsTotNum=0; 
 
  function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lTabsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$lTabsTotNum - 1; 

  parent::__construct($actObj,$actOp,self::INT_SIMPLE_LOCAL_TABS,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
  $this->setJavascriptModule(CLIENT_SIMPLE_LOCAL_TABS_CODE_PATH . DIR_SEP . JS_SIMPLE_LOCAL_TABS);
 }

 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
 	function useDojo():bool
	{
		return self::$useDojo;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}

	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$lTabsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lTabsTotNum=$actIntNum + 0;
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
	//$booleanPropsArray=array();
	//$this->serialize_props_exec($booleanPropsArray);
 	$serializer = $this->getSerializer();
  $voicesField = $this->getVoicesField();
 	$item1 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item1); 
 	/*$interfacesContainer = $this->getInterfacesContainer();
 	$item3 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item3);	*/
 }

 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 } 

 function getSimpleLocalTabsVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $localTabsVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $localTabsVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $localTabsVoices;
 }

 function setSimpleLocalTabsVoices(array $actLocalTabsVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actLocalTabsVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actLocalTabsVoices);
 } 
 }

 function addSimpleLocalTabsVoice(string $actLocalTabsVoice):void
 {
  $localTabsVoices = $this->getLocalTabsVoices();
  $localTabsVoices[] = $actLocalTabsVoice;
  $this->setLocalTabsVoices($localTabsVoices);
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
  return true;
 }
 
 function putContainer(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
	$cssClass = $this->getCssClass();
	$style = $this->getStyle(); 
  $interfacesContainer = $this->getInterfacesContainer();
	$dataFields = $this->getDataFields();	
  $num = count($dataFields);
  if($num < 1)
   die(self::ERROR_3);	
	$voicesField = $this->getVoicesField();
	if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 $labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;

	$labels = $actDataValues[$labelDataField];	  
  $num1 = count($labels);	
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);  
  foreach($labels as $ind=>$label)     
  {
	$htmlWriter->putButtonOpenTag(STRING_NULL,STRING_NULL,"tablinks",
	STRING_NULL,STRING_NULL,STRING_NULL,"simple_local_tabs_openCity(event, '" . $label . "')"); 
	$htmlWriter->putGenericHtmlString($label);
	$htmlWriter->putGenericHtmlString(BUTTON_CLOSE_TAG);
  }
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  $iterator = $interfacesContainer->create();
  $i=0;
  foreach($labels as $ind=>$label)
  {
	$ctl = $iterator->current();  
	if (is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
    {		
	 $htmlWriter->putDivOpenTag($labels[$i],STRING_NULL,"tabcontent");
	 $ctl->putData();
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	}
    $iterator->next();
	$i++;
  }	  
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