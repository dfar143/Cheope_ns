<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_p_tag extends Html_tags
{
 static private $psTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$psTotNum++;
 	parent::__construct($actOp,$actNum,PARAGRAPH_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$psTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$psTotNum=$actIntNum + 0;
 }
  
}

?>