<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Namespace_item extends Item
{
 const ERROR_1 = "Namespace_item:Errore nel tipo dell'item inserito.";	
 
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
 
 function tail_add(mixed $actItem):void
 {
 	$item = $this->getItem();
 	if(is_a($actItem,Classes_info::ITEM_CLASS))
 	 $item .= $actItem->toString();
 	else
 	 $item .= $actItem;
 	$this->setItem($item);
 }
 
 function tail_remove(int $actNum):bool
 {
 	$item = $this->getItem();
 	if($actNum > strlen($item) || ($actNum < 0))
   return false;
  $item = substr($item,0, strlen($item)-$actNum);
  $this->setItem($item);
  return true;
 }
 
 function erase():void
 {
 	$item = $this->getItem();
 	$item->erase();
 }
 
 function format($formatStr):Namespace_item
 {
 	$str = $this->getItem();
 	$str = sprintf($formatStr,$str);
 	$this->setItem($str);
 	return $this;
 } 
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	return "namespace" . STRING_SPACE . $item;
 }
 
}

?>