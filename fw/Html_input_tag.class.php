<?
namespace Cheope_ns\fw;
require_once("Html_tag.class.php");

class Html_input_tag extends Html_tag
{
 static private $inputsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$inputsTotNum++;
 	parent::__construct($actOp,$actNum,INPUT_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$inputsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$inputsTotNum=$actIntNum + 0;
 }  
}

?>