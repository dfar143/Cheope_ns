<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Classes_info.class.php");
require_once("Lex_rule.class.php");
require_once("Caller.tra.php");

class Lex_rules_container extends Generic_container
{
	Use Caller;
	
	const ERROR_1 = "Lex_rules_container:Errore nell'inserimento della regola lessicale nel contenitore.";
	const ERROR_2 = "Lex_rules_container:Errore nell'aggiunta della regola lessicale nel contenitore.";
	const ERROR_3 = "Lex_rules_container:Errore nell'aggiunta delle regole lessicali nel contenitore.";

	
	function __construct(string $actName=STRING_NULL)
	{
   parent::__construct($actName);		
	}
	
 function setLexRules(array $actRules):void
 {
 	foreach($actRules as $ind=>$rule)
	 if(! is_a($rule,Classes_info::LEX_RULE_CLASS))
   {
	  die(self::ERROR_3);
	 }
  parent::setContents($actRules);
 }
 
 function &getLexRules():array
 {
 	$contents = &parent::getContents();
  return $contents;
 }
 
 	function setElement(mixed $actItem,string|int $actPos):bool
	{
	 if(is_a($actItem,Classes_info::LEX_RULE_CLASS))
    return parent::setElement($actItem,$actPos);
   else
    die(self::ERROR_1);
	}

	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::LEX_RULE_CLASS))
	 {
    parent::add($arg);
	 }
	 else
	 {
	 	//ar_dump($arg);
	  die(self::ERROR_2);
	 }
	}
	
 function create():Generic_iterator
 {
	$iter = Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
	return $iter;
 }
 
 function getLexRule(string $actRuleName):?Lex_rule
 {
   return $this->getOneInSetByName($actRuleName);	
 }	
	
}


?>