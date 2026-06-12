<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("html.const.php");
require_once("Item_stack.class.php");
require_once("String_item.class.php");
require_once("Creator.tra.php");

class Html_writer
{
 const ERROR_1="Html_writer:Errore nell'inserimento dell'item_stack.";
 const ERROR_2="Html_writer:Errore nell'inserimento del dumper.";

 const QUOTE_CHAR=STRING_DOUBLE_QUOTE;
	
 private $itemStack=null;
 private $flushEnabled=true;
 private $CREnabled=false; 
 
 function __construct(Item_stack $actItemStack=null)
 {
 	if(! is_null($actItemStack))
 	 $this->setItemStack($actItemStack);
 }
 
 function getItemStack():Item_stack
 {
 	return $this->itemStack;
 }
 
 function setItemStack(Item_stack $actItemStack):void
 {
 	 $this->itemStack = $actItemStack;
 }
 
 function setFlushEnabled(bool $actEnable):void
 {
 	$this->flushEnabled = $actEnabled;
 }
 
 function getFlushEnabled():bool
 {
 	return $this->flushEnabled;
 }
 
 function setCREnabled(bool $actCREnabled):void
 {
 	$this->CREnabled = $actCREnabled;
 }
 
 function getCREnabled():bool
 {
 	return $this->CREnabled;
 }
 
 function getDumper():Dumper
 {
 	$itemStack = $this->getItemStack();
 	$dumper = $itemStack->getDumper();
 	return $dumper;
 }
 
 function setDumper(Dumper $actDumper):void
 {
 	$itemStack = $this->getItemStack();
 	$itemStack->setDumper($actDumper);
 }
 
 static function createStringItem():String_item
 {
 	$stringItem=Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL);
 	$stringItem->setType(STRING_NULL);
 	return $stringItem;
 } 
 
 function sendData():void
 {
 	$dumper = $this->getDumper();
 	$itemStack = $this->getItemStack();
 	$flushEnabled = $this->getFlushEnabled();
 	if(! is_a($dumper,Classes_info::MEMORY_DUMPER_CLASS))
 	{
 	 if($flushEnabled)
 	  $itemStack->flush();
 	 else
 	  $itemStack->dump();
  }
 }
 
function putXmlPrologString(string $actVersion,string $actEncoding):Html_writer
{
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();  
 $stringItem->setItem(HTML_TAG_INIT_CHAR . "?xml version=" . 
 self::QUOTE_CHAR . $actVersion . 
 self::QUOTE_CHAR . " encoding=" . self::QUOTE_CHAR . $actEncoding . 
 self::QUOTE_CHAR . STRING_QUESTION_MARK . HTML_TAG_END_CHAR);
 $itemStack->push($stringItem);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $this->sendData();
 return $this;
}

