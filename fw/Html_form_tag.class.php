<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_form_tag extends Html_tags
{
 static private $formsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$formsTotNum++;
 	parent::__construct($actOp,$actNum,FORM_TAG);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$formsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$formsTotNum=$actIntNum + 0;
 } 
  
}

?>