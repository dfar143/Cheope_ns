<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Array_item.class.php");

class Method_call_item extends Array_item
{
 const ERROR_1 = "Method_call_item:Errore negli argomenti.";
// const ERROR_2 = "Method_call_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";

 public $instanceName=STRING_NULL;
 public $parent=false;	
 
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
 }
 
 function getParent():string
 {
 	return $this->parent;
 }
 
 function setParent(string $actParent):void
 {
 	$this->parent = $actParent;
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$itemsCount = count($item);
 	if($itemsCount>=1)
 	{
 	 $instanceName = $item[0]->toString();
 	 $methodName = $this->getName();
 	 $ret=STRING_NULL;
 	 if(($itemsCount>1)&&(is_a($item[1],Classes_info::ARG_ITEM_CLASS)))
 	 {
 	  $ret = trim($item[1]->toString()); 	  
 	  for($i=2;$i<=$itemsCount-1;$i++)
 	  {
 	 	 $ret = $ret . STRING_COMMA . trim($item[$i]->toString());
 	  }
 	 }
  }
  else
   die(self::ERROR_1);
  $parent = $this->getParent();
  if(($parent=="true")||($parent=="1"))
   $parent=true;
 	$ret = $instanceName . (($parent)?("::"):"->") . $methodName . 
 	STRING_OPEN_PAR . trim($ret) . STRING_CLOSE_PAR;
 	return $ret;
 }
}

?>