function putBodyOpenTag(string $actClass,
string $actStyle,string $actBackground,
string $actBgColor,string $actText,string $actLink,
string $actVLink,string $actALink,string $actOnLoad,
string $actOnUnLoad):Html_writer
{
 list($class,$style,$background,$bgColor,$text,$link,$vLink,$aLink,$onLoad,$onUnLoad) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR; 
 if($actStyle !== STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR; 
 if($actBackground !== STRING_NULL)
  $background = " background=" . self::QUOTE_CHAR . $actBackground . self::QUOTE_CHAR;
 if($actBgColor !== STRING_NULL)
  $bgColor = " bgcolor=" . self::QUOTE_CHAR . $actBgColor . self::QUOTE_CHAR;
 if($actText !== STRING_NULL)
  $text = " text=" . self::QUOTE_CHAR . $actText . self::QUOTE_CHAR;
 if($actLink !== STRING_NULL)
  $link = " link=" . self::QUOTE_CHAR . $actLink . self::QUOTE_CHAR;
 if($actVLink !== STRING_NULL)
  $vLink = " vlink=" . self::QUOTE_CHAR . $actVLink . self::QUOTE_CHAR;
 if($actALink !== STRING_NULL)
  $aLink = " alink=" . self::QUOTE_CHAR . $actALink . self::QUOTE_CHAR;
 if($actOnLoad !== STRING_NULL)
  $onLoad = " onload=" . self::QUOTE_CHAR . $actOnLoad . self::QUOTE_CHAR;
 if($actOnUnLoad !== STRING_NULL)
  $onUnLoad = " onunLoad=" . self::QUOTE_CHAR . $actOnUnLoad . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem();  
  $stringItem->setItem(HTML_TAG_INIT_CHAR . BODY_TAG . 
  $class . $style . $background . $bgColor . $text . 
  $link . $vLink . $aLink . $onLoad . $onUnLoad . HTML_TAG_END_CHAR);
  $itemStack->push($stringItem);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
  $this->sendData();
  return $this;
}

function putHtmlOpenTag(string $actLang=STRING_NULL,
string $actXmlNameSpace=STRING_NULL):Html_writer
{
	list($lang,$xmlNameSpace) = array(STRING_NULL,STRING_NULL);
	if($actLang !== STRING_NULL)
	 $lang = " lang=" . self::QUOTE_CHAR . $actLang . self::QUOTE_CHAR;
	if($actXmlNameSpace !== STRING_NULL)
	 $xmlNameSpace = " xmlns=" . self::QUOTE_CHAR . $actXmlNameSpace . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem(); 	 	
	$stringItem->setItem(HTML_TAG_INIT_CHAR . HTML_TAG . $lang . $xmlNameSpace . HTML_TAG_END_CHAR);
  $itemStack->push($stringItem);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
  $this->sendData();
  return $this;
}
 
function putLiOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actTitle=STRING_NULL,
string $actLang=STRING_NULL,
string $actType=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnMouseOver=STRING_NULL,
string $actOnMouseOut=STRING_NULL):Html_writer
{
	list($id,$style,$class,$title,$lang,$type,$onClick,
	$onMouseOver,$onMouseOut) = array(STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
	if($actTitle !== STRING_NULL)
	 $title = " title=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
	if($actLang !== STRING_NULL)
	 $lang = " lang=" . self::QUOTE_CHAR . $actLang . self::QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;
	if($actOnClick !== STRING_NULL)
	 $onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
	if($actOnMouseOver !== STRING_NULL)
	 $onMouseOver = " onmouseover=" . self::QUOTE_CHAR . $actOnMouseOver . self::QUOTE_CHAR;
	if($actOnMouseOut !== STRING_NULL)
	 $onMouseOut = " onmouseout=" . self::QUOTE_CHAR . $actOnMouseOut . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem(); 		
	$stringItem->setItem(HTML_TAG_INIT_CHAR . 
	LI_TAG . $id . $style . $class . 
	$title . $lang . $type . 
	$onClick . $onMouseOver . $onMouseOut . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)  
  $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
  return $this; 
}
 
function putOlOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actType=STRING_NULL,
string $actStart=STRING_NULL):Html_writer
{
	list($id,$style,$class,$type,$start) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;
	if($actStart !== STRING_NULL)
	 $start = " start=" . self::QUOTE_CHAR . $actStart . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem(); 		
	$stringItem->setItem(HTML_TAG_INIT_CHAR . OL_TAG . 
	$id . $style . $class . $type . $start . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
  return $this; 
}

function putUlOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,string $actType=STRING_NULL):Html_writer
{
	list($id,$style,$class,$type) = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem(); 	
	$stringItem->setItem(HTML_TAG_INIT_CHAR . UL_TAG . 
	$id . $style . $class . $type . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
  return $this; 
}

function putFrameTag(string $actName,string $actSrc,string $actFrameBorder,
string|int $actMarginWidth,string|int $actMarginHeight,bool|int|string $actNoResize,string $actScrolling):Html_writer
{
	list($name,$src,$frameBorder,$marginWidth,$marginHeight,$noResize,$scrolling) 
	= array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
 if($actName != STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actSrc != STRING_NULL)
  $src = " name=" . HTML_FUN_QUOTE_CHAR . $actSrc . HTML_FUN_QUOTE_CHAR;
 if($actFrameBorder != STRING_NULL)
  $frameBorder = " name=" . HTML_FUN_QUOTE_CHAR . $actFrameBorder . HTML_FUN_QUOTE_CHAR;
 if($actMarginWidth != STRING_NULL)
  $marginWidth = " name=" . HTML_FUN_QUOTE_CHAR . $actMarginWidth . HTML_FUN_QUOTE_CHAR;
 if($actMarginHeight != STRING_NULL)
  $marginHeight = " name=" . HTML_FUN_QUOTE_CHAR . $actMarginHeight . HTML_FUN_QUOTE_CHAR;
 if(($actNoResize)||($actNoResize=='true'))
  $noResize = " noResize ";
 if($actScrolling != STRING_NULL)
  $scrolling = " scrolling=" . HTML_FUN_QUOTE_CHAR . $actScrolling . HTML_FUN_QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . FRAME_TAG . 
 $name . $src . $frameBorder . $marginWidth . $marginHeight .
 $noResize . $scrolling  . STRING_SLASH .
 HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putFrameOpenTag(string $actName,string $actSrc,string $actFrameBorder,
string|int $actMarginWidth,string|int $actMarginHeight,string|int|bool $actNoResize,
string $actScrolling):Html_writer
{
	list($name,$src,$frameBorder,$marginWidth,$marginHeight,$noResize,$scrolling) 
	= array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
 if($actName !== STRING_NULL)
  $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 if($actSrc !== STRING_NULL)
  $src = " src=" . self::QUOTE_CHAR . $actSrc . self::QUOTE_CHAR;
 if($actFrameBorder !== STRING_NULL)
  $frameBorder = " frameBorder=" . self::QUOTE_CHAR . $actFrameBorder . self::QUOTE_CHAR;
 if($actMarginWidth !== STRING_NULL)
  $marginWidth = " marginWidth=" . self::QUOTE_CHAR . $actMarginWidth . self::QUOTE_CHAR;
 if($actMarginHeight !== STRING_NULL)
  $marginHeight = " marginHeight=" . self::QUOTE_CHAR . $actMarginHeight . self::QUOTE_CHAR;
 if(($actNoResize)||($actNoResize=='true'))
  $noResize = " noresize ";
 if($actScrolling !== STRING_NULL)
  $scrolling = " scrolling=" . self::QUOTE_CHAR . $actScrolling . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . FRAME_TAG . 
 $name . $src . $frameBorder . $marginWidth . $marginHeight .
 $noResize . $scrolling  . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putFramesetOpenTag(int|string $actRows,int|string $actCols,string|int $actBorder,
string|int $actFrameBorder,string|int $actFrameSpacing,string $actOnLoad,
string $actOnUnload):Html_writer
{
	list($rows,
	$cols,$border,
	$frameBorder,
	$frameSpacing,
	$onLoad,$onUnload) = array(STRING_NULL,STRING_NULL,
	STRING_NULL,
	STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actRows !== STRING_NULL)
	 $rows = " rows=" . self::QUOTE_CHAR . $actRows . self::QUOTE_CHAR;
	if($actCols !== STRING_NULL)
	 $cols = " cols=" . self::QUOTE_CHAR . $actCols . self::QUOTE_CHAR;
	if($actBorder !== STRING_NULL)
	 $border = " border=" . self::QUOTE_CHAR . $actBorder . self::QUOTE_CHAR;
	if($actFrameBorder !== STRING_NULL)
	 $frameBorder = " frameBorder=" . self::QUOTE_CHAR . $actFrameBorder . self::QUOTE_CHAR;
	if($actFrameSpacing !== STRING_NULL)
	 $frameSpacing = " frameSpacing=" . self::QUOTE_CHAR . $actFrameSpacing . self::QUOTE_CHAR;  
	if($actOnLoad !== STRING_NULL)
	 $onLoad = " onload=" . self::QUOTE_CHAR . $actOnLoad . self::QUOTE_CHAR;
	if($actOnUnload !== STRING_NULL)
	 $onUnload = " onunload=" . self::QUOTE_CHAR . $actOnUnload . self::QUOTE_CHAR;

  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem();
  $stringItem->setItem(HTML_TAG_INIT_CHAR . FRAMESET_TAG . 
  STRING_SPACE . $rows . $cols . $border . 
  $frameBorder . 
  $frameSpacing . 
  $onLoad . $onUnload . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
  return $this; 
}

function putDocTypeTag(string $actStr):Html_writer
{
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . 
 "!DOCTYPE " . $actStr . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putImgTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actTitle=STRING_NULL,
string $actSrc=STRING_NULL,
string $actAlt=STRING_NULL,
string|int $actWidth=STRING_NULL,
string|int $actHeight=STRING_NULL,
string $actAlign=STRING_NULL,
string|int $actBorder=0,
string|int $actHSpace=STRING_NULL,
string|int $actVSpace=STRING_NULL,
string $actUseMap=STRING_NULL,string|int|bool $actIsMap=STRING_NULL):Html_writer
{
 list($id,$class,$style,$title,$alt,$width,$height,$align,$border,$hSpace,$vSpace,
 $useMap,$isMap)=array(STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actTitle !== STRING_NULL)
  $title = " title=" . self::QUOTE_CHAR . $actTitle . self::QUOTE_CHAR;
 if($actSrc !== STRING_NULL)
  $src = " src=" . self::QUOTE_CHAR . $actSrc . self::QUOTE_CHAR;
 if($actAlt !== STRING_NULL)
  $alt = " alt=" . self::QUOTE_CHAR . $actAlt . self::QUOTE_CHAR;
 if($actWidth !== STRING_NULL)
  $width = " width=" . self::QUOTE_CHAR . $actWidth . self::QUOTE_CHAR;
 if($actHeight !== STRING_NULL)
  $height = " height=" . self::QUOTE_CHAR . $actHeight . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;
 if($actBorder !== STRING_NULL) 
  $border = " border=" . self::QUOTE_CHAR . $actBorder . self::QUOTE_CHAR;
 if($actHSpace !== STRING_NULL)
  $hSpace = " hspace=" . self::QUOTE_CHAR . $actHSpace . self::QUOTE_CHAR;
 if($actVSpace !== STRING_NULL)
  $vSpace = " vspace=" . self::QUOTE_CHAR . $actVSpace . self::QUOTE_CHAR;
 if($actUseMap !== STRING_NULL)
  $useMap = " usemap=" . self::QUOTE_CHAR . $actUseMap . self::QUOTE_CHAR;
 if(($actIsMap)||($actIsMap=='true'))
  $isMap = " ismap ";		

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();

 $stringItem->setItem(HTML_TAG_INIT_CHAR . IMG_TAG . STRING_SPACE . 
 $id . $class . $title . 
 $title . $src . $alt . $width . 
 $height . $align . $border . $hSpace . 
 $vSpace . 
 $useMap . $isMap . CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putLinkTag(string $actRel=STRING_NULL,string $actHRef=STRING_NULL,
string $actType=MIME_0,
string $actRev=STRING_NULL,
string $actMedia=STRING_NULL,
string $actHRefLang=STRING_NULL,
string $actCharSet=STRING_NULL,
string $actTarget=STRING_NULL):Html_writer
{
 list($rel,$href,$type,$rev,$media,$hRefLang,$charSet,$target) 
 = array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL);
 
 if($actRel !== STRING_NULL)
  $rel = " rel=" . self::QUOTE_CHAR . $actRel . self::QUOTE_CHAR;
 else
  $rel = " rel=" . self::QUOTE_CHAR . "stylesheet" . self::QUOTE_CHAR;
 if($actHRef !== STRING_NULL)
  $href = " href=" . self::QUOTE_CHAR . $actHRef . self::QUOTE_CHAR;
 if($actType !== STRING_NULL)
 $type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;
 if($actRev !== STRING_NULL)
  $rev = " rev=" . self::QUOTE_CHAR . $actRev . self::QUOTE_CHAR;
 if($actMedia !== STRING_NULL)
  $media = " media=" . self::QUOTE_CHAR . $actMedia . self::QUOTE_CHAR;
 if($actHRefLang !== STRING_NULL)
  $hRefLang = " hreflang=" . self::QUOTE_CHAR . $actHRefLang . self::QUOTE_CHAR;
 if($actCharSet !== STRING_NULL)
  $charSet = " charset=" . self::QUOTE_CHAR . $actCharSet . self::QUOTE_CHAR;
 if($actTarget !== STRING_NULL)
  $target = " target=" . self::QUOTE_CHAR . $actTarget . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 	
 $stringItem->setItem(HTML_TAG_INIT_CHAR . 
 LINK_TAG . STRING_SPACE . $rel . $href . $type . 
 $rev . $media . $hRefLang . $charSet . $target . STRING_SLASH . 
 HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;
}

function putScriptIncludeTag(string $actSrc=STRING_NULL,string $actType=MIME_3):Html_writer
{
 $src = STRING_NULL;
 if($actSrc != STRING_NULL)
  $src = " src=" . self::QUOTE_CHAR . $actSrc . self::QUOTE_CHAR;
  
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SCRIPT_TAG . " language=" . self::QUOTE_CHAR . 
 "javascript" . self::QUOTE_CHAR .
 " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR . $src .
 HTML_TAG_END_CHAR . SCRIPT_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putScriptOpenTag(string $actType=MIME_3):Html_writer
{
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SCRIPT_TAG . " language=" . self::QUOTE_CHAR . 
 "javascript" . self::QUOTE_CHAR . " type=" . self::QUOTE_CHAR .
 $actType . self::QUOTE_CHAR . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}


function putButtonTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,
string $actLabel=STRING_NULL,string $actType=STRING_NULL,
string|int $actTabIndex=STRING_NULL,string $actOnClickCode=STRING_NULL):Html_writer
{
 list($id,$class,$style,$label,$type,$tabIndex,$onClickCode) = array(STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actLabel !== STRING_NULL)
  $label = $actLabel;
 if($actType !== STRING_NULL)
  $type= " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if($actOnClickCode !== STRING_NULL)
 	$onClickCode = " onclick=" . self::QUOTE_CHAR . $actOnClickCode . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . BUTTON_TAG  . $id . $class . $style . $type .  
 $tabIndex  . $onClickCode . HTML_TAG_END_CHAR . $actLabel . BUTTON_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putButtonOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,
string $actLabel=STRING_NULL,string $actType=STRING_NULL,
string|int $actTabIndex=STRING_NULL,string $actOnClickCode=STRING_NULL):Html_writer
{
 list($id,$class,$style,$label,$type,$tabIndex,$onClickCode) = array(STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actLabel !== STRING_NULL)
  $label = $actLabel;
 if($actType !== STRING_NULL)
  $type= " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if($actOnClickCode !== STRING_NULL)
 	$onClickCode = " onclick=" . self::QUOTE_CHAR . $actOnClickCode . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . BUTTON_TAG  . $id . $class . $style . $type .  
 $tabIndex  . $onClickCode . HTML_TAG_END_CHAR . $actLabel);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putGenericHtmlString(?string $actStr,int|string $actNumSpace=0,
string $actClass=STRING_NULL):Html_writer
{
 $space=STRING_NULL;
 for($i=0;$i<=$actNumSpace-1;$i++)
  $space = $space . STRING_SPACE;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
  
 if($actClass !== STRING_NULL)
  $stringItem->setItem($space . HTML_TAG_INIT_CHAR . 
  SPAN_TAG . " class=" . self::QUOTE_CHAR . 
  $actClass . self::QUOTE_CHAR . HTML_TAG_END_CHAR . 
  $actStr . SPAN_CLOSE_TAG);
 else
  $stringItem->setItem($space . $actStr);
  
 $CREnabled = $this->getCREnabled();
 if($CREnabled)  
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function put(?string $actStr,int|string $actNumSpace=0,string $actClass=STRING_NULL)
{
	$this->putGenericHtmlString($actStr,$actNumSpace,$actClass);
}

function putLabelTag(string $actId,string $actStyle,string $actClass,string $actFor,
string $actVal=STRING_NULL):Html_writer
{
 list($id,$class,$style,$for) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR ;
 }	
 if($actClass !== STRING_NULL)
 {
 	$class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
 	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 }
 if($actFor !== STRING_NULL)
 {
 	$for = " for=" . self::QUOTE_CHAR . $actFor . self::QUOTE_CHAR;
 } 
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . LABEL_TAG . 
 $id . $class . $style . $for . HTML_TAG_END_CHAR);
 $stringItem->tail_add($actVal);
 $stringItem->tail_add(LABEL_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putDojoRadioButton(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,array|string $actValues=STRING_NULL,
array|string $actLabels=STRING_NULL,
string $actValue=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actDirection=STRING_NULL,
string $actOnChange=STRING_NULL):Html_writer
{
	list($id,$name,$style,$toolTip,$title,$labels,$value,$direction,$onChange) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actName !== STRING_NULL)
 {
 	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle;
  if(($actStyle !== STRING_NULL) && ($actDirection == "H"))
  {
   $style = $style . ";"; 
   $style = $style . self::QUOTE_CHAR;	
  }
  else
   $style = $style . self::QUOTE_CHAR;	   
 }
 elseif(($actStyle == STRING_NULL) && ($actDirection == "H"))
 {
 	$style = " style=\"\"";
 }
  
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
  $toolTip = " toolTip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
 } 
  
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 }
 
 $itemStack = $this->getItemStack();
 $CREnabled = $this->getCREnabled();
 
 if(! is_array($actValues))
  $actValues = array($actValues);
  
 if(! is_array($actLabels))
  $actLabels = array($actLabels);

 $i=0;
 
 foreach($actValues as $ind=>$val)
 {
 	$label = (isset($actLabels[$ind])?$actLabels[$ind]:STRING_NULL);
  $stringItem = self::createStringItem();
  
  if($val !== STRING_NULL)
  {
 	 $value = " value=" . self::QUOTE_CHAR . $val . self::QUOTE_CHAR;
  }
  
  if($actId !== STRING_NULL)
  {
 	 $id = " id=" . self::QUOTE_CHAR . $actId . VAR_SEP . $ind . self::QUOTE_CHAR;
  }  
  
 	if($val == $actValue) 
   $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
   "dojoType = \"dijit.form.RadioButton\"" . STRING_SPACE . 
   $id . $name . $style . STRING_SPACE . 
   "checked" . STRING_SPACE . $value . $toolTip . 
   $title . $onChange . STRING_SPACE . HTML_TAG_END_CHAR .  
   (($actDirection == "H")?(SPAN_OPEN_TAG . $label . SPAN_CLOSE_TAG):
   ($label . SEP_OPEN_TAG)));
  else
   $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . 
   "dojoType = \"dijit.form.RadioButton\"" . STRING_SPACE .
   $id . $name . $style . $value . $toolTip . $title .
   $onChange . STRING_SPACE . HTML_TAG_END_CHAR .  
   (($actDirection == "H")?(SPAN_OPEN_TAG . $label . SPAN_CLOSE_TAG):
   ($label . SEP_OPEN_TAG)));  
  
  $itemStack->push($stringItem); 
 }
 
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $this->sendData();
 return $this;	  
}


function putDojoCheckBox(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string|bool $actChecked=STRING_NULL,string $actValue=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):Html_writer
{
	list($id,$name,$style,$checked,$value,$toolTip,$title,$onChange,$onClick) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL);

  if($actId !== STRING_NULL)
  {
 	 $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
  }
  if($actName !== STRING_NULL)
  {
 	 $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
  }
  if($actStyle !== STRING_NULL)
  {
	 $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
  }
  if(($actChecked)||($actChecked == 'true'))
  {
	 $checked = " checked ";
  } 	
 if($actValue !== STRING_NULL)
 {
 	$value = " value=" . self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR;
 }
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
 	$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
  $stringItem2 = self::createStringItem(); 
	$onChange = HTML_TAG_INIT_CHAR . SCRIPT_TAG . STRING_SPACE . 
	"type" . STRING_EQUAL . self::QUOTE_CHAR . "dojo/method" . self::QUOTE_CHAR .
	STRING_SPACE . "event" . STRING_EQUAL . self::QUOTE_CHAR . "onChange" . 
	self::QUOTE_CHAR . STRING_SPACE .
	"args" . STRING_EQUAL . self::QUOTE_CHAR . "evt" . self::QUOTE_CHAR .
	HTML_TAG_END_CHAR;
	$stringItem2->setItem($onChange);
	$stringItem2->tail_add($actOnChange);
	$stringItem2->tail_add(SCRIPT_CLOSE_TAG);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
   $stringItem2->tail_add(STRING_ESC_RETURN);
 } 
 else
 {
 	$stringItem2 = self::createStringItem(); 	
 }
 if($actOnClick !== STRING_NULL)
 {
	$stringItem3 = self::createStringItem(); 
	$onClick = HTML_TAG_INIT_CHAR . SCRIPT_TAG . STRING_SPACE . 
	"type" . STRING_EQUAL . self::QUOTE_CHAR . "dojo/method" . self::QUOTE_CHAR .
	STRING_SPACE . "event" . STRING_EQUAL . self::QUOTE_CHAR . "onClick" . 
	self::QUOTE_CHAR . STRING_SPACE .
	"args" . STRING_EQUAL . self::QUOTE_CHAR . "evt" . self::QUOTE_CHAR .
	HTML_TAG_END_CHAR;
	$stringItem3->setItem($onClick);
	$stringItem3->tail_add($actOnClick);
	$stringItem3->tail_add(SCRIPT_CLOSE_TAG);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
  $stringItem3->tail_add(STRING_ESC_RETURN);
 }
 else
 {
 	$stringItem3 = self::createStringItem();
 } 
	
 $itemStack = $this->getItemStack();
 $stringItem1 = self::createStringItem(); 
 $stringItem1->setItem(HTML_TAG_INIT_CHAR . DIV_TAG . STRING_SPACE . 
 "dojoType=\"dijit.form.CheckBox\""  . STRING_SPACE .
 $id . $name . $style . $checked . $value . $title .
 $toolTip . STRING_SPACE . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem1->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem1); 
 $itemStack->push($stringItem2);
 $itemStack->push($stringItem3);  
 $stringItem4 = self::createStringItem(); 
 $stringItem4->setItem(DIV_CLOSE_TAG);
 if($CREnabled)
  $stringItem4->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem4);
 $this->sendData();
 return $this;	  
}


