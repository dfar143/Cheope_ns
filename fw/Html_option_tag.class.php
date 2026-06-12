<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_option_tag extends Html_tags
{
 static private $optionsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$optionsTotNum++;
 	parent::__construct($actOp,$actNum,OPTION_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$optionsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$optionsTotNum=$actIntNum + 0;
 }
  
}

?>