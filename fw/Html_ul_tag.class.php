<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_ul_tag extends Html_tags
{
 static private $ulsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$ulsTotNum++; 
 	parent::__construct($actOp,$actNum,UL_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$ulsTotNum;
 }  
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$ulsTotNum=$actIntNum + 0;
 }
 
}

?>