function putDojoSimpleTextarea(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string|bool $actRequired=STRING_NULL,string $actValue=STRING_NULL,string|int $actRows=STRING_NULL,
string|int $actCols=STRING_NULL,string $actToolTip=STRING_NULL,string $actOnChange=STRING_NULL):Html_writer
{
	list($id,$name,$style,$required,$value,$rows,$cols,$toolTip,$title,$onChange) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
 {
 	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 } 	
 if($actRows !== STRING_NULL)
 {
	$rows = " rows=" . self::QUOTE_CHAR . $actRows . self::QUOTE_CHAR;
 } 
  if($actCols !== STRING_NULL)
 {
	$cols = " cols=" . self::QUOTE_CHAR . $actCols . self::QUOTE_CHAR;
 } 	
 if($actRequired !== STRING_NULL)
 {
	$required = " required=" . self::QUOTE_CHAR . $actRequired . self::QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
 {
 	$value = " value=" . self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR;
 }
 if($actToolTip !== STRING_NULL)
 {
	$title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
 	$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 } 
	
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TEXTAREA_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.SimpleTextarea\"" . STRING_SPACE .
 $id . $name . $style . $rows . $cols . $required . $value . $title .
 $toolTip . $onChange . 
 STRING_SPACE . CLOSE_TAG . TEXTAREA_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;	
}

function putDojoMultiSelect(string $actId=STRING_NULL,string $actName=STRING_NULL,
array $actValue=STRING_NULL,
string $actStyle=STRING_NULL,
string $actSelectedItem=STRING_NULL,
string|int $actSize=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnChange=STRING_NULL):Html_writer
{
	 list($id,$name,$style,
	 $tooltipPosition,$toolTip,$title,
	 $selected,$size,$onClick,$onChange) = 
	 array(STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 } 
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
	$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
 } 
 if($actTooltipPosition !== STRING_NULL)
 {
	$tooltipPosition = " tooltipPosition=" . self::QUOTE_CHAR . $actTooltipPosition . self::QUOTE_CHAR;
 }  
 if($actSize !== STRING_NULL)
 {
	$size = " size=" . self::QUOTE_CHAR . $actSize . self::QUOTE_CHAR;
 }
 if($actOnClick !== STRING_NULL)
 {
	$onClick = " onClick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 } 

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.MultiSelect\"" . STRING_SPACE .
 $id . $name . $style . 
 $size . $toolTip . $tooltipPosition . 
 $title . $onClick . 
 $onChange . STRING_SPACE . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $ct = 0;
 if(! is_array($actValue))
 {
   $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG);
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelectedItem==STRING_NULL))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 elseif(($actSelectedItem != STRING_NULL)&&($actSelectedItem == $val))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 else
    $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
    HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
    $CREnabled = $this->getCREnabled();
   if($CREnabled)
    $stringItem->tail_add(STRING_ESC_RETURN);
   $ct++;
  }
 }
 $stringItem->tail_add(SELECT_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;	  

}

function putDojoComboBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,string $actStyle=STRING_NULL,
array $actValue=STRING_NULL,string|int $actStop=STRING_NULL,
string $actPromptMessage=STRING_NULL,
string $actInvalidMessage=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actRegexp=STRING_NULL,
string|int $actSelected=STRING_NULL,string|bool $actRequired=STRING_NULL,
string|bool $actAutoComplete=STRING_NULL,string $actOnChange=STRING_NULL):Html_writer
{
	 list($id,$name,$style,$stop,$promptMessage,$invalidMessage,
	 $tooltipPosition,$toolTip,$title,$regexp,
	 $selected,$required,$autoComplete,$onChange) = 
	 array(STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 } 
 if($actStop !== STRING_NULL)
 {
	$stop = " maxlength=" . self::QUOTE_CHAR . $actStop . self::QUOTE_CHAR;
 } 
 if($actPromptMessage !== STRING_NULL)
 {
	$promptMessage = " promptMessage=" . self::QUOTE_CHAR . $actPromptMessage . self::QUOTE_CHAR;
 }
 if($actInvalidMessage !== STRING_NULL)
 {
	$invalidMessage = " invalidMessage=" . self::QUOTE_CHAR . $actInvalidMessage . self::QUOTE_CHAR;
 } 
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
	$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR;
 } 
 if($actTooltipPosition !== STRING_NULL)
 {
	$tooltipPosition = " tooltipPosition=" . self::QUOTE_CHAR . $actTooltipPosition . self::QUOTE_CHAR;
 }  
 if($actRegexp !== STRING_NULL)
 {
	$regexp = " regexp=" . self::QUOTE_CHAR . $actRegexp . self::QUOTE_CHAR;
 } 
 if(($actRequired)||($actRequired=='true'))
 {
	$required = " required ";
 }
 if($actAutoComplete != STRING_NULL)
 {
	$autoComplete = " autoComplete=" . self::QUOTE_CHAR . $actAutoComplete . self::QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 } 

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.ComboBox\"" . STRING_SPACE .
 $id . $name . $style . 
 $stop . 
 $promptMessage . $invalidMessage . $title .
 $toolTip . $tooltipPosition . $regexp . 
 $required . $autoComplete . 
 $onChange . STRING_SPACE . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $ct = 0;
 //echo "WWWWW" . $actSelected . "WWWWW";
 if(! is_array($actValue))
 {
   $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   self::QUOTE_CHAR . STRING_NULL . self::QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG);
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelected==STRING_NULL))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  . " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 elseif(($actSelected != STRING_NULL)&&($actSelected == $val))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 else
    $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
    HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
    $CREnabled = $this->getCREnabled();
   if($CREnabled)
    $stringItem->tail_add(STRING_ESC_RETURN);
   $ct++;
  }
 }
 $stringItem->tail_add(SELECT_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;	  
}


function putDojoDateTextBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,string $actStyle=STRING_NULL,
string $actFormat=STRING_NULL,string $actValue=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):Html_writer
{
 list($id,$name,$style,$format,$value,$onChange,$onClick) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 } 
 if($actFormat !== STRING_NULL)
 {
	$format = " format=" . self::QUOTE_CHAR . $actFormat . self::QUOTE_CHAR;
 } 
 if($actValue !== STRING_NULL)
 {
   $stdDojoDateArray = convertToDojoDefaultDate($actValue,$actFormat);
   $stdDojoDate = $stdDojoDateArray[2] . '-' . $stdDojoDateArray[1] . '-' .$stdDojoDateArray[0];
   $value = " value=" . self::QUOTE_CHAR . $stdDojoDate . self::QUOTE_CHAR;
 } 
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 }
 if($actOnClick !== STRING_NULL)
 {
	$onClick = " onClick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 }



 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.DateTextBox\"" . STRING_SPACE .
 $id . $name . $style . $value . $onChange . $onClick . STRING_SPACE . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;	 
}


function putDojoTextBox(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actValue=STRING_NULL,string $actType=STRNG_NULL,
string|bool $actRequired=STRING_NULL,
string|int $actLength=STRING_NULL,
string|int $actStop=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):Html_writer
{
 list($id,$name,$style,$value,$type,$required,$length,$stop,
 $toolTip,$title,$onChange,$onClick) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR; 	
 }	
 if($actName !== STRING_NULL)
 {
	$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
if($actStyle !== STRING_NULL)
 {
		$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
 {
	$value = " value=" . self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR ;
 }
 if($actType !== STRING_NULL)
 {
	$type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR ;
 }  
 if($actLength !== STRING_NULL)
 {
	$length = " size=" . self::QUOTE_CHAR . $actLength . self::QUOTE_CHAR ;
 } 
 if($actStop !== STRING_NULL)
 {
	$stop = " maxlength=" . self::QUOTE_CHAR . $actStop . self::QUOTE_CHAR ;
 } 
 if($actToolTip !== STRING_NULL)
 {
	$title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
	$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
 }  
 if(($actRequired==true)||($actRequired=='true'))
 {
		$required = " required ";
 }
 if($actOnChange !== STRING_NULL)
 {
		$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR ;
 }
 if($actOnClick !== STRING_NULL)
 {
		$onClick = " onClick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR ;
 }
 
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.TextBox\"" . STRING_SPACE .
 $id . $name . $style . $value . $type . $length . 
 $required . $stop . $toolTip . $title . $onChange . 
 $onClick . STRING_SPACE . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;	 	 
}


function putDojoValidationTextBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string $actValue=STRING_NULL,
string|bool $actRequired=STRING_NULL,
string|int $actStop=STRING_NULL,
string $actPromptMessage=STRING_NULL,
string $actInvalidMessage=STRING_NULL,
string $actRegExp=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL):Html_writer
{
	list($id,$name,$style,$value,$required,$stop,$promptMessage,$invalidMessage,
	$regExp,$tooltipPosition,$toolTip,$tabindex,$title,$onChange)=array(STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	{
		$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	}
	if($actName !== STRING_NULL)
	{
		$name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
	}
	if($actStyle !== STRING_NULL)
	{
		$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
	}
	if($actValue !== STRING_NULL)
	{
		$value = " value=" . self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR ;
	}
	if(($actRequired == "true")||($actRequired))
	{
		$required = " required ";
	}
	if($actStop !== STRING_NULL)
	{
		$stop = " maxlength=" . self::QUOTE_CHAR . $actStop . self::QUOTE_CHAR ;
	}
	if($actPromptMessage !== STRING_NULL)
	{
		$promptMessage = " promptMessage=" . self::QUOTE_CHAR . $actPromptMessage . self::QUOTE_CHAR ;
	}
	if($actInvalidMessage !== STRING_NULL)
	{
		$invalidMessage = " invalidMessage=" . self::QUOTE_CHAR . $actInvalidMessage . self::QUOTE_CHAR ;
	}
	if($actRegExp !== STRING_NULL)
	{
		$regExp = " regexp=" . self::QUOTE_CHAR . $actRegExp . self::QUOTE_CHAR ;
	}	
	if($actToolTip !== STRING_NULL)
	{
		$title = " title=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
		$toolTip = " tooltip=" . self::QUOTE_CHAR . $actToolTip . self::QUOTE_CHAR ;
	}	
	if($actTooltipPosition !== STRING_NULL)
	{
		$tooltipPosition = " tooltipPosition=" . self::QUOTE_CHAR . $actTooltipPosition . self::QUOTE_CHAR ;
	}
	if($actTabIndex !== STRING_NULL)
	{
		$tabIndex = " tabIndex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR ;
	}
    else
    {
		$tabIndex = " tabIndex=" . self::QUOTE_CHAR . "17" . self::QUOTE_CHAR ;
	}		
	if($actOnChange !== STRING_NULL)
	{
		$onChange = " onChange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR ;
	}	
	
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 

 $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.ValidationTextBox\"" . STRING_SPACE .
 $id . $name . $style . $value . 
 $required . $stop . $promptMessage . 
 $invalidMessage . $regExp . $toolTip . $title .
 $tooltipPosition . $tabIndex . $onChange . STRING_SPACE . HTML_TAG_END_CHAR);

 $CREnabled = $this->getCREnabled();

 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 

 $this->sendData();
 return $this;	
}

