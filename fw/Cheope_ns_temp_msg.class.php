<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("cheope_ns.fun.php");


class Cheope_ns_temp_msg extends Html_formatted_interface
{
 const DEFAULT_CSS_CLASS="msg";
 const DEFAULT_BUTTON_LABEL="Invia";
 const DEFAULT_BUTTON_FLAG=true;
 const DEFAULT_DELAY=3000;
 const DEFAULT_SEQUENCE_DELAY=200;
 const DEFAULT_IS_SEQUENCE_ACTIVE = false;
 const DEFAULT_SEND_FLAG=true;
 const DEFAULT_ALIGN="center";
 const DEFAULT_VALIGN="center";
 const DEFAULT_JAVASCRIPT_MODULE=JS_TEMP_MSG_SEQUENCER;
 const DEFAULT_CSS_MODULE=CSS_TEMP_MSG;
 const TEXT_FIELD_ID_SUFFIX="text_field";
 const WIDTH = "100%";
 const HEIGHT = "100";

 private $text=STRING_NULL;
 private $gesPage=STRING_NULL;
 private $delay=self::DEFAULT_DELAY;
 private $align=self::DEFAULT_ALIGN;
 private $vAlign=self::DEFAULT_VALIGN;
 private $sendFlag=self::DEFAULT_SEND_FLAG;
 private $buttonFlag=self::DEFAULT_BUTTON_FLAG;
 private $buttonLabel=self::DEFAULT_BUTTON_LABEL;
 private $isSequenceActive=self::DEFAULT_IS_SEQUENCE_ACTIVE;
 private $sequenceDelay=self::DEFAULT_SEQUENCE_DELAY;
 private $sequenceStrings = array();
 static private $tempMsgsTotNum=0;  
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement=true;
 		 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 self::$tempMsgsTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$tempMsgsTotNum - 1; 

