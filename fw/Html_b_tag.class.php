<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_b_tag extends Html_tags
{
 static private $boldsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$boldsTotNum++;
 	parent::__construct($actOp,$actNum,EMBOLD_TAG);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$boldsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$boldsTotNum=$actIntNum + 0;
 }
  
}

?>