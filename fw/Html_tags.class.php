<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("html.fun.php");


class Html_tags extends Html_formatted_interface
{
 
//	const ERROR_1 = "Html_tags:Errore nell'inserimento dell'interface_container.";
	const DEFAULT_BODY_POS_PRE = true;
		
// private $interfacesContainer=null;
 private $id=STRING_NULL;
 private $tag=STRING_NULL;
 private $tagBody = STRING_NULL;
 private $tagBodyPosPre = self::DEFAULT_BODY_POS_PRE;
 private $attribs = array();
 private static $distinctTagsCounter = array();
 private static $htmlTagsTotNum = 0;
 private static $htmlTagsNotDistinct = 0;
 public static $distinctTags = false;
 public static $autoIncId = true;
 
 function __construct(string $actOp=STRING_NULL, $actNum=STRING_NULL,string $actTag=STRING_NULL)
 {
 	self::$htmlTagsTotNum++;
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
 	   	
 	parent::__construct($actOp,self::INT_HTML_TAGS,$num);
 	$this->setTag($actTag);

 	if($distinctTags)
 	  $this->setType("Html" . VAR_SEP . $actTag . VAR_SEP . "tag");
 	
 	 $actId = $this->getInterfaceId();
 	 $this->setId($actId);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$htmlTagsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$htmlTagsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function putJavascriptInitializationCode(string $actPar):void
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
 	$id = $this->getId();
 	$item1 = array("%id"=>$id);
 	$serializer->loadItems($item1);
 	$tag = $this->getTag();
 	$item2 = array("tag"=>$tag);
 	$serializer->loadItems($item2);
 	$tagBody = $this->getTagBody();
 	$item3 = array("@tagBody"=>$tagBody);
 	$serializer->loadItems($item3); 
 	$tagBodyPosPre = $this->getTagBodyPosPre();
 	$item4 = array("tagBodyPosPre"=>$tagBodyPosPre);
 	$serializer->loadItems($item4); 
 	$attribs = $this->getAttribs();
 	$item5 = array("attribs"=>$attribs);
 	$serializer->loadItems($item5); 
 	$interfacesContainer = $this->getInterfacesContainer();	
 	$item6 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item6);	
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
 
 function getTagBody():string
 {
 	return $this->tagBody;
 }
 
 function setTagBody(string $actTagBody):void
 {
 	$this->tagBody = $actTagBody; 
 }
 
 function addToTagBody(string $actItem):void
 {
 	if($this->tagBody != NO_VALUE)
 	 $this->tagBody = $this->tagBody . STRING_RETURN . $actItem;
 	else
 	 $this->tagBody = $actItem;
 }
 
 function setTagBodyPosPre(string $actTagBodyPos):void
 {
 	$this->tagBodyPos = $actTagBodyPos;
 }
 
 function getTagBodyPosPre():string
 {
 if($this->tagBodyPosPre == STRING_NULL)
  return self::DEFAULT_BODY_POS_PRE;
 else
  return $this->tagBodyPosPre;
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
 
 function setAttrib(string $actAttrName,string|int $actAttrVal)
 {
 	$attribs = $this->getAttribs();
 	$attribs[$actAttrName] = $actAttrVal;
 	$this->setAttribs($attribs);
 }
 
 function isContainer():bool
 {
 	return true;
 }
 
  function isDecorator():bool
 {
 	return false;
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
 	$tag = $this->getTag();
 	$tagBody = $this->getTagBody();
 	$attribs = $this->getAttribs();
 	$style = $this->getStyle();
 	$attribsStr = STRING_NULL;
 	$attribsStr = STRING_OPEN_ANGLE_BRACKET . $tag;
 	
 	if(! item_in_array_keys("style",$attribs) && ($style != STRING_NULL))
 	 $attribsStr = $attribsStr  . STRING_SPACE . "style" . 
 	 STRING_EQUAL . STRING_DOUBLE_QUOTE . $style . STRING_DOUBLE_QUOTE;
 	
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

 	
 $attribsStr = $attribsStr . STRING_SPACE . STRING_CLOSE_ANGLE_BRACKET;
 	
 	$htmlWriter->putGenericHtmlString($attribsStr,0);

  if($this->getTagBodyPosPre())
  {
   if($tag == TEXTAREA_TAG)
    $tagBody = htmlspecialchars($tagBody);
   else
    $tagBody = $this->getTagBody();

   $htmlWriter->putGenericHtmlString($tagBody);
  }
 	$intContainer = $this->getInterfacesContainer();
 	if(! empty($intContainer))
 	{
 	 $intContIter = $intContainer->create();
 	 $intContIter->reset();
 	 while($intContIter->hasMore())
 	 {
 	  $int = $intContIter->current();
 	  /*if(is_null($int))
 	  {
 	  	var_dump($intContainer);
 	  	die('AAA');
 	  }*/
    $int->putData();
 	  $intContIter->next();
 	}
 	 
 	}
  if(! $this->getTagBodyPosPre())
  {
   if($tag == TEXTAREA_TAG)
    $tagBody = htmlspecialchars($tagBody);
   else
    $tagBody = $this->getTagBody();
   $htmlWriter->putGenericHtmlString(htmlspecialchars($tagBody),1);
  }
 	$htmlWriter->putGenericHtmlString(STRING_OPEN_ANGLE_BRACKET . STRING_SLASH . 
 	  $tag . STRING_CLOSE_ANGLE_BRACKET,0);
 }
 
}



?>