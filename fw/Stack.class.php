<?
namespace Cheope_ns\fw;
require_once("Classes_info.class.php");
require_once("Memory_dumper.class.php");
require_once("Echo_dumper.class.php");
require_once("File_dumper.class.php");
require_once("Stringable.int.php");
require_once("Content.int.php");
require_once("Factory_11.int.php");
require_once("Generic_iterator.class.php");
require_once("Creator.tra.php");

class Stack implements Stringable,Content,Factory_11
{
 const ERROR_1 = "Stack:Errore nell'impostazione del dumper.";
	
 private $name=STRING_NULL;
 private $contents=array();
 private $dumper=null;
  
 function __construct(string $actName=STRING_NULL)
 {
  $this->name = $actName; 	
 }
 
 function setDumper(Dumper $actDumper):void
 {
 	 $this->dumper = $actDumper;
 }
 
 function getDumper():Dumper
 {
 	return $this->dumper;
 }
 
 function setContents(array $actContents):void
 {
  $this->contents = $actContents;
 }
 
 function &getContents():array
 {
  return $this->contents;
 }
 
 function push(mixed $actData):void
 {
  $contents = &$this->getContents();
  $contents[] = $actData;
  $this->setContents($contents);
 }
 
 function pop():mixed
 {
 	 $contents = &$this->getContents();
 	 $item = $contents[count($contents)-1];
 	 unset($contents[count($contents)-1]);
 	 $this->setContents($contents);
   return $item;	
 }
 
 function erase():void
 {
 	$contents = &$this->getContents();
 	foreach($contents as $ind=>$val)
 	{
 	 unset($contents[$ind]);
 	}
 	$this->setContents($contents);
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
 	$dumper = $this->getDumper();
 	$dumper->setObj($this);
 	return $dumper->dump();
 }
 
 function flush():string
 {
 	$dumper = $this->getDumper();
 	$dumper->setObj($this);
 	$str = $dumper->dump();
 	$this->erase();
 	return $str;
 }
 
  function create():Generic_iterator
 {
 	return Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
 }
 
}

?>