<?
namespace Cheope_ns\fw;

require_once("generic.const.php");
require_once("html.const.php");

if(! defined('HTML_FUN_QUOTE_CHAR'))
define('HTML_FUN_QUOTE_CHAR',STRING_DOUBLE_QUOTE);

function putXmlPrologString(string $actVersion,string $actEncoding):void
{
 echo PHP_OPEN_TAG . "xml version=\"" . $actVersion . 
 "\" encoding=\"" . $actEncoding . "\"" . PHP_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putBodyOpenTag(string $actClass,
string $actStyle,string $actBackground,string $actBgColor,
string $actText,string $actLink,
string $actVLink,string $actALink,
string $actOnLoad,string $actOnUnLoad):void
{
 list($class,$style,$background,$bgColor,$text,$link,$vLink,$aLink,$onLoad,$onUnLoad) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR; 
 if($actStyle !== STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR; 
 if($actBackground !== STRING_NULL)
  $background = " background=" . HTML_FUN_QUOTE_CHAR . $actBackground . HTML_FUN_QUOTE_CHAR;
 if($actBgColor !== STRING_NULL)
  $bgColor = " bgcolor=" . HTML_FUN_QUOTE_CHAR . $actBgColor . HTML_FUN_QUOTE_CHAR;
 if($actText !== STRING_NULL)
  $text = " text=" . HTML_FUN_QUOTE_CHAR . $actText . HTML_FUN_QUOTE_CHAR;
 if($actLink !== STRING_NULL)
  $link = " link=" . HTML_FUN_QUOTE_CHAR . $actLink . HTML_FUN_QUOTE_CHAR;
 if($actVLink !== STRING_NULL)
  $vLink = " vlink=" . HTML_FUN_QUOTE_CHAR . $actVLink . HTML_FUN_QUOTE_CHAR;
 if($actALink !== STRING_NULL)
  $aLink = " alink=" . HTML_FUN_QUOTE_CHAR . $actALink . HTML_FUN_QUOTE_CHAR;
 if($actOnLoad !== STRING_NULL)
  $onLoad = " onload=" . HTML_FUN_QUOTE_CHAR . $actOnLoad . HTML_FUN_QUOTE_CHARR;
 if($actOnUnLoad !== STRING_NULL)
  $onUnLoad = " onunLoad=" . HTML_FUN_QUOTE_CHAR . $actOnUnLoad . HTML_FUN_QUOTE_CHAR;
  
  echo HTML_TAG_INIT_CHAR . BODY_TAG . $class . $style . $background . $bgColor . $text . 
  $link . $vLink . $aLink . $onLoad . $onUnLoad . HTML_TAG_END_CHAR; 
  echo STRING_ESC_RETURN;
}

function putHtmlOpenTag(string $actLang=STRING_NULL,string $actXmlNameSpace=STRING_NULL):void
{
	list($lang,$xmlNameSpace) = array(STRING_NULL,STRING_NULL);
	if($actLang !== STRING_NULL)
	 $lang = " lang=" . HTML_FUN_QUOTE_CHAR . $actLang . HTML_FUN_QUOTE_CHAR;
	if($actXmlNameSpace !== STRING_NULL)
	 $xmlNameSpace = " xmlns=" . HTML_FUN_QUOTE_CHAR . $actXmlNameSpace . HTML_FUN_QUOTE_CHAR;
	 	
	echo HTML_TAG_INIT_CHAR . 
	HTML_TAG . $lang . $xmlNameSpace . 
	HTML_TAG_END_CHAR;
	echo STRING_ESC_RETURN;
}

function putLiOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actTitle=STRING_NULL,
string $actLang=STRING_NULL,
string $actType=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnMouseOver=STRING_NULL,
string $actOnMouseOut=STRING_NULL):void
{
	list($id,$style,$class,$title,$lang,$type,$onClick,
	$onMouseOver,$onMouseOut) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
	if($actTitle !== STRING_NULL)
	 $title = " title=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
	if($actLang !== STRING_NULL)
	 $lang = " lang=" . HTML_FUN_QUOTE_CHAR . $actLang . HTML_FUN_QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;
	if($actOnClick !== STRING_NULL)
	 $onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;
	if($actOnMouseOver !== STRING_NULL)
	 $onMouseOver = " onmouseover=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOver . HTML_FUN_QUOTE_CHAR;
	if($actOnMouseOut !== STRING_NULL)
	 $onMouseOut = " onmouseout=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOut . HTML_FUN_QUOTE_CHAR;

	echo HTML_TAG_INIT_CHAR . 
	LI_TAG . $id . $style . $class . 
	$title . $lang . $type . 
	$onClick . $onMouseOver . $onMouseOut . HTML_TAG_END_CHAR;

}

function putOlOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actType=STRING_NULL,
string $actStart=STRING_NULL):void
{
	list($id,$style,$class,$type,$start) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;
	if($actStart !== STRING_NULL)
	 $start = " start=" . HTML_FUN_QUOTE_CHAR . $actStart . HTML_FUN_QUOTE_CHAR;
	
	echo HTML_TAG_INIT_CHAR . 
	OL_TAG . $id . $style . $class . $type . $start . 
	HTML_TAG_END_CHAR;
}

function putUlOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,string $actType=STRING_NULL):void
{
	list($id,$style,$class,$type) = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	 $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
	if($actStyle !== STRING_NULL)
	 $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
	if($actClass !== STRING_NULL)
	 $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
	if($actType !== STRING_NULL)
	 $type = " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;
	
	echo HTML_TAG_INIT_CHAR . UL_TAG . 
	$id . $style . $class . $type . HTML_TAG_END_CHAR;
}

function putFrameTag(string $actName,string $actSrc,string $actFrameBorder,
string $actMarginWidth,string $actMarginHeight,$actNoResize,string $actScrolling):void
{
	list($name,$src,$frameBorder,$marginWidth,$marginHeight,$noResize,$scrolling) 
	= array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
 if($actName != STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actSrc != STRING_NULL)
  $src = " name=" . HTML_FUN_QUOTE_CHAR . $actSrc . HTML_FUN_QUOTE_CHAR;
 if($actFrameBorder != STRING_NULL)
  $frameBorder = " name=" . HTML_FUN_QUOTE_CHAR . $actFrameBorder . HTML_FUN_QUOTE_CHARR;
 if($actMarginWidth != STRING_NULL)
  $marginWidth = " name=" . HTML_FUN_QUOTE_CHAR . $actMarginWidth . HTML_FUN_QUOTE_CHAR;
 if($actMarginHeight != STRING_NULL)
  $marginHeight = " name=" . HTML_FUN_QUOTE_CHAR . $actMarginHeight . HTML_FUN_QUOTE_CHAR;
 if(($actNoResize == 0)||($actNoResize==false)||($actNoResize==STRING_NULL))
  $noResize == STRING_NULL;
 else
  $noResize = " noResize ";
 if($actScrolling != STRING_NULL)
  $scrolling = " scrolling=" . HTML_FUN_QUOTE_CHAR . $actScrolling . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . FRAME_TAG . 
 $name . $src . $frameBorder . $marginWidth . $marginHeight .
 $noResize . $scrolling  . STRING_SLASH .
 HTML_TAG_END_CHAR;
}

