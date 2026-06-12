<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Classes_info.class.php");
require_once("Token.class.php");
require_once("Caller.tra.php");
require_once("Creator.tra.php");
require_once("Factory_1.int.php");

class Tokens_container extends Generic_container implements Factory_11
{	
	Use Caller;	
	
	const ERROR_1 = "Tokens_container:Errore nell'inserimento del token nel contenitore.";
	const ERROR_2 = "Tokens_container:Errore nell'aggiunta del token nel contenitore.";
	const ERROR_3 = "Tokens_container:Errore nell'aggiunta dei tokens nel contenitore.";
	
	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setTokens(array $actTokens):void
	{
		foreach($actTokens as $ind=>$token)
		 if(!(is_a($token,Classes_info::TOKEN_CLASS)|| is_null($token)))
	    die(self::ERROR_3);
		parent::setContents($actTokens);
	}
	
	function getTokens():array
	{
 	 $contents = &parent::getContents();
   return $contents;
	}
	
	function setElement(mixed $actItem,string|int $actPos):bool
	{
	 if(is_a($actItem,Classes_info::TOKEN_CLASS))
 	  return parent::setElement($actItem,$actPos);
 	 else
 	  die(self::ERROR_1);
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::TOKEN_CLASS)|| is_null($arg))
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
	
  
  function getToken(string $actTokenName):?Token
  {
   return $this->getOneInSetByName($actTokenName); 
  }
  	
}

?>