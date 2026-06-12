<?
namespace Cheope_ns\fw;
require_once("Html_tag.class.php");

class Html_br_tag extends Html_tag
{
 static private $brsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$brsTotNum++;
 	parent::__construct($actOp,$actNum,SEP_TAG);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$brsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$brsTotNum=$actIntNum + 0;
 }
  
}

?>