function putFrameOpenTag(string $actName,string $actSrc,string $actFrameBorder,
string $actMarginWidth,string $actMarginHeight,string $actNoResize,
string $actScrolling):void
{
	list($name,$src,$frameBorder,$marginWidth,$marginHeight,$noResize,$scrolling) 
	= array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
 if($actName !== STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actSrc !== STRING_NULL)
  $src = " src=" . HTML_FUN_QUOTE_CHAR . $actSrc . HTML_FUN_QUOTE_CHAR;
 if($actFrameBorder !== STRING_NULL)
  $frameBorder = " frameBorder=" . HTML_FUN_QUOTE_CHAR . $actFrameBorder . HTML_FUN_QUOTE_CHAR;
 if($actMarginWidth !== STRING_NULL)
  $marginWidth = " marginWidth=" . HTML_FUN_QUOTE_CHAR . $actMarginWidth . HTML_FUN_QUOTE_CHAR;
 if($actMarginHeight !== STRING_NULL)
  $marginHeight = " marginHeight=" . HTML_FUN_QUOTE_CHAR . $actMarginHeight . HTML_FUN_QUOTE_CHAR;
 if(($actNoResize == 0)||($actNoResize==false)||($actNoResize==STRING_NULL))
  $noResize == STRING_NULL;
 else
  $noResize = " noresize ";
 if($actScrolling !== STRING_NULL)
  $scrolling = " scrolling=" . HTML_FUN_QUOTE_CHAR . $actScrolling . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . FRAME_TAG . 
 $name . $src . $frameBorder . $marginWidth . $marginHeight .
 $noResize . $scrolling  . HTML_TAG_END_CHAR; 
}

function putFramesetOpenTag(string $actRows,string $actCols,
string $actOnLoad,string $actOnUnload):void
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
	 $rows = " rows=" . HTML_FUN_QUOTE_CHAR . $actRows . HTML_FUN_QUOTE_CHAR;
	if($actCols !== STRING_NULL)
	 $cols = " cols=" . HTML_FUN_QUOTE_CHAR . $actCols . HTML_FUN_QUOTE_CHAR;
	if($actBorder !== STRING_NULL)
	 $border = " border=" . HTML_FUN_QUOTE_CHAR . $actBorder . HTML_FUN_QUOTE_CHAR;
	if($actFrameBorder !== STRING_NULL)
	 $frameBorder = " frameBorder=" . HTML_FUN_QUOTE_CHAR . $actFrameBorder . HTML_FUN_QUOTE_CHAR;
	if($actFrameSpacing !== STRING_NULL)
	 $frameSpacing = " frameSpacing=" . HTML_FUN_QUOTE_CHAR . $actFrameSpacing . HTML_FUN_QUOTE_CHAR;  
	if($actOnLoad !== STRING_NULL)
	 $onLoad = " onload=" . HTML_FUN_QUOTE_CHAR . $actOnLoad . HTML_FUN_QUOTE_CHAR;
	if($actOnUnload !== STRING_NULL)
	 $onUnload = " onunload=" . HTML_FUN_QUOTE_CHAR . $actOnUnload . HTML_FUN_QUOTE_CHAR;

  echo HTML_TAG_INIT_CHAR . FRAMESET_TAG . 
  STRING_SPACE . $rows . $cols . $border . 
  $frameBorder . 
  $frameSpacing . 
  $onLoad . $onUnload . HTML_TAG_END_CHAR;
  echo STRING_ESC_RETURN;
}

function putDocTypeTag(string $actStr):void
{
 echo HTML_FUN_QUOTE_CHAR . 
 "!DOCTYPE " . $actStr . HTML_FUN_QUOTE_CHAR;
 echo STRING_ESC_RETURN;
}

function putImgTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actTitle=STRING_NULL,
string $actSrc=STRING_NULL,
string $actAlt=STRING_NULL,
string $actWidth=STRING_NULL,
string $actHeight=STRING_NULL,
string $actAlign=STRING_NULL,
int $actBorder=0,
string $actHSpace=STRING_NULL,
string $actVSpace=STRING_NULL,
string $actUseMap=STRING_NULL,string $actIsMap=STRING_NULL):void
{
 list($id,$class,$style,$title,$alt,$width,$height,$align,$border,$hSpace,$vSpace,
 $useMap,$isMap)=array(STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actTitle !== STRING_NULL)
  $title = " title=" . HTML_FUN_QUOTE_CHAR . $actTitle . HTML_FUN_QUOTE_CHAR;
 if($actSrc !== STRING_NULL)
  $src = " src=" . HTML_FUN_QUOTE_CHAR . $actSrc .HTML_FUN_QUOTE_CHAR;
 if($actAlt !== STRING_NULL)
  $alt = " alt=" . HTML_FUN_QUOTE_CHAR . $actAlt . HTML_FUN_QUOTE_CHAR;
 if($actWidth !== STRING_NULL)
  $width = " width=" . HTML_FUN_QUOTE_CHAR . $actWidth . HTML_FUN_QUOTE_CHAR;
 if($actHeight !== STRING_NULL)
  $height = " height=" . HTML_FUN_QUOTE_CHAR . $actHeight . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . HTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;
 if($actBorder !== STRING_NULL) 
  $border = " border=" . HTML_FUN_QUOTE_CHAR . $actBorder . HTML_FUN_QUOTE_CHAR;
 if($actHSpace !== STRING_NULL)
  $hSpace = " hspace=" . HTML_FUN_QUOTE_CHAR . $actHSpace . HTML_FUN_QUOTE_CHAR;
 if($actVSpace !== STRING_NULL)
  $vSpace = " vspace=" . HTML_FUN_QUOTE_CHAR . $actVSpace . HTML_FUN_QUOTE_CHAR;
 if($actUseMap !== STRING_NULL)
  $useMap = " usemap=" . HTML_FUN_QUOTE_CHAR . $actUseMap . HTML_FUN_QUOTE_CHAR;
 if($actIsMap !== STRING_NULL)
  $isMap = " ismap=" . HTML_FUN_QUOTE_CHAR . $actIsMap . HTML_FUN_QUOTE_CHAR;		

 echo HTML_TAG_INIT_CHAR . IMG_TAG . STRING_SPACE . 
 $id . $class . $title . 
 $title . $src . $alt . $width . 
 $height . $align . $border . $hSpace . 
 $vSpace . 
 $useMap . $isMap . CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putLinkTag(string $actRel=STRING_NULL,string $actHRef=STRING_NULL,
string $actType=MIME_0,
string $actRev=STRING_NULL,
string $actMedia=STRING_NULL,
string $actHRefLang=STRING_NULL,
string $actCharSet=STRING_NULL,
string $actTarget=STRING_NULL):void
{
 list($rel,$href,$type,$rev,$media,$hRefLang,$charSet,$target) 
 = array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL);
 
 if($actRel !== STRING_NULL)
  $rel = " rel=" . HTML_FUN_QUOTE_CHAR . $actRel . HTML_FUN_QUOTE_CHAR;
 else
  $rel = " rel=" . HTML_FUN_QUOTE_CHAR . "stylesheet" . HTML_FUN_QUOTE_CHAR;
 if($actHRef !== STRING_NULL)
  $href = " href=" . HTML_FUN_QUOTE_CHAR . $actHRef . HTML_FUN_QUOTE_CHAR;
 if($actType !== STRING_NULL)
 $type = " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;
 if($actRev !== STRING_NULL)
  $rev = " rev=" . HTML_FUN_QUOTE_CHAR . $actRev . HTML_FUN_QUOTE_CHAR;
 if($actMedia !== STRING_NULL)
  $media = " media=" . HTML_FUN_QUOTE_CHAR . $actMedia . HTML_FUN_QUOTE_CHAR;
 if($actHRefLang !== STRING_NULL)
  $hRefLang = " hreflang=" . HTML_FUN_QUOTE_CHAR . $actHRefLang . HTML_FUN_QUOTE_CHAR;
 if($actCharSet !== STRING_NULL)
  $charSet = " charset=" . HTML_FUN_QUOTE_CHAR . $actCharSet . HTML_FUN_QUOTE_CHAR;
 if($actTarget !== STRING_NULL)
  $target = " target=" . HTML_FUN_QUOTE_CHAR . $actTarget . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . 
 LINK_TAG . STRING_SPACE . $rel . $href . $type . 
 $rev . $media . $hRefLang . $charSet . $target . STRING_SLASH . 
 HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putScriptIncludeTag(string $actSrc=STRING_NULL):void
{
 $src = STRING_NULL;
 if($actSrc != STRING_NULL)
  $src = " src=" . HTML_FUN_QUOTE_CHAR . $actSrc . HTML_FUN_QUOTE_CHAR;
  
 echo HTML_TAG_INIT_CHAR . SCRIPT_TAG . " language=" . HTML_FUN_QUOTE_CHAR . 
 "javascript" . HTML_FUN_QUOTE_CHAR .
 " type=" . HTML_FUN_QUOTE_CHAR . MIME_3 . HTML_FUN_QUOTE_CHAR . $src .
 HTML_TAG_END_CHAR . SCRIPT_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putScriptOpenTag():void
{
 echo HTML_TAG_INIT_CHAR . SCRIPT_TAG . " language=" . HTML_FUN_QUOTE_CHAR . 
 "javascript" . HTML_FUN_QUOTE_CHAR . " type=" . HTML_FUN_QUOTE_CHAR 
 . MIME_3 . HTML_FUN_QUOTE_CHAR . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putButtonTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,
string $actLabel=STRING_NULL,string $actType=STRING_NULL,
string $actTabIndex=STRING_NULL,string $actOnClickCode=STRING_NULL):void
{
 list($id,$class,$style,$label,$type,$tabIndex,$onClickCode) = array(STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actLabel !== STRING_NULL)
  $label = $actLabel;
 if($actType !== STRING_NULL)
  $type= " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . HTML_FUN_QUOTE_CHAR . $actTabIndex . HTML_FUN_QUOTE_CHAR;
 if($actOnClickCode !== STRING_NULL)
 	$onClickCode = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClickCode . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . BUTTON_TAG  . $id . $class . $style . $type .  
 $tabIndex  . $onClickCode . HTML_TAG_END_CHAR . $actLabel . BUTTON_CLOSE_TAG;
 echo STRING_ESC_RETURN; 
}

function putGenericHtmlString(string $actStr,$actNumSpace=0,string $actClass=STRING_NULL):void
{
 $space=STRING_NULL;
 for($i=0;$i<=$actNumSpace-1;$i++)
  $space = $space . STRING_SPACE;
 
 if($actClass !== STRING_NULL)
  echo $space . HTML_TAG_INIT_CHAR . 
  SPAN_TAG . " class=" . HTML_FUN_QUOTE_CHAR . 
  $actClass . HTML_FUN_QUOTE_CHAR . HTML_TAG_END_CHAR . 
  $actStr . SPAN_CLOSE_TAG;
 else
  echo $space . $actStr;
    
 echo STRING_ESC_RETURN;
}


function putLabelTag(string $actId,string $actStyle,string $actClass,string $actFor,
string $actVal=STRING_NULL):void
{
 list($id,$class,$style,$for) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR ;
 }	
 if($actClass !== STRING_NULL)
 {
 	$class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
 	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 }
 if($actFor !== STRING_NULL)
 {
 	$for = " for=" . HTML_FUN_QUOTE_CHAR . $actFor . HTML_FUN_QUOTE_CHAR;
 } 
 echo HTML_TAG_INIT_CHAR . LABEL_TAG . 
 $id . $class . $style . $for . HTML_TAG_END_CHAR;
 echo $actVal;
 echo LABEL_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putDojoRadioButton(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,array $actValues=STRING_NULL,
array|string $actLabels=STRING_NULL,
string $actValue=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actDirection=STRING_NULL,
string $actOnChange=STRING_NULL):void
{
	list($id,$name,$style,$toolTip,$title,$labels,$value,$direction,$onChange) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actName !== STRING_NULL)
 {
 	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle;
  if(($actStyle !== STRING_NULL) && ($actDirection == "H"))
  {
   $style = $style . ";"; 
   $style = $style . HTML_WRITER_FUN_QUOTE_CHARR;	
  }
  else
   $style = $style . HTML_WRITER_FUN_QUOTE_CHAR;	   
 }
 elseif(($actStyle == STRING_NULL) && ($actDirection == "H"))
 {
 	$style = " style=\"\"";
 }
  
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR;
  $toolTip = " toolTip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
  
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR;
 }
  
 if(! is_array($actValues))
  $actValues = array($actValues);
  
 if(! is_array($actLabels))
  $actLabels = array($actLabels);
 
 $i=0;
 
 foreach($actValues as $ind=>$val)
 {
 	$label = (isset($actLabels[$ind])?$actLabels[$ind]:STRING_NULL);
 // $stringItem = self::createStringItem();
  
  if($val !== STRING_NULL)
  {
 	 $value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR;
  }
  
  if($actId !== STRING_NULL)
  {
 	 $id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . VAR_SEP . $ind . HTML_WRITER_FUN_QUOTE_CHAR;
  }  
  
 	if($val == $actValue) 
   echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
   "dojoType = \"dijit.form.RadioButton\"" . STRING_SPACE . 
   $id . $name . $style . STRING_SPACE . 
   "checked" . STRING_SPACE . $value . $toolTip . 
   $title . $onChange . STRING_SPACE . CLOSE_TAG .  
   (($actDirection == "H")?(SPAN_OPEN_TAG . $label . SPAN_CLOSE_TAG):
   ($label . SEP_OPEN_TAG));
  else
   echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . 
   "dojoType = \"dijit.form.RadioButton\"" . STRING_SPACE .
   $id . $name . $style . $value . $toolTip . $title .
   $onChange . STRING_SPACE . CLOSE_TAG .  
   (($actDirection == "H")?(SPAN_OPEN_TAG . $label . SPAN_CLOSE_TAG):
   ($label . SEP_OPEN_TAG));    
 
  echo INPUT_CLOSE_TAG;
 }
  echo STRING_ESC_RETURN;
}


