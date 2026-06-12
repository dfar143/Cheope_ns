<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Generic_iterator.class.php");
require_once("Stringable.int.php");
require_once("Content.int.php");

// Container di elementi ordinati per chiave.
//
class Container_associative implements Stringable,Content
{
//	const ERROR_1 = "Container_associative:Errore nell'inserimento del contenuto nel contenitore associativo";		
	
	private $name=STRING_NULL;
	private $contents = array();
	
	function __construct(string $actName=STRING_NULL)
	{
		$this->name = $actName;
	}
	
	function getName():string
	{
		return $this->name;
	}
	
	function setName(string $actName):void
	{
		$this->name = $actName;
	}
	
	function count():int
	{
		return count($this->contents);
	}
	
	function setContents(array $actContents):void
	{
		$this->contents = $actContents;
	}
	
	function &getContents():array
	{
		return $this->contents;
	}
	
	function setElement($actItem,string $actKey):void
	{
 	  $contents = &$this->getContents();
 	  $contents[$actKey] = $actItem;
 	  $this->setContents($contents);
 	  return true;
	}
	
	function getElement(string $actKey):mixed
	{
	 $contents = &$this->getContents();
	 if(isset($contents[$actKey]))
	 {
 	  return $contents[$actKey];
 	 }
 	 else
 	 {
 	 	$retVal = false;
 	  return $retVal;
	 }
	}
	
	function deleteItem(string $actKey):bool
	{
   $contents = &$this->getContents();
   if(isset($contents[$actKey]))
   {
	  unset($contents[$actKey]);
	  $this->setContents($contents);
	  return true;
	 }
	 else
	  return false;
	}
	
 function create():Generic_iterator
 {
 	$iter = new Generic_iterator($this);
 	return $iter;
 }

  function toString():string
  {
 	 $contents = &$this->getContents();
 	 $str = STRING_NULL;
 	 foreach($contents as $ind=>$val)
 	 {
 		$str .= var_export($val);
 	 }
 	 return $str;
  }
 
  function dump():string
  {
  }

// Ordina i valori
//
 function sort(string $sortType=STRING_NULL):void
  {
  	$contents = &$this->getContents();
 	  if($sortType==STRING_NULL)
  	 $sortType=SORT_REGULAR;
  	$contents = sort($contents,$sortType);
  	$this->setContents($contents);
  }

// Ordina i valori mantenendo le associazioni colle chiavi,tramite funzione
//  
  function uaSort(callable $fun):void
  {
 	  $contents = &$this->getContents();
  	$contents = uasort($contents,$fun);
  	$this->setContents($contents);  	
  }

// Ordina le chiavi,tramite funzione
//  
  function ukSort(callable $fun):void
  {
 	  $contents = &$this->getContents();
  	$contents = uksort($contents,$fun);
  	$this->setContents($contents);  	
  }
  
  function hasValue($actValue):bool
  {
  	$content = &$this->getContents();
  	return in_array($actValue,$content);
  }	
  	
}

?>