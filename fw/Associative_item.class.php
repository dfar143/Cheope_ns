<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Associative_item extends Array_item
{
 const ERROR_1 = "Associative_item:Errore nell'aggiunta in coda. La cardinalità dell'Item è max 2.";

 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }

 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 	if(count($item) < 2)
 	 $item[] = $actItem;
  else
   die(self::ERROR_1);
  $this->setItem($item);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$key = trim($item[0]->toString());
 	$value = trim($item[1]->toString());
 	$ret = $key . "=>" . $value;
 	return $ret;
 }
 
}

?>