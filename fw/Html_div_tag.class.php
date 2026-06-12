<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_div_tag extends Html_tags
{
 static private $divsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$divsTotNum++;
 	parent::__construct($actOp,$actNum,DIV_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$divsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$divsTotNum=$actIntNum + 0;
 }
  
}

?>