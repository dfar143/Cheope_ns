<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Stringable.int.php");
require_once("Content.int.php");
require_once("Generic_iterator.class.php");
require_once("Creator.tra.php");
require_once("Factory_11.int.php");

// Container di elementi ordinati per indice numerico.
//
class Generic_container implements Stringable,Content,\IteratorAggregate,Factory_11,\Serializable
{
	Use Creator;
	
	const ERROR_1 = "Generic_container:Errore nell'inserimento del contenuto nel contenitore.";
	const ERROR_2 = "Generic_container:Errore cancellazione contenuto nel contenitore associativo.";	
	const ERROR_3 = "Generic_container:Errore cancellazione contenuto nel contenitore.";
	
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
	
	function insert(mixed $actItem,int $actPos):bool
	{
		$contents = $this->getContents();
		$newContent = array();
		$num = count($contents);
		if(($actPos < count($contents)) && ($actPos >= 0))
		{
		 for($i=0;$i<=$actPos-1;$i++)
		 {
	   	if(isset($contents[$i]))
			 $newContent[$i] = $contents[$i];
			else
			 die(self::ERROR_1);
	   }
	   $newContent[$i] = $actItem;
	   for($j=1;$j<=($num-$actPos);$j++)
	   {
	   	if(isset($contents[$i+$j-1]))
	     $newContent[$i+$j] = $contents[$i+$j-1];
	    else
	     die(self::ERROR_1);
	   }
	   $this->setContents($newContent);
	   return true;
	  }
	  else
	   return die(self::ERROR_1);
  }
	
	function setElement(mixed $actItem,string|int $actKey):bool
	{
		if(is_string($actKey))
		{
 	   $contents = $this->getContents();
 	   $contents[$actKey] = $actItem;
 	   $this->setContents($contents);
 	   return true;
		}
		else
		{
		 $actPos = $actKey;
 	   $contents = $this->getContents();
 	   if(($actPos < count($contents)) && ($actPos >= 0))
 	   {
 	    $contents[$actPos] = $actItem;
 	    $this->setContents($contents);
 	    return true;
 	   }
 	   else
 	    return false;
 	  }
	}
	
	function getElement(string $actKey):mixed
	{
	 $contents = $this->getContents();
	 if(is_string($actKey))
	 {
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
	 else
	 {
 	  $actPos = $actKey;
 	  if(($actPos < count($contents)) && ($actPos >= 0))
 	  {
 	   return $contents[$actPos];
 	  }
 	  else
 	   return false;
 	  }
	}
	
	function add():void
	{
    $contents = &$this->getContents();
	  foreach(func_get_args() as $arg)	  
	   $contents[] = $arg;
	 // $this->setContents($contents);
	}
	
	function getIndex(mixed $actItem):int
	{
	 $contents = $this->getContents();
     $i=0;	 
     foreach($contents as $item)
     {
	  if($item === $actItem)
		return $i;
	  $i++;
	 }	
     return $i;	 
	}
	
	function deleteItem(string|int $actKey):bool
	{
   $contents = $this->getContents();   
   if(is_string($actKey))
   {
	//echo "W";
    if(isset($contents[$actKey]))
    {
	   unset($contents[$actKey]);
	   $this->setContents($contents);
	   return true;
	  }
	  else
	   die(self::ERROR_2);
   }
   else
   {
	 // echo "Q";
   	$actPos = $actKey;
    $num = count($contents);
    if(($actPos <= $num-1)&&($actPos >= 0))
    {
	  //unset($contents[$actPos]);
	   for($i=$actPos;$i<=$num-1;$i++)
	   {
	    $j=$i+1;
	    if($j<=$num-1)
	    {
	     if(isset($contents[$i]) && isset($contents[$j]))
	      $contents[$i]=$contents[$j];
	     else
	      die(self::ERROR_3);
	    }
	    else
	    {
	     if(isset($contents[$i]))
	      unset($contents[$i]);
	     else
	      die(self::ERROR_3);
	    }
	   }
	   $this->setContents($contents);
	  }
	  else
	   return false;
	 }
	 return true;
	}
	
 function create():Generic_iterator
 {
 	$iter = Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
 	return $iter;
 }
 
 function getIterator():\RecursiveArrayIterator
 {
 	$array = &$this->getContents();
 	return Creator::create("RecursiveArrayIterator",STRING_BACKSLASH,$array);
 }
	
  function toString():string
  {
 	 return get_class($this);
  }
 
  function dump():string
  {
  }

// Ordina i valori
//  
  function sort(string $sortType=STRING_NULL):void
  {
  	$contents = $this->getContents();
  	if($sortType==STRING_NULL)
  	 $sortType=SORT_REGULAR;
  	$contents = sort($contents,$sortType);
  	$this->setContents($contents);
  }

// Ordina i valori tramite funzione
//  
  function uSort(callable $fun):void
  {
 	$contents = $this->getContents();
  	$contents = usort($contents,$fun);
  	$this->setContents($contents);  	
  }
  
  function hasValue(mixed $actValue):bool
  {
  	$content = $this->getContents();
  	return in_array($actValue,$content);
  }	
  
 function serialize():void
 { 
 	serialize([$this->name,$this->contents]);
 }
 
 function unserialize(mixed $actData):void
 {
 	unserialize($actData);
 }    
  
}

?>