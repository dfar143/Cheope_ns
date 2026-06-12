<?
namespace Cheope_ns\fw;
require_once("Array_item.class.php");

class Block_def_item extends Array_item
{
// const ERROR_1 = "Block_def_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";

 public $brackets=false;	
	
 function __construct(array $actItem)
 {
   parent::__construct($actItem);
 }
 
 function setBrackets(bool $actBrackets):void
 {
 	$this->brackets=$actBrackets;
 }
 
 function getBrackets():bool
 {
 	return $this->brackets;
 }
 
 function tail_add(Item $actItem):void
 {
 	$item = $this->getItem();
 	$item[] = $actItem;
 	$this->setItem($item);
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$itemsCount = count($item);
 	$brackets = $this->getBrackets();
 	if($brackets)
 	 $ret = STRING_OPEN_GRAFF_BRACKET . STRING_RETURN . STRING_LINE_FEED;
 	else
 	 $ret = STRING_NULL;
 	for($i=0;$i<=$itemsCount-1;$i++)
 	{
 	 $ret = $ret . $item[$i]->toString() . 
 	 STRING_RETURN . STRING_LINE_FEED;
  }
 	if($brackets)
 	 $ret = $ret . STRING_CLOSE_GRAFF_BRACKET . STRING_RETURN . STRING_LINE_FEED;
 	return $ret;
 }
 
}

?>