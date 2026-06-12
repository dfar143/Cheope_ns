<?
namespace Std\fw;
require_once("Html_formatted_interface.class.php");
require_once("std.fun.php");


class Std_tb_layout extends Html_formatted_interface
{ 

// const ERROR_1="Std_tb_layout:Errore nell'inserimento dell'interface container di sinistra.";
// const ERROR_2="Std_tb_layout:Errore nell'inserimento dell'interface container di destra.";
 const DEFAULT_CSS_CLASS="tb_layout";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const DEFAULT_CONTAINER_STYLE = "width:100%;height:100%";
 const DEFAULT_CONTAINER_TOP_STYLE = "width:100%;height:50%";
 const DEFAULT_CONTAINER_BOTTOM_STYLE = "width:100%;height:50%";

 static private $layoutsTotNum=0;
 private $withContainer=true;
 private $bootstrapContainerType=self::DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1;
 private $containerStyle=self::DEFAULT_CONTAINER_STYLE;
 private $containerTopStyle=self::DEFAULT_CONTAINER_TOP_STYLE;
 private $containerBottomStyle=self::DEFAULT_CONTAINER_BOTTOM_STYLE;
 private $interfacesContainerTop=null;
 private $interfacesContainerBottom=null;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$layoutsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$layoutsTotNum - 1; 
  parent::__construct($actOp,self::INT_TB_LAYOUT,$actNum);
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
 	if($this->containerStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_STYLE;
 	else
 	 return $this->containerStyle;
 }
 
 function setContainerStyle(string $actContainerStyle):void
 {
 	$this->containerStyle = $actContainerStyle;
 }
 
 function getContainerStyle():string
 {
 	if($this->containerStyle == STRING_NULL)
 	 return  self::DEFAULT_CONTAINER_STYLE;
 	else
 	 return $this->containerStyle;
 }
  
 function setContainerTopStyle(string $actContainerTopStyle):void
 {
 	$this->containerTopStyle = $actContainerTopStyle;
 }
 
 function getContainerTopStyle():string
 {
 	if($this->containerTopStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_TOP_STYLE;
  else
   return $this->containerTopStyle;
 }
 
 function setContainerBottomStyle(string $actContainerBottomStyle):void
 {
 	$this->containerBottomStyle = $actContainerBottomStyle;
 }
 
 function getContainerBottomStyle():string
 {
 	if($this->containerBottomStyle == STRING_NULL)
 	 return self::DEFAULT_CONTAINER_BOTTOM_STYLE;
 	else
 	 return $this->containerBottomStyle;
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();

 	$serializer = $this->getSerializer();
 	$containerTopStyle = $this->getContainerTopStyle();
 	$containerBottomStyle = $this->getContainerBottomStyle();
 	$intContTop = $this->getInterfacesContainerTop();
	if(is_null($intContTop))
	 $intContTop = self::createInterfacesContainer();
 	$intContBottom = $this->getInterfacesContainerBottom();
 	if(is_null($intContBottom))
	 $intContBottom = self::createInterfacesContainer();
 	$withContainer = $this->getWithContainer();
 	$containerStyle = $this->getContainerStyle();
	$bootstrapContainerType = $this->getBootstrapContainerType();
 	$item1 = array("*withContainer"=>$withContainer);
 	$serializer->loadItems($item1); 	
 	$item2 = array("containerStyle"=>$containerStyle);
 	$serializer->loadItems($item2);
 	$item3 = array("bootstrapContainerType"=>$bootstrapContainerType);
 	$serializer->loadItems($item3);
 	$item4 = array("containerTopStyle"=>$containerTopStyle);
 	$serializer->loadItems($item4);
 	$item5= array("containerBottomStyle"=>$containerBottomStyle);
 	$serializer->loadItems($item5);
 	$item6 = array("interfacesContainerTop"=>$intContTop);
 	$serializer->loadItems($item6);
 	$item7 = array("interfacesContainerBottom"=>$intContBottom);
 	$serializer->loadItems($item7);  	
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
  if($this->bootstrapContainerType == STRING_NULL)
   return self::BOOTSTRAP_CONTAINER_TYPE_1;
  else
   return $this->bootstrapContainerType;
 }

 function enableBootstrap():void
 {
 	$bootstrapEnabled = $this->getBootstrapEnabled();
 	if ($bootstrapEnabled)
 	{
 		if(isset($this->interfacesContainerTop)||
 		isset($this->interfacesContainerBottom))
 		{
 		 $intContainer = $this->getInterfacesContainerTop();
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
 		 $intContainer = $this->getInterfacesContainerBottom();
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
  
 function setInterfacesContainerTop(?Interfaces_container $actIntContainer):void
 {
   $this->interfacesContainerTop = $actIntContainer;
 }
 
 function getInterfacesContainerTop():?Interfaces_container
 {
  return $this->interfacesContainerTop;
 }
 
 function setInterfacesContainerBottom(?Interfaces_container $actIntContainer):void
 {
   $this->interfacesContainerBottom = $actIntContainer;
 }
 
 function getInterfacesContainerBottom():?Interfaces_container
 {
  return $this->interfacesContainerBottom;
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
		
 function putContainerTop():void
 {
	$interfacesContainerTop= $this->getInterfacesContainerTop();
	$this->putContainer($interfacesContainerTop);
 }	
 
 function putContainerBottom():void
 {
	$interfacesContainerBottom = $this->getInterfacesContainerBottom();	
	$this->putContainer($interfacesContainerBottom);
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
	$bootstrapEnabled =  $this->getBootstrapEnabled();
	if($withContainer)
  {
	 $containerStyle= $this->getContainerStyle();
	 if($bootstrapEnabled)
	 {
	 	$containerType = $this->getBootstrapContainerType();
	 	$cssClass .= STRING_SPACE . $containerType;
   }    
   $htmlWriter->putDivOpenTag($intCode,$containerStyle,$cssClass);
  }	
  $topStyle = $this->getContainerTopStyle(); 
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "top",
  $topStyle,(($bootstrapEnabled)?"row":STRING_NULL));
	$this->putContainerTop();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  $bottomStyle = $this->getContainerBottomStyle();  
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "bottom",
  $bottomStyle,(($bootstrapEnabled)?"row":STRING_NULL));
	$this->putContainerBottom();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	if($withContainer)
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	
 }
}


?>