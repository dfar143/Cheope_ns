<?
namespace Cheope_ns\fw;
require_once("Db_items_container.class.php");
require_once("Db_query.class.php");
require_once("Caller.tra.php");

class Queries_container extends Db_items_container
{	
	use Caller;	
	
//  const ERROR_1 = "Queries_container:Errore nell'inserimento della query nel contenitore.";
  const ERROR_2 = "Queries_container:Errore nell'aggiunta della query nel contenitore.";	
	
	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setQueries(array $actQueries):void
	{
		parent::setDbItems($actQueries);
	}
	
	function &getQueries():array
	{
 	 $contents = &parent::getDbItems();
   return $contents;
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::DB_QUERY_CLASS))
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
	
  function getQueryByAliasName(string $actQueryName):Db_query|null
  {
  	$queries = &$this->getQueries();
  	foreach($queries as $query)
  	{
  		if($query->getAliasName()==$actQueryName)
  		{
  			return $query;
  		}
  	}
  	$ret=NULL;
  	return $ret;
  }
  
  function getQuery(string $actQueryName):?Db_query
  {
   return $this->getOneInSetByName($actQueryName);
  }
  	
}

?>