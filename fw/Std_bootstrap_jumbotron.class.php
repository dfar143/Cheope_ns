<?
namespace Std\fw;
require_once("Html_formatted_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_bootstrap_jumbotron extends Html_formatted_interface
{
 
 const DEFAULT_CSS_CLASS = "jumbotron";
 const BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
      
  private $bootstrapInnerContainerType = self::BOOTSTRAP_CONTAINER_TYPE_1;
  private $bootstrapOuterContainerType = self::BOOTSTRAP_CONTAINER_TYPE_2;
  private $innerInterface = null;
  static private $tablesTotNum=0;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = false;
  static $hasJavascriptManagement = false;
  static $hasCssManagement = false;
     
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;
  parent::__construct($actOp,self::INT_BOOTSTRAP_JUMBOTRON,$actNum);
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
 	$innerInterface = $this->getInnerInterface();
 	$bootstrapInnerContainerType = $this->getBootstrapInnerContainerType();
 	$item1 = array("bootstrapInnerContainerType"=>$bootstrapInnerContainerType); 
 	$serializer->loadItems($item1);
    $bootstrapOuterContainerType = $this->getBootstrapOuterContainerType();	
 	$item2 = array("bootstrapOuterContainerType"=>$bootstrapOuterContainerType); 
 	$serializer->loadItems($item2);	
 	$item4 = array("innerInterface"=>$innerInterface);
 	$serializer->loadItems($item4);
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item5 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item5); 							
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
 function enableBootstrap():void
 {
 	$this->setBootstrapEnabled(true);	
 } 
 
 function setBootstrapOuterContainerType(string $actBootstrapOuterContainerType):void
 {
	$this->bootstrapOuterContainerType = $actBootstrapOuterContainerType; 
 }

 function getBootstrapOuterContainerType():string
 {
 	if($this->bootstrapOuterContainerType == STRING_NULL)
 	 return self::BOOTSTRAP_CONTAINER_TYPE_2;
 	else
 	 return $this->bootstrapOuterContainerType;
 }
 
 function setBootstrapInnerContainerType(string $actBootstrapInnerContainerType):void
 {
	$this->bootstrapInnerContainerType = $actBootstrapInnerContainerType; 
 }

 function getBootstrapInnerContainerType():string
 {
  if($this->bootstrapInnerContainerType == STRING_NULL)
 	 return self::BOOTSTRAP_CONTAINER_TYPE_1;
 	else
 	 return $this->bootstrapInnerContainerType;
 }
 
 function getInnerInterface():?Html_formatted_interface
 {
 	return $this->innerInterface;
 }
 
 function setInnerInterface(?Html_formatted_interface $actInnerInterface):void
 {
 	$this->innerInterface = $actInnerInterface;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function isDecorator():bool
 {
  return false;
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
  $htmlWriter = $this->getHtmlWriter();
  $cssClass = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
  $cssClass1 = STRING_NULL;
  $cssClass2 = STRING_NULL;
  $bootstrapOuterContainerType = $this->getBootstrapOuterContainerType();
  $bootstrapInnerContainerType = $this->getBootstrapInnerContainerType();
  $cssClass1 .= $bootstrapOuterContainerType;
  $cssClass2 .= $bootstrapInnerContainerType;
  $innerInterface = $this->getInnerInterface(); 
 	$htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass1);
 	$htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass2);
 	$htmlWriter->putDivOpenTag(STRING_NULL,$style,$cssClass);
  if(! is_null($this->innerInterface))
   $innerInterface->putData();
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
}


?>