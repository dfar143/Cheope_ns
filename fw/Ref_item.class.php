<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Ref_item extends Item
{
 const ERROR_1 = "Ref_item:Errore nel tipo dell'item inserito.";		
	
 function __construct(string $actItem=STRING_NULL)
 {
//  if(is_string($actItem))
   parent::__construct($actItem);
//  else
//   die(self::ERROR_1);
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
 	$ret = trim($item);
 	return $ret;
 }
 
}

?>