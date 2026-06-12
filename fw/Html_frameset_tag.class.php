<?
require_once("Html_tags.class.php");

class Html_frameset_tag extends Html_tags
{
 static private $framesetsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$framesetsTotNum++;
 	if(($actNum === STRING_NULL)&&(Html_tags::$distinctTags))
 	 $actNum = self::$framesetsTotNum - 1; 
 	parent::__construct($actOp,$actNum,FRAMESET_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$framesetsTotNum;
 } 

 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$framesetsTotNum=$actIntNum + 0;
 } 
}

?>