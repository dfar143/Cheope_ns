<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Const_item extends Item
{
	
 const ERROR_1="Const_item:Errore nel tipo dell'Item inserito.";	
	
 function __construct(string $actItem)
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
 	$ret = strToUpper($item);
 	return $ret;
 }
 
}

?>