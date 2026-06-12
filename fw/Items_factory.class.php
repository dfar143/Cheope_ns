<?
namespace Cheope_ns\fw;
require_once("items_require_onces.def.php");
require_once("Factory_10.int.php");
require_once("Creator.tra.php");

class Items_factory implements Factory_10
{
	Use Creator_B;
	
	private $itemStr=STRING_NULL;
	
	 function __construct(string $actItemStr)
	 {
	 	$this->setItemStr($actItemStr);
	 }
	
	 function create(mixed $actValues):object
	 {
    $itemStr = $this->getItemStr();      
    $itemStr = $itemStr . VAR_SEP . "item";         
    $item = Creator_B::create_b($itemStr,STRING_NULL,$actValues);
    return $item;
	 }
	 
	 function setItemStr(string $actItemStr):void
	 {
	 	$this->itemStr = $actItemStr;
	 }
	 
	 function getItemStr():string
	 {
	 	return $this->itemStr;
	 }	 
	 
}


?>