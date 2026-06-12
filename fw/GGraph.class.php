<?
namespace Cheope_ns\fw;
require_once("Classes_info.class.php");
require_once("Generic_container.class.php");
require_once("GGraph_iterator.class.php");

class GGraph extends Generic_container
{
 use Creator;	
	
 const ERROR_1 = "GGraph:Errore nell'inserimento del nodo nel grafo.";	
	
 private $name=STRING_NULL;

 function __construct(string $actName)
 {
  parent::__construct($actName);
 }
 
 function getName():string
 {
 	return $this->name;
 }
 	
 function setName(string $actName):void
 {
  $this->name = $actName;
 }		
 
	function setGNodes(array $actGNodes)
	{
		parent::setContents($actGNodes);
	}
	
	function &getGNodes():array
	{
 	 $gNodes = &parent::getContents();
   return $gNodes;
	}
 
 function addNode():void
 {
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::GNODE_CLASS))
	 {
    parent::add($arg);
	 }
	 else
	  die(self::ERROR_1);
 }
 
 function create():Generic_iterator
 {
 	$iter = Creator::create(getClassNameForCreate(Classes_info::GGRAPH_ITERATOR),STRING_NULL,$this);
	return $iter;
 }
 
 function getElementsByNamePartial(string $actName):array
 {
  $objs = array();
  $nameItems = array();
	$i=0;
	$gNodes = &$this->getGNodes();
  for($j=0;$j<=count($gNodes)-1;$j++)
	{
	 $nameItems = explode(VAR_SEP,$gNodes[$j]->getName());
	 if (in_array($actName,$nameItems))
	 {
	  $objs[$i] = $gNodes[$j];
		$i++;
	 } 
	}
	return $objs; 	
 }
 
 function getElementsByName(string $actName):array
 {
  $objs = array();
	$i=0;
	$gNodes = &$this->getGNodes();
	$num = count($gNodes);
  for($j=0;$j<=$num-1;$j++)
	{
	 if ($gNodes[$j]->getName() == $actName)
	 {
	  $objs[$i] = $gNodes[$j];
		$i++;
	 } 
	}
	return $objs;
 }
  
}

?>