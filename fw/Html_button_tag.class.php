<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_button_tag extends Html_tags
{
 static private $buttonsTotNum=0;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$buttonsTotNum++;
 	parent::__construct($actOp,$actNum,BUTTON_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$buttonsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$buttonsTotNum=$actIntNum + 0;
 }
}

?>