function putDojoCheckBox(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actChecked=STRING_NULL,string $actValue=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):void
{
	list($id,$name,$style,$checked,$value,$toolTip,$title,$onChange,$onClick) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL);

  if($actId !== STRING_NULL)
  {
 	 $id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
  }
  if($actName !== STRING_NULL)
  {
 	 $name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
  }
  if($actStyle !== STRING_NULL)
  {
	 $style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
  }
  if($actChecked)
  {
	 $checked = " checked ";
  } 	
 if($actValue !== STRING_NULL)
 {
 	$value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
 	$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHARR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = HTML_TAG_INIT_CHAR . SCRIPT_TAG . STRING_SPACE . 
	"type" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "dojo/method" . HTML_WRITER_FUN_QUOTE_CHAR .
	STRING_SPACE . "event" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "onChange" . 
	HTML_WRITER_FUN_QUOTE_CHAR . STRING_SPACE .
	"args" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "evt" . HTML_WRITER_FUN_QUOTE_CHAR .
	HTML_TAG_END_CHAR;
 } 
 if($actOnClick !== STRING_NULL)
 {
	$onClick = HTML_TAG_INIT_CHAR . SCRIPT_TAG . STRING_SPACE . 
	"type" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "dojo/method" . HTML_WRITER_FUN_QUOTE_CHAR .
	STRING_SPACE . "event" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "onClick" . 
	HTML_WRITER_FUN_QUOTE_CHAR . STRING_SPACE .
	"args" . STRING_EQUAL . HTML_WRITER_FUN_QUOTE_CHAR . "evt" . HTML_WRITER_FUN_QUOTE_CHAR .
	HTML_TAG_END_CHAR;
 } 
	
 echo HTML_TAG_INIT_CHAR . DIV_TAG . STRING_SPACE . 
 "dojoType=\"dijit.form.CheckBox\""  . STRING_SPACE .
 $id . $name . $style . $checked . $value . $title .
 $toolTip . STRING_SPACE . HTML_TAG_END_CHAR;
 echo DIV_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}


function putDojoSimpleTextarea(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string $actRequired=STRING_NULL,string $actValue=STRING_NULL,string $actRows=STRING_NULL,
string $actCols=STRING_NULL,string $actToolTip=STRING_NULL,string $actOnChange=STRING_NULL):void
{
	list($id,$name,$style,$required,$value,$rows,$cols,$toolTip,$title,$onChange) = 
	array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
 {
 	$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
 } 	
 if($actRows !== STRING_NULL)
 {
	$rows = " rows=" . HTML_WRITER_FUN_QUOTE_CHAR . $actRows . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
  if($actCols !== STRING_NULL)
 {
	$cols = " cols=" . HTML_WRITER_FUN_QUOTE_CHAR . $actCols . HTML_WRITER_FUN_QUOTE_CHAR;
 } 	
 if($actRequired !== STRING_NULL)
 {
	$required = " required=" . HTML_WRITER_FUN_QUOTE_CHAR . $actRequired . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
 {
 	$value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actToolTip !== STRING_NULL)
 {
	$title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
 	$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
	
 echo HTML_TAG_INIT_CHAR . TEXTAREA_TAG . STRING_SPACE . HTML_WRITER_FUN_QUOTE_CHAR . 
 "dijit.form.SimpleTextarea" . HTML_WRITER_FUN_QUOTE_CHAR . STRING_SPACE .
 $id . $name . $style . $rows . $cols . $required . $value . $title .
 $toolTip . $onChange . 
 STRING_SPACE . HTML_TAG_END_CHAR . TEXTAREA_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putDojoMultiSelect(string $actId=STRING_NULL,string $actName=STRING_NULL,
array|string $actValue=STRING_NULL,
string $actStyle=STRING_NULL,
string $actSelectedItem=STRING_NULL,
string $actSize=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnChange=STRING_NULL):void
{
	 list($id,$name,$style,
	 $tooltipPosition,$toolTip,$title,
	 $selected,$size,$onClick,$onChange) = 
	 array(STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	 STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
	$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actTooltipPosition !== STRING_NULL)
 {
	$tooltipPosition = " tooltipPosition=" . HTML_WRITER_FUN_QUOTE_CHAR . $actTooltipPosition . HTML_WRITER_FUN_QUOTE_CHAR;
 }  
 if($actSize !== STRING_NULL)
 {
	$size = " size=" . HTML_WRITER_FUN_QUOTE_CHAR . $actSize . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actOnClick !== STRING_NULL)
 {
	$onClick = " onClick=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnClick . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR;
 } 

 echo HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.MultiSelect\"" . STRING_SPACE .
 $id . $name . $style . 
 $size . $toolTip . $tooltipPosition . 
 $title . $onClick . 
 $onChange . STRING_SPACE . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
 $ct = 0;
 if(! is_array($actValue))
 {
   echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG;
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelectedItem==STRING_NULL))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 elseif(($actSelectedItem != STRING_NULL)&&($actSelectedItem == $key))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 else
    echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
    HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
    echo STRING_ESC_RETURN;
   $ct++;
  }
 }
 echo SELECT_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putDojoComboBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,string $actStyle=STRING_NULL,
array|string $actValue=STRING_NULL,string $actStop=STRING_NULL,
string $actPromptMessage=STRING_NULL,
string $actInvalidMessage=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actRegexp=STRING_NULL,
string $actSelected=STRING_NULL,string $actRequired=STRING_NULL,
string $actAutoComplete=STRING_NULL,string $actOnChange=STRING_NULL):void
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
 	$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actStop !== STRING_NULL)
 {
	$stop = " maxlength=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStop . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actPromptMessage !== STRING_NULL)
 {
	$promptMessage = " promptMessage=" . HTML_WRITER_FUN_QUOTE_CHAR . $actPromptMessage . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actInvalidMessage !== STRING_NULL)
 {
	$invalidMessage = " invalidMessage=" . HTML_WRITER_FUN_QUOTE_CHAR . $actInvalidMessage . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actToolTip !== STRING_NULL)
 {
  $title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
	$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actTooltipPosition !== STRING_NULL)
 {
	$tooltipPosition = " tooltipPosition=" . HTML_WRITER_FUN_QUOTE_CHAR . $actTooltipPosition . HTML_WRITER_FUN_QUOTE_CHAR;
 }  
 if($actRegexp !== STRING_NULL)
 {
	$regexp = " regexp=" . HTML_WRITER_FUN_QUOTE_CHAR . $actRegexp . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actRequired)
 {
	$required = " required ";
 }
 if($actAutoComplete)
 {
	$autoComplete = " autoComplete=" . HTML_WRITER_FUN_QUOTE_CHAR . "true" . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR;
 } 

 echo HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.ComboBox\"" . STRING_SPACE .
 $id . $name . $style . 
 $stop . 
 $promptMessage . $invalidMessage . $title .
 $toolTip . $tooltipPosition . $regexp . 
 $required . $autoComplete . 
 $onChange . STRING_SPACE . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
 $ct = 0;

 if(! is_array($actValue))
 {
   echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   HTML_WRITER_FUN_QUOTE_CHAR . STRING_NULL . HTML_WRITER_FUN_QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG;
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelected==STRING_NULL))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  . " value=" . 
	  HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 elseif(($actSelected != STRING_NULL)&&($actSelected == $key))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . " selected=" . 
	   "selected"  .  " value=" . 
	  HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 else
    echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    HTML_WRITER_FUN_QUOTE_CHAR . $val . HTML_WRITER_FUN_QUOTE_CHAR .
    HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
    echo STRING_ESC_RETURN;
   $ct++;
  }
 }
 echo SELECT_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}


function putDojoDateTextBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,string $actStyle=STRING_NULL,
string $actFormat=STRING_NULL,string $actValue=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):void
{
 list($id,$name,$style,$format,$value,$onChange,$onClick) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
 	$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
 	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actFormat !== STRING_NULL)
 {
	$format = " format=" . HTML_WRITER_FUN_QUOTE_CHAR . $actFormat . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actValue !== STRING_NULL)
 {
	$value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR;
 } 
 if($actOnChange !== STRING_NULL)
 {
	$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actOnClick !== STRING_NULL)
 {
	$onClick = " onClick=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnClick . HTML_WRITER_FUN_QUOTE_CHAR;
 }

 $stdDojoDateArray = convertToDojoDefaultDate($actValue,$actFormat);
 $stdDojoDate = $stdDojoDateArray[2] . '-' . $stdDojoDateArray[1] . '-' .$stdDojoDateArray[0];

 echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . HTML_WRITER_FUN_QUOTE_CHAR . 
 "dijit.form.DateTextBox" . HTML_WRITER_FUN_QUOTE_CHAR . STRING_SPACE .
 $id . $name . $style . $stdDojoDate . $onChange . $onClick, STRING_SPACE . CLOSE_TAG;
 echo STRING_ESC_RETURN;
}


function putDojoTextBox(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actValue=STRING_NULL,string $actType=STRNG_NULL,
string $actRequired=STRING_NULL,
string $actLength=STRING_NULL,
string $actStop=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):void
{
 list($id,$name,$style,$value,$type,$required,$length,$stop,
 $toolTip,$title,$onChange,$onClick) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
	$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR; 	
 }	
 if($actName !== STRING_NULL)
 {
	$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
 }
if($actStyle !== STRING_NULL)
 {
		$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
 {
	$value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR ;
 }
 if($actType !== STRING_NULL)
 {
	$type = " type=" . HTML_WRITER_FUN_QUOTE_CHAR . $actType . HTML_WRITER_FUN_QUOTE_CHAR ;
 }  
 if($actLength !== STRING_NULL)
 {
	$length = " size=" . HTML_WRITER_FUN_QUOTE_CHAR . $actLength . HTML_WRITER_FUN_QUOTE_CHAR ;
 } 
 if($actStop !== STRING_NULL)
 {
	$stop = " maxlength=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStop . HTML_WRITER_FUN_QUOTE_CHAR ;
 } 
 if($actToolTip !== STRING_NULL)
 {
	$title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
	$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
 }  
 if($actRequired !== STRING_NULL)
 {
		$required = " required ";
 }
 if($actOnChange !== STRING_NULL)
 {
		$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR ;
 }
 if($actOnClick !== STRING_NULL)
 {
		$onClick = " onClick=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnClick . HTML_WRITER_FUN_QUOTE_CHAR ;
 }
 
 echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . HTML_WRITER_FUN_QUOTE_CHAR . 
 "dijit.form.TextBox" . HTML_WRITER_FUN_QUOTE_CHAR . STRING_SPACE .
 $id . $name . $style . $value . $type . $length . 
 $required . $stop . $toolTip . $title . $onChange . 
 $onClick . STRING_SPACE . CLOSE_TAG;
 echo STRING_ESC_RETURN;
}


function putDojoValidationTextBox(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string $actValue=STRING_NULL,
string $actRequired=STRING_NULL,
string $actStop=STRING_NULL,
string $actPromptMessage=STRING_NULL,
string $actInvalidMessage=STRING_NULL,
string $actRegExp=STRING_NULL,
string $actToolTip=STRING_NULL,
string $actTooltipPosition=STRING_NULL,
string $actOnChange=STRING_NULL):void
{
	list($id,$name,$style,$value,$required,$stop,$promptMessage,$invalidMessage,
	$regExp,$tooltipPosition,$toolTip,$title,$onChange)=array(STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	{
		$id = " id=" . HTML_WRITER_FUN_QUOTE_CHAR . $actId . HTML_WRITER_FUN_QUOTE_CHAR;
	}
	if($actName !== STRING_NULL)
	{
		$name = " name=" . HTML_WRITER_FUN_QUOTE_CHAR . $actName . HTML_WRITER_FUN_QUOTE_CHAR;
	}
	if($actStyle !== STRING_NULL)
	{
		$style = " style=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStyle . HTML_WRITER_FUN_QUOTE_CHAR;
	}
	if($actValue !== STRING_NULL)
	{
		$value = " value=" . HTML_WRITER_FUN_QUOTE_CHAR . $actValue . HTML_WRITER_FUN_QUOTE_CHAR ;
	}
	if($actRequired == "true")
	{
		$required = " required ";
	}
	if($actStop !== STRING_NULL)
	{
		$stop = " maxlength=" . HTML_WRITER_FUN_QUOTE_CHAR . $actStop . HTML_WRITER_FUN_QUOTE_CHAR ;
	}
	if($actPromptMessage !== STRING_NULL)
	{
		$promptMessage = " promptMessage=" . HTML_WRITER_FUN_QUOTE_CHAR . $actPromptMessage . HTML_WRITER_FUN_QUOTE_CHAR ;
	}
	if($actInvalidMessage !== STRING_NULL)
	{
		$invalidMessage = " invalidMessage=" . HTML_WRITER_FUN_QUOTE_CHAR . $actInvalidMessage . HTML_WRITER_FUN_QUOTE_CHAR ;
	}
	if($actRegExp !== STRING_NULL)
	{
		$regExp = " regexp=" . HTML_WRITER_FUN_QUOTE_CHAR . $actRegExp . HTML_WRITER_FUN_QUOTE_CHAR ;
	}	
	if($actToolTip !== STRING_NULL)
	{
		$title = " title=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
		$toolTip = " tooltip=" . HTML_WRITER_FUN_QUOTE_CHAR . $actToolTip . HTML_WRITER_FUN_QUOTE_CHAR ;
	}	
	if($actTooltipPosition !== STRING_NULL)
	{
		$tooltipPosition = " tooltipPosition=" . HTML_WRITER_FUN_QUOTE_CHAR . $actTooltipPosition . HTML_WRITER_FUN_QUOTE_CHAR ;
	}		
	if($actOnChange !== STRING_NULL)
	{
		$onChange = " onChange=" . HTML_WRITER_FUN_QUOTE_CHAR . $actOnChange . HTML_WRITER_FUN_QUOTE_CHAR ;
	}	
	
 echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE .  
 "dojoType=\"dijit.form.ValidationTextBox\"" . STRING_SPACE .
 $id . $name . $style . $value . 
 $required . $stop . $promptMessage . 
 $invalidMessage . $regExp . $toolTip . $title .
 $tooltipPosition . $onChange . STRING_SPACE . CLOSE_TAG;
 echo STRING_ESC_RETURN;
}


function putInputTag(string $actId=STRING_NULL,
string $actName=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actValue=STRING_NULL,
string $actType=STRING_NULL,
string|bool|int $actChecked=STRING_NULL,
string|int $actLength=STRING_NULL,
string $actStop=STRING_NULL,
string $actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):void
{
 list($id,$class,$style,$name,$value,$checked,
 $type,$length,$maxLength,$tabIndex,$onChange,$onClick)
 =array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
	$id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 } 
 if($actClass !== STRING_NULL)
 {
	$class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 }
 if($actStyle !== STRING_NULL)
 {
	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 }
 if($actName !== STRING_NULL)
 {
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 }
 if($actValue !== STRING_NULL)
  $value = " value=" . HTML_FUN_QUOTE_CHAR . $actValue . HTML_FUN_QUOTE_CHAR ;	
 if($actType !== STRING_NULL)
  $type = " type=" . HTML_FUN_QUOTE_CHAR . $actType . HTML_FUN_QUOTE_CHAR;	
 if(($actChecked !== STRING_NULL)&&($actChecked !== false)&&($actChecked !== 0))
  $checked = " checked";	
 if($actLength !== STRING_NULL)
  $length = " size=" . HTML_FUN_QUOTE_CHAR . $actLength . HTML_FUN_QUOTE_CHAR;	
 if($actStop !== STRING_NULL)
  $maxLength = " maxlength=" . HTML_FUN_QUOTE_CHAR . $actStop . HTML_FUN_QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . HTML_FUN_QUOTE_CHAR . $actTabIndex . HTML_FUN_QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
  $onChange = " onchange=" . HTML_FUN_QUOTE_CHAR . $actOnChange . HTML_FUN_QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
  $onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . INPUT_TAG . STRING_SPACE . 
 $id . $name . $class . $style . 
 $value . $type . $checked . $length . $maxLength . 
 $tabIndex . $onChange . $onClick . CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putTextAreaTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,
string $actValue=STRING_NULL,string $actNumRows=STRING_NULL,
string $actNumCols=STRING_NULL,string $actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL,string $actOnClick=STRING_NULL):void
{
 list($name,$id,$style,$class,$numRows,$numCols,$tabIndex,$onChange,$onClick)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actNumRows !== STRING_NULL)
  $numRows = " rows=" . HTML_FUN_QUOTE_CHAR . $actNumRows . HTML_FUN_QUOTE_CHAR ;	
 if($actNumCols !== STRING_NULL)
  $numCols = " cols=" . HTML_FUN_QUOTE_CHAR . $actNumCols . HTML_FUN_QUOTE_CHAR;	
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . HTML_FUN_QUOTE_CHAR . $actTabIndex . HTML_FUN_QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
 $onChange = " onchange=" . HTML_FUN_QUOTE_CHAR . $actOnChange . HTML_FUN_QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
 $onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TEXTAREA_TAG . STRING_SPACE . $id . $name . 
 $style . $class . $numRows . 
 $numCols . $tabIndex . $onChange . $onClick . HTML_TAG_END_CHAR;
 echo $actValue;
 echo TEXTAREA_CLOSE_TAG;
 echo STRING_ESC_RETURN;
}

function putSelectTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,array|string $actValue,
string $actTabIndex=STRING_NULL,string|bool|int $actMultiple=STRING_NULL,string $actSize=STRING_NULL,
string $actSelectedItem=STRING_NULL,string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):void
{
 list($name,$id,$style,$class,$tabIndex,$multiple,$size,$onChange,$onClick)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL
 ,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actTabIndex !== STRING_NULL)
  $tabIndex = " tabindex=" . HTML_FUN_QUOTE_CHAR . $actTabIndex . HTML_FUN_QUOTE_CHAR;
 if(($actMultiple !== STRING_NULL)&&($actMultiple !== false)&&($actMultiple !== 0))
  $multiple = " multiple ";
 if(($actSize !== STRING_NULL)&&(($actMultiple !== STRING_NULL)
 &&($actMultiple !== false)&&($actMultiple !== 0)))
  $size = " size=" . HTML_FUN_QUOTE_CHAR . $actSize . HTML_FUN_QUOTE_CHAR;
 if($actOnChange !== STRING_NULL)
  $onChange = " onchange=" . HTML_FUN_QUOTE_CHAR . $actOnChange . HTML_FUN_QUOTE_CHAR;
 if($actOnClick !== STRING_NULL)
  $onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . SELECT_TAG . STRING_SPACE . $id . $name . $style . $class .
 $multiple . 
 $size . $tabIndex . $onChange . $onClick . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
 $ct = 0;
 if(count($actValue)==0)
 {
   echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
   HTML_FUN_QUOTE_CHAR . STRING_NULL . HTML_FUN_QUOTE_CHAR .
   HTML_TAG_END_CHAR . STRING_NULL  . OPTION_CLOSE_TAG;
 }
 else
 {
  foreach($actValue as $key => $val)
  {
   if(($ct==0)&&($actSelectedItem==STRING_NULL))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . 
	  " selected"  .  " value=" . 
	  HTML_FUN_QUOTE_CHAR . $val . HTML_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 elseif(($actSelectedItem != STRING_NULL)&&($actSelectedItem==$key))
	  echo HTML_TAG_INIT_CHAR . OPTION_TAG . 
	   " selected" .  " value=" . 
	  HTML_FUN_QUOTE_CHAR . $val . HTML_FUN_QUOTE_CHAR .
	  HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
	 else
    echo HTML_TAG_INIT_CHAR . OPTION_TAG . " value=" . 
    HTML_FUN_QUOTE_CHAR . $val . HTML_FUN_QUOTE_CHAR .
    HTML_TAG_END_CHAR . $key  . OPTION_CLOSE_TAG;
    echo STRING_ESC_RETURN;
   $ct++;
  }
 }
 echo SELECT_CLOSE_TAG;
 echo STRING_ESC_RETURN; 
}

