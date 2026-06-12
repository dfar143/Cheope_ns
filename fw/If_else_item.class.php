<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Array_item.class.php");

class If_else_item extends Array_item
{
// const ERROR_1 = "If_else_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";
 
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
 	$ret = "if" . STRING_OPEN_PAR . 
 	trim($item[0]->toString()) . STRING_CLOSE_PAR .
 	STRING_RETURN . STRING_LINE_FEED;
 	$ret = $ret .  trim($item[1]->toString());
// 	$ret = $ret . STRING_RETURN . STRING_LINE_FEED . STRING_CLOSE_GRAFF_BRACKET .
 	$ret = $ret . STRING_RETURN . STRING_LINE_FEED;	
 	$itemsCount = count($item);
 	for($i=2;$i<=$itemsCount-2;$i=$i+2)
 	{
 	 $ret = $ret . "elseif" . STRING_OPEN_PAR . 
 	 trim($item[$i]->toString()) . STRING_CLOSE_PAR .
 	 STRING_RETURN . STRING_LINE_FEED;
// 	 $ret = $ret . STRING_OPEN_GRAFF_BRACKET . 
// 	 STRING_RETURN . STRING_LINE_FEED ;
 	 $ret = $ret .  trim($item[$i+1]->toString());
 	 $ret = $ret . STRING_RETURN . STRING_LINE_FEED;     
//   $ret = $ret . STRING_CLOSE_GRAFF_BRACKET .
// 	 STRING_RETURN . STRING_LINE_FEED;	
 	}
 	if($itemsCount - $i > 0)
 	{
 	 $ret = $ret . "else" . STRING_RETURN . STRING_LINE_FEED;
// 	 $ret = $ret . STRING_OPEN_GRAFF_BRACKET . 
// 	 STRING_RETURN . STRING_LINE_FEED ;
 	 $ret = $ret .  trim($item[$i]->toString());     
   $ret = $ret . STRING_RETURN . STRING_LINE_FEED;
//   $ret= $ret  . STRING_CLOSE_GRAFF_BRACKET .
// 	 STRING_RETURN . STRING_LINE_FEED;
  }
 	return $ret;
 }
 
}

?>