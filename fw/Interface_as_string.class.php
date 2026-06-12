<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

class Interface_as_string 
{
 private $itemName=STRING_NULL;	
	
	function __construct(string $actItemName)
	{	
	 $this->setItemName($actItemName);
	}
	
	function setItemName(string $actItemName):void
	{
	 $this->itemName = $actItemName;
	}
	
	function getItemName():string
	{
	 return $this->itemName;
	}
}


?>