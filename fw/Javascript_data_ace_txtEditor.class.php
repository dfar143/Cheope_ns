<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


//
// Editor di testo ace 
// Implementato tramite le interfacce javascript
//


class Javascript_data_ace_txtEditor extends Html_formatted_interface
{
 
 const JS_INTERFACES ="interfaces.js";
 const JS_ACE ="ace.js";
 const JS_ACE_STATUSBAR ="ext-statusbar.js";
 const CSS_ACE = "ace.css";
 const DUAL_JAVASCRIPT_INTERFACE_NAME = "JavascriptTxtEditor";
 const DEFAULT_DATA_EXCHANGE_TYPE="text";
 const DEFAULT_GET_FILE_OP="getFile";
 const DEFAULT_SEND_FILE_OP="sendFile";
 const DEFAULT_THEME="monokai";
 const DEFAULT_FONTSIZE=12;
 const DEFAULT_HEIGHT=400;
 const DEFAULT_KEYBOARD_HANDLER="windows";
 const DEFAULT_JAVASCRIPT_MODULE_0=self::JS_INTERFACES;
 const DEFAULT_JAVASCRIPT_MODULE_1=self::JS_ACE;
 const DEFAULT_JAVASCRIPT_MODULE_2=self::JS_ACE_STATUSBAR;
 const DEFAULT_CSS_MODULE=self::CSS_ACE;
 const CLIENT_CODE_PATH = "./js";
 const CLIENT_ACE_CODE_PATH = "./ace/src-noconflict";
 const CLIENT_STYLE_SHEET_PATH = "./css";
 const STYLE_SHEET_FILE_POSTFIX = "./css";
 const DIR_SEP = STRING_SLASH;
 
 
 private $hookId = STRING_NULL;
 private $editorId = STRING_NULL;
 private $dataExchangeType = self::DEFAULT_DATA_EXCHANGE_TYPE;
 private $enableInsertInClientContainer=true;
 private $enableExecuteOnLoad = true;
 private $enableDataFromRemote=true;
 private $fontSize=self::DEFAULT_FONTSIZE;
 private $height = self::DEFAULT_HEIGHT;
 private $keyBoardHandler=self::DEFAULT_KEYBOARD_HANDLER;
 private $readOnly=false;
 private $showInvisibles=false;
 private $mode=STRING_NULL;
 private $theme=self::DEFAULT_THEME;
 private $getOp=self::DEFAULT_GET_FILE_OP;
 private $sendOp=self::DEFAULT_SEND_FILE_OP;
 private $fileName=STRING_NULL;
 private $enableStatusBar=false;
 private $enableOpBar=false;
 private $callBackFunPattern=STRING_NULL;
 static private $javascriptDataTxtEditorsTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;

  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$javascriptDataTxtEditorsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptDataTxtEditorsTotNum - 1;  
 	parent::__construct($actOp,self::INT_JAVASCRIPT_DATA_ACE_TXTEDITOR,$actNum);
 	
  $this->setJavascriptModule(array(
  self::CLIENT_CODE_PATH . self::DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE_0,
  self::CLIENT_ACE_CODE_PATH . self::DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE_1,
  self::CLIENT_ACE_CODE_PATH . self::DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE_2));
  $this->setCssModule(self::CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE); 
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
	
 function setCallBackFunPattern(string $actCallBackFunPattern):void
 {
 	$this->callBackFunPattern = $actCallBackFunPattern;
 }
 
