<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Array_item.class.php");

class Class_var_item extends Array_item
{
 const ERROR_1 = "Class_var_item:Errore nel numero di componenti.";
 const ERROR_2 = "Class_var_item:Errore nell'aggiunta in coda delliItem.La cardinalità deve essere < 2.";
 	
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 	if(count($item)<2)
 	 $item[] = $actItem;
  else
   die(self::ERROR_2);
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
 	if($itemsCount==1)
 	{
 	 $ret = "var " . trim($item[0]->toString()) . STRING_SEMICOLON;
 	}
 	elseif($itemsCount==2)
 	{
 	 $ret = "var " . trim($item[0]->toString());
 	 $ret = $ret . STRING_EQUAL . trim($item[1]->toString()) 
 	 . STRING_SEMICOLON;
  }
  else
   die(self::ERROR_1);
 	return $ret;
 }
 
}

?>