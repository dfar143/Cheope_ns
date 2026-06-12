<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_li_tag extends Html_tags
{
 static private $lisTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$lisTotNum++;
 	parent::__construct($actOp,$actNum,LI_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$lisTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lisTotNum=$actIntNum + 0;
 }  
}

?>