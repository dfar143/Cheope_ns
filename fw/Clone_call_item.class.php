<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Clone_call_item extends Item
{

 const ERROR_1="Clone_call_item:Errore nel tipo dell'item inserito";

 function __construct(Var_item $actItem)
 {
//  if(is_a($actItem,Classes_info::VAR_ITEM_CLASS))
   parent::__construct($actItem);
//  else
//   die(self::ERROR_1);
 }
 
 function setItem(mixed $actItem):void
 {
   if(is_a($actItem,Classes_info::VAR_ITEM_CLASS))
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
 	if($item != STRING_NULL)
 	 $ret = "clone" . STRING_SPACE . $item->toString();
 	return $ret;
 }
 
}

?>