<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_select_tag extends Html_tags
{
 static private $selectsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$selectsTotNum++;
 	parent::__construct($actOp,$actNum,SELECT_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$selectsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$selectsTotNum=$actIntNum + 0;
 }
  
}

?>