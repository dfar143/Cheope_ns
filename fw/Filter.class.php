<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("class.const.php");
require_once("Executable_9.int.php");
require_once("Factory_8.int.php");

abstract class Filter implements Executable_9
{
	private $item;
	
	function __construct()
	{
	}
	
	function setItem(mixed $actItem)
	{
		$this->item = $actItem;
  }
  
  function getItem():mixed
  {
  	return $this->item;
  }
  
}

?>