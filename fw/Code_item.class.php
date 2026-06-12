<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Code_item extends Item
{
 function __construct(string $actItem=STRING_NULL)
 {
   parent::__construct($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
   parent::setItem($actItem);
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
 	elseif(is_object($item))
 	 $ret = $item->toString();
 	elseif(is_null($item))
 	 $ret=null;
 	else
 	 $ret = (string)$item;
 	return $ret;
 }
 
}

?>