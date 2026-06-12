<?
namespace Cheope_ns\fw;
require_once("Html_tag.class.php");

class Html_hr_tag extends Html_tag
{
 static private $hrsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$hrsTotNum++;
 	parent::__construct($actOp,$actNum,LINE_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$hrsTotNum;
 }  
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$hrsTotNum=$actIntNum + 0;
 }
}

?>