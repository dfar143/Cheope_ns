<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class Constructor_call_item extends Array_item
{		
 const ERROR_1 = "Constructor_call_item:Errore negli argomenti.";
// const ERROR_2 = "Constructor_call_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";
	
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
// 	if(is_a($actItem,Classes_info::ITEM_CLASS))
 	 $item[] = $actItem;
//  else
//   die(self::ERROR_2);
 	$this->setItem($item);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$className = $this->getName(); 	
 	$item = $this->getItem();
 	$itemsCount = count($item);
 	$ret=STRING_NULL;
 	if(($itemsCount>0)&&(is_a($item[0],Classes_info::ARG_ITEM_CLASS)))
 	{
 	 if(! is_null($item[0]))	
 	  $ret = trim($item[0]->toString());
 	 elseif($itemsCount==1)
 	  $ret=STRING_NULL;
 	 else
 	  die(self::ERROR_1);
 	  
 	 for($i=1;$i<=$itemsCount-1;$i++)
 	 {
 	 	$ret = $ret . STRING_COMMA . trim($item[$i]->toString());
 	 }
 	}

 	$ret = "new" . STRING_SPACE . $className . 
 	STRING_OPEN_PAR . trim($ret) . STRING_CLOSE_PAR;
 	return $ret;
 }
 
}

?>