function putInputTag(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string|int $actValue=STRING_NULL,
string $actType=STRING_NULL,
int|bool|string $actChecked=STRING_NULL,
int|string $actLength=STRING_NULL,
string|int $actStop=STRING_NULL,
string $actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):Html_writer
{
 list($id,$class,$style,$name,$value,$checked,
 $type,$length,$maxLength,$tabIndex,$onChange,$onClick)
 =array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 } 
 if($actClass !== STRING_NULL)
 {
	$class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
  $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
  $value = " value=" . self::QUOTE_CHAR . $actValue . self::QUOTE_CHAR ;	
 if($actType !== STRING_NULL)
  $type = " type=" . self::QUOTE_CHAR . $actType . self::QUOTE_CHAR;	
 if(($actChecked)||($actChecked =='true'))
  $checked = " checked";	
 if($actLength !== STRING_NULL)
  $length = " size=" . self::QUOTE_CHAR . $actLength . self::QUOTE_CHAR;	
 if($actStop !== STRING_NULL)
  $maxLength = " maxlength=" . self::QUOTE_CHAR . $actStop . self::QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
  $onChange = " onchange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
  $onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . 
 $id . $name . $class . $style . 
 $value . $type . $checked . $length . $maxLength . 
 $tabIndex . $onChange . $onClick . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;
}

function putTextAreaTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,
string $actValue=STRING_NULL,string|int $actNumRows=STRING_NULL,
string|int $actNumCols=STRING_NULL,string|int $actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):Html_writer
{
 list($name,$id,$style,$class,$numRows,$numCols,$tabIndex,$onChange,$onClick)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actNumRows !== STRING_NULL)
  $numRows = " rows=" . self::QUOTE_CHAR . $actNumRows . self::QUOTE_CHAR ;	
 if($actNumCols !== STRING_NULL)
  $numCols = " cols=" . self::QUOTE_CHAR . $actNumCols . self::QUOTE_CHAR;	
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
 $onChange = " onchange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
 $onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();  	
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TEXTAREA_TAG . STRING_SPACE . $id . $name . 
 $style . $class . $numRows . 
 $numCols . $tabIndex . $onChange . $onClick . HTML_TAG_END_CHAR);
 $stringItem->tail_add($actValue);
 $stringItem->tail_add(TEXTAREA_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putSelectTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,array $actValue,
string|int $actTabIndex=STRING_NULL,string|bool $actMultiple=STRING_NULL,
string|int $actSize=STRING_NULL,
string|int $actSelectedItem=STRING_NULL,string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):Html_writer
{
 list($name,$id,$style,$class,$tabIndex,$multiple,$size,$onChange,$onClick)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL
 ,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if(($actMultiple)||($actMultiple =='true'))
  $multiple = " multiple ";
 if(($actSize !== STRING_NULL)&&(($actMultiple)||($actMultiple =='true')))
  $size = " size=" . self::QUOTE_CHAR . $actSize . self::QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
  $onChange = " onchange=" . self::QUOTE_CHAR . $actOnChange . self::QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
  $onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();  
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE . $id . $name . $style . $class .
 $multiple . 
 $size . $tabIndex . $onChange . $onClick . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $ct = 0;
 if(count($actValue)==0)
 {
   $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   self::QUOTE_CHAR . STRING_NULL . self::QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG);
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelectedItem==STRING_NULL))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . 
	  " selected"  .  " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 elseif(($actSelectedItem != STRING_NULL)&&($actSelectedItem==$val))
	  $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . 
	   " selected" .  " value=" . 
	  self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
	 else
    $stringItem->tail_add(HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    self::QUOTE_CHAR . $key . self::QUOTE_CHAR .
    HTML_TAG_END_CHAR . $val  . OPTION_CLOSE_TAG);
    $CREnabled = $this->getCREnabled();
    if($CREnabled)
   $stringItem->tail_add(STRING_ESC_RETURN);
   $ct++;
  }
 }
 $stringItem->tail_add(SELECT_CLOSE_TAG);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;  
}

function putFormOpenTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,string $actAction=STRING_NULL,
string $actMethod=STRING_NULL,string $actEncType=STRING_NULL,string|bool $actNoValidate=STRING_NULL,
string $actOnSubmitCode=STRING_NULL,string $actOnResetCode=STRING_NULL):Html_writer
{
 list($id,$name,$style,$class,$action,$method,$encType,
 $noValidate,$onSubmitCode,$onResetCode)
  = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . self::QUOTE_CHAR . $actName . self::QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actAction !== STRING_NULL)
 {
 	$action = " action=" . self::QUOTE_CHAR . $actAction . self::QUOTE_CHAR;
 }
 if($actMethod !== STRING_NULL)
 {
 	$method = " method=" . self::QUOTE_CHAR . $actMethod . self::QUOTE_CHAR;
 }
 if($actEncType !== STRING_NULL)
 {
 	$encType = " enctype=" . self::QUOTE_CHAR . $actEncType . self::QUOTE_CHAR;
 }
 if(($actNoValidate)||($actNoValidate=='true'))
 {
 	$noValidate = " novalidate ";
 }
 if($actOnSubmitCode !== STRING_NULL)
 {
 	$onSubmitCode = " onsubmit=" . self::QUOTE_CHAR . $actOnSubmitCode . self::QUOTE_CHAR;
 }
 if($actOnResetCode !== STRING_NULL)
 {
 	$onResetCode = " onreset=" . self::QUOTE_CHAR . $actOnResetCode . self::QUOTE_CHAR;
 }
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . FORM_TAG . 
 STRING_SPACE . $id . $name . $style . $class . 
 $action . $method . $encType . $noValidate . 
 $onSubmitCode . $onResetCode . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem); 
 $this->sendData();
 return $this;
}

