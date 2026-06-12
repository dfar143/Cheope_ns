<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Array_item.class.php");

class Function_def_item extends Array_item
{ 
 const ERROR_1 = "Function_def_item:Errore negli argomenti.";
 const ERROR_2 = "Function_def_item:Errore nell'aggiunta in coda dell'Item.La cardinalità deve essere < 2.";
 
 public $retType=STRING_NULL;
 
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
 
 function setRetType(string $actRetType):void
 {
  $this->retType = $actRetType;
 }
 
 function getRetType():string
 {
	return $this->retType;
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$itemsCount = count($item);
 	$functionName = $this->getName();
 	if($itemsCount>1)
 	{ 	
 	 $args = trim($item[0]->toString());	  
 	 for($i=1;$i<=$itemsCount-2;$i++)
 	 {
 	 	$args = $args . STRING_COMMA . trim($item[$i]->toString());
 	 }	
	 $retType = $this->getRetType();
 	 $ret = "function " . $functionName . STRING_OPEN_PAR . 
 	 trim($args) . STRING_CLOSE_PAR . (($retType !== STRING_NULL)?(STRING_COLON . $retType):(STRING_NULL)) .
 	 STRING_RETURN . STRING_LINE_FEED;
 	 $ret = $ret . STRING_OPEN_GRAFF_BRACKET . STRING_RETURN . STRING_LINE_FEED;
 	 $ret = $ret .  trim($item[$itemsCount-1]->toString());      
 	 $ret = $ret . STRING_RETURN . STRING_LINE_FEED . STRING_CLOSE_GRAFF_BRACKET;	
 	}
 	else
 	{	
 	 die(self::ERROR_1);
 	}
 	return $ret;
 }
 
}

?>