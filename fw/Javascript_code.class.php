<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


//
// Codice javascript che può essere eseguito al caricamento della pagina.
//

class Javascript_code extends Html_formatted_interface
{
// const DUAL_JAVASCRIPT_INTERFACE_NAME = "JavascriptCode";
// const DEFAULT_JAVASCRIPT_MODULE=JS_INTERFACES;	
// const DEFAULT_INSERT_IN_CLIENT_CONTAINER = true;
// const DEFAULT_ENABLE_EXECUTE_ONLOAD = true;
	
// private $hookId = STRING_NULL;
 private $javascriptCode=STRING_NULL;
// private $enableInsertInClientContainer=self::DEFAULT_INSERT_IN_CLIENT_CONTAINER;
// private $enableExecuteOnLoad=self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 static private $javascriptCodeTotNum=0;
// static $useJQuery = true;
// static $useDojo = true;
// static $hasJavascriptEnabledSwitch = false;
// static $hasJavascriptManagement = true;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {

  self::$javascriptCodeTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptCodeTotNum - 1;
 	parent::__construct($actOp,self::INT_JAVASCRIPT_CODE,$actNum);
//  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
 }
 
/* function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putGenericHtmlString("//<!--" . chr(13));
 	$htmlWriter->putGenericHtmlString("if(interfacesContainer===undefined) interfacesContainer = interfaces.createInterfacesContainer();");	   
 	$this->putData(); 
 	$htmlWriter->putGenericHtmlString("//-->");
 }*/

 
 static function getInterfacesTotNum():string|int
 {
 	return self::$javascriptCodeTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$javascriptCodeTotNum=$actIntNum + 0;
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
 	//$hookId = $this->getHookId();
 	//$item1 = array("hookId"=>$hookId);
 	//$serializer->loadItems($item1);	
 	$javascriptCode = $this->getJavascriptCode();
 	$item1 = array("@javascriptCode"=>$javascriptCode);
 	$serializer->loadItems($item1);	
 	/*$enableInsertInClientContainer = $this->getEnableInsertInClientContainer();
 	$item3 = array("enableInsertInClientContainer"=>$enableInsertInClientContainer);
 	$serializer->loadItems($item3);
 	$enableExecuteOnLoad = $this->getEnableExecuteOnLoad();
 	$item4 = array("enableExecuteOnLoad"=>$enableExecuteOnLoad);
 	$serializer->loadItems($item4);*/						
 }
 
/* function setHookId(string $actHookId)
 {
 	$this->hookId = $actHookId;
 }
 
 function getHookId()
 {
 	return $this->hookId;
 }*/
 
 function loadCodeFromFile(string $actFileName):void
 {
 	$fileRows = file($actFileName);
 	$javascriptCode = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $javascriptCode = $javascriptCode . $fileRow;
 	}
 	$this->setJavascriptCode($javascriptCode);
 }
 
 function setJavascriptCode(string $actJavascriptCode):void
 {
 	//$actJavascriptCode = preg_replace("/[']/","\'",$actJavascriptCode);
 	$this->javascriptCode = $actJavascriptCode;
 }
 
 function getJavascriptCode():string
 {
 	return $this->javascriptCode;
 }
 
/* function setEnableInsertInClientContainer(bool $actEnableInsertInClientContainer)
 {
 	$this->enableInsertInClientContainer = $actEnableInsertInClientContainer;
 }
 
 function getEnableInsertInClientContainer()
 {
 	if($this->enableInsertInClientContainer == STRING_NULL)
 	 return self::DEFAULT_INSERT_IN_CLIENT_CONTAINER;
 	else
 	return $this->enableInsertInClientContainer;
 }
 
 function setEnableExecuteOnLoad(bool $actEnableExecuteOnLoad)
 {
 	$this->enableExecuteOnLoad = $actEnableExecuteOnLoad;
 }
 
 function getEnableExecuteOnLoad()
 {
 	if($this->enableExecuteOnLoad == STRING_NULL)
 	 return self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 	else
 	 return $this->enableExecuteOnLoad;
 }
 
 function getDualInterfaceName():string
 {
  $op = $this->getOp();
  $num = $this->getNum();
  $javascriptIntefaceName = self::DUAL_JAVASCRIPT_INTERFACE_NAME . $op . $num;
  return $javascriptIntefaceName;
 }*/
 
 function isContainer():bool
 {
  return false;
 }
 
 function isDecorator():bool
 {
  return false;
 }
 
/* function getJavascriptInterfaceInstantationStr()
 {
 	$fragment = $this->getJavascriptFragment();
 	$hookId = $this->getHookId();
 	$op = $this->getOp();
 	$num = $this->getNum();
  $javascriptInterfaceName = $this->getDualInterfaceName();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createJavascriptDataFragment('" . 
  $op . "','" . $num . "');" . STRING_ESC_RETURN;
  $str2 = $javascriptInterfaceName . STRING_POINT . "setHookId('" . $hookId . "');" . STRING_ESC_RETURN;
  $str3 = $javascriptInterfaceName . STRING_POINT . "setJavascriptFragment('" . $fragment . "');" . STRING_ESC_RETURN;
  $str4 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;
  $callBackFun = "function(){" .
  "var int = interfacesContainer.getInterface('" . $op . "');int.putData()}";  
  $str5 = "common.getEventStack().push($callBackFun);" . STRING_ESC_RETURN;
  $str = $str1 . $str2 . $str3 . (($this->getEnableInsertInClientContainer())?$str4:STRING_NULL) . 
  (($this->getEnableExecuteOnLoad())?$str5:STRING_NULL); 

  return $str;
 }*/
 
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();  
    $str = $this->getJavascriptCode();
 	$htmlWriter->putGenericHtmlString($str);
 }
     
}

?>