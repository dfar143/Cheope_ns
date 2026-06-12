<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_a_tag extends Html_tags
{
 static private $anchorsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$anchorsTotNum++;
 	parent::__construct($actOp,$actNum,ANCHOR_TAG);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$anchorsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$anchorsTotNum=$actIntNum + 0;
 }
  
}

?>