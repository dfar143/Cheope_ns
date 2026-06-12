<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_label_tag extends Html_tags
{
 static private $labelsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$labelsTotNum++;
 	parent::__construct($actOp,$actNum,LABEL_TAG);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$labelsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$labelsTotNum=$actIntNum + 0;
 }   
}

?>