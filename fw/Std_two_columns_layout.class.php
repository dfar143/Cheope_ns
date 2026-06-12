<?
namespace Std\fw;
require_once("Html_formatted_interface.class.php");
require_once("std.fun.php");


class Std_two_columns_layout extends Html_formatted_interface
{ 
// const ERROR_1="Std_two_columns_layout:Errore nell'inserimento dell'interface container di sinistra.";
// const ERROR_2="Std_two_columns_layout:Errore nell'inserimento dell'interface container di destra.";
 const DEFAULT_CSS_CLASS="two_columns_layout";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_1 = "xs";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_2 = "sm";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_3 = "md";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_4 = "lg";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_5 = "xl";
 const DEFAULT_CONTAINER_STYLE = "width:100%;height:100%";
 const DEFAULT_CONTAINER_LEFT_STYLE = "width:50%;height:100%";
 const DEFAULT_CONTAINER_RIGHT_STYLE = "width:50%;height:100%";

 static private $layoutsTotNum=0;
 private $withContainer=true;
 private $bootstrapContainerType = self::DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1;
 private $bootstrapViewPortSizeType = self::DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_3;
 private $containerStyle=self::DEFAULT_CONTAINER_STYLE;
 private $containerLeftStyle=self::DEFAULT_CONTAINER_LEFT_STYLE;
 private $containerRightStyle=self::DEFAULT_CONTAINER_RIGHT_STYLE;
 private $interfacesContainerLeft=null;
 private $interfacesContainerRight=null;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$layoutsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$layoutsTotNum - 1; 
  parent::__construct($actOp,self::INT_TWO_COLUMNS_LAYOUT,$actNum);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$layoutsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
  self::$layoutsTotNum=$actIntNum;
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
  
 function setContainerLeftStyle(string $actContainerLeftStyle):void
 {
 	$this->containerLeftStyle = $actContainerLeftStyle;
 }
 
 function getContainerLeftStyle():string
 {
 	if($this->containerLeftStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_LEFT_STYLE;
 	else
 	 return $this->containerLeftStyle;
 }
 
 function setContainerRightStyle(string $actContainerRightStyle):void
 {
 	$this->containerRightStyle = $actContainerRightStyle;
 }
 
 function getContainerRightStyle():string
 {
 	if($this->containerRightStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_RIGHT_STYLE;
 	else
 	 return $this->containerRightStyle;
 }

  function enableBootstrap():void
 {
 	$bootstrapEnabled = $this->getBootstrapEnabled();
 	if ($bootstrapEnabled)
 	{
 		if(isset($this->interfacesContainerLeft)||
 		isset($this->interfacesContainerRight))
 		{
 		 $intContainer = $this->getInterfacesContainerLeft();
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
 		 $intContainer = $this->getInterfacesContainerRight();
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
 	$containerLeftStyle = $this->getContainerLeftStyle();
 	$containerRightStyle = $this->getContainerRightStyle();
 	$intContLeft = $this->getInterfacesContainerLeft();
	if(is_null($intContLeft))
	 $intContLeft = self::createInterfacesContainer();
 	$intContRight = $this->getInterfacesContainerRight();
	if(is_null($intContRight))
	 $intContRight = self::createInterfacesContainer();
 	$withContainer = $this->getWithContainer();
 	$containerStyle = $this->getContainerStyle();
 	$bootstrapContainerType = $this->getBootstrapContainerType();
 	$bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
 	$item1 = array("*withContainer"=>$withContainer);
 	$serializer->loadItems($item1); 	
 	$item2 = array("containerStyle"=>$containerStyle);
 	$serializer->loadItems($item2);
 	$item3 = array("bootstrapContainerType"=>$bootstrapContainerType);
 	$serializer->loadItems($item3);
 	$item4 = array("bootstrapViewPortSizeType"=>$bootstrapViewPortSizeType);
 	$serializer->loadItems($item4);
 	$item5 = array("containerLeftStyle"=>$containerLeftStyle);
 	$serializer->loadItems($item5);
 	$item6 = array("containerRightStyle"=>$containerRightStyle);
 	$serializer->loadItems($item6);
 	$item7 = array("interfacesContainerLeft"=>$intContLeft);
 	$serializer->loadItems($item7);
 	$item8 = array("interfacesContainerRight"=>$intContRight);
 	$serializer->loadItems($item8);   	
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

function setBootstrapViewPortSizeType(string $actBootstrapViewPortSizeType):void
{
	$this->bootstrapViewPortSizeType = $actBootstrapViewPortSizeType; 
}

 function getBootstrapViewPortSizeType():string
 {
 	return $this->bootstrapViewPortSizeType;
 }

 function setInterfacesContainerLeft(?Interfaces_container $actIntContainer):void
 {
   $this->interfacesContainerLeft = $actIntContainer;
 }
 
 function getInterfacesContainerLeft():?Interfaces_container
 {
  return $this->interfacesContainerLeft;
 }
 
 function setInterfacesContainerRight(?Interfaces_container $actIntContainer):void
 {
   $this->interfacesContainerRight = $actIntContainer;
 }
 
 function getInterfacesContainerRight():?Interfaces_container
 {
  return $this->interfacesContainerRight;
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
 function putContainer(Interfaces_container $actCont):void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
  $interfacesContainer = $actCont;
	$intCode = $this->getInterfaceId();
  $iterator = $interfacesContainer->create();
  $iterator->reset();
	while($iterator->hasMore())
	{
	 $actCtl = $iterator->current();
	 if((! is_null($actCtl)) && ($iterator->hasMore()) && ($actCtl !== false))
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
		
 function putContainerLeft():void
 {
	$interfacesContainerLeft = $this->getInterfacesContainerLeft();
	$this->putContainer($interfacesContainerLeft);
 }	
 
 function putContainerRight():void
 {
	$interfacesContainerRight = $this->getInterfacesContainerRight();	
	$this->putContainer($interfacesContainerRight);
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
	$style = $this->getStyle();
	$bootstrapEnabled = $this->getBootstrapEnabled();
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
  $bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
  $leftCss = "col" . STRING_MINUS . $bootstrapViewPortSizeType . STRING_MINUS . "6";
  $leftStyle = "float:left";
  $leftStyle = $leftStyle . STRING_SEMICOLON . $this->getContainerLeftStyle();  
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "left",$leftStyle,
  (($bootstrapEnabled)?$leftCss:STRING_NULL));
	$this->putContainerLeft();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$rightCss = "col" . STRING_MINUS . $bootstrapViewPortSizeType . STRING_MINUS . "6";
  $rightStyle = "float:left";
  $rightStyle = $rightStyle . STRING_SEMICOLON . $this->getContainerRightStyle();  
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "right",$rightStyle,
  (($bootstrapEnabled)?$rightCss:STRING_NULL));
	$this->putContainerRight();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	if($withContainer)
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	

 }
}


?>