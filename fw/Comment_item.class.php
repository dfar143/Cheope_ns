<?
namespace Cheope_ns\fw;
require_once("Array_item.class.php");

class Comment_item extends Array_item
{
		
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

 	$item = $this->getItem();
 	$itemsCount = count($item);
 	$ret = STRING_SLASH . STRING_STAR . STRING_RETURN . STRING_LINE_FEED;

 	for($i=0;$i<=$itemsCount-1;$i++)
 	{
 	 $ret = $ret . $item[$i]->toString() . 
 	 STRING_RETURN . STRING_LINE_FEED;
  }
 	
 	$ret = $ret . STRING_STAR . STRING_SLASH . STRING_RETURN . STRING_LINE_FEED;
 	return $ret;
 }
 
}

?>