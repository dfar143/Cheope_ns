<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Var_item extends Item
{

 const ERROR_1="Var_item:Errore nel tipo dell'item inserito.";

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
 	if($item != STRING_NULL)
 	 $ret = STRING_DOLLAR . trim($item);
 	return $ret;
 }
 
}

?>