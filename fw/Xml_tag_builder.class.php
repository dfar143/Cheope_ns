<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("filesystem.const.php");

class Xml_tag_builder
{
 const XML_VERSION_TB="1.0";
 const XML_ENCODING_TB="ISO-8859-1";
 
 private $tag=STRING_NULL;
 
 function __construct(string $actTag=STRING_NULL)
 {
 	if($actTag != STRING_NULL)
 	 $this->setTag($actTag);
 }
 
 function getProlog():string
 {
 	$xmlProlog = STRING_OPEN_ANGLE_BRACKET . STRING_QUESTION_MARK . XML_ACRONYM . 
 	STRING_SPACE . "version" . STRING_EQUAL . STRING_DOUBLE_QUOTE . self::XML_VERSION_TB . 
 	STRING_DOUBLE_QUOTE . STRING_SPACE . "encoding" . STRING_EQUAL . STRING_DOUBLE_QUOTE . 
 	self::XML_ENCODING_TB . 
 	STRING_DOUBLE_QUOTE . STRING_SPACE . STRING_QUESTION_MARK . STRING_CLOSE_ANGLE_BRACKET;
 	return $xmlProlog;
 } 
 
 function getTag():string
 {
 	return $this->tag;
 }
 
 function setTag(string $actTag):void
 {
 	$this->tag = $actTag;
 }
 
 function cData_open_build():string
 {
 	return "<![CDATA[";
 }
 
 function cData_close_build():string
 {
 	return "]]>";
 }
 
 function tag_open_build(array $actProps=array()):string
 {
 	$tag = $this->getTag();
 	$attribsStr = STRING_NULL;
 	$attribsStr = STRING_OPEN_ANGLE_BRACKET . $tag;
 	foreach($actProps as $ind=>$val)
 	{
 		$attribsStr = $attribsStr . STRING_SPACE . 
 		$ind . STRING_EQUAL . STRING_DOUBLE_QUOTE . 
 		$val . STRING_DOUBLE_QUOTE;
 	} 
 	$attribsStr = $attribsStr . STRING_CLOSE_ANGLE_BRACKET;
 	return $attribsStr;
 }
 
 function tag_close_build():string
 {
 	$tag = $this->getTag();
 	$attribsStr = STRING_NULL;
 	$attribsStr = STRING_OPEN_ANGLE_BRACKET . 
 	STRING_SLASH . $tag . STRING_CLOSE_ANGLE_BRACKET;
 	return $attribsStr; 	
 }
 
}

?>