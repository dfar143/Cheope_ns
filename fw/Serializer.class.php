<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Serializable.int.php");
require_once("Items.int.php");

abstract class Serializer implements Serializable,Items
{
	private $fileName=STRING_NULL;
	private $items=array();
	
	function __construct(string $actFileName)
	{
		$this->setFileName($actFileName);
	}
	
	function setFileName(string $actFileName):void
	{
		$this->fileName = $actFileName;
	}
	
	function getFileName():string
	{
		return $this->fileName;
	}
	
	function setItems(array $actItem):void
	{
		$this->items = $actItem;
	}
	
	function getItems():array
	{
		return $this->items;
	}
	
}

?>