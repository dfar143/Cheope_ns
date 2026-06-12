<?
namespace Cheope_ns\fw;
require_once("Parser.class.php");
require_once("Executable_5.int.php");

abstract class Parser_grammar_rule implements Executable_5
{
	private $name=STRING_NULL;
	private $parser=null;
  
	function __construct(string $actName)
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
	
	function getParser():Parser
	{
		return $this->parser;
	}
	
	function setParser(Parser $actParser):void
	{
		$this->parser = $actParser;
  }
		
}





?>