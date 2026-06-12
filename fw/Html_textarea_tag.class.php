<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_textarea_tag extends Html_tags
{
 static private $textareasTotNum=0;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$textareasTotNum++;
 	parent::__construct($actOp,$actNum,TEXTAREA_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$textareasTotNum;
 }  
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$textareasTotNum=$actIntNum + 0;
 }
 
}

?>