function putFormOpenTag(string $actId=STRING_NULL,string $actName=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL,string $actAction=STRING_NULL,
string $actMethod=STRING_NULL,string $actEncType=STRING_NULL,string $actNoValidate=STRING_NULL,
string $actOnSubmitCode=STRING_NULL,string $actOnResetCode=STRING_NULL):void
{
 list($id,$name,$style,$class,$action,$method,$encType,
 $noValidate,$onSubmitCode,$onResetCode)
  = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actName !== STRING_NULL)
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actName . HTML_FUN_QUOTE_CHAR;
 if($actClass !== STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actAction !== STRING_NULL)
 {
 	$action = " action=" . HTML_FUN_QUOTE_CHAR . $actAction . HTML_FUN_QUOTE_CHAR;
 }
 if($actMethod !== STRING_NULL)
 {
 	$method = " method=" . HTML_FUN_QUOTE_CHAR . $actMethod . HTML_FUN_QUOTE_CHAR;
 }
 if($actEncType !== STRING_NULL)
 {
 	$encType = " enctype=" . HTML_FUN_QUOTE_CHAR . $actEncType . HTML_FUN_QUOTE_CHAR;
 }
 if($actNoValidate !== STRING_NULL)
 {
 	$noValidate = " novalidate=" . HTML_FUN_QUOTE_CHAR . "novalidate" . HTML_FUN_QUOTE_CHAR;
 }
 if($actOnSubmitCode !== STRING_NULL)
 {
 	$onSubmitCode = " onsubmit=" . HTML_FUN_QUOTE_CHAR . $actOnSubmitCode . HTML_FUN_QUOTE_CHAR;
 }
 if($actOnResetCode !== STRING_NULL)
 {
 	$onResetCode = " onreset=" . HTML_FUN_QUOTE_CHAR . $actOnResetCode .HTML_FUN_QUOTE_CHAR;
 }
 echo HTML_TAG_INIT_CHAR . FORM_TAG . 
 STRING_SPACE . $id . $name . $style . $class . 
 $action . $method . $encType . $noValidate . 
 $onSubmitCode . $onResetCode . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableOpenTag(string $actId=STRING_NULL,
string $actClass=STRING_NULL,
string $actWidth=STRING_NULL,
string $actHeight=STRING_NULL,
string $actBorder=STRING_NULL,
string $actCellSpacing=STRING_NULL,
string $actCellPadding=STRING_NULL,
string $actSummary=STRING_NULL):void
{
 list($id,$class,$width,$height,$border,$cellSpacing,$cellPadding,$summary) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 $summary = " summary=" . HTML_FUN_QUOTE_CHAR . $actSummary . HTML_FUN_QUOTE_CHAR;

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . HTML_FUN_QUOTE_CHAR . $actWidth . HTML_FUN_QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . HTML_FUN_QUOTE_CHAR . $actHeight . HTML_FUN_QUOTE_CHAR;
 if($actBorder!==STRING_NULL)
  $border = " border=" . HTML_FUN_QUOTE_CHAR . $actBorder . HTML_FUN_QUOTE_CHAR;
 if($actCellSpacing!==STRING_NULL)
  $cellSpacing = " cellspacing=" . HTML_FUN_QUOTE_CHAR . $actCellSpacing .HTML_FUN_QUOTE_CHAR;
 if($actCellPadding!==STRING_NULL)
  $cellPadding = " cellpadding=" . HTML_FUN_QUOTE_CHAR . $actCellPadding . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_TAG . $id . 
 $class . $width . $height . $border . 
 $cellSpacing . $cellPadding . $summary . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableColumnOpenTag(string $actId=STRING_NULL,
string $actClass=STRING_NULL,
string $actWidth=STRING_NULL,string $actHeight=STRING_NULL,
string $actColSpan=STRING_NULL,string $actRowSpan=STRING_NULL,
string $actVAlign=STRING_NULL,
string $actAlign=STRING_NULL):void
{
 list($id,$class,$width,$height,$colSpan,$rowSpan,$valign,$align) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . HTML_FUN_QUOTE_CHAR . $actWidth . HTML_FUN_QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . HTML_FUN_QUOTE_CHAR . $actHeight . HTML_FUN_QUOTE_CHAR;
 if($actColSpan !== STRING_NULL)
  $colSpan = " colspan=" . HTML_FUN_QUOTE_CHAR . $actColSpan . HTML_FUN_QUOTE_CHAR;
 if($actRowSpan !== STRING_NULL)
  $rowSpan = " rowspan=" . HTML_FUN_QUOTE_CHAR . $actRowSpan . HTML_FUN_QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . HTML_FUN_QUOTE_CHAR . $actVAlign . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . HTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_COLUMN_TAG . $id . $class . $width . 
 $height . $colSpan . $rowSpan . $valign . $align . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableHeaderOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actWidth=STRING_NULL,string $actHeight=STRING_NULL,
string $actColSpan=STRING_NULL,string $actVAlign=STRING_NULL,
string $actAlign=STRING_NULL,string $actHeaders=STRING_NULL,
string $actAbbr=STRING_NULL,string $actScope=STRING_NULL):void
{
 list($id,$class,$width,$height,$colSpan,$valign,$align,$headers,$abbr,$scope) = 
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actWidth!==STRING_NULL)
  $width= " width=" . HTML_FUN_QUOTE_CHAR . $actWidth . HTML_FUN_QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . HTML_FUN_QUOTE_CHAR . $actHeight . HTML_FUN_QUOTE_CHAR;
 if($actColSpan !== STRING_NULL)
  $colSpan = " colspan=" . HTML_FUN_QUOTE_CHAR . $actColSpan . HTML_FUN_QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . HTML_FUN_QUOTE_CHAR . $actVAlign . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . HTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;
 if($actHeaders !== STRING_NULL)
  $headers = " headers=" . HTML_FUN_QUOTE_CHAR . $actHeaders . HTML_FUN_QUOTE_CHAR;
 if($actAbbr !== STRING_NULL)
  $abbr = " abbr=" . HTML_FUN_QUOTE_CHAR . $actAbbr . HTML_FUN_QUOTE_CHAR;
 if($actScope !== STRING_NULL)
  $scope = " scope=" . HTML_FUN_QUOTE_CHAR . $actScope . HTML_FUN_QUOTE_CHAR;
 
 echo HTML_TAG_INIT_CHAR . TABLE_H_TAG . 
 $id . $class . $width . $height . 
 $colSpan . $valign 
 . $align . $headers . $abbr . $scope . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableTHeadOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):void
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . HTML_FUN_QUOTE_CHAR . $actVAlign . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . HTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_THEAD_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableTBodyOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):void
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . HTML_FUN_QUOTE_CHAR . $actVAlign . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . HTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_TBODY_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableTFootOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actVAlign=STRING_NULL,string $actAlign=STRING_NULL):void
{
 list($id,$class,$valign,$align)=array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);

 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actVAlign !== STRING_NULL)
  $valign = " valign=" . HTML_FUN_QUOTE_CHAR . $actVAlign . HTML_FUN_QUOTE_CHAR;
 if($actAlign !== STRING_NULL)
  $align = " align=" . sHTML_FUN_QUOTE_CHAR . $actAlign . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_TFOOT_TAG . $id . $class . $valign 
 . $align . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putTableRowOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL,
string $actHeight=STRING_NULL):void
{
 list($id,$class,$height) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actHeight!==STRING_NULL)
 	$height = " height=" . HTML_FUN_QUOTE_CHAR . $actHeight . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . TABLE_ROW_TAG . 
 $id . $class . $height . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putHrefOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actLink=STRING_NULL,string $actTarget=STRING_NULL,
