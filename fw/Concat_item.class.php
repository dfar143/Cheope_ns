<?
namespace Cheope_ns\fw;
require_once("Item.php");
require_once("Array_item.php");

class Concat_item extends Array_item
{
// const ERROR_1 = "Concat_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";
	
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 // if(is_a($actItem,Classes_info::ITEM_CLASS))
 	 $item[] = $actItem;
 // else
 //die(self::ERROR_1);
 	$this->setItem($item);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$itemsCount = count($item);
 	$ret = STRING_NULL;
 	if($itemsCount>0)
 	{
 	 $ret = $item[0]->toString();
 	 for($i=1;$i<=$itemsCount-1;$i++)
 	 {
 	  $ret = $ret . " . " . $item[$i]->toString();
   }
  }
 	return $ret;
 }
 
}

?>