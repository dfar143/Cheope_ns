<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("html.fun.php");

class Html_tag extends Html_formatted_interface
{
 var $id=STRING_NULL;
 var $tag=STRING_NULL;
 var $attribs = array();
 private static $distinctTagsCounter = array();
 private static $htmlTagTotNum = 0;
 private static $htmlTagsNotDistinct = 0;
 public static $distinctTags = false;
 public static $autoIncId = true;
  
 function __construct(string $actOp=OP_NONE, $actNum=STRING_NULL,string $actTag=STRING_NULL)
 {
 	self::$htmlTagTotNum++;
 	$autoIncId = self::$autoIncId;
 	$distinctTags = self::$distinctTags;
 	
 	if($distinctTags)
 	{
 		if(isset(self::$distinctTagsCounter[$actTag]))
 		 self::$distinctTagsCounter[$actTag]+=1;
    else
     self::$distinctTagsCounter[$actTag]=0;
    $num = self::$distinctTagsCounter[$actTag];
  }
  else
  {
   self::$htmlTagsNotDistinct++;
 	 if(($actNum === STRING_NULL)||($autoIncId))
 	  $num = self::$htmlTagsNotDistinct-1;
 	 else
 	  $num = $actNum;
 	}

 	parent::__construct($actOp,self::INT_HTML_TAG,$num);
 	$this->setTag($actTag);

 	if($distinctTags)
 	  $this->setType($actTag);
 	$actId = $this->getInterfaceId();
 	$this->setId($actId);
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 } 
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$htmlTagTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$htmlTagTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function setTag(string $actTag):void
 {
 	$this->tag = $actTag;
 }
 
 function getTag():string
 {
 	return $this->tag;
 }

// override; 
 function setCssClass(string $actClass):void
 {
 	parent::setCssClass($actClass);
 	$this->setAttrib("class",$actClass);
 }
 
 function getCssClass():string
 {
 	return parent::getCssClass();
 }
 
 function setId(string $actId):void
 {
 	$this->id = $actId;
 	$this->setAttrib("id",$this->id);
 }
 
 function getId():string
 {
 	return $this->id;
 }

 
 function getAttribs():array
 {
 	return $this->attribs;
 }
 
 function setAttribs(array $actAttribs):void
 {
 	$id = $this->getId();
 	$this->attribs = $actAttribs;
 	if((! item_in_array_keys("id",$actAttribs))&&($id!==STRING_NULL))
 	 $this->attribs["id"] = $id;
 }
 
 function getAttrib(string $actAttrName):string|int
 {
 	$attribs = $this->getAttribs();
 	foreach($attribs as $ind=>$val)
 	{
 		if($ind==$actAttrName)
 		 return $val;
 	}
 	return NO_VALUE;
 }
 
 function setAttrib(string $actAttrName,string|int $actAttrVal):void
 {
 	$attribs = $this->getAttribs();
 	$attribs[$actAttrName] = $actAttrVal;
 	$this->setAttribs($attribs);
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
 	$style = $this->getStyle();
 	$class = $this->getCssClass();
 	$tag = $this->getTag();
 	$attribs = $this->getAttribs();
 	$attribsStr = NO_VALUE;
 	$attribsStr = STRING_OPEN_ANGLE_BRACKET . $tag;
 	
 	if(! item_in_array_keys("style",$attribs) && ($style != STRING_NULL))
 	 $attribsStr = $attribsStr  . STRING_SPACE . "style" . 
 	 STRING_EQUAL . STRING_DOUBLE_QUOTE . $style . STRING_DOUBLE_QUOTE;
 	 
 	if(! item_in_array_keys("class",$attribs) && ($class != STRING_NULL))
 	 $attribsStr = $attribsStr  . STRING_SPACE . "class" . 
 	 STRING_EQUAL . STRING_DOUBLE_QUOTE . $class . STRING_DOUBLE_QUOTE;
 	 
 	foreach($attribs as $ind=>$val)
 	{
 		if($val !== STRING_NULL)
 		{
 		 $attribsStr = $attribsStr . STRING_SPACE . 
 		 $ind . STRING_EQUAL . STRING_DOUBLE_QUOTE . 
 		 $val . STRING_DOUBLE_QUOTE;
 	  }
 	  else
 	   $attribsStr = $attribsStr . STRING_SPACE .
 	   $ind . STRING_SPACE;
 	}
 	$attribsStr = $attribsStr . STRING_SPACE . STRING_SLASH . STRING_CLOSE_ANGLE_BRACKET; 
	
 	$htmlWriter->putGenericHtmlString($attribsStr,0);
 }
}



?>