string $actTitle=STRING_NULL,
string $actAccessKey=STRING_NULL,string $actTabIndex=STRING_NULL,
string $actOnClick=STRING_NULL,
string $actOnMouseOver=STRING_NULL,string $actOnMouseOut=STRING_NULL,
string $actOnKeyDown=STRING_NULL):void
{
 list($name,$id,$style,$class,$link,$target,$title,$accessKey,
 $tabIndex,$onClick,$onMouseOver,$onMouseOut,$onKeyDown) 
 = array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 
 if($actId !== STRING_NULL)
 {
  $name = " name=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
	$id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 } 
 if($actClass !== STRING_NULL)
 	$class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actStyle !== STRING_NULL)
 	$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actLink!==STRING_NULL)
  $link = " href=" . HTML_FUN_QUOTE_CHAR . $actLink . HTML_FUN_QUOTE_CHAR;
 if($actTarget!==STRING_NULL)
  $target = " target=" . HTML_FUN_QUOTE_CHAR . $actTarget . HTML_FUN_QUOTE_CHAR;
 if($actTitle!==STRING_NULL)
  $title = " title=" . HTML_FUN_QUOTE_CHAR . $actTitle . HTML_FUN_QUOTE_CHAR;
 if($actAccessKey!==STRING_NULL)
  $accessKey = " accesskey=" . HTML_FUN_QUOTE_CHAR . $actAccessKey . HTML_FUN_QUOTE_CHAR;
 if($actTabIndex!==STRING_NULL)
  $tabIndex = " tabindex=" . HTML_FUN_QUOTE_CHAR . $actTabIndex . HTML_FUN_QUOTE_CHAR;
 if($actOnClick!==STRING_NULL)
 	$onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;
 if($actOnMouseOver!==STRING_NULL)
 	$onMouseOver = " onmouseover=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOver . HTML_FUN_QUOTE_CHAR;
 if($actOnMouseOut!==STRING_NULL)
 	$onMouseOut = " onmouseout=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOut . HTML_FUN_QUOTE_CHAR;
 if($actOnKeyDown!==STRING_NULL)
  $onKeyDown = " onkeydown=" . HTML_FUN_QUOTE_CHAR . $actOnKeyDown . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . ANCHOR_TAG . $name . $id . $style . 
 $class . $link . $target . $title . 
 $accessKey . $tabIndex . $onClick . $onMouseOver . 
 $onMouseOut . $onKeyDown . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putNavOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STING_NULL):void
{
	list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
	
	if($actId !== STRING_NULL)
	{
		$id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
	}
	if($actClass !== STRING_NULL)
	{
		$class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
	}
	if($actStyle !== STRING_NULL)
	{
		$style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
	}
	
	$stringItem->setItem(HTML_TAG_INIT_CHAR . NAV_TAG . $id . 
	$style . $class . HTML_TAG_END_CHAR);
  echo STRING_ESC_RETURN;
}

function putGenericArrayOpenTag(string $actTag,array $actPropArray):void
{
 $propStr = STRING_SPACE;
 if(array_is_assoc($actPropArray)&&($actTag !== STRING_NULL))
 {
 	foreach($actPropArray as $ind=>$val)
 	{
   if($ind !== STRING_NULL)
   {
   	$propStr .= STRING_SPACE . $ind . STRING_EQUAL . 
   	HTML_FUN_QUOTE_CHAR . $val . HTML_FUN_QUOTE_CHAR;
   }  
  }    
  echo HTML_TAG_INIT_CHAR . $actTag . 
  $propStr . HTML_TAG_END_CHAR;
  echo STRING_ESC_RETURN;
 }
}

function putSpanOpenTag(string $actId=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$class) = array(STRING_NULL,STRING_NULL);
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . SPAN_TAG . $id . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putParagraphOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actClass!=STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . PARAGRAPH_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putDivOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actOnClick=STRING_NULL,string $actOnMouseOver=STRING_NULL,
string $actOnMouseOut=STRING_NULL):void
{
 list($id,$style,$class,$onClick,$onMouseOver,$onMouseOut)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actOnClick!==STRING_NULL)
 	$onClick = " onclick=" . HTML_FUN_QUOTE_CHAR . $actOnClick . HTML_FUN_QUOTE_CHAR;
 if($actOnMouseOver!==STRING_NULL)
 	$onMouseOver = " onmouseover=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOver . HTML_FUN_QUOTE_CHAR;
 if($actOnMouseOut!==STRING_NULL)
 	$onMouseOut = " onmouseout=" . HTML_FUN_QUOTE_CHAR . $actOnMouseOut . HTML_FUN_QUOTE_CHAR;

 echo HTML_TAG_INIT_CHAR . DIV_TAG . $id . 
 $style . $class . $onClick . $onMouseOver . 
 $onMouseOut . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putFieldsetOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class) = array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actId !== STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 $stringItem->setItem(HTML_TAG_INIT_CHAR . FIELDSET_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR);
 echo STRING_ESC_RETURN;
}


function putH1OpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . H1_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putH2OpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . H2_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putH3OpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . H3_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putDlOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . DL_TAG . 
 $id . $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putDtOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . DT_TAG . $id . 
 $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putDDOpenTag(string $actId=STRING_NULL,
string $actStyle=STRING_NULL,string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . DD_TAG . $id . 
 $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putAreaOpenTag(string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL,
string $actShape=STRING_NULL,string $actCoords=STRING_NULL,
string $actHRef=STRING_NULL,string $actTarget=STRING_NULL,
string $actNoHRef=STRING_NULL,string $actAlt=STRING_NULL):void
{
 list($id,$style,$class,$shape,$coords,$hRef,$target,$noHRef,$actAlt)=
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,
 STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 if($actShape!==STRING_NULL)
  $shape = " shape=" . HTML_FUN_QUOTE_CHAR . $actShape . HTML_FUN_QUOTE_CHAR;
 if($actCoords!==STRING_NULL)
  $coords = " coords=" . HTML_FUN_QUOTE_CHAR . $actCoords . HTML_FUN_QUOTE_CHAR;
 if($actHRef!==STRING_NULL)
  $hRef = " href=" . HTML_FUN_QUOTE_CHAR . $actHRef . HTML_FUN_QUOTE_CHAR;
 if($actTarget!==STRING_NULL)
  $target = " target=" . HTML_FUN_QUOTE_CHAR . $actTarget . HTML_FUN_QUOTE_CHAR;
 if($actNoHRef!==0)
  $noHRef = " nohref";  
 if($actAlt!==STRING_NULL)
  $alt = " alt=" . HTML_FUN_QUOTE_CHAR . $actAlt . HTML_FUN_QUOTE_CHAR;  
  
 echo HTML_TAG_INIT_CHAR . AREA_TAG . $id . 
 $style . $class . $shape . $coords .
 $hRef . $target . $noHRef . $alt . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}

function putGenericOpenTag(string $actTag,
string $actId=STRING_NULL,string $actStyle=STRING_NULL,
string $actClass=STRING_NULL):void
{
 list($id,$style,$class)=
 array(STRING_NULL,STRING_NULL,STRING_NULL);
 if($actId!==STRING_NULL)
  $id = " id=" . HTML_FUN_QUOTE_CHAR . $actId . HTML_FUN_QUOTE_CHAR;
 if($actStyle!==STRING_NULL)
  $style = " style=" . HTML_FUN_QUOTE_CHAR . $actStyle . HTML_FUN_QUOTE_CHAR;
 if($actClass!==STRING_NULL)
  $class = " class=" . HTML_FUN_QUOTE_CHAR . $actClass . HTML_FUN_QUOTE_CHAR;
 echo HTML_TAG_INIT_CHAR . $actTag . $id . 
 $style . $class . HTML_TAG_END_CHAR;
 echo STRING_ESC_RETURN;
}
?>