 function getCallBackFunPattern():string
 {
 	return $this->callBackFunPattern;
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putGenericHtmlString("//<!--" . chr(13));
 	$htmlWriter->putGenericHtmlString("if(interfacesContainer===undefined) interfacesContainer = interfaces.createInterfacesContainer();");	
   
 	$ajaxOp = $this->getOp();
 	$htmlWriter->putGenericHtmlString("ajaxHandler.JAVASCRIPT_OP = '" . $ajaxOp . "';");
  $op = ucFirst($ajaxOp);
 	$opFunction = "Op" . $op;
 	$htmlWriter->putGenericHtmlString("ajaxHandler.addOp(new " . 
 	$opFunction . "(ajaxHandler.JAVASCRIPT_OP));");
 	$this->putData();
 
 	$htmlWriter->putGenericHtmlString("//-->");
 	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG); 
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$javascriptDataTxtEditorsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$javascriptDataTxtEditorsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$hookId = $this->getHookId();
 	$item1 = array("hookId"=>$hookId);
 	$serializer->loadItems($item1);	
 	$editorId = $this->getEditorId();
 	$item2 = array("editorId"=>$editorId);
 	$serializer->loadItems($item2);	
 	$dataExchangeType = $this->getDataExchangeType();
 	$item3 = array("dataExchangeType"=>$dataExchangeType);
 	$serializer->loadItems($item3);	
 	$enableInsertInClientContainer = $this->getEnableInsertInClientContainer();
 	$item4 = array("enableInsertInClientContainer"=>$enableInsertInClientContainer);
 	$serializer->loadItems($item4);
 	$enableExecuteOnLoad = $this->getEnableExecuteOnLoad();
 	$item5 = array("enableExecuteOnLoad"=>$enableExecuteOnLoad);
 	$serializer->loadItems($item5);
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
 	$item6 = array("enableDataFromRemote"=>$enableDataFromRemote);
 	$serializer->loadItems($item6); 
 	$fontSize = $this->getFontSize();
 	$item7 = array("fontSize"=>$fontSize);
 	$serializer->loadItems($item7); 
 	$height = $this->getHeight();
 	$item8 = array("height"=>$height);
 	$serializer->loadItems($item8); 		
 	$keyBoardHandler = $this->getKeyBoardHandler();
 	$item9 = array("keyBoardHandler"=>$keyBoardHandler);
 	$serializer->loadItems($item9);   
 	$readOnly = $this->getReadOnly();
 	$item10 = array("*readOnly"=>$readOnly);
 	$serializer->loadItems($item10);
 	$showInvisibles = $this->getShowInvisibles();
 	$item11 = array("showInvisibles"=>$showInvisibles);
 	$serializer->loadItems($item11); 	
 	$mode = $this->getMode();
 	$item12 = array("mode"=>$mode);
 	$serializer->loadItems($item12); 
 	$theme = $this->getTheme();
 	$item13 = array("theme"=>$theme);
 	$serializer->loadItems($item13); 	
 	$getOp = $this->getGetOp();
 	$item14 = array("getOp"=>$getOp);
 	$serializer->loadItems($item14);
 	$sendOp = $this->getSendOp();
 	$item15 = array("sendOp"=>$sendOp);
 	$serializer->loadItems($item15);
 	$fileName = $this->getFileName();
 	$item16 = array("fileName"=>$fileName);
 	$serializer->loadItems($item16);
 	$enableStatusBar = $this->getEnableStatusBar();
 	$item16 = array("enableStatusBar"=>$enableStatusBar);
 	$serializer->loadItems($item16);
 	$enableOpBar = $this->getEnableOpBar();
 	$item17 = array("enableOpBar"=>$enableOpBar);
 	$serializer->loadItems($item17); 	 	  	 		  									
 }
 
 function getFontSize():int
 {
 	if($this->fontSize==NO_VALUE)
 	 return self::DEFAULT_FONTSIZE;
 	else
 	 return $this->fontSize;
 }
 
 function setFontSize(int $actFontSize):void
 {
 	$this->fontSize=$actFontSize;
 }
 
 function getHeight():int
 {
 	if($this->height==NO_VALUE)
 	 return self::DEFAULT_HEIGHT;
 	else
 	 return $this->height;
 }
 
 function setHeight(int $actHeight):void
 {
 	$this->height=$actHeight;
 }
 
 function getKeyBoardHandler():string
 {
 	if($this->keyBoardHandler==STRING_NULL)
 	 return self::DEFAULT_KEYBOARD_HANDLER;
 	else
 	 return $this->keyBoardHandler;
 }
 
 function setKeyBoardHandler(string $actKeyBoardHandler):void
 {
 	$this->keyBoardHandler=$actKeyBoardHandler;
 } 
 
 function getReadOnly():bool
 {
 	 return $this->readOnly;
 }
 
 function setReadOnly(bool $actReadOnly):void
 {
 	$this->readOnly=$actReadOnly;
 }
 
 function getShowInvisibles():bool
 {
 	 return $this->showInvisibles;
 }
 
 function setShowInvisibles(bool $actShowInvisibles):void
 {
 	$this->showInvisibles = $actShowInvisibles;
 }
 
 function getTheme():string
 {
 	if($this->theme==STRING_NULL)
 	 return self::DEFAULT_THEME;
 	else
 	 return $this->theme;
 }
 
 function setTheme(string $actTheme):void
 {
 	$this->theme = $actTheme;
 }
 
 function getMode():string
 {
 	 return $this->mode;
 }
 
 function setMode(string $actMode):void
 {
 	$this->mode=$actMode;
 }
 
 function getEnableDataFromRemote():bool
 {
 	return $this->enableDataFromRemote;
 }
 
 function setEnableDataFromRemote(bool $actEnableDatafromRemote):void
 {
 	$this->enableDataFromRemote = $actEnableDatafromRemote;
 }
 
  function getDataExchangeType():string
 {
 	if($this->dataExchangeType==STRING_NULL)
 	 return DEFAULT_JAVASCRIPT_DATA_FRAGMENT_DATA_EXCHANGE_TYPE;
 	else
 	 return $this->dataExchangeType;
 }
 
 function setDataExchangeType(string $actDataExchangeType):void
 {
 	$this->dataExchangeType = $actDataExchangeType;
 }
 
 function setHookId(string $actHookId):void
 {
 	$this->hookId = $actHookId;
 }
 
 function getHookId():string
 {
 	return $this->hookId;
 }
 
 function setEditorId(string $actEditorId):void
 {
 	$this->editorId = $actEditorId;
 }
 
 function getEditorId():string
 {
 	return $this->editorId;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getGetOp():string
 {
 	return $this->getOp;
 }
 
 function setGetOp(string $actGetOp):void
 {
 	$this->getOp = $actGetOp;
 }
 
 function getSendOp():string
 {
 	return $this->sendOp;
 }
 
 function setSendOp(string $actSendOp):void
 {
 	$this->sendOp = $actSendOp;
 }
 
 function setEnableInsertInClientContainer(bool $actEnableInsertInClientContainer):void
 {
 	$this->enableInsertInClientContainer = $actEnableInsertInClientContainer;
 }
 
 function getEnableInsertInClientContainer():bool
 {
 	return $this->enableInsertInClientContainer;
 }
 
 function setEnableExecuteOnLoad(bool $actEnableExecuteOnLoad):void
 {
 	$this->enableExecuteOnLoad = $actEnableExecuteOnLoad;
 }
 
 function getEnableExecuteOnLoad():bool
 {
 	return $this->enableExecuteOnLoad;
 }
 
 function setEnableStatusBar(bool $actEnableStatusBar):void
 {
 	$this->enableStatusBar = $actEnableStatusBar;
 }
 
 function getEnableStatusBar():bool
 {
 	return $this->enableStatusBar;
 }
 
 function setEnableOpBar(bool $actEnableOpBar):void
 {
 	$this->enableOpBar = $actEnableOpBar;
 }
 
 function getEnableOpBar():bool
 {
 	return $this->enableOpBar;
 }
 
 function getDualInterfaceName():string
 {
  $op = $this->getOp();
  $num = $this->getNum();
  $javascriptIntefaceName = self::DUAL_JAVASCRIPT_INTERFACE_NAME . $op . $num;
  return $javascriptIntefaceName;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function isDecorator():bool
 {
  return false;
 }
 
 function getJavascriptInterfaceInstantationStr():string
 {
 	$op = $this->getOp();
 	$num = $this->getNum();
  $fileName = $this->getFileName();
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
 	$hookId = $this->getHookId();
 	$fontSize = $this->getFontSize();
 	$height = $this->getHeight();
 	$keyBoardHandler = $this->getKeyBoardHandler();
 	$readOnly = $this->getReadOnly();
 	$showInvisibles = $this->getShowInvisibles();
 	$theme = $this->getTheme();
 	$style = $this->getStyle();
 	$mode = $this->getMode();
 	$getOp = $this->getGetOp();
 	$sendOp = $this->getSendOp();
 	$editorId = $this->getEditorId();
  $enableStatusBar = $this->getEnableStatusBar();
  $enableOpBar = $this->getEnableOpBar();
  
 	$javascriptInterfaceName = $this->getDualInterfaceName();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createJavascriptAceTxtEditor('" . 
  $op . "','" . $num . "','" . $editorId . "');" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setHookId(\"" . $hookId . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setFontSize(" . $fontSize . ");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setHeight(\"" . $height . "px" . "\");" . STRING_ESC_RETURN .  
  $javascriptInterfaceName . STRING_POINT . "setKeyboardHandler(\"" . $keyBoardHandler . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setReadOnly(" . (($readOnly==true)?"true":"false") . ");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setShowInvisibles(" . (($showInvisibles==true)?"true":"false") . ");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setTheme(\"" . $theme . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setStyle(\"" . $style . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setMode(\"" . $mode . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setGetAjaxOp(\"" . $getOp . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setSendAjaxOp(\"" . $sendOp . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setFileName(\"" . $fileName . "\");" . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setEditorId(\"" . $editorId . "\");"  . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setEnableStatusBar(\"" . $enableStatusBar . "\");"  . STRING_ESC_RETURN .
  $javascriptInterfaceName . STRING_POINT . "setEnableOpBar(\"" . $enableOpBar . "\");"  . STRING_ESC_RETURN;
  
  $str2 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;
  $dataExchangeType = $this->getDataExchangeType();

  $callBackFunPattern = $this->getCallBackFunPattern();

  if($callBackFunPattern != STRING_NULL)
   $callBackFun = "function(){" .
   "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
   "','" . $fileName . "','" . $dataExchangeType . "',$callBackFunPattern);}";
  else
   $callBackFun = "function(){" .
   "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE ."','" . $op . 
   "','" . $fileName . "','" . $dataExchangeType . "');}";   	  
  
  $str3 = (($enableDataFromRemote==true)?
  ("common.getEventStack().push($callBackFun);" . STRING_ESC_RETURN):
  (STRING_NULL));
  
  $str = $str1 . (($this->getEnableInsertInClientContainer())?$str2:STRING_NULL) . 
  (($this->getEnableExecuteOnLoad())?$str3:STRING_NULL); 

  return $str;
 }
 
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();  
  $str = $this->getJavascriptInterfaceInstantationStr();
 	$htmlWriter->putGenericHtmlString($str);
 }
     
}

?>