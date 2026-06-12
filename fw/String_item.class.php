<?
namespace Cheope_ns\fw;
require_once("Item.class.php");

class String_item extends Item
{
 const SINGLE_QUOTED = "single_quoted";
 const DOUBLE_QUOTED = "double_quoted";
 const NO_QUOTED = "no_quoted";
 const DEFAULT_QUOTE = self::DOUBLE_QUOTED;
 const ERROR_1 = "String_item:Errore nel tipo dell'item inserito.";

 public $type = self::DEFAULT_QUOTE;	
 
 function __construct(string $actItem=STRING_NULL)
 {
   parent::__construct($actItem);
 }
 
 function setItem(mixed $actItem):void
 {
  if(is_string($actItem))
   parent::setItem($actItem);
  else
   die(self::ERROR_1);
 }
 
 function setType(string $actType):void
 {
 	$this->type = $actType;
 }
 
 function getType():string
 {
 	return $this->type;
 }
 
 function tail_add($actItem):void
 {
 	$item = $this->getItem();
 	if(is_a($actItem,Classes_info::ITEM_CLASS))
 	 $item .= $actItem->toString();
 	else
 	 $item .= $actItem;
 	$this->setItem($item);
 }
 
 function tail_remove($actNum):bool
 {
 	$item = $this->getItem();
 	if($actNum > strlen($item) || ($actNum < 0))
   return false;
  $item = substr($item,0, strlen($item)-$actNum);
  $this->setItem($item);
  return true;
 }
 
 function erase():void
 {
 	parent::setItem(STRING_NULL);
 }
 
 function format(string $formatStr):String_item
 {
 	$str = $this->getItem();
 	$str = sprintf($formatStr,$str);
 	$this->setItem($str);
 	return $this;
 } 
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$type = $this->getType();
 	if($type==self::DOUBLE_QUOTED)
 	 return STRING_DOUBLE_QUOTE . $item . STRING_DOUBLE_QUOTE;
 	elseif($type==self::SINGLE_QUOTED)
 	 return STRING_SINGLE_QUOTE . $item . STRING_SINGLE_QUOTE;
 	else
 	 return $item;
 }
 
}

?>