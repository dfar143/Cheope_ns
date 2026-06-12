<?
namespace Cheope_ns\fw;
require_once("GGraph.class.php");
require_once("Db_items_iterator.class.php");

class Db_items_container extends GGraph
{
	use Creator;
	
  const ERROR_1 = "Db_items_container:Errore nell'aggiunta del db_item nel contenitore.";
  const ERROR_2 = "Db_items_container:Errore nell'aggiunta dei db_items nel contenitore.";

	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setDbItems(array $actDbItems):void
	{
	 foreach($actDbItems as $ind=>$dbItem)
	 if(! is_a($dbItem,Classes_info::DB_ITEM_CLASS))
	  die(self::ERROR_2);
	 parent::setGNodes($actDbItems);
	}
	
	function &getDbItems():array
	{
	 $gNode = &parent::getGNodes();
	 return $gNode;
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::DB_ITEM_CLASS))
	 {
    parent::addNode($arg);
	 }
	 else
	 die(self::ERROR_1);
	}
	
 function create():Generic_iterator
 {
	$iter = Creator::create(getClassNameForCreate(Classes_info::DB_ITEMS_ITERATOR_CLASS),STRING_NULL,$this);
	return $iter;
 }
	
 function getElementByAliasName(string $actAliasName):?Db_item
 {
	$i=0;
 	$gNodes = &$this->getGNodes();
	$num = count($gNodes);
  for($j=0;$j<=$num-1;$j++)
	{
	 if ($gNodes[$j]->getAliasName() == $actAliasName)
	 {
	  $obj = $gNodes[$j];
		return $obj;
	 } 
	}
	return null;
 }
	
}


?>