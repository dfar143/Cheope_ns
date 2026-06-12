<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Class_prop_item extends Item
{
  const ERROR_1="Class_prop_item:Errore nel tipo dell'Item inserito.";	

 function __construct(mixed $actItem)
 {
   parent::__construct($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
   if(is_a($actItem,Classes_info::ITEM_CLASS))
    parent::setItem($actItem);
   else
   {
	die(self::ERROR_1);
   }
 }
 
 function erase():void
 {
 	$item = $this->getItem();
 	$item->erase();
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$propName = $this->getName();
 	$ret = STRING_NULL;
 	$ret = trim($item->toString()) . "->" . $propName;
 	return $ret;
 }
 
}

?>