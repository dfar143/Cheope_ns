<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Expr_item extends Item
{ 
 const ERROR_1 = "Expr_item:Errore nel tipo dell'item inserito.";

 function __construct(string $actItem=STRING_NULL)
 {
   parent::__construct($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
 	if(is_string($actItem))
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
 	$ret = STRING_NULL;
 	if(is_string($item))
   $ret = $item;
 	elseif(is_a($item,Classes_info::ITEM_CLASS))
 	 $ret = $item->toString();
 	elseif(is_null($item))
 	 $ret=null;
 	else
 	 $ret = (string)$item;
 	return $ret;
 }
 
}

?>