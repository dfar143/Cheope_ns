<?
namespace Cheope_ns\fw;
require_once("Item.class.php");
require_once("Array_item.class.php");

class Class_def_item extends Item
{	
// const ERROR_1 = "Class_def_item:Errore nell'inserimento dell'oggetto. L'oggetto deve essere un item.";
 public $extendsClass=STRING_NULL;
 
 function __construct(Item $actItem)
 {
   parent::__construct($actItem);
 }
 
 function getExtendsClass():string
 {
 	return $this->extendsClass;
 }
 
 function setExtendsClass(string $actExtendsClass):void
 {
 	$this->extendsClass = $actExtendsClass;
 }
 
 
 function erase():void
 {
 	$item = $this->getItem();
 	$item->erase();
 }
 
 function toString():string
 {
 	//
 	// Non deve passare un riferimento ma una copia.
 	//
 	$item = $this->getItem();
 	$className = $this->getName();
 	$extendsClass = $this->getExtendsClass();
 	$ret = "class" . STRING_SPACE . 
 	$className . STRING_SPACE . "extends" . 
 	STRING_SPACE . $extendsClass .
 	STRING_RETURN . STRING_LINE_FEED .
 	STRING_OPEN_GRAFF_BRACKET . 
 	STRING_RETURN . STRING_LINE_FEED;
 	$ret = $ret .  trim($item->toString());      
  $ret = $ret . STRING_RETURN . STRING_LINE_FEED . 
  STRING_CLOSE_GRAFF_BRACKET . 
 	STRING_RETURN . STRING_LINE_FEED;
 	return $ret;
 }
 
}

?>