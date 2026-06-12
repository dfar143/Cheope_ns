<?
namespace Cheope_ns\fw;
require_once("Html_tags.class.php");

class Html_script_tag extends Html_tags
{
 static private $scriptsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$scriptsTotNum++;
 	parent::__construct($actOp,$actNum,SCRIPT_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$scriptsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$scriptsTotNum=$actIntNum + 0;
 }
   
}

?>