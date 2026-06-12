<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_ol_tag extends Html_tags
{
 static private $olsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$olsTotNum++; 
 	parent::__construct($actOp,$actNum,OL_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$olsTotNum;
 }  
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$olsTotNum=$actIntNum + 0;
 }
}

?>