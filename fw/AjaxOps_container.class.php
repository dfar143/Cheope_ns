<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Classes_info.class.php");
require_once("AjaxOp.class.php");
require_once("Caller.tra.php");
require_once("Creator.tra.php");

class AjaxOps_container extends Generic_container
{	
	Use Caller,Creator;
	
	const ERROR_1 = "AjaxOps_container:Errore nell'inserimento dell' operazione ajax nel contenitore.";
	const ERROR_2 = "AjaxOps_container:Errore nell'aggiunta dell' operazione ajax nel contenitore.";
	const ERROR_3 = "AjaxOps_container:Errore nell'aggiunta delle operazioni ajax nel contenitore.";

	
	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
  function setOps(array $actOps):void
	{
	  foreach($actOps as $ind=>$op)
	   if(! is_a($op,Classes_info::AJAXOP_CLASS))
      die(self::ERROR_3);
		parent::setContents($actOps);
	}
	
	function &getOps():array
	{
 	 $ops = &parent::getContents();
   return $ops;
	}
	
	function setElement(mixed $actItem,string|int $actPos):bool
	{
	 if(is_a($actItem,Classes_info::AJAXOP_CLASS))
    return parent::setElement($actItem,$actPos);
   else
    die(self::ERROR_1);
	}

	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::AJAXOP_CLASS))
	 {
    parent::add($arg);
	 }
	 else
	  die(self::ERROR_2);
	}
	
	function create():Generic_iterator
	{
		$iter = Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
		return $iter;
	}
	 
  function getOp(string $actOpName):?AjaxOp
  {
   return $this->getOneInSetByName($actOpName);
  }	
}


?>