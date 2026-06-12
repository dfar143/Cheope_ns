<?
namespace Cheope_ns\fw;

require_once("Content.int.php");

class Generic_iterator implements \Iterator
{

	private $obj;
	
  function __construct(Content $actObj)
 	{ 
 	   $this->setObj($actObj);
 	}
 	
	function getObj():Content
	{
	 return $this->obj;
	}
	
	function setObj(Content $actObj):void
	{
		$this->obj = $actObj;
	}
 	
 	function count():int
 	{
 	 $obj = $this->getObj();
   $contents = &$obj->getContents();
   return count($contents);
 	}
 	
 	function end():void
 	{
 	 $obj = $this->getObj();
   $contents = &$obj->getContents();
   end($contents);
 	}
 	
 	//
 	// metodo per l'uso tramite foreach
 	//
 	function last():mixed
 	{
 	 $obj = $this->getObj();
   $contents = &$obj->getContents();
	 return end($contents);
 	}

 	//
 	// metodo per l'uso tramite foreach
 	// 	
 	function previous():void
 	{
	 $obj = $this->getObj();
   $contents = &$obj->getContents();
	 prev($contents);
 	}

 	//
 	// metodo per l'uso tramite foreach
 	//	 
 	function next():void
	{
	 $obj = $this->getObj();
   $contents = &$obj->getContents();
	 next($contents);
	}
	
	function reset():void
	{
	 $obj = $this->getObj();
   $contents = &$obj->getContents();
   reset($contents);
	}

 	//
 	// metodo per l'uso tramite foreach
 	//	
	function rewind():void
	{
	 $obj = $this->getObj();
   $contents = &$obj->getContents();
   reset($contents);
	}

 	//
 	// metodo per l'uso tramite foreach
 	//	
	function current():mixed
	{
	 $obj = $this->getObj();
   $contents = &$obj->getContents();
   return current($contents); 
	}
	
	function hasMore():bool
	{
	//	$obj = $this->getObj();
	//	$contents = &$obj->getContents();
	  $nextInt = $this->current();
	  if ($nextInt===false) 
	  {
	   return false;
	  }
	  else
	   return true; 
	}	

 	//
 	// metodo per l'uso tramite foreach
 	//	
	function valid():bool
	{
	 $obj = $this->getObj();
	 $contents = &$obj->getContents();
	 $nextInt = current($contents);
	 if ($nextInt===false) 
	 {
	  return false;
	 }
	 else
	  return true;
	}

 	//
 	// metodo per l'uso tramite foreach
 	//	
	function key():string|int
	{
	 $obj = $this->getObj();
	 $contents = &$obj->getContents();
     return key($contents);
	}
	
	function pos():string|int
 	{
 	 $obj = $this->getObj();
 	 $contents = &$obj->getContents();
     return key($contents);
 	}
}

?>