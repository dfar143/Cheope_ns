<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Stringable.int.php");
require_once("Creator.tra.php");

class Array_item extends Item 
{
 use Creator;	
	
 const SEP_OPEN_STRING = STRING_NULL;
 const SEP_CLOSE_STRING = STRING_NULL;
 const ERROR_1 = "Array_item:Errore nel tipo dell'item inserito.";
 
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
  if( is_array($actItem))
   parent::setItem($actItem);
  else
   die(self::ERROR_1);
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 	$item[] = $actItem;
 	$this->setItem($item);
 }
 
 function tail_remove(int $actNum):bool
 {
 	$item = $this->getItem();
 	$num = count($item);
 	if($actNum<=$num)
 	{
 	 for($i=1;$i<=$actNum;$i++)
 	  unset($item[$num-$i]);
 	 $this->setItem($item);
 	 return true;
  }
  else
   return false;
 }
 
 function erase():void
 {
 	$items = $this->getItem();
 	foreach($items as $ind=>$val)
 	{
 		$items[$ind]->erase();
 	}
 	$this->setItem($items);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia
 	//
 	$str = STRING_NULL;
 	$item = $this->getItem();
  $sepOpenString = self::SEP_OPEN_STRING;
  $sepCloseString = self::SEP_CLOSE_STRING;
  
 	 foreach($item as $ind=>$val)
 	 {
 	  if(is_a($val,Classes_info::ITEM_CLASS))
 	  {
 		 $str = $str . $sepOpenString . $val->toString() . $sepCloseString;
 	  }
 	  elseif(is_array($val))
 	  {
 	   $newArrayItem = Creator::create(getClassNameForCreate(Classes_info::ARRAY_ITEM_CLASS),STRING_NULL,$val); 
 	   $str = $str . $newArrayItem->toString();
    }
    else
     $str = $str . $sepOpenString . $val . $sepCloseString;
   }
 	 return $str;
 }
 
}

?>