function putTableOpenTag(string $actId=STRING_NULL,
string $actClass=STRING_NULL,
string|int $actWidth=STRING_NULL,
string|int $actHeight=STRING_NULL,
string|int $actBorder=STRING_NULL,
string|int $actCellSpacing=STRING_NULL,
string|int $actCellPadding=STRING_NULL,
string $actSummary=STRING_NULL):Html_writer
{
 list($id,$class,$width,$height,$border,$cellSpacing,$cellPadding,$summary) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 $summary = " summary=" . self::QUOTE_CHAR . $actSummary . self::QUOTE_CHAR;

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . self::QUOTE_CHAR . $actWidth . self::QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . self::QUOTE_CHAR . $actHeight . self::QUOTE_CHAR;
 if($actBorder!==STRING_NULL)
  $border = " border=" . self::QUOTE_CHAR . $actBorder . self::QUOTE_CHAR;
 if($actCellSpacing!==STRING_NULL)
  $cellSpacing = " cellspacing=" . self::QUOTE_CHAR . $actCellSpacing . self::QUOTE_CHAR;
 if($actCellPadding!==STRING_NULL)
  $cellPadding = " cellpadding=" . self::QUOTE_CHAR . $actCellPadding . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();	 
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_TAG . $id . 
 $class . $width . $height . $border . 
 $cellSpacing . $cellPadding . $summary . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function putTableColumnOpenTag(string $actId=STRING_NULL,
string $actClass=STRING_NULL,
string|int $actWidth=STRING_NULL,string|int $actHeight=STRING_NULL,
string|int $actColSpan=STRING_NULL,string|int $actRowSpan=STRING_NULL,
string $actVAlign=STRING_NULL,
string $actAlign=STRING_NULL):Html_writer
{
 list($id,$class,$width,$height,$colSpan,$rowSpan,$valign,$align) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . self::QUOTE_CHAR . $actWidth . self::QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . self::QUOTE_CHAR . $actHeight . self::QUOTE_CHAR;
 if($actColSpan !== STRING_NULL)
  $colSpan = " colspan=" . self::QUOTE_CHAR . $actColSpan . self::QUOTE_CHAR;
 if($actRowSpan !== STRING_NULL)
  $rowSpan = " rowspan=" . self::QUOTE_CHAR . $actRowSpan . self::QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . self::QUOTE_CHAR . $actVAlign . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_COLUMN_TAG . $id . $class . $width . 
 $height . $colSpan . $rowSpan . $valign . $align . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putTableHOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string|int $actWidth=STRING_NULL,string|int $actHeight=STRING_NULL,
string|int $actColSpan=STRING_NULL,string $actVAlign=STRING_NULL,
string $actAlign=STRING_NULL,string $actHeaders=STRING_NULL,
string $actAbbr=STRING_NULL,string $actScope=STRING_NULL):Html_writer
{
 list($id,$class,$width,$height,$colSpan,$valign,$align,$headers,$abbr,$scope) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . self::QUOTE_CHAR . $actWidth . self::QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . self::QUOTE_CHAR . $actHeight . self::QUOTE_CHAR;
 if($actColSpan !== STRING_NULL)
  $colSpan = " colspan=" . self::QUOTE_CHAR . $actColSpan . self::QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . self::QUOTE_CHAR . $actVAlign . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;
 if($actHeaders !== STRING_NULL)
  $headers = " headers=" . self::QUOTE_CHAR . $actHeaders . self::QUOTE_CHAR;
 if($actAbbr !== STRING_NULL)
  $abbr = " abbr=" . self::QUOTE_CHAR . $actAbbr . self::QUOTE_CHAR;
 if($actScope !== STRING_NULL)
  $scope = " scope=" . self::QUOTE_CHAR . $actScope . self::QUOTE_CHAR;
 
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_H_TAG . 
 $id . $class . $width . $height . 
 $colSpan . $valign 
 . $align . $headers . $abbr . $scope . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putTableTHeadOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):Html_writer
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . self::QUOTE_CHAR . $actVAlign . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_THEAD_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putTableTBodyOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):Html_writer
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . self::QUOTE_CHAR . $actVAlign . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_TBODY_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putTableTFootOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):Html_writer
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . self::QUOTE_CHAR . $actVAlign . self::QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . self::QUOTE_CHAR . $actAlign . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_TFOOT_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putTableRowOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string|int $actHeight=STRING_NULL):Html_writer
{
 list($id,$class,$height) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . self::QUOTE_CHAR . $actHeight . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . TABLE_ROW_TAG . 
 $id . $class . $height . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putHrefOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actLink=STRING_NULL,string $actTarget=STRING_NULL,
string $actTitle=STRING_NULL,
string $actAccessKey=STRING_NULL,string|int $actTabIndex=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnMouseOver=STRING_NULL,string $actOnMouseOut=STRING_NULL,
string $actOnKeyDown=STRING_NULL):Html_writer
{
 list($name,$id,$style,$class,$link,$target,$title,$accessKey,
 $tabIndex,$onClick,$onMouseOver,$onMouseOut,$onKeyDown) 
 = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
  $name = " name=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 } 
 if($actClass !== STRING_NULL)
 	$class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
 	$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actLink!==STRING_NULL)
  $link = " href=" . self::QUOTE_CHAR . $actLink . self::QUOTE_CHAR;
 if($actTarget!==STRING_NULL)
  $target = " target=" . self::QUOTE_CHAR . $actTarget . self::QUOTE_CHAR;
 if($actTitle!==STRING_NULL)
  $title = " title=" . self::QUOTE_CHAR . $actTitle . self::QUOTE_CHAR;
 if($actAccessKey!==STRING_NULL)
  $accessKey = " accesskey=" . self::QUOTE_CHAR . $actAccessKey . self::QUOTE_CHAR;
 if($actTabIndex!==STRING_NULL)
  $tabIndex = " tabindex=" . self::QUOTE_CHAR . $actTabIndex . self::QUOTE_CHAR;
 if($actOnClick!==STRING_NULL)
 	$onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 if($actOnMouseOver!==STRING_NULL)
 	$onMouseOver = " onmouseover=" . self::QUOTE_CHAR . $actOnMouseOver . self::QUOTE_CHAR;
 if($actOnMouseOut!==STRING_NULL)
 	$onMouseOut = " onmouseout=" . self::QUOTE_CHAR . $actOnMouseOut . self::QUOTE_CHAR;
 if($actOnKeyDown!==STRING_NULL)
  $onKeyDown = " onkeydown=" . self::QUOTE_CHAR . $actOnKeyDown . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();		
 $stringItem->setItem(HTML_TAG_INIT_CHAR . ANCHOR_TAG . $name . $id . $style . 
 $class . $link . $target . $title . 
 $accessKey . $tabIndex . $onClick . $onMouseOver . 
 $onMouseOut . $onKeyDown . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putNavOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STING_NULL):Html_writer
{
	list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	{
		$id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
	}
	if($actClass !== STRING_NULL)
	{
		$class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
	}
	if($actStyle !== STRING_NULL)
	{
		$style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
	}
	
	$itemStack = $this->getItemStack();
	$stringItem = self::createStringItem();
	$stringItem->setItem(HTML_TAG_INIT_CHAR . NAV_TAG . $id . 
	$style . $class . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
   $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
  return $this;	
}


function putGenericArrayOpenTag(string $actTag,array $actPropArray):Html_writer
{
 $propStr = STRING_SPACE;
 if(array_is_assoc($actPropArray)&&($actTag !== STRING_NULL))
 {
 	foreach($actPropArray as $ind=>$val)
 	{
   if($ind !== STRING_NULL)
   {
   	$propStr .= STRING_SPACE . $ind . STRING_EQUAL . 
   	self::QUOTE_CHAR . $val . self::QUOTE_CHAR;
   }
   else
   {
	$propStr .= STRING_SPACE . $val;
   }	   
  }    
  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem();		
  $stringItem->setItem(HTML_TAG_INIT_CHAR . $actTag . 
  $propStr . HTML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
   $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
 }
 return $this;
}

function putSpanOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,string $actOnClick=STRING_NULL):Html_writer
{
 list($id,$class,$onClick) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
  $onClick = " onClick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();	
 $stringItem->setItem(HTML_TAG_INIT_CHAR . SPAN_TAG . $id . $class . $onClick . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
  if($CREnabled)
   $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
 return $this;
}

function putParagraphOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actClass!=STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();	
 $stringItem->setItem(HTML_TAG_INIT_CHAR . PARAGRAPH_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putDivOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actOnClick=STRING_NULL,string $actOnMouseOver=STRING_NULL,
string $actOnMouseOut=STRING_NULL):Html_writer
{
 list($id,$style,$class,$onClick,$onMouseOver,$onMouseOut)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actOnClick!==STRING_NULL)
 	$onClick = " onclick=" . self::QUOTE_CHAR . $actOnClick . self::QUOTE_CHAR;
 if($actOnMouseOver!==STRING_NULL)
 	$onMouseOver = " onmouseover=" . self::QUOTE_CHAR . $actOnMouseOver . self::QUOTE_CHAR;
 if($actOnMouseOut!==STRING_NULL)
 	$onMouseOut = " onmouseout=" . self::QUOTE_CHAR . $actOnMouseOut . self::QUOTE_CHAR;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();	
 $stringItem->setItem(HTML_TAG_INIT_CHAR . DIV_TAG . $id . 
 $style . $class . $onClick . $onMouseOver . 
 $onMouseOut . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putFieldsetOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . FIELDSET_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putH1OpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . H1_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putH2OpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . H2_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putH3OpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . H3_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putDlOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . DL_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putDtOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . DT_TAG . $id . 
 $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putDDOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . DD_TAG . $id . 
 $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putAreaOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actShape=STRING_NULL,string $actCoords=STRING_NULL,
string $actHRef=STRING_NULL,string $actTarget=STRING_NULL,
string $actNoHRef=STRING_NULL,string $actAlt=STRING_NULL):Html_writer
{
 list($id,$style,$class,$shape,$coords,$hRef,$target,$noHRef,$actAlt)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 if($actShape!==STRING_NULL)
  $shape = " shape=" . self::QUOTE_CHAR . $actShape . self::QUOTE_CHAR;
 if($actCoords!==STRING_NULL)
  $coords = " coords=" . self::QUOTE_CHAR . $actCoords . self::QUOTE_CHAR;
 if($actHRef!==STRING_NULL)
  $hRef = " href=" . self::QUOTE_CHAR . $actHRef . self::QUOTE_CHAR;
 if($actTarget!==STRING_NULL)
  $target = " target=" . self::QUOTE_CHAR . $actTarget . self::QUOTE_CHAR;
 if($actNoHRef!==0)
  $noHRef = " nohref";  
 if($actAlt!==STRING_NULL)
  $alt = " alt=" . self::QUOTE_CHAR . $actAlt . self::QUOTE_CHAR;  
  
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . AREA_TAG . $id . 
 $style . $class . $shape . $coords .
 $hRef . $target . $noHRef . $alt . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putIOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
  
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . I_TAG . $id . 
 $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putGenericOpenTag(string $actTag,
string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):Html_writer
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . self::QUOTE_CHAR . $actId . self::QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . self::QUOTE_CHAR . $actStyle . self::QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . self::QUOTE_CHAR . $actClass . self::QUOTE_CHAR;
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(HTML_TAG_INIT_CHAR . $actTag . $id . 
 $style . $class . HTML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

}

?>