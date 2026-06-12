<?
namespace Cheope_ns\fw;
require_once("Html_tag.class.php");

class Html_frame_tag extends Html_tag
{
 static private $framesTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$framesTotNum++;
 	parent::__construct($actOp,$actNum,FRAME_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$framesTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$framesTotNum=$actIntNum + 0;
 } 
}

?>