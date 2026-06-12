<?
namespace Cheope_ns\fw;
require_once("Html_tag.class.php");

class Html_img_tag extends Html_tag
{
 const DEFAULT_BOOTSTRAP_IMG_CLASS = "img-fluid";
	
 static private $imgsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$imgsTotNum++;
 	parent::__construct($actOp,$actNum,IMG_TAG);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$imgsTotNum;
 } 
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$imgsTotNum=$actIntNum + 0;
 }  
 
 function putData():void
 {
 	$class = $this->getCssClass();
 	if($this->getBootstrapEnabled())
 	{
 		$class .= STRING_SPACE . self::DEFAULT_BOOTSTRAP_IMG_CLASS;
 		$this->setCssClass($class);
 	}
 	parent::putData();
 } 
}

?>