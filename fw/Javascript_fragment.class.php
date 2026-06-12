<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


//
// Frammento javascript che può essere eseguito al caricamento della pagina.
// L'output con opzione su hookId.
//

class Javascript_fragment extends Html_formatted_interface
{
 
 const DUAL_JAVASCRIPT_INTERFACE_NAME = "JavascriptFragment";
 const DEFAULT_JAVASCRIPT_MODULE=JS_INTERFACES;	
 const DEFAULT_INSERT_IN_CLIENT_CONTAINER = true;
 const DEFAULT_ENABLE_EXECUTE_ONLOAD = true;
	
 private $hookId = STRING_NULL;
 private $javascriptFragment=STRING_NULL;
 private $enableInsertInClientContainer=self::DEFAULT_INSERT_IN_CLIENT_CONTAINER;
 private $enableExecuteOnLoad=self::DEFAULT_ENABLE_EXECUTE_ONLOAD;
 static private $javascriptFragmentsTotNum=0;
 static $useJQuery = true;
 static $useDojo = true;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  /*self::$useDojo =  true;
  self::$useJQuery = true;*/
  self::$javascriptFragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$javascriptFragmentsTotNum - 1;

 	parent::__construct($actOp,self::INT_JAVASCRIPT_FRAGMENT,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putGenericHtmlString("//<!--" . chr(13));
 	$htmlWriter->putGenericHtmlString("if(interfacesContainer===undefined) interfacesContainer = interfaces.createInterfacesContainer();");	   
 	$this->putData(); 
 	$htmlWriter->putGenericHtmlString("//-->");
 }

 
 static function getInterfacesTotNum():string|int
 {
 	return self::$javascriptFragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$javascriptFragmentsTotNum=$actIntNum + 0;
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
 	$javascriptFragment = $this->getJavascriptFragment();
 	$item2 = array("@javascriptFragment"=>$javascriptFragment);
 	$serializer->loadItems($item2);	
 	$enableInsertInClientContainer = $this->getEnableInsertInClientContainer();
 	$item3 = array("enableInsertInClientContainer"=>$enableInsertInClientContainer);
 	$serializer->loadItems($item3);
 	$enableExecuteOnLoad = $this->getEnableExecuteOnLoad();
 	$item4 = array("enableExecuteOnLoad"=>$enableExecuteOnLoad);
 	$serializer->loadItems($item4);						
 }
 
 function setHookId(string $actHookId):void
 {
 	$this->hookId = $actHookId;
 }
 
 function getHookId():string
 {
 	return $this->hookId;
 }
 
 function loadFragmentFromFile(string $actFileName):void
 {
 	$fileRows = file($actFileName);
 	$javascriptFragment = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $javascriptFragment = $javascriptFragment . $fileRow;
 	}
 	$this->setJavascriptFragment($javascriptFragment);
 }
 
 function setJavascriptFragment(string $actJavascriptFragment):void
 {
 	$actJavascriptFragment = preg_replace("/[']/","\'",$actJavascriptFragment);
 	$this->javascriptFragment = $actJavascriptFragment;
 }
 
 function getJavascriptFragment():string
 {
 	return $this->javascriptFragment;
 }
 
 function setEnableInsertInClientContainer(bool $actEnableInsertInClientContainer):void
 {
 	$this->enableInsertInClientContainer = $actEnableInsertInClientContainer;
 }
 
 function getEnableInsertInClientContainer():bool
 {
 	if($this->enableInsertInClientContainer == STRING_NULL)
 	 return self::DEFAULT_INSERT_IN_CLIENT_CONTAINER;
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
 	$fragment = $this->getJavascriptFragment();
 	$hookId = $this->getHookId();
 	$op = $this->getOp();
 	$num = $this->getNum();
  $javascriptInterfaceName = $this->getDualInterfaceName();  
  $str1 = "var " . $javascriptInterfaceName . " = interfaces.createJavascriptFragment('" . 
  $op . "','" . $num . "');" . STRING_ESC_RETURN;
  //$str12= $javascriptInterfaceName . STRING_POINT . "setId('" . $hookId . "');" . STRING_ESC_RETURN;
  $str2 = $javascriptInterfaceName . STRING_POINT . "setHookId('" . $hookId . "');" . STRING_ESC_RETURN;
  $str3 = $javascriptInterfaceName . STRING_POINT . "setJavascriptFragment('" . $fragment . "');" . STRING_ESC_RETURN;
  $str4 = "interfacesContainer.add(" .  $javascriptInterfaceName . ");" . STRING_ESC_RETURN;
  $callBackFun = "function(){" .
  "var int = interfacesContainer.getInterface('" . $op . "');int.putData()}";  
  $str5 = "common.getEventStack().push($callBackFun);" . STRING_ESC_RETURN;
  $str = $str1  /*$str12*/ . $str2 . $str3 . (($this->getEnableInsertInClientContainer())?$str4:STRING_NULL) . 
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