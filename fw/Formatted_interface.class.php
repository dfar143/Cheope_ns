<?
namespace Cheope_ns\fw;
// ************************
// CLASSE OBSOLETA.
// ************************

require_once("Generic_interface.class.php");

abstract class Formatted_interface extends Generic_interface
{
	
	private $dispFields=array();
	
	function __construct(string $actOp,string $actType,$actNum=STRING_NULL)
	{
		parent::__construct($actOp,$actType,$actNum);
	}
	
  function setDispFields(array $actDispFields):void
  {
   $this->dispFields = $actDispFields;
  }
 
  function getDispFields():array
  {
   return $this->dispFields;
  }
	
}

?>