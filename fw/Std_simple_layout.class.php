<?
namespace Std\fw;
require_once("Html_formatted_interface.class.php");
require_once("std.fun.php");


class Std_simple_layout extends Html_formatted_interface
{ 
 
// const ERROR_1="Std_simple_layout:Errore nell'inserimento dell'interface container.";
 const DEFAULT_CSS_CLASS="simple_layout";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const DEFAULT_CONTAINER_STYLE = "width:100%;height:100%";

 static private $layoutsTotNum=0;
 private $withContainer=true;
 private $containerStyle=self::DEFAULT_CONTAINER_STYLE;
 private $bootstrapContainerType = self::DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1;
 private $interfacesContainerCenter=null;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$layoutsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$layoutsTotNum - 1; 
  parent::__construct($actOp,self::INT_SIMPLE_LAYOUT,$actNum);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$layoutsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$layoutsTotNum=$actIntNum + 0;
 }
 
 function setWithContainer(bool $actWithContainer):void
 {
 	$this->withContainer = $actWithContainer;
 }
 
 function getWithContainer():bool
 {
 	return $this->withContainer;
 }
 
 function setContainerStyle(string $actContainerStyle):void
 {
 	$this->containerStyle = $actContainerStyle;
 }
 
 function getContainerStyle():string
 {
 	if($this->containerStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_STYLE;
 	else
 	 return $this->containerStyle;
 }
  
 function enableBootstrap():void
 {
 	$bootstrapEnabled = $this->getBootstrapEnabled();
 	if ($bootstrapEnabled)
 	{
 		if(isset($this->interfacesContainerCenter))
 		{
 		 $intContainer = $this->getInterfacesContainerCenter();
 		 $iterator = $intContainer->create();
 	   $iterator->reset();
 	   while($iterator->hasMore())
 	   {
 		  $int = $iterator->current();
 		  if(isset($int->bootstrapEnabled))
 		  {
 		   $int->setBootstrapEnabled(true);
 		   $int->enableBootstrap();
 		  } 
 		  $iterator->next();
 	   }
 	   $iterator->reset();
 	  }
 	} 
 }  
  
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$intCont = $this->getInterfacesContainerCenter();
	if(is_null($intCont))
	 $intCont = self::createInterfacesContainer();
 	$withContainer = $this->getWithContainer();
 	$containerStyle = $this->getContainerStyle();
 	$bootstrapEnabled = $this->getBootstrapEnabled();
 	$bootstrapContainerType = $this->getBootstrapContainerType();
 	$item1 = array("interfacesContainerCenter"=>$intCont);
 	$serializer->loadItems($item1);
 	$item2 = array("*withContainer"=>$withContainer);
 	$serializer->loadItems($item2); 	
 	$item3 = array("containerStyle"=>$containerStyle);
 	$serializer->loadItems($item3);
 	$item4 = array("bootstrapContainerType"=>$bootstrapContainerType);
 	$serializer->loadItems($item4);
 }
 
 function getCssClass():string
{
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
}
 
function setBootstrapContainerType(string $actBootstrapContainerType):void
{
	$this->bootstrapContainerType = $actBootstrapContainerType; 
}

 function getBootstrapContainerType():string
 {
 	return $this->bootstrapContainerType;
 }
  
 function setInterfacesContainerCenter(?Interfaces_container $actIntContainer):void
 {
   $this->interfacesContainerCenter = $actIntContainer;
 }
 
 function getInterfacesContainerCenter():?Interfaces_container
 {
  return $this->interfacesContainerCenter;
 }
 
 function isContainer():bool
 {
  return true;
 }
 
 function isDecorator():bool
 {
 	return false;
 }
 
 //  Effettua il render dei controlli contenuti
 // nel contenitore 
 //
 function putContainer():void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
  $interfacesContainer = $this->getInterfacesContainerCenter();
	$intCode = $this->getInterfaceId();
	if (! empty($interfacesContainer))
	{
   $iterator = $interfacesContainer->create();
   $iterator->reset();
	 while($iterator->hasMore())
	 {
		$actCtl = $iterator->current();
		if((! is_null($actCtl)) && 
		($iterator->hasMore()) && 
		($actCtl !== false))
		{
		 $actCtl->setHtmlWriter($htmlWriter);
		 $actCtl->putData();
		 $iterator->next();	
		}
		elseif($iterator->hasMore())
		{
		  $iterator->next();
		}
	 }
	}		 
 }
 
 function getHeader(array $actRow):string
 {
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
 	$htmlWriter = $this->getHtmlWriter(); 	
	$cssClass = $this->getCssClass();
	$intCode = $this->getInterfaceId();
	$withContainer = $this->getWithContainer();
	if($withContainer)
  {
	 $containerStyle = $this->getContainerStyle();
	 if($this->getBootstrapEnabled())
	 {
	 	$containerType = $this->getBootstrapContainerType();
	 	$cssClass .= STRING_SPACE . $containerType;
	 }
   $htmlWriter->putDivOpenTag($intCode,$containerStyle,$cssClass);
  }	
	$this->putContainer();
	if($withContainer)
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	
 }
}


?>