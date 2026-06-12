<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


//
// Editor di testo html
// Implemenatto tramite le interfacce javascript.
//


class Javascript_data_txtEditor extends Html_formatted_interface
{
 
 const DUAL_JAVASCRIPT_INTERFACE_NAME = "JavascriptTxtEditor";
 const DEFAULT_DATA_EXCHANGE_TYPE="text";
 const DEFAULT_JAVASCRIPT_MODULE=JS_INTERFACES;
 const DEFAULT_GET_FILE_OP="getFile";
 const DEFAULT_SEND_FILE_OP="sendFile";
 const DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER = true;
 const DEFAULT_ENABLE_EXECUTE_ON_LOAD = true;
 const DEFAULT_EXECUTE_DATA_FROM_REMOTE = true;
 const DEFAULT_COLS = 80;
 const DEFAULT_ROWS = 20;
 
 private $hookId = STRING_NULL;
 private $dataExchangeType = self::DEFAULT_DATA_EXCHANGE_TYPE;
 private $enableInsertInClientContainer=self::DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER;
 private $enableExecuteOnLoad = self::DEFAULT_ENABLE_EXECUTE_ON_LOAD;
 private $enableDataFromRemote=self::DEFAULT_EXECUTE_DATA_FROM_REMOTE;
 private $callBackFunPattern=STRING_NULL;
 private $fileName=STRING_NULL;
 private $getOp=self::DEFAULT_GET_FILE_OP;
 private $sendOp=self::DEFAULT_SEND_FILE_OP;
 private $cols=self::DEFAULT_COLS;
 private $rows=self::DEFAULT_ROWS;
 static private $javascriptDataTxtEditorsTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$javascriptDataTxtEditorsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptDataTxtEditorsTotNum - 1;
 	//self::$hasJavascriptManagement=true; 
 	parent::__construct($actOp,self::INT_JAVASCRIPT_DATA_TXTEDITOR,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
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
 
 function setCallBackFunPattern(string $actCallBackFunPattern):void
 {
 	$this->callBackFunPattern = $actCallBackFunPattern;
 }
 
 function getCallBackFunPattern():string
 {
 	return $this->callBackFunPattern;
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
 	$dataExchangeType = $this->getDataExchangeType();
 	$item3 = array("dataExchangeType"=>$dataExchangeType);
 	$serializer->loadItems($item3);	
 	$enableInsertInClientContainer = $this->getEnableInsertInClientContainer();
 	$item4 = array("*enableInsertInClientContainer"=>$enableInsertInClientContainer);
 	$serializer->loadItems($item4);
 	$enableExecuteOnLoad = $this->getEnableExecuteOnLoad();
 	$item5 = array("*enableExecuteOnLoad"=>$enableExecuteOnLoad);
 	$serializer->loadItems($item5);
 	$fileName = $this->getFileName(); 		
 	$item6 = array("fileName"=>$fileName);
 	$serializer->loadItems($item6);
 	$getOp = $this->getGetOp();
 	$item7 = array("getOp"=>$getOp);
 	$serializer->loadItems($item7);
 	$sendOp = $this->getSendOp();
 	$item8 = array("sendOp"=>$sendOp);
 	$serializer->loadItems($item8);
 	$cols = $this->getCols();
 	$item9 = array("cols"=>$cols);
 	$serializer->loadItems($item9);
 	$rows = $this->getRows();
 	$item10 = array("rows"=>$rows);
 	$serializer->loadItems($item10);
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
 	$item11 = array("*enableDataFromRemote"=>$enableDataFromRemote);
 	$serializer->loadItems($item11); 	  									
 }
 
 function getEnableDataFromRemote():bool
 {
 	if($this->enableDataFromRemote == STRING_NULL)
 	 return self::DEFAULT_EXECUTE_DATA_FROM_REMOTE;
 	else
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
 
 function getCols():int
 {
 	if($this->cols == NO_VALUE)
 	 return self::DEFAULT_COLS;
 	else
 	 return $this->cols;
 }
 
 function setCols(int $actCols):void
 {
 	$this->cols = $actCols;
 }
 
 function getRows():int
 {
 	if($this->rows == NO_VALUE)
 	 return self::DEFAULT_ROWS;
 	else
 	 return $this->rows;
 }
 
 function setRows(int $actRows):void
 {
 	$this->rows = $actRows;
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
 	if($this->getOp == STRING_NULL)
 	 return self::DEFAULT_GET_FILE_OP;
 	else
 	 return $this->getOp;
 }
 
 function setGetOp(string $actGetOp):void
 {
 	$this->getOp = $actGetOp;
 }
 
 function getSendOp():string
 {
 	if($this->sendOp == STRING_NULL)
 	 return self::DEFAULT_SEND_FILE_OP;
 	else
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
 	if($this->enableInsertInClientContainer == STRING_NULL)
 	 return self::DEFAULT_ENABLE_INSERT_IN_CLIENT_CONTAINER;
 	else
 	 return $this->enableInsertInClientContainer;
 }
 
 function setEnableExecuteOnLoad(bool $actEnableExecuteOnLoad):void
 {
 	$this->enableExecuteOnLoad = $actEnableExecuteOnLoad;
 }
 
 function getEnableExecuteOnLoad():bool
 {
 	if($this->enableExecuteOnLoad == STRING_NULL)
 	  return self::DEFAULT_EXECUTE_ON_LOAD;
 	else
 	 return $this->enableExecuteOnLoad;
 }
 
 function getDualInterfaceName():string
 {
  $op = $this->getOp();
  $num = $this->getNum();
  $javascriptIntefaceName = self::DUAL_JAVASCRIPT_INTERFACE_NAME . $op . $num;
  return $javascriptIntefaceName;
 }
 
 function enableBootstrap():void
 {
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
 	$hookId = $this->getHookId();
 	$op = $this->getOp();
 	$getOp = $this->getGetOp();
 	$sendOp = $this->getSendOp();
 	$num = $this->getNum();
 	$rows = $this->getRows();
 	$cols = $this->getCols();
  $fileName = $this->getFileName();
 	$enableDataFromRemote = $this->getEnableDataFromRemote();
  $javascriptInterfaceName = $this->getDualInterfaceName();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createJavascriptTxtEditor('" . 
  $op . "','" . $num . "');" . STRING_ESC_RETURN;
  $str2 = $javascriptInterfaceName . STRING_POINT . "setHookId(\"" . $hookId . "\");" . STRING_ESC_RETURN;
  $str3 = $javascriptInterfaceName . STRING_POINT . "setRows(\"" . $rows . "\");" . 
  $javascriptInterfaceName . STRING_POINT . "setCols(\"" . $cols . "\");" .
  $javascriptInterfaceName . STRING_POINT . "setGetAjaxOp(\"" . $getOp . "\");" .
  $javascriptInterfaceName . STRING_POINT . "setSendAjaxOp(\"" . $sendOp . "\");" .
  $javascriptInterfaceName . STRING_POINT . "setFileName(\"" . $fileName . "\");";
  $str4 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;

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
  	  

  $str5 = (($enableDataFromRemote==true)?
  ("common.getEventStack().push($callBackFun);" . STRING_ESC_RETURN):
  (STRING_NULL));
  
  $str = $str1 . $str2 . $str3 . (($this->getEnableInsertInClientContainer())?$str4:STRING_NULL) . 
  (($this->getEnableExecuteOnLoad())?$str5:STRING_NULL); 

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