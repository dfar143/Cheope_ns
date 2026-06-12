<?
namespace Cheope_ns\fw;
require_once("Array_item.class.php");
require_once("Arg_item.class.php");

class Args_list_item extends Array_item
{
 const ERROR_1 = "Arg_list_item:Errore nell'inserimento dell'item. L'oggetto deve essere un Arg_item.";
 
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 	if(is_a($actItem,Classes_info::ARG_ITEM_CLASS))
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
 	$ret = STRING_NULL;
 	$itemsCount = count($item);
 	if($itemsCount>0)
 	{
 	 $ret = $item[0]->toString();
 	 for($i=1;$i<=$itemsCount-1;$i++)
 	 {
 	  $ret = $ret .  STRING_COMMA . trim($item[$i]->toString());     
 	 }
 	} 
 	$ret = $ret . STRING_RETURN . STRING_LINE_FEED;	
 	return $ret;
 }
 
}

?>