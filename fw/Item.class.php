<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Classes_info.class.php");
require_once("Stringable.int.php");
require_once("IItem.int.php");

class Item implements Stringable,IItem
{
 private $item;
 public $name=STRING_NULL;
 
 function __construct(mixed $actItem)
 {
  $this->setItem($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
   $this->item = $actItem;
 }
 
 function &getItem():mixed
 {
  return $this->item;
 }
 
 function setName(string $actName):void
 {
 	$this->name = $actName;
 }
 
 function getName():string
 {
 	return $this->name;
 }
 
 function toString():string
 {
 	$item = $this->getItem();
 	return var_export($item);
 }
 
 function erase():void
 {
 	$item = &$this->getItem();
 	unset($item);
 }
 
}

?>