  parent::__construct($actOp,self::INT_TEMP_MSG,$actNum);
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
 	$i=$actPar;
 	$htmlWriter = $this->getHtmlWriter();
 	if($this->getIsSequenceActive())
 	{
 	 $seqStrings = $this->getSequenceStrings();
 	 $num = count($seqStrings);
 	 $htmlWriter->putGenericHtmlString("tempMsgSeq.TEMP_MSG_" . $i . "_SEQ_STRINGS_NUM = " . $num . ";");
 	 $htmlWriter->putGenericHtmlString("tempMsgSeq.tempMsg" . $i . "SeqStrings = Array(" . 
 		 	"tempMsgSeq.TEMP_MSG_" . $i . "_SEQ_STRINGS_NUM" . ");");
 	 for($j=0;$j<=$num-1;$j++)
 	 {
    $htmlWriter->putGenericHtmlString("tempMsgSeq.tempMsg" . $i . "SeqStrings[" . $j . 
       	"]='" . $seqStrings[$j] . "';");	 	 	
 	 }
 		 $i++;
  }
  $htmlWriter->putGenericHtmlString("tempMsgSeq.TEMP_MSGS_WITH_SEQUENCER_ACTIVE_NUM = " . $i . ";");
  $htmlWriter->putGenericHtmlString("var initTempMsg = function(){for(var i=0;i<=tempMsgSeq.TEMP_MSGS_WITH_SEQUENCER_ACTIVE_NUM-1;i++)" .
  "tempMsgSeq.ctTempMsgsSeqs[i]=0;}();");
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tempMsgsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tempMsgsTotNum=$actIntNum + 0;
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
	//$booleanPropsArray=array("sendFlag","buttonFlag","isSequenceActive");
	//$this->serialize_props_exec($booleanPropsArray);
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$text = $this->getText();
 	$item1 = array("text"=>$text);
 	$serializer->loadItems($item1); 
 	$gesPage = $this->getGesPage();
 	$item2 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item2); 
 	$delay = $this->getDelay();
 	$item3 = array("delay"=>$delay);
 	$serializer->loadItems($item3);
 	$align = $this->getAlign();
 	$item4 = array("align"=>$align);
 	$serializer->loadItems($item4);
 	$vAlign = $this->getVAlign();
 	$item5 = array("vAlign"=>$vAlign);
 	$serializer->loadItems($item5); 
 	$sendFlag = $this->getSendFlag();
 	$item6 = array("*sendFlag"=>$sendFlag);
 	$serializer->loadItems($item6); 
 	$buttonFlag = $this->getButtonFlag();
 	$item7 = array("*buttonFlag"=>$buttonFlag);
 	$serializer->loadItems($item7);
 	$buttonLabel = $this->getButtonLabel();
 	$item8 = array("buttonLabel"=>$buttonLabel);
 	$serializer->loadItems($item8);  	
 	$isSequenceActive = $this->getIsSequenceActive();
 	$item9 = array("*isSequenceActive"=>$isSequenceActive);
 	$serializer->loadItems($item9);
 	$sequenceDelay = $this->getSequenceDelay();
 	$item10 = array("sequenceDelay"=>$sequenceDelay);
 	$serializer->loadItems($item10);
 	$sequenceStrings = $this->getSequenceStrings();
 	$item11 = array("\$sequenceStrings"=>$sequenceStrings);
 	$serializer->loadItems($item11);  	 	    
 }

 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
 function getText():string
 {
  return $this->text;
 }
 
 function setText(string $actText):void
 {
  $this->text = $actText;
 }
 
 function getVAlign():string
 {
 	if($this->vAlign == STRING_NULL)
 	 return self::DEFAULT_VALIGN;
  else
   return $this->vAlign;
 }
 
 function setVAlign(string $actVAlign):void
 {
 	$this->vAlign = $actVAlign;
 }
 
 function getAlign():string
 {
 	if($this->align == STRING_NULL)
 	 return self::DEFAULT_ALIGN;
  else
   return $this->align;
 }
 
 function setAlign(string $actAlign):void
 {
 	$this->align = $actAlign;
 } 
 
 function getGesPage():string
 {
  return $this->gesPage;
 }
 
 function setGesPage(string $actGesPage):void
 {
  $this->gesPage = $actGesPage;
 }
 
 function setButtonFlag(bool $actButtonFlag):void
 {
  $this->buttonFlag = $actButtonFlag;
 }
 
 function getButtonFlag():string
 {
  if ($this->buttonFlag !== STRING_NULL)
	 return $this->buttonFlag;
	else
   return self::DEFAULT_BUTTON_FLAG;
 }
 
 function setSendFlag(bool $actSendFlag):void
 {
  $this->sendFlag = $actSendFlag;
 }
 
 function getSendFlag():bool
 {
  if ($this->sendFlag !== STRING_NULL)
	 return $this->sendFlag;
	else
   return self::DEFAULT_SEND_FLAG;
 }
 
 function setButtonLabel(string $actLabel):void
 {
  $this->buttonLabel = $actLabel;
 }
 
 function getButtonLabel():string
 {
  if ($this->buttonLabel==STRING_NULL)
	 return self::DEFAULT_BUTTON_LABEL;
	else
   return $this->buttonLabel;
 }
 
 function setDelay(int $actDelay):void
 {
  $this->delay = $actDelay;
 }
 
 function getDelay():int
 {
  if ($this->delay==NO_VALUE)
	 return self::DEFAULT_DELAY;
	else
	 return $this->delay;
 }
 
 function getIsSequenceActive():bool
 {
  if ($this->isSequenceActive!==STRING_NULL)
	 return $this->isSequenceActive;
	else
   return self::DEFAULT_IS_SEQUENCE_ACTIVE;
 }
 
 function setIsSequenceActive(bool $actIsSeqActive):void
 {
  $this->isSequenceActive = $actIsSeqActive;
 }
 
 function getSequenceDelay():int
 {
 if ($this->sequenceDelay==STRING_NULL)
	 return self::DEFAULT_SEQUENCE_DELAY;
	else
   return $this->sequenceDelay;
 }
 
 function setSequenceDelay(int $actSeqDelay):void
 {
 	$this->sequenceDelay = $actSeqDelay;
 }
 
 function setSequenceStrings(array $actSeqStrings):void
 {
 	$this->sequenceStrings = $actSeqStrings;
 }
 
 function getSequenceStrings():array
 {
 	return $this->sequenceStrings;
 }
 
 function addSequenceString(string $actSeqString):void
 {
 	$seqStrings = $this->getSequenceStrings();
 	$seqStrings[] = $actSeqString;
 	$this->setSequenceStrings($seqStrings);
 }
 
 function deleteSequenceString(int $actPos):bool
 {
  $seqStrings = $this->getSequenceStrings();
  $num = count($seqStrings);
  if(($actPos <= $num-1)&&($actPos>=0))
  {
	 unset($seqStrings[$actPos]);
	 for($i=$actPos;$i<=$num-1;$i++)
	 {
	  $j=$i+1;
	  if($j<=$num-1)
	   $seqStrings[$i] = $seqStrings[$j];
	  else
	   unset($seqStrings[$i]);
	 }
	 $this->setSequenceStrings($seqStrings);
	}
	else
	 return false;
  return true;
 }
 
  function isContainer():bool
 {
  return false;
 }
 
 function isDecorator():bool
 {
  return false;
 }
 
 function putCtrlCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $gesPage = $this->getGesPage();
	$delay = $this->getDelay();
	$htmlWriter->putScriptOpenTag();
	$htmlWriter->putGenericHtmlString("setTimeout('window.location = \"" . $gesPage . "\"'," . $delay . ")");
  $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 } 
 
 function putSequenceActivationCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$seqDelay = $this->getSequenceDelay();
 	$htmlWriter->putScriptOpenTag();
  $htmlWriter->putGenericHtmlString("setInterval('tempMsgSeq.tempMsgsSequenceActivate()'," . $seqDelay . ")");
  $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
  $text = $this->getText();
  $buttonFlag = $this->getButtonFlag();
  $buttonLabel = $this->getButtonLabel();
  $sendFlag = $this->getSendFlag();
	$isSeqActive = $this->getIsSequenceActive();
	$gesPage = $this->getGesPage();
	$cssClass = $this->getCssClass();
	$vAlign = $this->getVAlign();
	$align = $this->getAlign();
	$num = $this->getNum();
	$type = $this->getType();
	$style = $this->getStyle();	

	if($sendFlag)
   $this->putCtrlCode();
	if($isSeqActive)
	 $this->putSequenceActivationCode();
	
	$htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
	$htmlWriter->putTableOpenTag(STRING_NULL,$cssClass,self::WIDTH,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
  $htmlWriter->putTableColumnOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,$vAlign,$align);
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG,0);
	$htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::TEXT_FIELD_ID_SUFFIX);
	$htmlWriter->putGenericHtmlString($text,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
  $htmlWriter->putTableColumnOpenTag(STRING_NULL);
	if($buttonFlag)
	 $htmlWriter->putButtonTag($intCode . VAR_SEP . "button",
	 STRING_NULL,STRING_NULL,$buttonLabel,STRING_NULL,
	 BUTTON_TYPE_BUTTON,
	 "window.location = '" . $gesPage . "'");
	$htmlWriter->putGenericHtmlString(SEP_OPEN_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
 
}


?>