<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Generic_db_op.class.php");
require_once("Caller.tra.php");

class Db_ops_container extends Generic_container
{	
	use Caller;
	
  const ERROR_1 = "Db_ops_container:Errore nell'inserimento della Db_op nel contenitore.";
  const ERROR_2 = "Db_ops_container:Errore nell'aggiunta della Db_op nel contenitore.";	
  const ERROR_3 = "Db_ops_container:Errore nell'aggiunta delle Db_ops nel contenitore.";	
	
	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setDbOps(array $actOps):void
	{
		foreach($actOps as $ind=>$op)
	   if(! is_a($op,Classes_info::GENERIC_DB_OP_CLASS))
	    die(self::ERROR_3);		
		parent::setContents($actOps);
	}
	
	function &getDbOps():array
	{
 	 $contents = &parent::getContents();
   return $contents;
	}
	
	function setElement(mixed $actItem,string|int $actKey):bool
	{
	 if(is_a($actItem,Classes_info::GENERIC_DB_OP_CLASS))
    return parent::setElement($actItem,$actKey);
   else
    die(self::ERROR_1);
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::GENERIC_DB_OP_CLASS))
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
  
  function getDbOp(string $actDbOpName):?Generic_db_op
  {
   return $this->getOneInSetByName($actDbOpName);
  }
  	
}

?>