<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Cond_item extends Item
{
 const ERROR_1 = "Cond_item:Errore nel tipo dell'item inserito.";
 
 function __construct(string $actItem=STRING_NULL)
 {
//  if(is_a($actItem,Classes_info::ITEM_CLASS)||($actItem==STRING_NULL))
   parent::__construct($actItem);
//  else
//   die(self::ERROR_1);
 }
 
 function setItem(mixed $actItem):void
 {
  if(is_a($actItem,Classes_info::ITEM_CLASS)||($actItem==STRING_NULL))
   parent::setItem($actItem);
  else
   die(self::ERROR_1);
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
 	$ret = $item->toString();
 	return $ret;
 }
 
}

?>