<?
namespace Cheope_ns\fw;
require_once("Db_items_container.class.php");
require_once("Db_node.class.php");

class Db_nodes_container extends Db_items_container
{
	
  const ERROR_1 = "Db_nodes_container:Errore nell'inserimento del nodo nel contenitore.";
  const ERROR_2 = "Db_nodes_container:Errore nell'inserimento dei nodi nel contenitore.";

	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setDbNodes(array $actDbNodes):void
	{
		foreach($actDbNodes as $ind=>$node)
	   if(! is_a($node,Classes_info::DB_NODE_CLASS))
	    die(self::ERROR_2);		
		parent::setDbItems($actDbNodes);
	}
	
	function &getDbNodes():array
	{
 	 $contents = &parent::getDbItems();
   return $contents;
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::DB_NODE_CLASS))
	 {
    parent::add($arg);
	 }
	 else
	  die(self::ERROR_1);
	}
 
 function isAMNLinkTable(string $actTableName):bool
 {
 	$gNodes = &$this->getDbNodes();
 	foreach($gNodes as $node)
 	{
 		$rels = $node->getRels();
 		foreach($rels as $rel)
 		{
 			if($rel->getLinkTable() == $actTableName)
 			 return true;
 		}
 	}
 	return false;
 }
 
/* function create()
 {
	$iter = Creator::create("Db_items_iterator",STRING_NULL,$this);
	return $iter;
 }*/
}

?>