<?
namespace Cheope_ns\fw;
require_once("items_require_onces.def.php");
require_once("Stack.class.php");
require_once("Stringable.int.php");

class Item_stack extends Stack implements Stringable
{
 const ERROR_1 = "Item_stack:Errore nell'inserimento di un item.";
 
 function __construct(string $actName=STRING_NULL)
 {
  parent::__construct($actName); 	
 }
 
 function push($actData):void
 {
  $contents = $this->getContents();
  if(is_a($actData,Classes_info::ITEM_CLASS))
  {
   $contents[] = $actData;
   $this->setContents($contents);
 }
 else
   die(self::ERROR_1);
 }
 
 function erase():void
 {
 	$contents = $this->getContents();
 	foreach($contents as $ind=>$val)
 	{
 	 $val->erase();
 	 unset($contents[$ind]);
 	}
 	$this->setContents($contents);
 }
 
 function toString():string
 {
 	$contents = $this->getContents();
 	$str = STRING_NULL;
 	foreach($contents as $ind=>$val)
 	{
 		$str .= $val->toString();
 	}
 	return $str;
 }
 
}

?>