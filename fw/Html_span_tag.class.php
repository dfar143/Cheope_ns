<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_span_tag extends Html_tags
{
 static private $spansTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$spansTotNum++;
 	parent::__construct($actOp,$actNum,SPAN_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$spansTotNum;
 }  
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$spansTotNum=$actIntNum + 0;
 }
 
}

?>