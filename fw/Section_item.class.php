<?
namespace Cheope_ns\fw;
require_once("Array_item.class.php");

class Section_item extends Array_item
{
// const ERROR_1 = "Section_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";
	
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
//   die(self::ERROR_1);
 	 $this->setItem($item);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$sectionName = $this->getName();
 	$itemsCount = count($item);
 	$ret = STRING_SLASH . STRING_SLASH . STRING_SPACE . 
 	$sectionName . STRING_RETURN . STRING_LINE_FEED;
 	for($i=0;$i<=$itemsCount-1;$i++)
 	{
 	 /*echo "item:";
 	 print_r($item[$i]);
 	 echo "<br/>";*/
 	 $ret = $ret . $item[$i]->toString() . 
 	 STRING_RETURN . STRING_LINE_FEED;
  }
 	return $ret;
 }
 
}

?>